/**
 * round number to 10
 */
function round(number){
    number = parseInt(number);
    return Math.round(number / 10) * 10;
};

/**
 * get element type
 */
 function gettype(elem){
 var type;
  $('.wcontrol').each(function(){
  if(elem.is($(this).data('selector'))){
    type = $(this).attr('id');
    return false;
  }  
  });    

return type;    
}
/**
 * get settings from prop
 */
function getPropSettings(el,type){
      var jset = el.attr("data-settings");
  
  if (typeof jset !== typeof undefined && jset !== false) {
   var allsettings = JSON.parse(jset);  
   var settings = allsettings['default'];
   if(allsettings[type]){
    jQuery.extend(settings, allsettings[type]);
   }
   
  } 
  
  return settings;
}
/**
 * get or create elem id
 */
function getId(elem){
          if (typeof elem.attr('id') !== typeof undefined && elem.attr('id') !== false) {
    return elem.attr('id');
    } else{
        var id = "s-"+makeid(8);
       elem.attr("id",id);  
       return id; 
    }
}
function getClass(elem){
    var cl = elem.attr('class').match(/\bs-[a-z0-9]+/);
    if (cl != null) {
    return cl[0];
    } else{
        var cl = "s-"+makeid(8);
       elem.addClass(cl);  
       return cl; 
    }
}
/**
 * update selector and show in dynamic fields
 */
function activeTemp(settings,inp){
    var activeTemp = inp.closest('.intabcon').find('.selchange.active');
if(activeTemp.length !=0){
  
    var tempSelector = activeTemp.attr('data-selector');
    var index = 0;
    settings.show = settings.show.split(':');
    
        if(tempSelector !== undefined && tempSelector != 'default'){
          settings.selector = tempSelector; 
          index = activeTemp.index();
        }
       if(settings.show[index]){
        settings.show = settings.show[index];
       }  else{
        settings.show = settings.show[0];
       }
          
}
return settings;
}
/**
 * find selector elem, create temp item for css and get css
 */
 function prepareTemp(settings,elem,inp){
    
if(settings.outsideSelector){
 if (settings.outsideSelector.match("[frame]")) {

   return f(settings.outsideSelector.replace('[frame]',''));
} else{
 return $(settings.outsideSelector);   
}

}
  
    var id = getId(elem);
          if(settings.selector){
            
     selector = settings.selector.split(',');
     settings.selector = selector[0];
selector.forEach(function(item,index,selector) {
   var ita = item.split(' ');
   item = item.replace(/ /g,">");
   if(ita[0] == 'useClass'){
    var cl = getClass(elem);
    selector[index] = item.replace('useClass','.'+cl);
   } else{
    selector[index] = "#"+id+">"+item;
   }
});
el = elem.find(settings.selector).eq(0);
selector = selector.join();
     
   } else{
    selector = "#"+id;
    el = elem;
   }
  selector = selector.replace(/>:hover/g,":hover");
  selector = selector.replace(/>\[this\]/g,"");
  
    var repeater =  false;
    if(inp.closest('.repeater').length !=0){
        repeater = true;
    var parent = inp.closest('.repeater-container').data('parent');
    var index = inp.closest('.repeater').index();
        if(settings.selector){
        var rx = new RegExp('^'+parent);
    el = elem.find(parent).eq(index).find(settings.selector.replace(rx,'')).eq(0);
   } else{
    el = elem.find(parent).eq(index);
   }
   }


     if(selector.indexOf(":") != -1 || settings.iprop && !repeater || settings.special == 'gradient' || settings.special == 'shadow'){
       
    if (tempElems[selector]){ 
        el = tempElems[selector];
        } else{
          el = $('<div>');
        tempElems[selector] = el;  
        
            var rul = escapeRegExp(selector+"{"); 

            var filter = new RegExp(rul+"(.*?)}");
            var astyle = f(".astyles#"+f(".sitekly-container").attr('id'));
            if(astyle.html().match(filter) !== null){
            var tpstyl = astyle.html().match(filter)[1];
            el.attr("style",tpstyl);
            }
        }
        
      if (jQuery.inArray( selector, livetemps ) == -1){ 
        livetemps.push(selector);
        inp.data('selector',selector);
        }   
        
        
   }
   inp.data('el',el);
   inp.data('settings',settings);
   return el;
 }
 
/**
 * getsuffix from value
 */
