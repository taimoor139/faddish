var cselem;
var editEnabled;
var prevElem; //for go back button
var popChangesMade; 
onboth('click', ".z-style, .g-edit, .tool-menu, .tool-settings, .custom-edit, .edit-css", function(e){
     console.log("get click-----");
 editEnabled = true; 
 popChangesMade = false;
 if(cmActive && !$(this).is('.g-edit')){
    var el = cselem = activeItem;
 } else{
    var el = cselem = $(this).closest('.sitekly-edit, .sitekly-col, .sitekly-block, .z-addel-con');
 }
 
  
    
    if(el.is('.z-addel-con')){

        cselem.data('lr',$(this).closest('.z-elad').index());
    } else if($(this).is('.tool-menu')){
       var el = cselem = allpages;
     
    } else if($(this).is('.tool-settings')){
        if(!isset(globalSettings['website'])){  
        globalSettings['website'] = {'raw':$('<website>')};   
        }
        if(typeof(globalSettings['website']['raw']) == 'string'){
         globalSettings['website']['raw'] = $(globalSettings['website']['raw']);   
        }
        var settings = $(globalSettings['website']['raw']).eq(0);
       var el = cselem = settings;
     
    }
    if($(this).is('.custom-edit')){
        var el = cselem = customObject;
    }
     else if($(this).is('.edit-css')){
        var el = cselem = $('<'+$(this).attr('id')+'>');
    }
preparePop(el);
});




