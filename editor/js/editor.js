//$(function(){
var cl = console.log;
editmode = true;
var bar;
var percent;
var nimg;
var preload;

var loaded = false;

$frame = $('iframe.site');
var f = function(s){
    return $frame.contents().find(s);
};
var fcw = function(s){
      return $frame[0].contentWindow.$(s);
};

function onframe(event,selector,fn){
 if(loaded){
    f('body').on(event,selector,fn);
 } else {
   setTimeout(() => {
    onframe(event,selector,fn);
  }, 100);  
 }
};

function onboth(event,selector,fn){
 if(loaded){
    f('body').on(event,selector,fn);
    $(document).on(event,selector,fn);
 } else {
   setTimeout(() => {
    onboth(event,selector,fn);
  }, 100);  
 }
};

function sFrame(event,selector,fn){
 if(loaded){
    f(selector)[event](fn); 
 } else {
   setTimeout(() => {
    sFrame(event,selector,fn);
  }, 100);  
 }
};


$(document).ready(function() {
  tinyInit();  

  });
  
  
$(window).on('pageshow',function(){ 
    loaded = true;
$('body').attr('style',''); 
$('.sitecon').show();
$("body").css("overflow","");
if($('.z-panel.left').children().length == 0){
    $('body').addClass('left-empty');
}
loadDelayed();
dropzones();

menusInit();
importPages();
sliderInit();
searchSelect();

columnResize(f('.sitekly-container'));
globalsInit();
$(".tool-views #lg").click();
//sectionSlider();
 $frame.contents().scroll(function(){
 f('.helper.active').hide();
 });
 
$('#preloader').fadeOut(500); 

if($(window).width() < 1200){
    alert("It's recommended to use editor with desktop device and at least 1200px wide screen.");
}

initTour();

}); 

   var cmActive = false;   
  onframe('contextmenu', function(e) {

        showContext(e);
    });   
       
  sFrame('click','body', function(e) {
    
    if(!cmActive){
        return;
    }
    if($(e.target).is('.tbicon')){
        return;
    }
clearContext();
  });
  
  onframe('click','.tbicon', function(e) {
  showContext(e);
  });
  
  
  var activeItem;
  function showContext(e){
  
        clearContext();
    var t = $(e.target);
    if(t.is('input') || t.is('textarea')){
    
        return;
    }
    
    var item = t.closest(".sitekly-edit, .sitekly-col, .sitekly-block");
    if(item.length == 0){
       return;
    }
    e.preventDefault();
    var h = item.children('.helper');
    
    
    cmActive = h;
   // h.addClass('active');
   // h.find(".tbox").addClass('active');
    var hc = h.clone().addClass('active helper-clone');
    var tb = hc.find(".tbox").addClass('active');
      if(!styleItem || styleItem.data('type') != gettype(item)){
        hc.find('.z-paste').hide();
    } else{
        hc.find('.z-paste').show();
    }  

        if(item.is('.global')){
        var name = globals[item.attr('id')]['name'];
        hc.find('.wname .name').text(" ("+name+")");
        hc.find('.save').hide();
        hc.find('.unlink').show();
    } else {
        hc.find('.save').show();
        hc.find('.unlink').hide();
    }

    f('body').prepend(hc);
    var offY = e.pageY;
    var bottom = offY-$frame.contents().scrollTop()+tb.height();
    var fh = $frame.height() - 10;
    if(bottom>fh){
      var dif = bottom - fh;
      offY = offY - dif;
    }

    var offX = e.pageX;
    var fw = $frame.width()-30;
    var left = offX-$frame.contents().scrollLeft();
    var right = offX-$frame.contents().scrollLeft()+tb.width();
    if(right>fw){
      var dif = right - fw;
      offX = offX - dif;
    }
    
   // h.animate({ top: offY-item.offset().top, left: offX-item.offset().left },100);
   // h.offset({ top: offY, left: offX });
    
    hc.offset({ top: offY, left: offX });
    activeItem = item;
  }

  function clearContext(){
        if(cmActive ){
       // cmActive.attr('style',"");
        //cmActive.removeClass('active');
       // cmActive.find('.tbox').removeClass('active');
        cmActive = false;
        f('.helper-clone').remove();
    }
  }

function zhidden(hide){
if(hide){
 $(".z-hidden").hide(300);   
} else{
    if(!$(".tool-group-title.active").is(".side")){
     return false;   
    }
    $(".z-addel").hide();
    var addel = $(".z-addel#"+$(".tool-group-title.active").attr("id"));
    addel.css("opacity","0").show();
   
   $(".z-hidden").show(300, function() {
      addel.find(".addgr").each(function(){
        var h =($(this).height() / 2 * -1) + 20;
     $(this).css("margin-top",h); 

      });
     addel.css("opacity","1");
  });  
}    
};
var wide;


onframe('mouseenter',".sitekly-edit:not('.sitekly-editing')", function(e){
if($(this).find(".inhelps").length == 0){
columnResize($(this).parent());
}
});

