function cleanPublish(p){
  
p.find('.video iframe').attr("src",""); 
p.removeHelpers();
p.find('.ui-resizable').removeClass('ui-resizable');
p.find('.nav a').removeClass('active');
p.find('.ui-resizable-handle').remove();
p.find(".accordion .item").removeClass('active').children('.body').hide();
p.find(".accordion.expand").find('.item:first').addClass('active').children('.body').show();
p.find("*").removeAttr("data-mce-style"); 
p.find('.autoInhelp').removeClass('inhelp-item');

//updateGlobalsAll(p);  
}
var thumbs = [];
function getThumbs(p){
    p.find('.gallery').each(function(){
        var size = parseInt($(this).data('thumb') );
        if(size > 0){
            $(this).find('.img').each(function(){
                
               var url = url2src($(this).css('background-image'));
               if(url == 'none' || url.length == 0){
                    url = $(this).attr('src');
               }
               var base = url.split("/"+mediaDir+"/")[0];
               var file = url.split('/').slice(-1)[0];
               
               var thumbUrl = base+"/"+mediaDir+"/thumbs/"+size+"/"+file;
               var imageUrl = base+"/"+mediaDir+"/"+file;
               console.log(thumbUrl);
              $(this).attr('style','').attr('src',imageUrl).attr('data-tsrc',thumbUrl);
             //  $(this).attr('src',imageUrl).attr('data-tsrc',thumbUrl);

               thumbs.push({'file':file,'width':size});
            });
        }   
    })
}