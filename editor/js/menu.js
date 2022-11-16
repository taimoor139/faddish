var allmenus;
function menusInit(){
allmenus = $('<menus>');
if(menus){
    allmenus.html(menus).html(allmenus.text());
} 
if(allmenus.find('menu#autoMenu').length == 0){
allmenus.prepend('<menu id="autoMenu" name="'+lang.autoMenu+'">');
autoMenu();
 }
}

//function importPages(){
////    $.each( menus, function( key, page ) {  
////if (page.url.indexOf("/") >= 0){
////  var sub = "sub"; 
////  page.url = page.url.split('/')[1]; 
////} else{
////    var sub = "";
////}
////allpages.append('<page id="'+key+'" class="'+sub+'"><name>'+page.name+'</name><url>'+page.url+'</url><title>'+page.title+'</title><description>'+page.description+'</description><keywords>'+page.keywords+'</keywords><content>'+htmlEntities(page.content)+'</content></page>');
//// 
////$(".tool-navigate").append('<li id="'+key+'" class="'+sub+'">'+page.name+'</li>');   
//// 
////
////});
////$('.tool-navigate li').eq(0).click();
//}

function setMenu(){

    cselem.html("");
     var li = $('<li>').append('<a>');
    $('#menu-manage.wcontrol').find('.repeater').each(function(){
       
       if($(this).is('.subitem')){
        var last = cselem.children('li').last();
        last.addClass('parent');
        if(last.find('ul').length == 0){
            last.append('<ul class="subnav">');
        }
        last.find('ul').append(li.clone());
       } else{
        cselem.append(li.clone());
       } 
    });

    

   setstyle($('#menu-manage.wcontrol'), cselem,'set menu',false);  
   setNav();
   
 
}
function setNav(elem){
    
    var m = (elem) ? elem.clone() : cselem.clone();
    m.find('li').removeAttr('id');
//    m.prepend('<a class="toggle"></a>');
    if(elem){
        return m;
    }
    f('.sitekly-container').find('.z-menu[data-id="'+menuActive.attr('data-id')+'"]').each(function(){
    $(this).find('ul.nav').html(m.html());
    updateglobals($(this));
  });
}
 
function menuPagesAddList(pop,el,elem,inp){
    inp.html("");
    allpages.find('page').each(function(){
        inp.append('<option value="'+$(this).attr('id')+'">'+$(this).find('name').text()+'</option>');
    });
    inp.prepend('<option value="customLink">'+lang.customLink+'</option>');
}
$(document).on('click',"#menu-manage.wcontrol .addToMenu", function(event){
    select = $("#menu-manage.wcontrol #linkType");
    
    if(select.val() == 'customLink'){
          if(isset($('#menu-manage.wcontrol .ownlink').val())) {
          var link = $('#menu-manage.wcontrol .ownlink').val();
          var label = lang.customLink;  
        }  
    } else {
       var link = getPageLink(select.val());
       var label = select.find("option:selected" ).text(); 
    }
    
    if(isset(link) && isset(label)){ 
    var c = $(this).closest('.intabcon1').find('.repeater-container');
    var p = c.data('proto');
    var nl = $(p).clone().attr('class','repeater');
    nl.find('.repeater-handle').text(label);
    nl.find('.label').val(label);
    nl.find('.linkid').val(select.val());
    nl.find('.linkhref').val(link);
    if(select.val() != 'customLink'){
        nl.find('.linkhref').attr('disabled','true');
    }
    c.append(nl);
    cselem.append('<li id="'+select.val()+'"><a href="'+link+'">'+label+'</a></li>');
    setNav();
    }
});

$(document).on('repeater:AfterSort repeater:AfterDelete', "#menu-manage.wcontrol", function(event){
setMenu();
});

var menuActive;
$(document).on('mousedown', "#menu.wcontrol .addMenu", function(event){
  menuActive = f(".sitekly-edit.active");  
 var n = $('#menu.wcontrol .menuName');
 if(isset(n.val())){
    n.removeClass('invalid');
    customObject = $('<menu>');
    var id = "m"+makeid(8);
    menuActive.attr('data-id',id);
    customObject.attr('id',id);
    customObject.attr('name',n.val());
    allmenus.append(customObject);  
    menuActive.find("ul.nav").html(""); 
 } else{
    customObject = false;
    n.addClass('invalid');
 }   
});

$(document).on('mousedown', "#menu.wcontrol .editMenu", function(event){
  menuActive = f(".sitekly-edit.active");  
 var id = $('#menu.wcontrol #menuSelect').val();
    prevElem = cselem;
    customObject = allmenus.find('menu#'+id)
  
});

$(document).on('mousedown', "#menu.wcontrol .delMenu", function(event){

 var select = $('#menu.wcontrol #menuSelect');
allmenus.find('menu#'+select.val()).remove();
select.find("option:selected" ).remove();
select.change();
cselem.find("ul.nav").html("");
  
});

//$(document).on('click', "#menu-manage.wcontrol .toMenu", function(event){
//menuActive.find('.z-style').click();
//});
function menuAddList(pop,el,elem,inp,settings,reget){
    
    inp.html("");
    allmenus.find('menu').each(function(){
        inp.append('<option value="'+$(this).attr('id')+'">'+$(this).attr('name')+'</option>');
    });
    inp.prepend('<option value="newMenu">'+lang.newMenu+'</option>');
    
    pop.find('.menuName').val('');
    if(isset(elem.attr('data-id'))){
      inp.val(elem.attr('data-id')); 
      pop.find('.menuName2').val(inp.find("option:selected").text());
    } else{
       inp.val('newMenu'); 
    }
    
    
}

function menuListPick(pop,el,elem,inp){
if(inp.val() != "newMenu"){ 
     if(inp.val() != cselem.attr('data-id')){
         var m = allmenus.find( "menu#"+inp.val());
     cselem.attr('data-id',inp.val());
      cselem.find('ul.nav').html(setNav(m).html()); 


      
       $('#menu.wcontrol').find('.menuName2').val(inp.find("option:selected").text());
     }  
}   
}


function menuLinkHref(pop,el,elem,inp){
    inp.val(el.attr('href'));
   if(el.parent('li').attr('id') != 'customLink'){
    inp.attr('disabled','true');
   } else{
    inp.removeAttr('disabled');
   }
}


$(document).on('change', "#menu.wcontrol .menuName2", function(event){
    
  var n = $(this).val();
  var s = $('#menu.wcontrol').find('#menuSelect');
  
 if(n != s.find("option:selected").text()){
    allmenus.find( "menu#"+s.val()).attr('name',n); 
    s.find("option:selected").text(n);
 }   
});
$(document).on('change', "#menu-manage.wcontrol .linkhref, #menu-manage.wcontrol .label", function(event){
setNav();
});