//var openAutoPop = false;
//onframe('mousedown mouseup',".sitekly-edit", function(e){
//   // return;
//   if(e.which != 1) return;
//   
//   if($(e.target).is('.z-style')) return false; 
//    
//   if(e.type == 'mousedown'){
//      if($(this).is('.active')){
//       openAutoPop = false;
//      } else{
//        openAutoPop = true;
//      } 
//   } else if(openAutoPop) {
//    $(this).find(".z-style").click();
//    }
//});

//sorting
var sortItem;
var placer;
var newItemAdding;
var parentPage;
onframe('mousedown', ".z-handle", function(e){
newItemAdding = false;
    sortItem = activeItem; 
    $(this).closest('.helper').hide(); 
    parentPage = $('body').attr('id');
    sorting("start");
});
onboth('keyup', "", function(e){
  if (e.keyCode === 27){
    sorting("end");
  }
});
onboth("contextmenu",'',function(e){
   sorting("end");
}); 

//adding elements
$(document).on('click', ".z-addel-tabs div", function(e){
$(this).siblings().removeClass('active');
$(this).addClass('active');
$('.z-addel-con').hide();
$('.z-addel-con').eq($(this).index()).show();
});
$(document).on('mousedown', ".addgr, .z-elad", function(e){
if($(e.target).is('.g-edit')){
    return false;
}
parentPage = false;
newItemAdding = true;
    if( $(this).is(".z-elad")){
   if($(this).parent().is('.elements')){
    sortItem = $($(this).data('code'));   
   } else{
    sortItem = updateGlobalsAll($(globals[$(this).data('id')]['content']));
   }
     
    sorting("start");
    }  else if( $(this).is(".addgr")){
        sortItem = $(this).children().clone();   
        sorting("start");
    }
});
onframe('mouseenter mouseleave click', ".inhelp, .autoInhelp.enabled",  function(e){
     if( e.type == "mouseenter"){
    $(this).addClass("hover");
    }     else if( e.type == "mouseleave"){
      $(this).removeClass("hover");
    
    } else if( e.type == "click"){
    placer = $(this); 
     sorting("stop");
    
    }
    
    });
    
    
function sorting(action){
 if(action == "start"){
     f("body").addClass("sorting").css("cursor",""); 
        if(sortItem.is(".sitekly-edit")){
     f(".sitekly-container .inhelps.ih-item").show();
     f(".sitekly-container .inhelps.ih-incol").show();
        if(sortItem.is(".z-incont")){
        f(".z-incont .inhelps").hide();
        f(".z-incont > .inhelps").show().children('.full').hide();
        } else{
          f(".inhelps .full").show(); 
          f('.autoInhelp.inhelp-item').addClass('enabled'); 
        }
     } else if(sortItem.is(".sitekly-col")){
     f(".sitekly-container .inhelps.ih-col").show();
     } else if(sortItem.is(".sitekly-block")){
     f(".sitekly-container .inhelps.ih-block").show();
     }
 } else if(action == "stop"){
   var ogp = sortItem.parent().closest('.global');
 if(sortItem.is(".sitekly-edit")){

    var parent = placer.parents().eq(1);
    
    if(placer.is('.autoInhelp')){
    placer.prepend(sortItem);
    } else if(parent.is(".z-incont") && placer.is(".full")){
      
    parent.find('.z-inner').prepend(sortItem);
    } else if(parent.is(".box-row")){
        
        if(parent.children(".z-back").length==1){
         sortItem.insertAfter(parent.children(".z-back"));   
        } else{
            sortItem.insertAfter(placer.parent());
        }

    } else if(parent.is(".sitekly-edit")){
       
        if(placer.is(".top")){
           sortItem.insertBefore(parent); 
        } else if(placer.is(".bottom")){
           sortItem.insertAfter(parent); 
        } 

    } else if(parent.is(".column")){
    parent.find('.column-inside').prepend(sortItem);
    }
        
 } else  if(sortItem.is(".sitekly-col")){
 
     if(placer.is(".inh5a")){
            if(placer.is(".left")){
            sortItem.insertBefore(placer.closest(".sitekly-col"));
            } else if(placer.is(".right")){
            sortItem.insertAfter(placer.closest(".sitekly-col"));
            }
        } else{
            if(placer.is(".top")){
            sortItem.insertAfter(placer.closest(".row").children().eq(0));
            } else if(placer.is(".bottom")){
            sortItem.insertAfter(placer.closest(".row").children().last());
            }
        }
 
 }else  if(sortItem.is(".sitekly-block")){
 
     if(placer.is(".full")){
         sortItem.insertAfter(placer.parent()); 
     } if(placer.is(".top")){
        sortItem.insertBefore(placer.parents(".sitekly-block")); 
     } else if(placer.is(".bottom")){
        sortItem.insertAfter(placer.parents(".sitekly-block")); 
     }
 
 }
    updateglobals(ogp);
    updateglobals(sortItem.parent().closest('.global'));
    columnResize(sortItem.parent());
    addimportedCss();
    
    if(newItemAdding){ 
       // fcw('.video')
        fcw(sortItem).trigger('added');
     addPoint('item-added'); 
    } else{
      addPoint('item-moved');  
    }

    
 sorting("end");
 }
 else if(action == "end"){
    if(f("body").is(".sorting")){
      f("body").removeClass("sorting");
     f(".sitekly-container .inhelps").hide(); 
     f('.autoInhelp').removeClass('enabled hover');  
     }
   importData = false; 
 }   
}  
sFrame('mousedown','html', function(e){
 if($frame[0].contentWindow.inlineTinyActive){
    if($(e.target).is('.inlinetiny') || $(e.target).closest('.inlinetiny').length !=0 || $(e.target).closest('.tox').length !=0){
        return;
    }
}
if(editEnabled){
hideTiny(e);
autohider(e);
} 
editEnabled = false; 
});
 //click hidder && last tab finder
 $(document).on('mousedown', "body", function(e){
 if(editEnabled){
hideTiny(e);

//  if($(e.target).closest('.z-pop16').length == 0 && !$(e.target).is('.selchange') && $(e.target).closest('.z-pophelper').length == 0 && $(e.target).closest('.sp-container').length == 0 
//  && $(e.target).closest('.tox').length == 0  
//  ){
//
//autohider();     
//  }
  
 if($(e.target).closest('.z-panel.top').length != 0 && $(e.target).closest('.tool-views').length == 0){
    autohider(e);
    editEnabled = false;
 } 
  
   
  
 }
 if($frame[0].contentWindow.inlineTinyActive){
    console.log('hidder inline');
    $frame[0].contentWindow.removeInlineTiny();
 }


 });
 