function getsuffix(ival){
   // if (typeof jset !== typeof undefined && jset !== false) {
   var suffix = "";
    if(isset(ival)){
           if(ival.match(/%$/)){  
        suffix = '%';
       } else if(ival.match(/vh$/)){  
        suffix = 'vh';
       } else if(ival.match(/vw$/)){  
        suffix = 'vw';
       } else if(ival.match(/rem$/)){  
        suffix = 'rem';
       } else if(ival.match(/em$/)){  
        suffix = 'em';
       }else{
        suffix = "px";
       }
   }   
       
   // } else {
     //  suffix = "px"; 
   // }
       return suffix;
}

/**
 * sanitize links
 */
function sanUrl(val){
    val = val.toLowerCase();
    var f = [' ',',','/','ą','ć','ę','ł','ń','ó','ś','ź','ż'];
    var r = ['-','-','-','a','c','e','l','n','o','s','z','z'];
f.forEach(function( l, i) {
    val = val.replace( new RegExp( l, 'g' ), r[i] );
});
val = val.replace(/[^a-zA-Z-_0-9]+/g, '');
    return val;
};
function escapeRegExp(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
}
/**
 * create rand id string
 */
 function makeid(len) {
  var text = "";
  var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
    
  for (var i = 0; i < len; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
function url2src(val){
  if(val.match("^url")){
   return val.split('"')[1];
} else{
    return val;
}  
}
function src2url(val){
    if(!isset(val)) return '';

  if(val.match("^url")){
   return val;
} else if(val.length > 0){
    return 'url("'+val+'")';
} else{
    return "";
} 
}
function relativePath(url){
    if(!isset(url)){
     return "";
  } else{
   return url.replace(siteBase,'');
    }
}
function absolutePath(url){
    if(!url.includes(siteBase)){
  url = siteBase+url;
  }
    return url;

}
function rgb2hex(rgb) {
    rgb = rgb.split("(")[1].split(")")[0].split(",");
  return "#" + ((1 << 24) + (parseInt(rgb[0]) << 16) + (parseInt(rgb[1]) << 8) + parseInt(rgb[2])).toString(16).slice(1);
}
function hex2rgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
   var rgb = result ? [
    parseInt(result[1], 16),
    parseInt(result[2], 16),
    parseInt(result[3], 16)
  ] : null;
  if(!rgb) return rgb;
  return 'rgb('+rgb.join(', ')+')'
}
function rgba2hex(orig) {
  var a, isPercent,
    rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
    alpha = (rgb && rgb[4] || "").trim(),
    hex = rgb ?
    (rgb[1] | 1 << 8).toString(16).slice(1) +
    (rgb[2] | 1 << 8).toString(16).slice(1) +
    (rgb[3] | 1 << 8).toString(16).slice(1) : orig;

  if (alpha !== "") {
    a = alpha;
  } else {
    a = 01;
  }
  // multiply before convert to HEX
  a = ((a * 255) | 1 << 8).toString(16).slice(1)
  hex = hex + a;

  return hex;
}

function issetIndex(v){
    if(typeof(v) != "undefined" && v !== null && v !== -1){
     return true;   
    } else {
        return false;
    }
}
function isset(v){
    if(typeof(v) != "undefined" && v !== null && v === v && v.length != 0){
     return true;   
    } else {
        return false;
    }
}
 function isfun(fname){

    if(isset(fname)){
        var fn = window[fname];
    if (typeof fn === "function"){
        return true;
    } else{
      return false;  
    }
    }
 }
 function ischecked(inp){
 if(inp.is(":checked")){
    return true;
 } else{
    return false;
 }
}
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function repeaterLabel(val,inp){

   var handle = inp.closest('.repeater').find('.repeater-handle'); 
    if(inp.is('.impr.icons')){

     handle.html(inp.html());   
    } else if(inp.is('.impr') || inp.is('.imgurl')){
     handle.css('background-image',val);   
    } else if(inp.is('.tiny')){
       handle.html(val); 
    } else{
      if(inp.is('select')){
        val = inp.children('option:selected').text();
      }  
   handle.text(val);
   }
}

$.fn.dataAttr = function() { 
        var d = {}, 
        re_dataAttr = /^data\-(.+)$/;

    $.each(this.get(0).attributes, function(index, attr) {
        if (re_dataAttr.test(attr.nodeName)) {
            var key = attr.nodeName.match(re_dataAttr)[1];
            d[key] = attr.nodeValue;
        }
    });

    return d;
};