var tempElems = {};
var getting = false;
function getstyle(pop, elem, tempchange){
getting = true;
    console.log("get");

 var type = gettype(elem);
 
// if(pop.is('.z-popup')){
//  pop.find('.wcontrol').not('#'+type).hide(); 
//  pop = pop.find('.wcontrol#'+type); 
//  pop.show();
// }

if(!tempchange){ 
dynamicFields(pop,type);
prepareRepeaters(pop,type,elem);
//cpicker(pop);

 }
pop.find(".psg, .depend").removeClass("off");   
pop.find(".prop").each(function(){

var settings = getPropSettings($(this),type);
 
settings = activeTemp(settings,$(this));
 
  
if(settings.show == "0"){
    $(this).closest(".psg").addClass("off");
    
    return true;
}
$(this).data('el',false);
$(this).data('selector',false);
el = prepareTemp(settings,elem,$(this));


if($(this).closest(".depend.disabled").length > 0){
    return true;
}
if($(this).closest(".altcon").is(".disabled")){
return true;
}

var ival;

$(this).closest(".z-pop-cont").removeClass("off");
if(settings.customGet && settings.customGet.length > 0){
  runFunction(settings.customGet,pop,el,elem,$(this),settings,tempchange,'get');  
} else if(settings.special && settings.special.length > 0){
    

    if(settings.special == "gradient" && $(this).is('#fcol')){
    
    ival = el.prop('style')[settings.iprop];
    var intabcon = $(this).closest('.intabcon');
    
    if (ival.match("^linear-gradient")) {
    ivala = ival.split(/(linear-gradient)\(([\d]+)deg, (rg.+\)) (\d+)%, (rg.+\)) (\d+)%\)/).filter(Boolean);
       
        
        
        intabcon.find('#fcol').css('background-color',ivala[2]);
        intabcon.find('#scol').css('background-color',ivala[4]);
        intabcon.find('#loc1').val(ivala[3]);
        intabcon.find('#loc2').val(ivala[5]);
        intabcon.find('#angl').val(ivala[1]);
        
        intabcon.find('#gtypes').val(ivala[0]);
    
    
    } else if (ival.match("^radial-gradient")) {
     ivala = ival.split(/(radial-gradient)\(at ([\d]+)% ([\d]+)%, (rg.+\)) (\d+)%, (rg.+\)) (\d+)%\)/).filter(Boolean); 
     
        intabcon.find('#fcol').css('background-color',ivala[3]);
        intabcon.find('#scol').css('background-color',ivala[5]);
        intabcon.find('#loc1').val(ivala[4]);
        intabcon.find('#loc2').val(ivala[6]);
        
        intabcon.find('#xaxis').val(ivala[1]);
        intabcon.find('#yaxis').val(ivala[2]);
        
        intabcon.find('#gtypes').val(ivala[0]);
     
       
    }
    setslider(intabcon.find('.altcon.bg-g')); 
    
    }  
      else  if(settings.special == "border"){
        
     if($(this).is('#t')){  
        
        
     ival = el.prop('style')[settings.iprop];
    var inpts = $(this).closest('.bradcon').find('.z-pop-inp');
    
     if(ival.length == 0){
        
        inpts.val("");
     } else{

     
    ivala = ival.split(" ");

    inpts.attr('suffix',getsuffix(ivala[0]));
        if(ivala.length == 1){

          inpts.val(parseFloat(ivala[0]));  
            
        } else if(ivala.length == 2){

            inpts.eq(0).val(parseFloat(ivala[0]));
            inpts.eq(2).val(parseFloat(ivala[0]));
            inpts.eq(1).val(parseFloat(ivala[1]));
            inpts.eq(3).val(parseFloat(ivala[1]));
            
            
        } else if(ivala.length == 3){

            inpts.eq(0).val(parseFloat(ivala[0]));
            inpts.eq(1).val(parseFloat(ivala[1]));
            inpts.eq(2).val(parseFloat(ivala[2]));
            inpts.eq(3).val(parseFloat(ivala[1]));
            
            
        } else if(ivala.length == 4){

            for(i=0;i<4;i++){
                inpts.eq(i).val(parseFloat(ivala[i]));
            }
            
            
        }
    }
        
        
        
    }
     
     } else if(settings.special == "shadow"){
           var con = $(this).closest('.intabcon1');  
           var type = con.find('.bsht');
         if($(this).is('.bsht')){
           $(this).val('outside');
           $(this).addClass('hide');
         } else if($(this).is('.bshc')){
            var bs = el.prop('style')['box-shadow'];
            if($(this).is('.first')){
            con.find('.altcon').addClass('disabled').hide();
            if(!isset(bs)){
              con.find('.bsht').val('default'); 
              return;
            } else if(bs == 'none'){
             con.find('.bsht').val('none');    
             return;
            }
            }
            if($(this).is('.first')){
                if(bs.indexOf('inset') != -1){
                 con.find('.bsht').val('inside');   
                }
                con.find('.altcon').removeClass('disabled').show();
               var vals = bs.match(/-?\d+px/g); 
               con.find('.bsh').each(function(i){
                $(this).val(parseInt(vals[i]));
               }); 
            }
            var c = bs.match(/rgba?\([0-9, .]+\)/);
            var color = (isset(c)) ? c[0] : '';
            $(this).css('background-color',color);    
            
         }
     }
    else if(settings.special == "class"){
        $(this).val($(this).children("option").eq(0).val()); 
        
        var prefix = '';
        if(settings.prefix){
          if(settings.prefix=='viewport'){  
         prefix = f('.sitekly-container').attr('id'); 
         } else if(settings.prefix=='viewport-col'){  
         prefix = "col-"+f('.sitekly-container').attr('id')+"-";
         var filter = new RegExp(prefix+"([0-9]+)");
         var cl = el.attr('class').match(filter);
        if(isset(cl)){
            $(this).val(cl[1]);
        }
            

         } else{
          prefix = settings.prefix;  
         }  
        }
        if($(this).is('select')){
        $(this).children("option").each(function(){
        if(el.hasClass(prefix+$(this).val())){
           ival = $(this).val()
        $(this).parent().val(ival);   
        }   
        });
        } else if($(this).is('.checker')){
            ival = el.hasClass(prefix+$(this).attr('data-on'));
         $(this).prop( "checked", ival );    
    
        } 
        
    } else if(settings.special == "valcon1"){

        if($(this).closest(".vspacont").length > 0 && $(this).closest(".vspacont").find(".psg:not('.off, .linked')").length == 0){
 
          $(this).closest(".vspacont").hide();  
        } else{
  
        $(this).closest(".vspacont").show();
        var numgroup = $(this).closest(".numgroup");
        var inputs = numgroup.find(".prop:not('.special')");
        var numgroupUnit = numgroup.prev(".numgroup-top").find(".numgroup-unit");
        var suffix = numgroupUnit.find("span").eq(0).text();
        var vals = [];
        inputs.each(function(){
            if($(this).parent().is('.off')){
                return true;
            }
          if ($.inArray($(this).val(), vals) == -1){ vals.push($(this).val())};  
          
          if($(this).val().length > 0){
            suffix = $(this).attr('suffix');
          }
            
        });
        
        if(vals.length == 1){
           numgroup.find(".psg.linked").addClass("active"); 
        } else{
          numgroup.find(".psg.linked").removeClass("active");   
        }
   
        setunits(numgroupUnit.find("span[suffix='"+suffix+"']"));
        }
    } 