function autohider(e){
console.log('hidder');
 if($('.z-pop16').is(":visible")){
 var pop = $('.wcontrol.active');
  tempElems = {};
  $(".z-pop16 .cpicker").spectrum("destroy"); 

    var lt = pop.find('.p-tab.active').index();
    var lst = pop.find('.item-select.active').index();
    var la = $('.intab.active:visible').index('.intab:visible');
    var lr = $('.repeater.active:visible').index('.repeater:visible');
    
    
    cselem.data({'lt':lt,'lst':lst,'la':la,'lr':lr});
    $('.z-pop16').hide();
    f(".sitekly-edit").removeClass("sitekly-editing");
     pop.trigger("afterHide");
}     
      if($(e.target).closest('.z-toptool').length == 0 && popChangesMade){
        console.log('point added');
        addPoint('item-edited');
      }
 
  if($('.tool-navigate.open').length > 0 && $(e.target).closest('.tool-navigate').length == 0){
   $('.tool-navigate').removeClass('open'); 
 }
 cselem.removeClass('active');   
} 
 
//helper click
   onframe('click', ".helper", function(e){
    if( e.target == this ){
       $(this).hide();  
       $(".z-popup").hide();
       f(".sitekly-edit.sitekly-editing").removeClass("sitekly-editing");
    }
 });


//clone
 onframe('click', ".z-clone", function(e){
var action = 'clone';
var item = activeItem; 
cloneItem(item);
addPoint(action); 
 });
//unlink from globals
  onframe('click', ".gsave .unlink", function(e){
var action = 'global-unlink';
var item = activeItem; 
cloneItem(item);
item.remove();
addPoint(action); 
 });

function cloneItem(item){
  manageCss(item.clone(),'c').insertAfter(item).removeClass("active global");
updateglobals(item.parent().closest('.global'));
columnResize(item.parent());
 }
 //copy style
 var styleItem;
 onframe('click', ".z-copy", function(e){
var item = activeItem; 
styleItem = item.clone();
styleItem.data('type',gettype(styleItem));
styleItem.children().remove();
manageCss(styleItem,'e');
 });

onframe('click', ".z-paste", function(e){
    var item = activeItem; 
    
    if(!styleItem || styleItem.data('type') != gettype(item)){
        return false;
    }
    var styleItemold = item.clone();
    styleItemold.children().remove();
    manageCss(styleItemold,'d');
    
    var sc = styleItem.attr('class').match(/\bs-[a-zA-Z0-9]+/);
    var sid = styleItem.attr('id');
    var nc = "s-"+makeid(8);
    var nid = "s-"+makeid(8);
    
    item.attr('id',nid);
    
    styleItem.attr('class', function(i, c){
    return c.replace(/\bs-[a-zA-Z0-9]+/g, nc);
    });
    
    if(styleItem.data('type') == 'col'){
      styleItem.attr('class', function(i, c){
    return c.replace(/\bcol-[a-z]{2}-[0-9]+/g, '');
    }); 
     var cols = item.attr('class').match(/\bcol-[a-z]{2}-[0-9]+/g);
     styleItem.addClass(cols);
    }
    
    item.attr('class',styleItem.attr('class'));
    
    f(".astylec style").each(function(){
    var id = $(this).attr('id');
    if(isset(styleItem.data(id))){
      var filter = new RegExp(sid,'g');
      var css = styleItem.data(id).replace(filter,nid); 
      var filter = new RegExp(sc,'g');
      var css = css.replace(filter,nid); 
      $(this).append(css);
    }
    
});
 refreshSS();   
addPoint('style-pasted');
 });
 

