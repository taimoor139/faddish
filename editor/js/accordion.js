$(document).on('click', "#accordion .repeater-handle", function(e){
var rep = $(this).closest('.repeater');
var i = rep.index();
var item = cselem.find('.item').eq(i);
if(rep.is('.active') && !item.is('.active')){
    item.children('.head').click();
}
});

$(document).on('change', "#accordion .expopt", function(e){
if(!isset($(this).val())){
 cselem.find('.item').removeClass('active').children('.body').slideUp();  
 cselem.find('.item').eq(0).children('.head').click(); 
}
});

$(document).on('change', "#accordion .iniopt", function(e){
cselem.find('.item').removeClass('active').children('.body').slideUp();
if(isset($(this).val())){
 cselem.find('.item').eq(0).children('.head').click(); 
}
});