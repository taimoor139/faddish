<?php

require 'config.php';
require 'images.php';

$manager = new manager();

echo json_encode($manager->run());

class manager
{
    protected $allowedMethods = ['upload', 'resize', 'thumbs', 'deleteFile', 'deleteDirectory', 'listImages', 'listAll', 'copyRemote', 'space', 'setStatus', 'renameDir', 'install'];
    protected $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    protected $request;
    protected $base;
    protected $error;
    protected $config;
    public function run()
    {
        $this->request = $_POST;
        $this->config = new Config();
        if (!isset($this->request['secret']) || $this->request['secret'] != $this->config->secret) return ['error' => 'Authorization failed'];

        $this->base = __DIR__ . '/';

        if (!$this->required(['action'])) return $this->error;

        if (!in_array($this->request['action'], $this->allowedMethods)) return ['error' => 'wrong action'];

        $method = $this->request['action'];
        return $this->$method();
    }

    protected function upload()
    {
        if (!$this->required(['directory', 'filename', 'file'])) return $this->error;

        if (!$this->extension($this->request['filename'])) return $this->error;

        $path = $this->base . $this->request['directory'];

        if (!$this->checkDir($path)) return $this->error;

        $filepath = $path . '/' . $this->request['filename'];
        $thumb = $path . '/systhumb/' . $this->request['filename'];


        try {
            $image = new \claviska\SimpleImage();
            file_put_contents($filepath, $this->request['file']); //_mod
            $image->fromFile($filepath)->toFile($filepath, null, 75)->resize(350)->toFile($thumb, null, 75); //_mod
        } catch (Exception $err) {
            //   print_r($err);
            return ['error' => 'image transform'];
        }

        return $this->imageData($filepath, $this->request['directory'], $this->request['filename']);
    }

    protected function deleteFile()
    {
        if (!$this->required(['directory', 'filename'])) return $this->error;


        $path = $this->base . $this->request['directory'];


        $filepath = $path . '/' . $this->request['filename'];
        $thumb = $path . '/systhumb/' . $this->request['filename'];
        unlink($filepath);
        unlink($thumb);
    }

    protected function deleteDirectory()
    {
        if (!$this->required(['directory'])) return $this->error;

        $path = $this->base . $this->request['directory'];

        $this->deleteDir($path);
    }

    protected function resize()
    {
        if (!$this->required(['directory', 'filename', 'newname', 'width'])) return $this->error;


        if (!$this->extension($this->request['filename'])) return $this->error;
        if (!$this->extension($this->request['newname'])) return $this->error;

        $path = $this->base . $this->request['directory'];

        if (!$this->checkDir($path)) return $this->error;

        $filepath = $path . '/' . $this->request['filename'];
        $newfilepath = $path . '/' . $this->request['newname'];

        $thumb = $path . '/systhumb/' . $this->request['filename'];
        $newthumb = $path . '/systhumb/' . $this->request['newname'];


        try {
            $image = new \claviska\SimpleImage();
            if (isset($this->request['height'])) {
                if (!$this->required(['x', 'y'])) return $this->error;
                $x1 = $this->request['x'];
                $x2 = $this->request['x'] + $this->request['width'];
                $y1 = $this->request['y'];
                $y2 = $this->request['y'] + $this->request['height'];
                $image->fromFile($filepath)->crop($x1, $y1, $x2, $y2)->toFile($newfilepath, null, 75)->resize(350)->toFile($newthumb, null, 75);
            } else {
                $image->fromFile($filepath)->resize($this->request['width'])->toFile($newfilepath, null, 75)->resize(350)->toFile($newthumb, null, 75);
            }
            if ($this->request['replace']) {
                $this->deleteFile();
            }
        } catch (Exception $err) {
            return ['error' => 'image transform'];
            //echo $err->getMessage();
        }


        return $this->imageData($newfilepath, $this->request['directory'], $this->request['newname']);
    }

    protected function thumbs()
    {

        if (!$this->required(['directory', 'files'])) return $this->error;

        $path = $this->base . $this->request['directory'];
        $this->deleteDir($path . '/thumbs/');

        if (!$this->checkDir($path)) return $this->error;

        $files = json_decode($this->request['files'], true);
        $image = new \claviska\SimpleImage();

        foreach ($files as $file) {

            if (!$this->extension($file['file'])) {
                continue;
            };


            $size = (int)$file['width'];

            if (!$size > 0) continue;


            if ($this->createDir($path . '/thumbs/' . $size)) {

                try {
                    $image->fromFile($path . '/' . $file['file'])->resize($size)->toFile($path . '/thumbs/' . $size . '/' . $file['file'], null, 75);
                } catch (Exception $err) {
                    return $err->getMessage();
                    return ['error' => 'image transform'];
                }
            }
        }

        return true;
    }


    protected function listImages()
    {
        if (!$this->required(['directory'])) return $this->error;
        $path = $this->base . $this->request['directory'];
        $urlPath = $this->config->baseUrl . '/' . $this->request['directory'] . '/';
        $files = array_filter(scandir($path), function ($item) use ($path) {
            return !is_dir($path . '/' . $item);
        });
        $images = [];
        foreach ($files as $k => $file) {
            //	$images[] = $urlPath.$file;
            if ($file == '.htaccess') continue;
            $images[] = $this->imageData($path . '/' . $file, $this->request['directory'], $file);
        }
        return ['links' => $images];
    }


