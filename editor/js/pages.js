var allpages = $('<opages>');
var allLinks = {};

function importPages(){
    $.each( opages, function( key, page ) {  
        
  allLinks[key] = page.url;
        
if (page.url.indexOf("/") >= 0){
  var sub = "sub"; 
  page.url = page.url.split('/')[1]; 
} else{
    var sub = "";
}
page.hidden = (isset(page.hidden)) ? page.hidden : 'show';
page.altlang = isset(page.altlang) ? page.altlang : "";

allpages.append('<page id="'+key+'" class="'+sub+" "+page.hidden+'"><name>'+page.name+'</name><url>'+page.url+'</url><title>'+page.title+'</title><description>'+page.description+'</description><keywords>'+page.keywords+'</keywords><altlang>'+page.altlang+'</altlang><content>'+page.content+'</content></page>');
 
$(".tool-navigate").append('<li id="'+key+'" class="'+sub+'">'+page.name+'</li>');   
 

});
f('body').prepend('<style class="tempstyle">');
f('body').prepend($('.astylec'));
$('.tool-navigate li').eq(0).click();
}


$(document).on('click', ".tool-navigate li.active", function(event){
$('.tool-navigate').toggleClass('open');
searchOpen = true;
});
//menu click
$(document).on('click', ".tool-navigate li:not('.active')", function(event){
$('.tool-navigate').removeClass('open');     
$('.tool-navigate li').removeClass('active');
$(this).addClass('active');
var nid = $(this).attr('id');
var oid = $("body").attr("id");

if(oid){  
  f(".sitekly-container").removeHelpers();
 allpages.find('#'+oid).children('content').html("").prepend(f(".sitekly-container").children());
}
f(".sitekly-container").html('').prepend(allpages.find('#'+nid).children('content').children());

$("body").attr("id",nid);
updateGlobalsAll(f(".sitekly-container"));

//if(allmenus){
//f(".sitekly-container").find(".z-menu").each(function(){
//    var m = allmenus.find('menu#'+$(this).data('id'));
// $(this).find('ul.nav').html(setNav(m).html());
//});
//}

 vhPoint = -1;
 vHistory = [];
 addPoint("init");
 fcw('.video').trigger('change');
//vidset('.sitekly-container');
//gmaps();
//menuUpdate();
columnResize(f('.sitekly-container'));
if(f('body').is('.sorting')){
    sorting("start");
}

fcw('body').trigger('loaded');

});

 $(document).on('repeater:AfterDelete', "#pages.wcontrol", function(event,item){
item = $(item);

//manageCss($('<div>').prepend(item.find("content").html()),'d').remove();
var id = item.attr('id');
if($('body').is('#'+id)){
    var content = f('.sitekly-container').children();
  } else{
   var content = item.find("content").children();
  }
manageCss(content,'d').remove();
updatePageLinks();
});

 $(document).on('repeater:AfterClone', "#pages.wcontrol", function(event,item){
    
   item = $(item);
 var n = item.find('name').text();
 item.find('url').text("");
  url = uniqueUrl(sanUrl(n));

 item.find('url').text(url); 
  var id = "p"+makeid(8);
  var oid = item.attr('id');
  item.attr('id',id);
  
  if($('body').is('#'+oid)){
    var content = f('.sitekly-container').html();
  } else{
   var content = item.find("content").html();
  }


  var nc = manageCss($('<div>').prepend(content),'c');
  item.find("content").html(nc.html());
  
updatePageLinks();

getstyle($(event.target).closest('.intabcon1'),cselem,false);


});


$(document).on('repeater:AfterSort', "#pages.wcontrol", function(event){
updatePageLinks();
});



$(document).on('click',"#pages.wcontrol .addPage", function(event){
  var n = $('#pages.wcontrol .pagename').val();
  if(!isset(n)){
    return false;
  } 
  
  url = uniqueUrl(sanUrl(n));
  var id = "p"+makeid(8);
allpages.append('<page id="'+id+'"><name>'+n+'</name><url>'+url+'</url><title></title><description></description><keywords></keywords><content></content></page>');

getstyle($(this).closest('.intabcon1'),cselem,false);
updatePageLinks();
});

