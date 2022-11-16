function dynamicPlaceholders(){ 
    var pex = {};

    var pages = epages();
    
    $.each( pages, function( key, data ) {

     var page = $(data['content']);
     data['dynamic'] = {};
     
        var dwidgets = page.find('.dynamic-widget');
        
        dwidgets.each(function(){
           var config = $(this).children('.z-content').text(); 
          if(isJson(config)){ 
            var jconfig = JSON.parse(config);
            var fid = "replace-"+makeid(8);
            if(!isset(data['dynamic'][jconfig['type']])){
                data['dynamic'][jconfig['type']] = {};
            }
           data['dynamic'][jconfig['type']][fid] = config;
           $(this).children('.z-content').html(fid);
           }
        }); 
        
        data['content'] = $('<div>').prepend(page).html();    

    });
    

    return pages;    
}


function getDynamicReady(){

var data = {
"dynamicpages": JSON.stringify(dynamicPlaceholders()),
}
allpages.find('#'+blockpage).remove();
$.extend( expdata, data );

}