 //globals update
 function updateglobals(elem){ 
  if(elem.is('.global')){
  var glob = elem.children().eq(0).parents('.global');
  } else{
  var glob = elem.parents('.global'); 
  }
  
glob.each(function(){
  var gid = $(this).attr('id');
        globals[gid]['content'] = $('<div>').append($(this).clone().removeHelpers()).html();
        f('.global[id="'+gid+'"]').not($(this)).replaceWith($(this).clone());  
});

  if(glob.length > 0){
    columnResize(f('.sitekly-container'));
  }

 }
 function globalsInit(){
  $('.z-addel-con.globals').html('');  
  if(!globals){
  globals = {};   
} else{

    for (var key in globals) {

     $('.z-addel-con.globals').prepend('<div class="z-elad '+globals[key]['type']+'" data-id="'+key+'"><span class="label">'+globals[key]['name']+'</span><span class="g-edit"></span></div>');
    }

}  
 }
 function updateGlobalsAll(page){
    page.find('.global').each(function(){
     if(isset(globals[$(this).attr('id')])){
      $(this).replaceWith($(globals[$(this).attr('id')]['content']).clone());   
     } else{
        $(this).remove();
     }   
    });
    
    if(allmenus){
    page.find(".z-menu").each(function(){
    var m = allmenus.find('menu#'+$(this).data('id'));
 $(this).find('ul.nav').html(setNav(m).html()); 
});
}
    
    
    return page;
 }

 function globalsClean(){
   for (var key in globals) {
 var gl = $('<div>').append(globals[key]['content']);
 cleanPublish(gl);
 globals[key]['content'] = gl.html();
// updateGlobalsAll(p);  
 
 
} 
 }
 
  $(document).on('afterHide', "#globals.wcontrol", function(event){
 $('.z-addel-tabs div').eq(1).click();
 for (var key in globals) {
    globals[key]['name'] = $('.z-addel-con.globals').children(".z-elad[data-id='"+key+"']").find('.label').text();
}
});
$(document).on('repeater:AfterDelete', "#globals.wcontrol", function(e){
for (var key in globals) {
    if($('.z-addel-con.globals').children(".z-elad[data-id='"+key+"']").length != 1){
      delete globals[key];
      manageCss($('<div class="sitekly-block" id="'+key+'">'),'d');
      f('.sitekly-container .global#'+key).remove();
    }
}
});