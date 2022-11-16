$(document).on('click', ".tool-templates",  function(){ 
    $('#lg.tool-view').click();
    $('.z-popmedia.sections').show();
    $('.z-popmedia.sections .p-tab').eq($(this).index()).click();
});

$(document).on('click', ".tool-media",  function(){ 
    $('.z-popmedia.images').show();
    $('.z-popmedia.images .p-tab').eq(1).click();
});

var importData = false;
$(document).on('click', ".sections .isection",  function(){ 
var d = $(this).data('params');

getToken().then((token) => {  
    d[token.name] = token.value;
   $.ajax({
    type:'POST', 
    url: window.location.href+'/import', 
    data:d, 
    
    success: function(response) {
        response = jQuery.parseJSON(response);
        if(isset(response.error)){
            alert(response.error);
         } else {
            importData = response;
            if(isset(importData.html)){
             
             $('.z-popup.sections').hide();
             sortItem = $(importData.html);
             sortItem.removeAttr('data-name').closest('.global').removeClass('global');   
             sorting("start");
             

               $.each( importData.fonts, function( key, value ) {
                loadFont(value);
                });
                

              var con = $(".z-popmedia .img-con");
              $.each( importData.images, function( key, value ) {
                var url = importData.base+value;
                var thumb = importData.base+"systhumb/"+value;

                if(con.find( "div[src='"+url+"']" ).length == 0){
                $($('<div class="myimages">').css("background-image","url("+thumb+")").attr('src',url)).insertAfter(con.find('#imgform'));
                }
                });
                
            }
         }
         
    }
    });
 
}).catch((error) => {
    console.log(error)
  })

});

function addimportedCss(){
  if(importData != false){
    f(".astylec style").each(function(){
    var id = $(this).attr('id');
    if(isset(importData[id])){
        $(this).append(importData[id]);
    } 
});
$('#lg.tool-view').click();
importData = false;
  }  
}
function getFonts(){  

var allFonts = {}; 
var checked = [];

allpages.find('content').each(function(){

 var p = f(".sitekly-container").html($($(this).html())); 
p.find("*").each(function(){
 var ff = $(this).css("font-family").replaceAll('"','');
 var fw = $(this).css("font-weight");
 if(!allFonts[ff]){
    if(!isset(gfonts[ff])){
        return;
    }
    allFonts[ff] = [];
 }

 if(allFonts[ff].indexOf(fw) === -1 && checked.indexOf(ff+fw) === -1){
    var fvar = gfonts[ff].split(',');
   if(fvar.indexOf(fw) === -1) {

var cw = false;


if(fw > 500){
    for(i=600; i<1000; i+=100){
        if(fvar.indexOf(i.toString()) !== -1) {
        cw = i;
        }
    }  
}
 
if(!cw && fw == '400' && fvar.indexOf('500') !== -1){
cw = '500';

} 

if(!cw && fw == '500' && fvar.indexOf('400') !== -1){
cw = '400';

} 
if(!cw){
    for(i=500; i>0; i-=100){
        if(fvar.indexOf(i.toString()) !== -1) {
        cw = i;
        }
    }

}

if(cw){
   allFonts[ff].push(cw);
}

  
  if(checked.indexOf(ff+fw) === -1){
    checked.push(ff+fw)
  }  
  
   } else{
   
  allFonts[ff].push(fw);
  }
  
 }
})
});

return allFonts; 
}

function getSectionFonts(elem){
    var allFonts = {}; 
var checked = [];
elem.find("*").each(function(){
 var ff = $(this).css("font-family").replaceAll('"','');
 var fw = $(this).css("font-weight");
 if(!allFonts[ff]){
    if(!isset(gfonts[ff])){
        return;
    }
    allFonts[ff] = [];
 }

 if(allFonts[ff].indexOf(fw) === -1 && checked.indexOf(ff+fw) === -1){
    var fvar = gfonts[ff].split(',');
   if(fvar.indexOf(fw) === -1) {

var cw = false;


if(fw > 500){
    for(i=600; i<1000; i+=100){
        if(fvar.indexOf(i.toString()) !== -1) {
        cw = i;
        }
    }  
}
 
if(!cw && fw == '400' && fvar.indexOf('500') !== -1){
cw = '500';

} 

if(!cw && fw == '500' && fvar.indexOf('400') !== -1){
cw = '400';

} 
if(!cw){
    for(i=500; i>0; i-=100){
        if(fvar.indexOf(i.toString()) !== -1) {
        cw = i;
        }
    }

}

if(cw){
   allFonts[ff].push(cw);
}

  
  if(checked.indexOf(ff+fw) === -1){
    checked.push(ff+fw)
  }  
  
   } else{
   
  allFonts[ff].push(fw);
  }
  
 }
})
return allFonts; 
}