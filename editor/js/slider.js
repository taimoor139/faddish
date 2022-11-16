//slider
$(document).on('mousedown', "#slider .control.edit",  function(){ 

var ind = $(this).closest('.repeater').index();
    prevElem = cselem;
    customObject = cselem.find('.slide').eq(ind);
    customObject.addClass('current').show().siblings().removeClass('current').hide();
    fcw(customObject).trigger('showslide');
    
});

$(document).on('repeater:AfterDelete', "#slider.wcontrol", function(event,item){
    manageCss($(item).clone(),'d');

});

$(document).on('repeater:AfterClone', "#slider.wcontrol", function(event,nitem){
var item = $(nitem).prev();
nitem.remove();

manageCss(item.clone(),'c').insertAfter(item).removeClass('current').hide();
updateglobals(item.parent().closest('.global'));
columnResize(item.parent());

});
//carousel
$(document).on('repeater:AfterClone repeater:AfterDelete', "#carousel.wcontrol", function(event,nitem){

if(event.type == 'repeater:AfterClone'){
var item = $(nitem).prev();
nitem.remove();
cloneItem(item);
item.next().removeClass('active');
}
var i = f('.carousel.active .dot.active').index();
fcw('.carousel.active').trigger('dots');
f('.carousel.active .dot').removeClass('active').eq(i).addClass('active');
});
$(document).on('change slideStop', "#carousel-cols", function(event,nitem){
fcw('.carousel.active').trigger('init');
});
//gallery
$(document).on('repeater:AfterClone', "#gallery.wcontrol", function(event,nitem){

$(nitem).find('.img').removeAttr('src');
});