//save as global
 onframe('click', ".gsave .save", function(e){
 var elem = activeItem;
 if(!elem.is('.global')){
 var gid = getId(elem);  
 var type = gettype(elem); 
  elem.addClass('global'); 
  if(typeof globals[gid] != "object"){
  globals[gid] = {};    
  }
  globals[gid]['content'] = $('<div>').append(elem.clone()).html();
  globals[gid]['type'] = type;
  updateglobals(elem.parent().closest('.global'));
  $('.z-addel-con.globals').prepend('<div class="z-elad '+type+'" data-id="'+gid+'"><span class="label">'+lang.global_item+'</span><span class="g-edit"></span></div>');
  $('.z-addel-con.globals .z-elad').eq(0).children('.g-edit').click();
 }
 });


//delete
 onframe('click', ".z-delete",  function(e){
var elem = activeItem;
var gpar = elem.parent().closest('.global');

manageCss(elem,'d');

elem.remove(); 
updateglobals(gpar);
columnResize(f('.sitekly-container'));
 addPoint('delete');
 });
 
//export
onframe('click', ".z-export-code", function(e){
var action = 'e';
var item = activeItem; 

var fonts = getSectionFonts(item);
var fontString = [];
for (var key in fonts) {
    if (fonts.hasOwnProperty(key)) {
        fontString.push(key+':'+fonts[key]);
    }
}

var fontLink = '<link href="https://fonts.googleapis.com/css?family='+fontString.join('|')+'&display=swap" rel="stylesheet">';

var item = manageCss(item.clone(),'e');
item.find('.inhelps, .helper, .ui-resizable-handle').remove();
 var html = '<div class="sitekly-w">'+$('<div>').prepend(item).html()+"</div>";
//var html = $('<div>').prepend(item).html();
 
 var css = '<style>'+item.data('lg')+'@media only screen and (max-width: 75em) {'+item.data('md')+'}@media only screen and (max-width: 62em) {'+item.data('sm')+'}@media only screen and (max-width: 48em) {'+item.data('xs')+'}</style>';
 var baseHref = window.location.href.replace('/builder','');
 
var inlineScript = "  <script>" +
	" if(typeof(sectionLoaded) == \"undefined\"){" +
	"    var exportBase = '"+baseHref+"';" +
	"    var tag = document.createElement('script');" +
	"    tag.src = exportBase+'/template/js/sections.js';" +
	"    document.getElementsByTagName('body')[0].appendChild(tag);" +
	"    sectionLoaded = true;" +
	" }" +
	" </script>";
var templateCss = '<link href="'+baseHref+'/template/css/sections.css" rel="stylesheet">';

   var code = templateCss+css+fontLink+html+inlineScript;
   code = code.replace(/\r?\n|\r/g, "").replace(/ +(?= )/g,'');
   
   code = "<!-- SECTION CODE START -->\n"+code+"\n<!-- SECTION CODE END -->";
   
   
$('body').prepend('<div class="tempPop z-popup" style="position: fixed;background: #5d5d5de0;width: 100%;height: 100%;z-index: 999;display: flex;align-items: center;justify-content: center;"><div style="width: 50%;height: 50%;position: relative;"><div class="z-close" style="top: -40px;right: -10px;color: #fff;"></div><textarea class="code" onclick="this.select();" style="width: 100%; height:100%;"></textarea></div></div>');

$('.tempPop .code').text(code);

 });
$(document).on('click', ".tempPop", function(e){ 
    if(!$(e.target).is('.code')){
    $(this).remove();
    }
});
//add column
onframe('click', ".z-addc", function(e){ 
var col = $('<div class="sitekly-col col-md-12 col-sm-12 col-xs-12 col-lg-12"><div class="box-row"><div class="z-back"></div></div></div>');

if(activeItem.is('.sitekly-col')){
var lcol = activeItem;
var classes = lcol.attr("class").match(/\bcol-\S+/g).join(" ");
col.attr('class',classes).addClass("sitekly-col");
col.insertAfter(lcol);  
     
} else {
 activeItem.find('.row').append(col);   
}
columnResize(col.parent());
addPoint('add-column');
});

//


    //menu switch
$(document).on('click', ".p-tab", function(){ 
    var pop = $(this).closest('.wcontrol, .z-popup:visible');
 pop.find(".z-pop-cont").hide();
 pop.find(".z-pop-cont").eq($(this).index()).show();
  $(this).siblings().removeClass("active");
 $(this).addClass("active");
});
//tabs inside
$(document).on('click', ".intab", function(){ 
 $(this).toggleClass("active");
 
 var con = $(this).nextAll('.intabcon').eq(0);
 
 if($(this).is('.active')){
    $(this).siblings('.intabcon, .subtabs').hide();
    $(this).next('.subtabs:not(".disable")').show();
    con.show();
    $(this).siblings('.intab').removeClass('active');
 } else{
   con.hide(); 
   $(this).next('.subtabs').hide();
 }
});
$(document).on('click', ".advtab", function(){ 
  $(this).toggleClass("active");  


});


