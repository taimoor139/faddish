editmode = true;
var inlineTinyActive = false;  

$(document).on('change','.sitekly-edit.video',function(){
  var $this = $(this);
   var data = vidata($this);

    var custom = url2src(data.cthumb);

   if(custom && custom != 'none'){
    $this.find('.vidcon').css('background-image','url("'+custom+'")');
   } else {
        custom = false;
   }
   

   if(data.href == $this.data('prevhref')){
        if(!custom){
            $this.find('.vidcon').css('background-image','url("'+data.thumb+'")');
        }
    return;
   }
   $this.data('prevhref',data.href);
   $this.find('iframe').attr('src','');
   var bg;
   if(data.type == 'yt'){
    bg = 'https://img.youtube.com/vi/'+data.id+'/maxresdefault.jpg';
    $this.attr('data-thumb',bg);
    if(custom) return;
    $this.find('.vidcon').css('background-image','url("'+bg+'")');

   } else {
            $.get( "https://vimeo.com/api/oembed.json?url="+data.href, function( response ) {
          if(typeof(response.thumbnail_url != 'undefined')){
            bg = response.thumbnail_url;
            $this.attr('data-thumb',bg);
            if(custom) return;
            $this.find('.vidcon').css('background-image','url("'+bg+'")');
          }
        }); 
  
   }
    
   
});
$(document).on('loaded', "body",  function(){ 
$('.carousel').carousel('init');
galleryInit();
});
$(document).on('pointAdded', "body",  function(){ 
stretch();
});
$(document).on('viewChanged', "body",  function(){ 
    $('.carousel').carousel('dots');
});
$(document).on('init dots added','.carousel',function(e){

if(e.type == 'added'){
  $(this).carousel('init');  
} else if(e.type == 'init'){
$(this).carousel('init');
} else{
 $(this).carousel('dots');   
}
});

$(document).on('showslide', ".slide",  function(){
stretch($(this));
});
function url2src(val){
    if(!isset(val)) return "";
  if(val.match("^url")){
   return val.split('"')[1];
} else{
    return val;
}  
}


    const pTinyConfig = { 
    selector: '.inlinetiny.tinyp',
  resize: false,
  skin: "sitekly",
  height: 350,
  menubar: false,
  branding: false,
  inline: true,
  contextmenu: false,
  invalid_elements: 'div',
  forced_root_block : '',
//  plugins: [
//    'advlist autolink lists link charmap print preview anchor',
//    'searchreplace visualblocks code fullscreen',
//    'insertdatetime media table paste code help wordcount '
//  ],
    plugins: [
      'link lists'  
  ],
  toolbar: 'align bold italic underline strikethrough forecolor link bullist numlist removeformat code customEditButton',

          setup: function(editor) {
        editor.on('blur', function(e){
            e.stopImmediatePropagation();
            removeInlineTiny();
            
        });
        
        editor.ui.registry.addIcon('cog', '<svg height="24" viewBox="0 0 24 24" width="24"><path class="heroicon-ui" d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>');
            editor.ui.registry.addButton('customEditButton', {
        icon: 'cog',
        onAction: function (_) {
        var editbtn = activeTiny.closest('.sitekly-edit');    
        removeInlineTiny();
        editbtn.find('.z-style').click();
        
      }
    });
        
    }
    
    };
    
  const tTinyConfig = Object.assign({},pTinyConfig,{
    selector: '.inlinetiny.tinyt',
         invalid_elements: 'div,p,h1,h2,h3,h4,h5,h6',
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '', 
        toolbar: 'bold italic underline strikethrough forecolor link customEditButton',
   }); 
   
 $(document).ready(function() {
    $('body').append('<div id="inlinetinycon"><div class="inlinetiny tinyt" style="display: none;"></div><div class="inlinetiny tinyp" style="display: none;"></div></div>');
    tinymce.init(tTinyConfig);
    tinymce.init(pTinyConfig);

});

function removeInlineTiny(){
    if(!inlineTinyActive) return; 
    inlineTinyActive = false;
    var $it = activeTiny;
    $it.closest('.sitekly-edit').find(".helper3").css("display","");
    $('.tinyEnabled').html($it.html()).removeClass('tinyEnabled').show();
    $("body").append($it);
    $it.hide();
  if(activeTiny.data('html').trim() != activeTiny.html().trim()){
    parent.addPoint('item-edited');
  }
    activeTiny = false;
    
     setTimeout(function(){ 
 tinymce.remove(); 
 }, 10);
 
} 

function tinyCustom(){
    
    $(".tox-split-button[aria-label='Text color']").find('.tox-split-button__chevron').addClass('tinyColorDrop');
    activeTiny.closest('.sitekly-edit').find(".helper3").hide();
    var container = $(tinymce.activeEditor.container);
    if(container.height() > 50){
        container.css({left:'auto',right:'0'});
        container.find('.tox-editor-header').attr('style','');
    }
    
 }
 
function setCaret() {
    
    var el = activeTiny[0];
    var range = document.createRange();
    var sel = window.getSelection();
    if(el.childElementCount == 0){
      range.setStart(el, 1);  
    } else {
      range.setStart(el.childNodes[el.childElementCount-1], 1);  
    }

    range.collapse(true);
    
    sel.removeAllRanges();
    sel.addRange(range);
}
var titleSelectors = '.text.t .z-content, .iconlist span, .iconbox .t, .imgbox .t, .accordion .title';
var pSelectors = '.text.p .z-content, .iconbox .p, .imgbox .p, .accordion .body';
var activeTiny;
$(document).on('click', titleSelectors,  function(){ 
    if($(this).is('.inlinetiny')) return;
    tinyShow($(this),tTinyConfig,'inlinetiny tinyt');

 }); 
$(document).on('click', pSelectors,  function(){ 
    if($(this).is('.inlinetiny')) return;
if(tinyinited){
    $(titleSelectors).eq(0).click();
}
    tinyShow($(this),pTinyConfig,'inlinetiny tinyp');

 }); 
 var tinyinited = true;
 function tinyShow(con,config,cname){ 
  removeInlineTiny();
   var html = con.html();
   activeTiny = $(config.selector);
   activeTiny.insertAfter(con); 
   activeTiny.html(html).show();
   activeTiny.data('html',html)
   activeTiny.attr('class',cname+' '+con.attr('class'));
   activeTiny.css('margin-top','');
 
  if(con.offset().top < 40){
        //container.find('.tox-editor-header').css('top',activeTiny.offset().top+activeTiny.height());
      var margin = 45 - con.offset().top + parseInt(con.css('margin-top')) ;
      activeTiny.css('margin-top',margin);  
    }
   
   con.addClass("tinyEnabled").hide();
   if(!tinyinited){
    setTimeout(function(){ 
   tinymce.init(config);
   },15);
   }
   tinyinited = false;
   inlineTinyActive = true;
   setTimeout(function(){ 
   tinymce.activeEditor.fire("focusin");
    setCaret();
    tinyCustom();  
    }, 50);  
     
 }
  var downCoords; 
 $(document).on('mousedown click', ".sitekly-edit",  function(e){ 
        if(!activeTiny && !$(e.target).parent().is('.tbox')){
            if(event.type == 'mousedown'){
                downCoords = {x:e.pageX, y:e.pageY};
            } else if(Math.abs(downCoords.x - e.pageX) < 5 && Math.abs(downCoords.y - e.pageY) < 5) {
               $(this).find(".z-style").click(); 
            }
            
        }
 });