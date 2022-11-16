function vidtype(pop,el,elem,inp){
    var con = inp.closest('.intabcon');
    var mute = con.find('.mute');
 var src = elem.attr('data-href');
  if(src.indexOf('youtube.com') !== -1){
  inp.val('yt');
  } else{
  inp.val('vim');  
  }
  
  if(con.find('.auto').is(":checked")){
    mute.addClass('disable');
   if(!mute.is(":checked")){
    mute.prop('checked',1).change();
   }
  } else{
    mute.removeClass('disable');
  }
  
  altcons(inp);
}
function vidtypes(pop,el,elem,inp){
vidtype(pop,el,elem,inp);    
fcw(elem).trigger('change');
}