//repeater options expand

$(document).on('click', ".z-popup .repeater-handle", function(e){
$(this).closest('.repeater').toggleClass("active");
$(this).closest('.repeater').siblings().removeClass('active');
});
//repeater controls
$(document).on('click', ".z-popup .repeater-controls .control", function(e){
var rep = $(this).closest('.repeater');
var rcon = $(this).closest('.repeater-container');
var isel = rcon.data('parent');
var item = cselem.find(isel).eq(rep.index());
if($(this).is('.delete')){
if($(this).closest('.repeatset').is('.protectLast') && $(this).closest(".repeater-container").children().length == 1){
    return false;
}    
    
if(isset($(this).data('confirm'))){
 if(!confirm($(this).data('confirm'))){
    return false;
 }   
}
item.remove();
rep.remove();
rcon.trigger("repeater:AfterDelete",item);
} if($(this).is('.clone')){
if(isset(rcon.data('limit')) && $(this).closest(".repeater-container").children().length == parseInt(rcon.data('limit'))){
  alert(lang.limitReached);
  return false;  
}
   
    
var nitem = item.clone();
nitem.insertAfter(item); 
if(rep.is('.active')){
    rep.removeClass('active');
    
} 
var nrep = rep.clone();
nrep.insertAfter(rep); 
rep.find('select.prop').each(function(i){
 nrep.find('select.prop').eq(i).val($(this).val());  
});
if(nrep.find('.tox-tinymce').length != 0){
   nrep.find('.tox-tinymce').remove();
   nrep.find('textarea.tiny').removeAttr('id').show();
}

//sliderInit();
setslider(rcon);
setTimeout(function(){ rcon.trigger("repeater:AfterClone",nitem) }, 1);


}
});

//element selector
$(document).on('click', ".z-popup .item-select", function(e){
$(this).addClass("active").siblings().removeClass('active');
var ind = $(this).closest('.item-selector').find('.item-select').index(this);
$(this).closest('.item-selector').siblings().removeClass('active');
$(this).closest('.item-selector').siblings().eq(ind).addClass('active');
});

//change image start
$(document).on('click', ".z-pop16 .impr.images", function(){
$(".impr").removeClass('active');
$(this).addClass('active');
$(".z-popmedia.images").show();
var img = url2src($(this).css('background-image'));
$( ".myimages[src='"+img+"']" ).click();
});
/**
 * ICONS
 */
$(document).on('click', ".z-pop16 .impr.icons", function(){
$(".impr").removeClass('active');
$(this).addClass('active');
$(".z-popmedia.icons").show();
});
//icon search
$(document).on('keyup', ".icofind", function(){
    var value = $(this).val().toLowerCase();
    $(this).closest('.z-popmedia').find('.fa-icon').filter(function() {
      $(this).toggle($(this).find('span').text().toLowerCase().indexOf(value) > -1)
    });
  });
$(document).on('click', ".j-tab", function(){
   $(this).closest('.z-popmedia').find('.fa-icon-con').hide();
   $(this).closest('.z-popmedia').find('.fa-icon-con.'+$(this).attr('id')).show();
  });

$(document).on('click',".fa-icon", function(){
    $(".impr.active i").attr('class',$(this).children('i').attr('class'));
    setstyle($('.wcontrol:visible'), cselem,'special input change',$(".impr.active"));
   $('.z-popmedia').hide();
  });
  


//$(document).on('click mouseover mouseout', ".z-popmedia .cnt3 .myimages", function(e){
//if( e.type == "click"){
//    
//var src = $(this).attr("src");
//$(".impr.active").css("background-image","url("+src+")");
//imageData(src,$(".impr.active"),true);
//setstyle($('.wcontrol:visible'), cselem,'special input change',$(".impr.active"));
//
//$('.z-popmedia').hide();
//
//} else if( e.type == "mouseover"){
//  $(".dimg").show().offset($(this).offset());  
//  $(".myimages, .doc").removeClass("active");
//  $(this).addClass("active");
//} else{
// $(".dimg").hide();   
//}
//});

//$(document).on('click', "#imcropopen", function(){ 
//var pop = $('.z-popup#imcrop');
//var img = $('.myimages.active');
//pop.find('#rcropimg').attr('src',img.attr('src'));
//pop.show();
//});
//


    //remove from myimages





//delete image
$(document).on('click',".delimg", function(e){
$(this).prev('.prop').css("background-image","none");
setstyle($('.wcontrol:visible'), cselem,'special input change',$(this).prev('.prop'));
});

//style units choose
$(document).on('click',".numgroup-unit span:not('.active')", function(e){
setunits($(this));
$(this).closest('.pbox').find(".prop").val("").change();
});
function setunits(unitItem){

    unitItem.addClass("active").siblings().removeClass("active");

var inps = unitItem.closest('.pbox').find(".prop");
inps.attr("suffix",unitItem.attr("suffix")).attr("step",unitItem.attr("step")).attr("max",unitItem.attr("max")).attr("min",unitItem.attr("min"));
setslider(unitItem.closest('.pbox'));
}