//    else if(settings.special == "repeater"){  
//    $(this).next('.repeater-handle').text(el.text());
//    } 
    else if(settings.special == "icon"){
        $(this).find('i').attr('class',el.attr('class'));
    }
    
    
} else{
    if(settings.computedcss){
        ival = el.css(settings.iprop);
    } else if(settings.variableprop){
        ival = el[0].style.getPropertyValue(settings.iprop);
 
        
    } else if(settings.iprop){
        
    ival = el.prop('style')[settings.iprop];
    } else if(settings.inlineProp) {
    ival = el.prop('style')[settings.inlineProp];
    } 
    
    else if(settings.iattr){
        if(settings.iattr == 'text'){
     ival = el.text();       
        } else if(settings.iattr == 'html'){
     ival = el.html();       
        } 
        else if(settings.iattr == 'tinyhtml'){ 
     ival = el.html();  
     $(this).next('.tiny-preview').html(ival)
        } else if(settings.iattr == 'brhtml'){
     ival = el.html().replace(/<br>/g,"\n");       
        } else if(settings.iattr == 'tag' || settings.iattr == 'text-tag'){
     ival = el.prop("tagName"); 
     if(ival == 'INPUT'){
        ival = el.attr('type');
     }  

        } else if(settings.iattr == "val"){
        ival = el.val();
    } else if(settings.iattr == "options"){
        if(el.is('select')){
            ival ='';
            el.children('option').each(function(){
             ival +=$(this).text()+"\n";  
            })
        } else{
            ival =''; 
            el.parent().find('span').each(function(){
             ival +=$(this).text()+"\n";   
            });
        }
    }  else if(settings.suffixAttr){
                if(settings.suffixAttr=='viewport'){  
                settings.iattr += "-"+f('.sitekly-container').attr('id'); 
                } else {
                settings.iattr += suffixAttr;   
                }
        ival = el.attr(settings.iattr);
       }
     else {
    ival = el.attr(settings.iattr);
    }    
    
    }
 
    if(settings.sprop == "background-image"){
         
     ival = src2url(ival);
 
    
    if(ival == 'url("none")'){
        ival = "";
    }
 
    }
    if($(this).attr('type') == 'number'){  
     
    suffix = getsuffix(ival);
       
       
          setunits($(this).closest('.pbox').find('.numgroup-unit').find("span[suffix='"+suffix+"']"));
        ival = parseFloat(ival);    
        }

         //filters
     if(settings.filter){ 
            if(settings.filter == "flex-calc"){
            ival = Math.round(100/parseFloat(ival));
            } else if(settings.filter == "relativePath"){
                if(settings.sprop == "background-image"){
                    ival = src2url(absolutePath(url2src(ival),'editor'));
                    
                } else{
                  ival = absolutePath(ival,'editor');  
                }        
            } else{
             ival = runFunction(settings.filter,ival,pop,el,elem,$(this),settings,'set');   
            }
     
     } 
    
    if(settings.sattr == "css"){   
        
    $(this).css(settings.sprop,ival);
    } else if(settings.sattr == "val"){
    $(this).val(ival);
    }
    else if(settings.sattr == "code"){
    $(this).val(ival);
    this.editor.setValue(ival);
     var that = this;
    setTimeout(function() {
    that.editor.refresh();
    },1);
    } else if(settings.sattr == "check"){
      if(ival == $(this).attr('data-on')){
        $(this).prop('checked',1);
      } else{
        $(this).prop('checked',0);
      } 
     
    }
     else if(settings.sattr == "icon-val"){  
       
    $(this).attr(settings.sattr,ival); 
    $(this).children().removeClass('active');
    if(isset(ival)){
    $(this).children("#"+ival).addClass('active');
        }
    } else{
       
    $(this).attr(settings.sattr,ival); 
 
    }
}
//set label for repeater
if(settings.copylabel){
    repeaterLabel(ival,$(this));
}

