var fselectpsg = false;
function palette_get(pop,el,elem,inp,settings,tempchange){
inp.next('.palette-con').html('');

    var all = palette_allCss();
    if(settings.select == 'sbg'){
        
        var colors = design_get_val(all,'sbg');
        $.each( colors, function( key, value ) {
        inp.next('.palette-con').append('<div class="blank-con"><div class="cpicker gcolor" style="background-color:'+value+'"></div></div>');
        });
    } else if(settings.select == 'gbg'){
        
        var colors = design_get_val(all,'gbg');
        $.each( colors, function( key, value ) {
        var ca = value.split(':');
        inp.next('.palette-con').append('<div class="palette-grad-con blank-con"><div class="cpicker gcolor" style="background-color:'+ca[0]+'"></div><div class="cpicker gcolor" style="background-color:'+ca[1]+'"></div></div>');
        });
    } else if(settings.select == 'fc'){
        
        var colors = design_get_val(all,'fc');
        $.each( colors, function( key, value ) {
        inp.next('.palette-con').append('<div class="blank-con"><div class="cpicker gcolor" style="background-color:'+value+'"></div></div>');
        });
    } else if(settings.select == 'ff'){
        
        var fonts = design_get_val(all,'ff');
        var con = inp.closest('.intabcon');
        if(!fselectpsg){
          fselectpsg = con.find(".fselect").eq(0).clone();   
        }
        
        
        con.find(".fselect").remove();
        $.each( fonts, function( key, value ) {

          fselectpsg.find('.fontselectinp').val(value);  
        con.prepend(fselectpsg.clone());
        });

    }
}


function palette_set(pop,el,elem,inp,settings){
if(settings.select == 'ff'){
 var prop = inp.closest('.intabcon').find('.fontSelect.active');
 prop.removeClass('active');
 var c = prop.val();   
} else{
 var prop = inp.closest('.psg').find('.cpicker.gcolor.active');
var c = prop.css('background-color');   
}

if(!isset(prop.data('last')) || !isset(c)){
    return;
}


 if(settings.select == 'ff'){
     var filter = new RegExp("font-family: "+escapeRegExp(prop.data('last')),'g');
    
 f(".astylec style").each(function(){  
$(this).html($(this).html().replace(filter, 'font-family: '+c));
 });
 
 prop.parent().siblings().children('.fontSelect').filter(function() {
    return $(this).val().indexOf(c) > -1
}).parent().remove();
 
refreshSS();
return;
} 


 
 if(settings.select == 'sbg'){
     var filter = new RegExp("background-color: "+escapeRegExp(prop.data('last')),'g');
    
 f(".astylec style").each(function(){  
$(this).html($(this).html().replace(filter, 'background-color: '+c));
});

prop.parent().siblings().children('.cpicker').filter(function() {
    return $(this).css('background-color').indexOf(c) > -1
}).spectrum("destroy").remove();
$('#globaldesign .blank-con:empty').remove();
 
} else  if(settings.select == 'fc'){
     var filter = new RegExp("([ {]color: )"+escapeRegExp(prop.data('last')),'g');
    
 f(".astylec style").each(function(){  
$(this).html($(this).html().replace(filter, "$1"+c));
 });
prop.parent().siblings().children('.cpicker').filter(function() {
    return $(this).css('background-color').indexOf(c) > -1
}).spectrum("destroy").remove();
$('#globaldesign .blank-con:empty').remove();
   var spans =  allpages.find('.z-content span').add(f('.z-content span'));
   spans.each(function(){
    var color = this.style.color;
    if(prop.data('last') == color){

        $(this).css('color',c);
    }
    
   });

} 
else if(settings.select == 'gbg'){
    var con = prop.closest('.palette-grad-con');
   var sec = con.children('.gcolor:not(".active")');
   var oldc = [];
   var newc = [];
   oldc[prop.index()] = escapeRegExp(prop.data('last'));
   oldc[sec.index()] = escapeRegExp(sec.css('background-color'));
   
   newc[sec.index()] = sec.css('background-color');
   newc[prop.index()] = prop.css('background-color');

  
  var filter = new RegExp("(background-image: [a-z-]+\\([a-z0-9 %,]+)("+oldc[0]+")([a-z0-9 %,]+)("+oldc[1]+")",'g');  
  var cg = newc[0]+newc[1];  
f(".astylec style").each(function(){     
$(this).html($(this).html().replace(filter, "$1"+newc[0]+"$3"+newc[1]));
});

prop.parent().siblings().filter(function() {
    var cp = $(this).children('.gcolor');
    var cs = cp.eq(0).css('background-color')+cp.eq(1).css('background-color');
    return cg==cs;
}).spectrum("destroy").remove();
$('#globaldesign .blank-con:empty').remove();
 
}
prop.data('last',prop.css('background-color'));
refreshSS();
}
function palette_allCss(){
    var s ="";
    f(".astylec style").each(function(){
   s += $(this).html();  
});
return s;
}

function design_get_val(all,t){
    if(t=='sbg'){
        var regexp = /background-color: (rgba?\([0-9,. ]+\))/g;
    } else if(t=='gbg'){
        var regexp = /background-image: [a-z-]+\([a-z0-9 %,]+(rgba?\([0-9,. ]+\))[a-z0-9 %,]+(rgba?\([0-9,. ]+\))/g;
    } else if(t=='fc'){
        var regexp = /[ {]color: (rgba?\([0-9,. ]+\))/g;
    } else if(t=='ff'){
        var regexp = /font-family: ?([^;']*);?/g;
     }
    
      var val; 
   var vals = [];
  if(t=='sbg' || t=='fc' || t=='ff'){
      while (val = regexp.exec(all)) {
        if(vals.indexOf(val[1]) === -1) {
        vals.push(val[1]);
        }
    } 
  } else if(t=='gbg'){
      while (val = regexp.exec(all)) {
        var ca = val[1]+":"+val[2];
        if(vals.indexOf(ca) === -1) {
        vals.push(ca);
        }
    } 
  }
    if(t=='fc'){
        return design_inline_colors(vals);
    }
    return vals;
}
function design_inline_colors(vals){
  var inlines =  allpages.find('span').add(f('span'));

   inlines.each(function(){
    var color = this.style.color;
    if(color.length != 0 && vals.indexOf(color) === -1) {
        vals.push(color);
    }
    
   });
   return vals;
}
$(document).on('mousedown',".cpicker.gcolor", function(e){
$(this).data('last',$(this).css('background-color'));
});
$(document).on('mousedown',".fselect .fontSelect", function(e){
$(".cpicker.active").removeClass('active');
});