//linked values

$(document).on('click', ".z-popup .linked", function(e){
$(this).toggleClass("active");
var inps = $(this).closest(".numgroup").find(".z-pop-inp");
inps.removeClass("linked");
if($(this).is(".active")){
 var v = inps.eq(0).val();
 inps.addClass("linked");
 inps.val(v).change();   
}
});


$(document).on('change', ".z-popup .numgroup .z-pop-inp", function(e){
if($(this).closest(".numgroup").find(".linked").is(".active")){
$(this).closest(".numgroup").find(".z-pop-inp").val($(this).val());    
}
});
//icon select
$(document).on('click', ".z-popup .icon-select", function(e){
 var $this = $(this);
 $this.toggleClass('active').siblings().removeClass('active');
 var val = $this.is('.active') ? $this.attr('id') : '';
 $this.closest('.icon-select-con').attr('icon-val',val).change();
});

//dynamic selector change
$(document).on('click', ".z-popup .selchange", function(e){
var scon = $(this).closest('.subtabs');
var intabcon = $(this).closest('.intabcon');
scon.find('.selchange').removeClass('active');
$(this).addClass('active'); 
getstyle(intabcon,cselem,true);
});

$(document).on('change keyup', ".z-pop16 .z-pop-inp", function(e){
altcons($(this));
if($(this).is('.sliinp')){
 setslider($(this).closest('.inpcon'));   
}
setstyle($('.wcontrol:visible'), cselem,'input change full',$(this));

});

function altcons(inp){
    settings = inp.data('settings');
        if(inp.is('.altcons')){

if(inp.is('.checker')){
var ival = (inp.prop('checked')) ? inp.attr("data-on") : inp.attr("data-off");
} else{
var ival = inp.val();    
}


var rep = (settings.scope) ? inp.closest(settings.scope) : inp.closest('.intabcon, .repeater'); 
var alts = rep.find(".altcon."+inp.attr("id"));
alts.addClass('disabled').hide();
if(isset(ival) && ival.length>0){
alts.filter("."+ival).removeClass('disabled').show();

alts.filter(".allexept").removeClass('disabled').show();
alts.filter(".allexept#"+ival).addClass('disabled').hide();
alts.filter(".notEmpty").removeClass('disabled').show(); 
} else{
alts.filter(".onEmpty").removeClass('disabled').show();  
}
}
}
function dependeds(settings,inp,ival){
  if(!settings.depended && !settings.dependedOpt){
    return;
    }
var con = (settings.scope) ? inp.closest(settings.scope) : inp.closest('.wcontrol'); 
    
if(settings.depended){
if(!ival || ival.length == 0 || ival == settings.disableval){
    con.find("."+settings.depended).addClass("disabled");
} else{
 con.find("."+settings.depended).each(function(){
  $(this).removeClass("disabled"); 
  //pick default units 
  if($(this).find(".numgroup-unit").length > 0 && $(this).find(".numgroup-unit .active").length == 0){
  setunits($(this).find(".numgroup-unit span").eq(0));
  }
}); 

}
}

if(settings.dependedOpt){ 
 
 con.find("."+settings.dependedOpt).addClass("disabled");
 if(!isset(ival)){
    return;
 }
if(settings.prefix || settings.suffix){
   ival = inp.val();
} 
 con.find("."+settings.dependedOpt+"."+ival).each(function(){
   $(this).removeClass("disabled"); 
  //pick default units 
  if($(this).find(".numgroup-unit").length > 0 && $(this).find(".numgroup-unit .active").length == 0){
  setunits($(this).find(".numgroup-unit span").eq(0));
  }
}); 
}
}
var strt = false;
$(document).on('propertychange click keyup input paste', ".z-pop16 .inpcon .z-pop-inp", function(e){
if(!strt && e.type == 'input'){

    strt = true;
} else if(strt && e.type=='click'){

   strt = false;
}
if($(this).data('lastval') != $(this).val()){
    
  if($(this).closest(".numgroup").find(".linked").is(".active")){
$(this).closest(".numgroup").find(".z-pop-inp").val($(this).val());    
}  
    
     setstyle($(this).closest('.inpcon, .intabcon1'), cselem,'live input change',$(this));
    
    $(this).data('lastval',$(this).val());
}
});

//pop close
$(document).on('click',".z-close, .pop-close", function(){
$(this).closest(".z-popup").hide();
});


/**
 * Version history
 */
var vHistory = [];
var vhPoint = -1;

