<?php
if(is_file('style.css')) die('File already exist');
ob_start();
?>
<?php echo file_get_contents('reset.css') ?>
<?php echo file_get_contents('main.css') ?>

<?php echo file_get_contents('responsive/lg.css') ?>

@media only screen and (max-width: 75em) {
<?php echo file_get_contents('responsive/md.css') ?>
}
@media only screen and (max-width: 62em) {
 <?php echo file_get_contents('responsive/sm.css') ?>   
}
@media only screen and (max-width: 48em) {
 <?php echo file_get_contents('responsive/xs.css') ?>   
}

@media only screen and (max-width: 47.999999em) {
<?php echo file_get_contents('responsive/noinherit/xs.css') ?>
}

@media only screen and (min-width: 48em) and (max-width: 61.999999em) {
<?php echo file_get_contents('responsive/noinherit/sm.css') ?>
}

@media only screen and (min-width: 62em) and (max-width: 74.999999em) {
<?php echo file_get_contents('responsive/noinherit/md.css') ?>
}

@media only screen and (min-width: 75em) {
<?php echo file_get_contents('responsive/noinherit/lg.css') ?>
}
<?php echo file_get_contents('custom.css') ?>

<?php
$style = ob_get_clean();
file_put_contents('style.css',$style);
 ?>