$(document).on('change', "#pages.wcontrol .pname, #pages.wcontrol .purl, #pages.wcontrol .autoHide", function(event){
updatePageLinks();
    });

function uniqueUrl(base,url,i){ 
var found = false; 
url = (isset(url)) ? url : base;   
allpages.find("url").each(function(){
    if(url == $(this).text()){
        found = true;
       return false;
    }
});      
    
if(found){
    i = (isset(i)) ? i+1 : 1;
    url = base+"_"+i;
    return uniqueUrl(base,url,i);
} else{
    return url;
}  
}
var slugcheck;
function validate_slug(pop,el,elem,inp){
 
    if(slugcheck){
        return false;
    }
   
 slugcheck = true;   
 elem.find('page').each(function(){

 var i = $(this).index();
 var inp = pop.find('.purl').eq(i);

      $(this).find('url').text("");
       var curl = isset(inp.val()) ? inp.val() : pop.find('.pname').eq(i).val();
       var curl = isset(curl) ? curl : 'page-name';

     url = uniqueUrl(sanUrl(curl));
     $(this).find('url').text(url);
     inp.val(url);
 });
setTimeout(function(){ slugcheck = false; }, 100);    
}

function getPageLink(id){
    var page = allpages.find('page#'+id);
     if(page.is('.sub')){
       return page.prevAll("page:not('.sub')").eq(0).find("url").text()+"/"+page.find("url").text();
     } else{
     
       return page.find("url").text(); 

     }    
}

function updatePageLinks(){
    autoMenu();
    $(".tool-navigate").html("");
    allpages.children("page").each(function(){
    var url = $(this).find('url').text();
    var id = $(this).attr('id');
    var n = $(this).find('name').text();
    manageLink(id);
         if($(this).is('.sub')){
      var sub = "sub";  
    } else{
        var sub = "";
    }
    
    $(".tool-navigate").append('<li id="'+id+'" class="'+sub+'">'+n+'</li>');  
    });
    var c = $(".tool-navigate li#"+$('body').attr('id'));
if( c.length != 0 ){ 
 c.addClass('active');   
} else{
  $(".tool-navigate li").eq(0).click();  
}

updateMenuAll();
}


function manageLink(id){
    var url = getPageLink(id);    
    if(isset(allLinks[id])){
       if(allLinks[id] != url){
       updateMenusLink(id,url);
       allLinks[id] = url;
       } 
        
        
    } else{
     allLinks[id] = url;   
    }
}
function updateMenusLink(id,url){
 allmenus.find('li#'+id).each(function(){
  $(this).children('a').attr('href',url); 
  $(this).closest('menu').addClass('changed');
 });  

}
function updateMenuAll(){
 allmenus.find('menu.changed').each(function(){
  $(this).removeClass('changed');
  var m = $(this);
  f('.sitekly-container').find('.z-menu[data-id="'+m.attr('id')+'"]').each(function(){
    $(this).find('ul.nav').html(setNav(m).html());
    updateglobals($(this));
  });
 }); 
}

function autoMenu(){
 var auto = allmenus.find("menu#autoMenu");  
auto.html("").addClass('changed');
 allpages.children("page").each(function(){
    if($(this).is('.hide') || $(this).is('.sub') && $(this).prevAll("page:not('.sub')").eq(0).is('.hide')){
        return true;
    }
    var id = $(this).attr('id');
    var url = getPageLink(id);
    var n = $(this).find('name').text(); 
    
    var li = $('<li>').append('<a>');
    li.children('a').attr('href',url).text(n);
    
           if($(this).is('.sub')){
           var last = auto.children('li').last();
           last.addClass('parent');
        if(last.find('ul').length == 0){
            last.append('<ul class="subnav">');
        }
        last.find('ul').append(li.clone());
       } else{
        auto.append(li.clone());
       }
    
    });
}