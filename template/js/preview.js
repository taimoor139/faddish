$(document).ready(function(){
    $(".cform form").submit(function(e) {
    e.preventDefault();
    alert(previewModeInfo);
    return false;
    });
});