    protected function listAll(&$list = [], $dir = null)
    {
        if (!$dir) {
            if (!$this->required(['directory'])) return $this->error;
            $dir = $this->request['directory'];
        }

        $urlPath = $this->config->baseUrl . '/' . $dir . '/';


        $ffs = scandir($dir);
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if (count($ffs) < 1)
            return;


        foreach ($ffs as $ff) {
            $path = $dir . '/' . $ff;
            $path = substr($path, strpos($path, '/', 1) + 1);

            if (is_dir($dir . '/' . $ff)) {
                $list['dirs'][] = $path;

                $this->listAll($list, $dir . '/' . $ff);
            } else {

                $list['files'][] =  $path;
            }
        }
        $list['base'] = $this->config->baseUrl . '/' . $this->request['directory'] . '/';
        return $list;
    }

    protected function copyRemote()
    {

        if (!$this->required(['directory', 'list'])) return $this->error;

        $path = $this->base . $this->request['directory'] . '/';

        if (!$this->checkDir($path)) return $this->error;

        $list = json_decode($this->request['list'], true);
        foreach ($list['dirs'] as $dir) {

            if (!$this->createDir($path . $dir)) return false;
        }

        $ch = curl_init();
        foreach ($list['files'] as $file) {
            if (!$this->extension($file)) return $this->error;

            curl_setopt($ch, CURLOPT_URL, $list['base'] . $file);


            $fp = fopen($path . $file, "w");

            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            curl_exec($ch);

            fclose($fp);
        }
        curl_close($ch);
    }

    protected function space()
    {
        if (!$this->required(['directory'])) return $this->error;
        $path = $this->base . $this->request['directory'] . '/';

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path)
        );

        $totalSize = 0;
        foreach ($iterator as $file) {
            $totalSize += $file->getSize();
        }

        return ['used' => $totalSize / 1000000];
    }

    protected function setStatus()
    {
        if (!$this->required(['directory', 'expire', 'status'])) return $this->error;
        $file = $this->base . $this->request['directory'] . '/.htaccess';
        if ($this->request['status'] == 0) {
            $content = "RewriteEngine On\nRewriteRule ^ /blocked.jpg [L]";
        } else {
            $date = date("YmdHis", $this->request['expire']);
            echo $date;
            $content = "RewriteEngine On\nRewriteCond %{TIME_YEAR}%{TIME_MON}%{TIME_DAY}%{TIME_HOUR}%{TIME_MIN}%{TIME_SEC} >" . $date . "\nRewriteRule ^ /expired.jpg [L]";
        }
        if (file_put_contents($file, $content) !== false) {
            return ['status' => 'ok'];
        }
        return ['status' => 'fail'];
    }

    protected function renameDir()
    {
        if (!$this->required(['old', 'new'])) return $this->error;
        if (rename($this->base . $this->request['old'], $this->base . $this->request['new'])) {
            return ['status' => 'ok'];
        }
        return ['status' => 'fail'];
    }

    protected function install()
    {

        if (!$this->required(['replace'])) return $this->error;
        if ($this->config->secret == '{media-secret}') {
            $path = $this->base . 'config.php';
            $content = file_get_contents($path);
            if (!$content) return ['error' => "can't read config file"];
            foreach ($this->request['replace'] as $k => $v) {
                $content = str_replace('{' . $k . '}', $v, $content);
            }
            file_put_contents($path, $content);
            return ['status' => 'ok'];
        }
    }


    protected function required($fields)
    {
        foreach ($fields as $field) {
            if (!isset($this->request[$field])) {
                $this->error = ['error' => 'missing ' . $field];
                return false;
            }
        }
        return true;
    }


    protected function extension($filename)
    {

        if (!in_array(pathinfo($filename, PATHINFO_EXTENSION), $this->allowedExtensions)) {
            $this->error = ['error' => 'wrong type' . $filename . 'dd'];
            return false;
        }
        return true;
    }

    protected function checkDir($path)
    {
        if (!$this->createDir($path)) return false;
        if (!$this->createDir($path . '/systhumb')) return false;
        if (!$this->createDir($path . '/thumbs')) return false;
        return true;
    }

    protected function createDir($path)
    {
        if (!is_dir($path)) {
            if (!mkdir($path)) {
                $this->error = ['error' => 'can\'t create directory'];
                return false;
            }
            return true;
        }
        return true;
    }

    protected function imageData($filepath, $directory, $filename)
    {

        $size = number_format((float)filesize($filepath) / 1024, 2, '.', '');
        list($width) = getimagesize($filepath);

        return [
            'file' => $this->config->baseUrl . '/' . $directory . '/' . $filename,
            'thumb' => $this->config->baseUrl . '/' . $directory . '/systhumb/' . $filename,
            'size' => $size,
            'width' => $width
        ];
    }


    protected function deleteDir($path)
    {
        if (!file_exists($path)) {
            return true;
        }

        if (!is_dir($path)) {
            return unlink($path);
        }

        foreach (scandir($path) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDir($path . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($path);
    }
}