altcons($(this));
dependeds(settings,$(this),ival);
//if(settings.depended){
// var con = (settings.scope) ? $(this).closest(settings.scope) : $(this).closest('.wcontrol'); 
//if(ival.length == 0 || ival == settings.disableval){
//    con.find("."+settings.depended).addClass("disabled");
//} else{
// con.find("."+settings.depended).removeClass("disabled");  
//}
//}
//
//if(settings.dependedOpt){
//    if(!ival){
//        ival = $(this).val();
//    }
// $(this).closest('.wcontrol').find("."+settings.dependedOpt).addClass("disabled");
// $(this).closest('.wcontrol').find("."+settings.dependedOpt+"."+ival).removeClass("disabled"); 
//}

if(settings.action){
//   if(settings.action == 'fontset'){ 
//
//    $(this).trigger('setFont',ival);
//    }
}

});

getting = false;
return true;
}

function dynamicFields(pop,type){

     pop.find('.tempcon').remove();
 
 $('.subtabs').each(function(){
   var subtab = $(this);  
   var settings = getPropSettings(subtab,type);
   delete settings.show; 
   subtab.html("");
   
   $.each( settings, function( key, value ) {
    subtab.append('<div class="selchange" data-selector="'+value+'">'+key+'</div>');
    });
    subtab.children('.selchange').eq(0).addClass('active');

 }); 
 
 
// cpicker();
}

   function prepareRepeaters(pop,type,elem){
    pop.find('.repeater-container').each(function(){
      var rcon = $(this);
      rcon.find(".repeater").remove();  
       
       if(!rcon.data('proto')){
            var proto = $('<div>').prepend(rcon.find('.proto')).html();
        } else{
          var proto = rcon.data('proto'); 
        }
        proto = $(proto);
        
     var settings = getPropSettings(proto.find('.repeatset .prop'),type);  
     
     var controls = settings.controls.split(",");
     
        rcon.attr('data-parent',settings.parent);
        rcon.attr('data-subparent',settings.subparent);
        rcon.attr('data-subclass',settings.subclass);
        rcon.attr('data-limit',settings.limit);
     
        if(jQuery.inArray( 'sort', controls ) !=-1 ){
         sortControls(rcon,elem);   
        } else if(jQuery.inArray( 'multisort', controls ) !=-1 ){
        rcon.addClass('multisort');
        if(isset(settings.subclass)){
            rcon.addClass('simplemulti');    
        }
         sortControls(rcon,elem);  
        }
        if(jQuery.inArray( 'edit', controls ) == -1 ){
          proto.find('.control.edit').remove();   
        }
        if(jQuery.inArray( 'clone', controls ) == -1 ){
          proto.find('.control.clone').remove();   
        }
        if(jQuery.inArray( 'delete', controls ) == -1 ){
          proto.find('.control.delete').remove();  
        }
        
     rcon.data('proto',proto);
      
    if(settings.show != "0"){
        
        var items = $(elem).find(settings.parent);
      
      items.each(function(){
         var rep = proto.clone().attr('class','repeater');
        if(isset(settings.subparent) && $(this).parent().is(settings.subparent) || isset(settings.subclass) && $(this).hasClass(settings.subclass)){
        rep.addClass('subitem');
        }
       rcon.append(rep);  
        
        
      });


    
    }
    
    rcon.trigger("repeater:AfterCreate");
    
    }); 
  sliderInit();
}

function sortControls(rcon,elem){
    var multi = (rcon.is(".multisort")) ? true : false;
    var simplemulti = (rcon.is(".simplemulti")) ? true : false;
    var items = rcon.data('parent');
    rcon.sortable({
    placeholder: "repeater-place",
    tolerance: "pointer",
    handle: '.repeater-handle',
     start: function( event, ui ) {
        
        $(this).find('.repeater').each(function(index){
        $(this).data('index',index);   
        });
        
        $(this).find(".repeater").removeClass('active');
        ui.item.height('auto');
        

        
       if(multi){
          ui.helper.nextAll('.repeater').each(function() {
           if(ui.helper.is('.subitem')){
            return false;
           } 
         if ($(this).is(".subitem")){
          $(this).addClass('tempsub'); 
         } else{
            return false;
         }   
        });
    }
      
     },
     sort: function( event, ui ) {
        if(multi){
       if($(ui.helper).offset().left > 40 && $(this).children().not('.ui-sortable-helper').index($(ui.placeholder)) != 0){
        $(ui.placeholder).addClass('indent');
       } else{
        $(ui.placeholder).removeClass('indent');
       }
      }
     },
     stop: function( event, ui ) {
       var subclass = $(this).data('subclass');
       var item = elem.find(items).eq( $(ui.item).data('index'));
       
        
       if(multi){
           if($(ui.placeholder).is('.indent')){
             $(ui.item).addClass('subitem');
                 if(simplemulti){
                  //item.addClass(subclass);  
                 }
           } else {
            $(ui.item).removeClass('subitem');
                 if(simplemulti){
               // item.removeClass(subclass);  
                }
           }
           $(this).find('.tempsub').insertAfter($(ui.item)).removeClass('tempsub');
           $(this).children('.repeater').eq(0).removeClass('subitem');
           
       }
      
     var ei = $(ui.item).index();

      if(simplemulti || !multi){
        
       $(this).children('.repeater').each(function(index){
       var oldindex = $(this).data('index');
       var citem = elem.find(items).eq(oldindex);
       
       if($(this).is('.subitem')){
        citem.addClass(subclass);
       } else{
        citem.removeClass(subclass);
       } 
       citem.data('index',index);     
   
      });
      
    elem.find(items).each(function(index){ 
            if($(this).data('index') != index){
        $(this).insertBefore(elem.find(items).eq($(this).data('index')));      
       } 
     });
      
      }
      rcon.trigger("repeater:AfterSort");
     }   
    });
}

