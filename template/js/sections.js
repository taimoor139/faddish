    var exportLinks = ['/template/line-awesome/1.3.0/css/line-awesome.min.css','/template/css/animate.min.css'];
    exportLinks.forEach(function (item, index) {
    var tag = document.createElement('link');
    tag.href = exportBase+item;
    tag.rel = 'stylesheet';
    document.getElementsByTagName('body')[0].appendChild(tag);
        });
        
        
      window.onload = function() {
    if (window.jQuery) {  
        loadExportJS();
    } else {
        var tag = document.createElement('script');
        tag.src = exportBase+'/template/js/jquery.js';
        document.getElementsByTagName('body')[0].appendChild(tag);
        tag.onload = function() { loadExportJS() }
    }
}  
        
        
     function loadExportJS(){
      var exportScripts = ['//f.vimeocdn.com/js/froogaloop2.min.js',exportBase+'/template/js/site.js'];
            exportScripts.forEach(function (item, index) {
            var tag = document.createElement('script');
            tag.src = item;
            document.getElementsByTagName('body')[0].appendChild(tag);
        });  
     }   