var tinfo = true;
var hasChanges = false;
function addPoint(action){
  if(action != 'init'){
    hasChanges = true;
  }
  
    var prevpoint = vhPoint;   
    var changes = [];
    
    vhPoint++;
vHistory[vhPoint] = {};
vHistory[vhPoint]['action'] = action;

vHistory[vhPoint]['html'] = [];
if(prevpoint != -1 && vHistory[prevpoint]['html'][0] == f('.sitekly-container').html()){
vHistory[vhPoint]['html'] = vHistory[prevpoint]['html'];  
} else{
vHistory[vhPoint]['html'] = [f('.sitekly-container').html()]; 
changes.push('html'); 
}   

   
vHistory[vhPoint]['scroll'] = $frame.contents().scrollTop();


vHistory[vhPoint]['css'] = [];

f(".astyles").each(function(index){
if(prevpoint != -1 && vHistory[prevpoint]['css'][index][0] == $(this).html()){
 vHistory[vhPoint]['css'][index] = vHistory[prevpoint]['css'][index];  
} else{
 vHistory[vhPoint]['css'][index] = [$(this).html()];   
 changes.push('css'+index);
}

})

if(prevpoint != -1 && JSON.stringify(vHistory[prevpoint]['globals']) == JSON.stringify(globals)){
vHistory[vhPoint]['globals'] = vHistory[prevpoint]['globals'];  
} else{
vHistory[vhPoint]['globals'] = jQuery.extend(true, {}, globals); 
changes.push('globals'); 
}


vHistory[vhPoint]['menus'] = [];
if(prevpoint != -1 && vHistory[prevpoint]['menus'][0] == allmenus.html()){
vHistory[vhPoint]['menus'] = vHistory[prevpoint]['menus'];  
} else{

vHistory[vhPoint]['menus'] = [allmenus.html()]; 
changes.push('menus'); 
}    

vHistory.splice(vhPoint+1);

sleft();
if(vhPoint == 1 && tinfo){
 $(".z-topinfo").css("display","block");   
}
if(vhPoint == 2){
 $(".z-topinfo").hide();      
 tinfo = false;
}
vHistory[vhPoint]['changes'] = changes;


//temp
//$('.hmess').text(action);
//setTimeout(function(){ $('.hmess').text(""); }, 3000);
fcw('body').trigger('pointAdded');
}
$(document).on('click', ".tool-sback", function(event){
if(vhPoint > 0){
vhPoint -=1;
hstep(vhPoint+1);
}
});
$(document).on('click', ".tool-sforw", function(event){
if(vHistory[vhPoint+1]){    
vhPoint += 1;
hstep(vhPoint);
}
});
$(document).on('mouseover mouseout click', ".harrows", function(e){
$('.hmess').text("");  
if(e.type != "mouseout"){
  if($(this).is('.tool-sback') && vhPoint > 0){

    $('.hmess').text(lang.undo+": "+lang[vHistory[vhPoint]['action']]);
  } else if($(this).is('.tool-sforw') && vHistory[vhPoint+1]){
    $('.hmess').text(lang.redo+": "+lang[vHistory[vhPoint+1]['action']]);
  }  
}
});

function hstep(checkp){
$frame.contents().scrollTop(vHistory[checkp]['scroll']); 
f(".astyles").each(function(index){
if(vHistory[checkp]['changes'].indexOf('css'+index) !== -1){
$(this).html(vHistory[vhPoint]['css'][index][0]);
}
});
if(vHistory[checkp]['changes'].indexOf('html') !== -1){
f('.sitekly-container').html(vHistory[vhPoint]['html'][0]);
}
if(vHistory[checkp]['changes'].indexOf('globals') !== -1){
globals = jQuery.extend(true, {}, vHistory[vhPoint]['globals']); 
globalsInit();
} 
if(vHistory[checkp]['changes'].indexOf('menus') !== -1){
allmenus.html(vHistory[vhPoint]['menus'][0]);
}

columnResize(f('.sitekly-container'));
sleft();
   
refreshSS();
}

function sleft(){
$(".tool-sforw, .tool-sback").removeClass("active");
if(vHistory[vhPoint+1]){
$(".tool-sforw").addClass("active");
}
if(vHistory[vhPoint-1]){
$(".tool-sback").addClass("active");
}
} 
   
//a click
onframe('click', "a", function(event){
event.preventDefault();
var href = $(this).attr('href');
if(isset(href) && href.startsWith('#') && href.length > 1){
$frame.contents().scrollTop(f(href).offset().top);     
}
});
$(document).on('click', ".toggle", function(event){
    $(this).toggleClass('active');
    dropDown = true;
});
//views
$(document).on('click', ".tool-view", function(event){
 if(editEnabled && !$(this).is('.active')){  
var scroll = cselem.offset().top - $frame.contents().scrollTop();  
 }
$(".tool-view").removeClass("active");
$(this).addClass("active");
$("iframe.site").attr("id",$(this).attr("id"));
f(".sitekly-container").attr("id",$(this).attr("id"));
var vi = $(this).index();
refreshSS();
//$(".rcss link").each(function(){
// var i = $(this).index(); 
// if(i> vi){
//  this.sheet.disabled = true;  
// } else {
//  this.sheet.disabled = false;    
// }
// 
//   
//})
//$(".rcss-noinherit link").each(function(){
// var i = $(this).index(); 
// if(i == vi){
//  this.sheet.disabled = false;  
// } else {
//  this.sheet.disabled = true;    
// }
// 
//   
//})

if(editEnabled){
    
    tempElems = {};
    preparePop(cselem,true);
    if(scroll){
     $frame.contents().scrollTop(cselem.offset().top-scroll);   
    }
  // getstyle($('.wcontrol.active'),cselem,false);
}
fcw('body').trigger('viewChanged');
});

