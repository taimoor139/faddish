//var section;
//$(document).on('click', ".b-tools .b-tsave", function(event){
//section = $(this).closest(".sitekly-block").clone();
//exportSection(section);
//});

//function exportSection(section){
//removeHelpers(section);
//section.find('.global').removeClass('global');
//section = manageCss(section,'e');
//return section;
//}
var blockpage = 'blocks-p8istsf8y';
function exportSections(){
   // var sections =  $(allpages.find('#'+blockpage).children('content').text());
   var sections =  allpages.find('#'+blockpage).children('content').children();
    var secex = {};
    sections.find('.global').removeClass('global');
    sections.each(function(index){  
     section = manageCss($(this),'er'); 
     secex[index] = {};
     secex[index]['html'] = $('<div>').prepend(section.clone()).html();
     secex[index]['selectors'] = section.data('selectors');
     secex[index]['category'] = section.attr('data-name');
     secex[index]['lg'] = section.data('lg');
     secex[index]['md'] = section.data('md');
     secex[index]['sm'] = section.data('sm');
     secex[index]['xs'] = section.data('xs');

     
    });
    return secex;    
}

function exportPages(){ 
    var pex = {};

    

    allpages.find("page").each(function(){
        if($(this).is('#'+blockpage)){
            return;
        }
        var index = $(this).attr('id');
        var page = $($(this).children("content").html());
        page.find('.global').removeClass('global');
    
     section = manageCss(page,'e'); 
     pex[index] = {};
     pex[index]['html'] = $('<div>').prepend(section.clone()).html();
     pex[index]['selectors'] = section.data('selectors');
     pex[index]['title'] = $(this).children("title").text();
     
     pex[index]['lg'] = section.data('lg');
     pex[index]['md'] = section.data('md');
     pex[index]['sm'] = section.data('sm');
     pex[index]['xs'] = section.data('xs');

     
    });
    return pex;    
}

function getExports(){
var thumb = confirm(lang.update_thumb);

//$('.tool-navigate li#'+blockpage).click();
 var os = {};
f(".astylec style").each(function(){
    var s = $(this).html();
    var id = $(this).attr('id');
    os[id] = s;
    
});

var data = {
"ostylefull": JSON.stringify(os),
'fontsfull': JSON.stringify(getFonts()),
"sections": JSON.stringify(exportSections()),
"epages": JSON.stringify(exportPages()),
"thumb": thumb,
'pagesfull': JSON.stringify(epages()),
}
allpages.find('#'+blockpage).remove();
$.extend( expdata, data );

}

$(document).on('click', ".tool-blocks-edit", function(event){

});
function hideBlocks(pop,el,elem,inp){
    if(el.is("#"+blockpage)){
        inp.closest('.repeater').find('.control').remove();
        inp.closest('.repeater').children().eq(0).nextAll().hide(); 
    }
}
var sectionCategoriesData;
function sectionCategories(pop,el,elem,inp){
    
    var con = inp.closest('.intabcon');
    if($('body').attr('id') != blockpage){
        con.find('.psg').addClass('off');
      // con.hide().prev('.intab').hide(); 
    } else{
      var sname = elem.data('name');  
      var isCustom = true;  
      con.find('.psg').removeClass('off');
    
    inp.html("");
    if(!isset(sectionCategoriesData)){
        sectionCategoriesData = $('#sectionCategory').data('options');
    }
    $.each( sectionCategoriesData, function( key, value ){
     inp.append('<option value="'+key+'">'+value+'</option>');
     
     if(isset(sname) && key.toUpperCase() == sname.toUpperCase()){
      isCustom = false;  
     }
});
    inp.prepend('<option value="customLink">'+lang.add_new+'</option>');
    if(isCustom){
     inp.val('customLink');   
    } else{
    inp.val(sname);    
    }
    }
}
//remove css rule using selector
function remcss(cid){
    cid = escapeRegExp(cid).replace(/\s/g, '');
 f('.astyles').each(function(){
var filter = new RegExp(cid+"[^{}]*{[^{}]*}","g");
var astyle = $(this);
if(matches = astyle.html().match(filter)){
    matches.forEach(function (item, index) {
        astyle.html(astyle.html().replaceAll(item,"")); 

    });
}
});
}


function cleanCss(){
    allHtml = $('<hall>');
 allpages.find('#'+$("body").attr("id")).children('content').html(f(".sitekly-container").html());
        allpages.find("page").each(function(){
        if($(this).is('#'+blockpage)){
         //   return;
        }

        var page = $('<div>').prepend($(this).children("content").html());

        page.find(".sitekly-block, .sitekly-col, .sitekly-edit, .slide").each(function(){
        var $this = $(this);
        
        var item = $("<"+$this.prop("tagName")+">");
        item.attr('class',$this.attr('class')).attr('id',$this.attr('id'));
        
        allHtml.prepend(item);
        });

    });
    
          for (var key in globals) {

        var page = $(globals[key]['content']);
        page.find(".sitekly-block, .sitekly-col, .sitekly-edit, .slide").each(function(){
        var $this = $(this);
        
        var i = $("<"+$this.prop("tagName")+">");
        i.attr('class',$this.attr('class')).attr('id',$this.attr('id'));
        
        allHtml.prepend(i);
        });
    };
    
missing = [];    
     f('.astyles').each(function(){
var filter = new RegExp("[#|.][^{}]*{[^{}]*}","g");
var ifilter = new RegExp("[#|.]s-[a-zA-Z0-9]+");
var astyle = $(this);

if(matches = astyle.html().match(filter)){  
    matches.forEach(function (item, index) {
       
        if(imatches = item.match(ifilter)){ 
            if(allHtml.find(imatches[0]).length == 0){
             missing.push(imatches[0]);   

            astyle.html(astyle.html().replaceAll(item,""));   
            }
        }
 

    });
}

});
    
}

 onframe('click', ".z-export", function(e){
var $clone = manageCss(activeItem.clone(),'c').removeClass("active global").removeHelpers();
allpages.find('#'+blockpage).children('content').append($clone);

 });