function preparePop(el,reinit){
if(!el){
    return;
    }
var pop = $(".z-pop16");

if(!reinit){
f(".sitekly-edit, .sitekly-col, .sitekly-block, .z-addel-con").removeClass("active");
el.addClass("active");

 var type = gettype(el); 

  pop.find('.wcontrol').hide().removeClass('active'); 
  pop = pop.find('.wcontrol#'+type).addClass('active');
  $(".z-pop16").show();
  pop.show(); 
  
if(pop.is('.init')){
$('<div class="editinfo"><span>'+lang.editingLabel+' </span><span></span>'+pop.data('label')+'</div>').insertBefore(pop.find('.p-tabs'));

pop.find('.item-select').each(function(){
$(this).nextUntil(".item-select").wrapAll('<div class="'+$(this).data('wrap')+'"></div>');    
});
pop.find('.intab1').each(function(){
$(this).nextUntil(".intab1, .endtab1").wrapAll('<div class="'+$(this).data('wrap')+'"></div>');    
});
pop.find('.intab2').each(function(){
$(this).nextUntil(".intab2, .endtab2").wrapAll('<div class="'+$(this).data('wrap')+'"></div>');    
});
pop.find('.intab3').each(function(){
$(this).nextUntil(".intab3, .endtab3").wrapAll('<div class="'+$(this).data('wrap')+'"></div>');    
});

pop.find('.z-pop-cont').each(function(){
var selectors = $('<div class="item-selector"></div>').prepend($(this).find('.item-select, .item-title'));
 $(this).prepend(selectors);   
});

pop.removeClass('init');

initCodeMirror(pop);

}
} else{
    pop = $('.wcontrol.active');
}
getstyle(pop,el,false);


pop.find('.z-pop-cont').each(function(){
 $(this).find('.intab').each(function(){
var con = $(this).next('.intabcon').eq(0);

  if(con.find('.psg:not(".off,.linked")').length == 0){
   $(this).addClass('off');
   con.addClass('off'); 
  } else{
    $(this).removeClass('off');
   con.removeClass('off');
  }  
 }); 
if(!reinit){
 $(this).find('.intab:not(".off")').eq(0).removeClass('active').click();
 $(this).find('.item-select').eq(0).click(); 
 }
 
});

if(!reinit){
if(issetIndex(cselem.data('lt'))){  
    var tab = pop.find(".p-tab").eq(cselem.data('lt'));
} else{
   var tab = pop.find(".p-tab").eq(0);
    
}
tab.click();
if(issetIndex(cselem.data('lst'))){
    pop.find('.item-select').eq(cselem.data('lst')).click();
}
if(issetIndex(cselem.data('la'))){
    pop.find('.intab:visible').eq(cselem.data('la')).removeClass('active').click();
}
if(issetIndex(cselem.data('lr'))){
    pop.find('.repeater:visible').eq(cselem.data('lr')).removeClass('active').find('.repeater-handle').click();
}

}

setslider(pop);
//if(el.is('.text')){
//    $("#helper2").hide();
//f(".sitekly-edit.active").addClass('sitekly-editing');
////tinyClean();
//}
initFontselect(pop);

}
//go back button
$(document).on('mousedown', ".z-popup .goback.custom-edit",  function(){ 
customObject = prevElem;
});