function refreshSS(){
 var vi = $(".tool-view.active").index();   
  f(".astyles").each(function(){
 var i = $(this).index(); 
 if(i> vi){
  f(".astyles").eq(i)[0].sheet.disabled = true;  
 } else {
  f(".astyles").eq(i)[0].sheet.disabled = false;    
 } 
});  
}


function epages(){
    var epages = {};  
allpages.find("page").each(function(){
    if($(this).is('.sub')){
      var url = $(this).prevAll("page:not(.sub)").eq(0).find("url").text()+'/'+$(this).find("url").text();
    } else{
     var url = $(this).find("url").text();
    }
  var autoHidden = ($(this).is('.hide')) ? 'hide' : 'show';
    
 epages[$(this).attr("id")] = {
  "index":$(this).index(),
  "name":$(this).find("name").text(),
  "url":url,
  "hidden":autoHidden,
  "title":$(this).find("title").text(),
  "description":$(this).find("description").text(),
  "keywords":$(this).find("keywords").text(),
  "altlang":$(this).find("altlang").text(),
  "content":$(this).find("content").html()
 };   
});
return epages;
}
//switch version
searchOpen = false;
dropDown = false;
$(document).on('click', ".tool-version li.active", function(event){
$('.tool-version').toggleClass('open');
searchOpen = true;
});
$(document).on('click', ".tool-version li:not('.active, .disabled')", function(event){
if($(this).is('#pv')){
    document.location.href=window.location.href;
} else{
    openDraft();
}
});
onboth('mouseup', "", function(e){
if(searchOpen && !$(e.target).is('li.active')){
 $('.tool-select.open').removeClass('open');
 searchOpen = false;   
}
if(dropDown && $(e.target).closest('.z-topcon').length == 0){
    $('.toggle').toggleClass('active');
    dropDown = false;
}
});
  
 
//save and publish
var leave = true;
var expdata = {};
$(document).on('click', ".tool-save", function(event){
 $('#preloader').show();    
    
var draft;
 allpages.find('#'+$("body").attr("id")).children('content').html(f(".sitekly-container").html());
 
 globalsClean();
 
 allpages.find('content').each(function(){
 //var p = $("<div>").prepend($($(this).text())); 
 
 //cleanPublish(p)
 cleanPublish($(this));
 getThumbs($(this));
 updateGlobalsAll($(this));  
//$(this).text(p.html());
});

runFunction('getExports');
runFunction('getDynamicReady');

 var os = {};
f(".astylec style").each(function(){
    var s = $(this).html();
    var id = $(this).attr('id');
    os[id] = s;
    
});
ostyle = JSON.stringify(os);

 var draft = $(this).is(".draft") ? true : false;   


fpages = epages();

fpages = JSON.stringify(fpages);

var raw = $(globalSettings['website']['raw']);
raw.removeAttr('id class');
$.each(raw[0].attributes, function(i, attrib){
    globalSettings['website'][attrib.name] = attrib.value;
});
globalSettings['website']['raw'] = raw[0].outerHTML;
var settings = JSON.stringify(globalSettings);

globals = JSON.stringify(globals);

var data = {
  "pages":fpages,
  "settings":settings,
  "ostyle": ostyle,
  "globals": globals,
  "thumbs": JSON.stringify(thumbs),
  "allmenus": allmenus.html(),
  'fonts': JSON.stringify(getFonts()),
  "draft": draft,
  'site': siteId
}

$.extend( expdata, data );


 getToken().then((token) => {
    expdata[token.name] = token.value;
 
   $.ajax({
    type:'POST',
    url: window.location.href+'/publish', 
    data: expdata,
    success: function(response) {

     // response = JSON.parse(response);  

      

         if (isset(response.status)){

leave = false;  
$('.lds-roller').remove();
$('.published').show().find('.status').text(response.status);  
if(draft){     
    
    $('.published .tool-close').eq(0).addClass('openDraft');
    $(document).on('click', ".openDraft", function(e){
        e.preventDefault();
        openDraft();
    });   
} 
         }
         else {
            console.log(response);
         }     
    }
    });
    
   }).catch((error) => {
    console.log(error)
  }) 
});

function openDraft(){
  getToken().then((token) => {  

var form = $('<form action="' + window.location.href + '" method="post">' +
  '<input type="text" name="draft" value="true" /><input type="text" name="'+token.name+'" value="'+token.value+'" />' +
  '</form>');
$('body').append(form);
form.submit();  
}).catch((error) => {
    console.log(error)
  })
}

function getToken(){
   return new Promise((resolve, reject) => {  
    $.ajax({
    url: window.location.href+'/token', 
    type: 'GET',
    success: function(res) {
        resolve(res)
    },
    error: function (error) {
        reject(error)
    },
});
})
}

$(window).on('beforeunload', function(){

    if(leave && hasChanges){
        //lang.sure_close_editor
  return confirm("Do you really want to close?"); 
  }
});

//});