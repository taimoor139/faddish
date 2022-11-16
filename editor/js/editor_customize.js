//add custom code to be included in editor
//$(document).on('click',"#cform.wcontrol .addInput", function(event){
// $(this).prev('.repeater-container').find('.control.clone').last().click();
// 
// var newInput = $('#cform.wcontrol .repeater').last();   
//});
//
//


$(document).on('click',"#cform.wcontrol .addInput", function(event){
var rep = $('#cform.wcontrol .repeater').last();
var rcon = $('#cform.wcontrol .repeater-container');
var isel = rcon.data('parent');
var item = cselem.find(isel).eq(rep.index());



if(isset(rcon.data('limit')) && rcon.children().length == parseInt(rcon.data('limit'))){
  alert(lang.limitReached);
  return false;  
}
   
    
var nitem = item.clone();
nitem.insertAfter(item); 
if(rep.is('.active')){
    rep.removeClass('active');
    
} 
var nrep = rep.clone();
nrep.find('.z-pop-inp.prop').val('');
nrep.find('input.z-pop-inp.prop').eq(0).val('Label');
nrep.insertAfter(rep); 
nrep.find('select.prop').eq(0).val('text').change();


});