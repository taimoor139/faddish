var editmode;
$(document).ready(function(){
    
activeAnchor();   
initAnimated();
//stretch();
paralax();
sticky();
$('.carousel').carousel('init');


galleryInit();


    $(".cform form").submit(function(e) {
    if (typeof exportBase !== 'undefined') return;
    
    e.preventDefault();
    var form = $(this);
    var url = $('base').attr('href')+'ajaxform/'+form.closest('.cform').attr('id');
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(),
           success: function(response)
           {
            response = JSON.parse(response);
               alert(response.message);
               if(response.status == 1){
                form[0].reset();
               }
           }
         });

    
});

});



$(window).on('pageshow',function(){ 
sectionSlider(); 
paralax();
sticky();
stretch();
vidauto();
});



function galleryInit(){
      
   $('.gallery .img').each(function(){

        var url = $(this).attr('tsrc');
    if(!url) {
     var url = $(this).attr('data-tsrc');   
    }
    if(!url) return;
    $(this).css('background-image','url("'+url+'")');
   })
    
}
$(document).on('click', ".gallery .imgcon",  function(){ 
    var isopen = ($(".gbig").length != 0) ? 1 : 0;
    $(".gbig").remove();
    $('.gallery .imgcon').removeClass('active');
    var img = $(this).children('.img');
    $(this).addClass('active');
    var g = $(this).closest('.gallery');
    if(!isopen && isset(img.attr('href'))){
        redirect(img.attr('href'));
        return;
    }
url = img.attr('src');
if(!url){
    url = img.css('background-image').split('"')[1];
}
if(!url){
    return;
}
if(g.is('.nofull')){
        return;
}

var alt = isset(img.attr('alt')) ? img.attr('alt') : '';

if(g.is('.intab')){
        redirect(url);
        return;
}

$("body").css("overflow",'hidden').prepend('<div class="gbig"><a class="arrow prev">❮</a><a class="arrow next">❯</a><div class="gbigin" style="display:none;"><img src="'+url+'"/><div class="ialt">'+alt+'</div></div></div>');
$(".gbigin img").on('load',function(){
$(".gbig").css("background-image","none");    
$(".gbigin").css("top",($(".gbig").height() - $(".gbigin").height()) / 2+"px"); 
$(".gbigin").show();
$(".ialt").width($(this).width());  
});

});
function redirect(url){
    if(!url){ return };
    if($('base').attr('href')){
        url = $('base').attr('href')+url;
    }
    if(editmode){
         window.parent.open(url, '_blank');
    } else{
      window.location.href = url;  
    }
}
function isset(v){
    if(typeof(v) != "undefined" && v !== null && v === v && v.length != 0){
     return true;   
    } else {
        return false;
    }
}
$(document).on('click', ".gbig",  function(e){ 
 if($(e.target).is('.arrow')){
    return;
 }   
$(".gbig").remove();
$('body').css('overflow',"");
});
$(document).on('click', ".gbig .arrow",  function(){ 
if($(this).is('.next')){
   var n = $('.imgcon.active').next(); 
} else{
   var n = $('.imgcon.active').prev();
}
if(n.length == 0){
 $(".gbig").click();   
} else{
    n.click();
}
});
/**
 * anchor links
 */
 var autoScroll;
$(document).on('click', "a",  function(e){ 
var $this = $(this);
if($this.attr('href') && $this.attr('href').startsWith('#')){
    e.preventDefault();
  autoScroll = true;
    $('.nav a').removeClass('active');
  $this.addClass('active');

  var textTarget = this.hash;
 if(!textTarget) return;
  var target = $(textTarget);
  if(target.length == 0) return;
  $('html, body').stop().animate({
    scrollTop: (target.offset().top) + 1
  }, 500, 'swing', function() {
    window.location.hash = textTarget;
    autoScroll = false;
   
  });  
}
});


function mid(len) {
  var text = "";
  var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < len; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

function sectionSlider(){
  $(".sitekly-block.slider").each(function(){
    $(this).find('.slide').eq(0).addClass('current').show().siblings().removeClass('current').hide();
    playSlider($(this));
});  
}


function playSlider(slider){
    if(editmode){
        return;
    }
      if(slider.is('.autoplay')){ 
     var speed = (slider.data('speed')) ? parseInt(slider.data('speed')) * 1000 : 3000; 
    var inter = setInterval(function () {
     nextSlide(slider,'f');  
    }, speed);   
    slider.data('int',inter)
    
    }  
}

function nextSlide(slider,direction){
if(slider.find('.slide').length < 2){
    return;
}
var c = slider.find('.slide.current');  
var n;
 if(direction == 'f'){
  if(c.next('.slide').length != 0){
  n = c.next('.slide'); 
  } else{
  n = slider.find('.slide').eq(0);  
  }  
 } else{
    if(c.prev('.slide').length != 0){
    n = c.prev('.slide');
    } else{
     n = slider.find('.slide').last();    
    }
  
 } 
    n.fadeIn('normal');
    stretch(n);
    c.fadeOut('normal', function(){
       n.addClass('current');
        c.removeClass('current');
    });  
}


$(document).on('click', ".slider>.arrow",  function(){
var slider = $(this).closest('.slider');    
clearInterval(slider.data('int'));  
if($(this).is('.next')){
nextSlide(slider,"f");
} else{
 nextSlide(slider);   
}
playSlider(slider);
});

$(document).on('click', ".accordion .head",  function(e){
if($(e.target).is('.inlinetiny')) return;
var $this = $(this);
var p = $this.parent();
p.toggleClass('active');
if(p.is('.active')){
$this.next().slideDown();
} else {
$this.next().slideUp();
}
if(!$this.closest('.accordion').is('.unhide')){
 p.siblings('.active').removeClass('active').children('.body').slideUp();   
}
});

var lastScrollTop = 0;
function sticky(){
var scroll = $(document).scrollTop();
 $('section.sticky').each(function(){
    var s = $(this);
    var off = s.offset().top;
    if(off <= scroll && scroll !=0 && scroll < lastScrollTop){
     s.addClass('fixed'); 
    } else{
         s.removeClass('fixed'); 
    }
 });
 
 lastScrollTop = scroll;
    
}
 $(window).scroll(function(){
 sticky();
 });


function vidplay(con){
if($(con).is('.video')){
    var players = con;
} else{
     var players = $(con).find('.video.sitekly-edit');
}

  players.each(function(){
    var data = vidata($(this));
    data['auto'] = '1';
    
    if(data.type == 'yt'){
       var ifr = '<iframe width="100%" height="100%" class="yt" src="https://www.youtube.com/embed/'+data.id+'?autoplay='+data['auto']+'&mute='+data['mute']+'&start='+data['start']+'&end='+data['end']+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>'; 
    $(this).find('.vidcon').html(ifr);
    } else {
       var ifr = '<iframe width="100%" height="100%"  class="vimeo" src="https://player.vimeo.com/video/'+data.id+'?controls='+data['controls']+'&background='+data['background']+'&autoplay='+data['auto']+'&mute='+data['mute']+'&loop='+data['loop']+'&byline=0&title=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>'; 
        $(this).find('.vidcon').html(ifr); 
        vimeo($(this));
    }
    $(this).addClass('play');

  })  
}
function vidauto(){
    if(editmode) return; 
    $('.video.sitekly-edit').each(function(){
       if($(this).data('auto') == '1'){
        vidplay($(this)); 
       }
    });
}
$(document).on('click', ".video",  function(){
    if(editmode) return; 
     vidplay($(this));   
});

function vidata(video){
    var data = video.dataAttr();
    if(data['href'].indexOf('youtube.com') !== -1){
            data.href = data.href.split('&')[0];
              match = data['href'].match(/^http.+youtube.com\/watch?(?:.+)=([\w]+)/);
            if(!match){
             match = data['href'].match(/^http(?:.+)youtu\.be\/([\w]+)/); 
            }
            if(match){
                data.type = 'yt';
                data.id = match[1];
           }
    
    } else{
      match = data['href'].match(/(.+)\/(\d+)$/);
      if(match){
        data.type = 'vim';
        data.id = match[2];
     } 
        
    }
    return data;
}
//vimeo player

function vimeo(p){
 p.find('iframe.vimeo').each(function(){
    if($(this).attr('src').indexOf('mute=1') == -1){
    return;
    }
             var iframe = $(this)[0],
            player = $f(iframe),
            status = $('.status');

            player.addEvent('ready', function() {
                player.api('setVolume', 0);
            });


 })   
}
$(document).on('click', ".z-menu .toggle",  function(){
$(this).closest('.z-menu').toggleClass('active');
});
$(document).on('click', ".z-menu .parent",  function(e){
    if(!$(this).is('.active')){
        e.preventDefault();
    }
$(this).toggleClass('active')
$(this).siblings('.parent').removeClass('active'); 
});

$(document).on('mousedown', "body",  function(e){
if($(".z-menu.active").length != 0 && $(e.target).closest('.navcon').length == 0){
 $(".z-menu.active").removeClass('active');  
}
});

/**
 * animation
 */
$(document).on('animationend',".animated", function(e){
$(this).removeClass($(this).css('animation-name')+' animated');
});
var animatedItems = false;
function initAnimated(){
 animatedItems = $();   
$("[class*=-animate]").each(function(){
if($(this).css('--animation-name') && $(this).css('--animation-name') != 'none'){
  animatedItems = animatedItems.add(this);
}    
});
animate();
}
function animate(){
    
var b = $(window).scrollTop() + $(window).height();     
animatedItems.each(function(){
 $this = $(this);  
 if($this.data('fired')){
     return true;
 } 
var t = $this.offset().top;  
if(t < b){
    $this.addClass('animated '+$(this).css('--animation-name')).data('fired',true);
}
})    
}
$(window).scroll(function(event) {
 if(animatedItems){
  animate();  
 }
 paralax();
 if(!autoScroll){
 activeLink();
 }
});
/**
 * animation
 */
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

function paralax(){

  var scroll = $(document).scrollTop();
  var screen = $(window).scrollTop() + $(window).height(); 
 $("[class*=-scroll]").each(function(){
 var $this = $(this); 
 var speed = $(this).css('--scroll-speed');
 if(speed == 'none'){
  return true;  
 }
 var offset = $this.offset().top;
 var height = $this.height();

 var pos = (offset - scroll) * speed / 10;
 if(offset+height > scroll && offset < screen ){
 $this.css('background-position-y',pos);
 }
 });   
    
}
function stretch(parent = false){
 
 var p = parent ? parent : $('.sitekly-container');   

 p.find("[class*=-stretch]").each(function(){
    $this = $(this);
   if($this.css('--bg-stretch') == 1){
   var parentPrev = $this.closest('section').prev('section');
   if(parentPrev.is('.fixed')){
    parentPrev.removeClass('sticky fixed');
    $this.offset({ top: parentPrev.offset().top}).css('padding-top',$this.css('top').substring(1));
    parentPrev.addClass('sticky fixed');
   } else{
    $this.offset({ top: parentPrev.offset().top}).css('padding-top',$this.css('top').substring(1));
   }  
 } else{
     $this.css({'padding-top':'','top':''});
 } 
 });   
}
$(window).resize(function() {
stretch();
});
var scrolling = false;
var anchorLinks;
function activeLink(){
    	    var scrollPos = $(document).scrollTop();
         clearTimeout(scrolling);
         if(!scrolling){
            anchorLinks = $();
	    $('.nav a[href^="#"]').each(function () {
	        var currLink = $(this);
            if(currLink.attr("href").length == 1){
                return true;
            }
	        var refElement = $(currLink.attr("href"));
            if(refElement.length > 0){
            var section = refElement.closest('.sitekly-block');
            var include = refElement.data('include');
            if(include && include > 1){
              var lastSection = section.nextAll().eq(include-2);  
              var top = refElement.offset().top;
              var bottom = lastSection.offset().top + lastSection.outerHeight(); 
                
            } else{
              var top = refElement.offset().top;
              var bottom = top + section.outerHeight();  
            }
            
            
            if(refElement.length > 0){
               anchorLinks = anchorLinks.add(currLink);
               currLink.data('place',{'top':top,'bottom':bottom});  
            }
            }
	    });
       };
       
       anchorLinks.each(function () {
        var data = $(this).data('place');
        	        if (data.top <= scrollPos && data.bottom > scrollPos) {
	            anchorLinks.removeClass("active");
	            $(this).addClass("active");
	        }
	        else{
	            $(this).removeClass("active");
	        }
        });
     scrolling =  setTimeout(function(){ scrolling = false; }, 2000);           
}
function activeAnchor(){
  $('.nav a').removeClass('active'); 
  var pathname = window.location.pathname.substr(1);
  $('.nav a[href="'+pathname+'"]').addClass('active'); 
}
/**
 * carousel
 */
$.fn.carousel = function(action) {
    if (action == 'init') {
        $(this).find('.crow').each(function(){
           var carousel = $(this);
           var carouselCon = carousel.closest('.carousel');
           first = carousel.children(".column:not('.cloned')").eq(0);
            
            carousel.children('.cloned').remove();
            carouselCon.carousel('dots');
            
            if(carouselCon.is('.infiniteScroll') && !editmode){
                var front = $();
                 var atonce = Math.round(carousel.parent().width() / first.outerWidth());
               carousel.children().slice(0,atonce).each(function(){
                  front = front.add($(this).clone().addClass('cloned').attr('data-index',$(this).index()));
                });
                
                var back = $();
               carousel.children().slice(atonce*-1).each(function(){
                  back = back.add($(this).clone().addClass('cloned').attr('data-index',$(this).index()));
                });
              carousel.append(front);  
              carousel.prepend(back); 
            }

            var pos = first.outerWidth() * first.index() * -1; 
            $(this).css('left', pos+'px').children().removeClass('active');
            first.addClass('active');
            
            carousel.carousel('play');
    
            
        });
        
$(this).find('.crow').on('mouseover mouseout', function(e){
carousel = $(this);
if(e.type == 'mouseover'){
  clearInterval(carousel.data('int'));  
} else{
 carousel.carousel('play');   
}
});
var dragEnd;
$(this).find('.crow').on('mousedown touchstart', function(e){
    carousel = $(this);
  if (carousel.hasClass('transition')) return;
  
  clearInterval(carousel.data('int'));
  
  var dragStart = e.originalEvent.touches ?  e.originalEvent.touches[0].pageX : e.pageX;
  var startPos = parseInt($(this).css('left'));
var threshold = carousel.children('.active').outerWidth()/3;
  $(document).on('touchmove mousemove mouseup',function handler(e) {
    if (e.type === 'mouseup') {
        dragStart = dragEnd;
        carousel.carousel('play');
 return $(this).off('mouseup mousemove touchmove',handler);
    }
     if (carousel.hasClass('transition')) return;
    dragEnd = e.originalEvent.touches ?  e.originalEvent.touches[0].pageX : e.pageX;
    var distance = dragEnd - dragStart;
    var off = startPos + distance;
    carousel.css('left', off+'px');
    
    if (distance > threshold) { return carousel.carousel('slide',-1) }
    if (distance < -threshold) { return carousel.carousel('slide',1) }
  });

});

    $(document).on('click', ".dotscon .dot", function(event,nitem){
    var $this = $(this);
    if($this.is('.active')) return;
    var ni = $this.index();
    var ci = $this.siblings('.active').index();
    var dif = ni-ci;
    var direction = dif > 0 ? 1 : -1;
    var steps = Math.abs(dif);
    
    $this.carousel('slide',direction,steps);
    $this.addClass('active').siblings().removeClass('active');
   });     
        
    } else if (action == 'dots') {
        var carouselCons = $(this);
                
        carouselCons.each(function(){
          var carousel = $(this).find('.crow');
        var first = carousel.children(".column:not('.cloned')").eq(0);
            var atonce = Math.round(carousel.parent().width() / first.outerWidth());
           carousel.data('atonce',atonce);
            
            var dots = carousel.closest('.carousel').find('.dotscon');
            dots.html("");
            if($(this).is('.dots')){
              var n = Math.ceil(carousel.children().length / atonce);
              for(i=0;i<n;i++){
                dots.prepend('<div class="dot"></div>');
              } 
              dots.children().eq(0).addClass('active');
            }   
                  
            });
         
    } else if (action == 'slide') {
        var carouselCon = $(this).closest('.carousel');
        var carousel = carouselCon.find('.crow');
        if (carousel.hasClass('transition')) return; 
        $(document).mouseup();
        var direction = arguments[1];
        var steps = arguments[2];
        var active = carousel.children('.active'); 
        var slideWidth = active.outerWidth();
        var atonce = carousel.data('atonce');
        active.removeClass('active');
        
        if (direction === 1) {
            
            if(active.index() + atonce * 2 > carousel.children().length){
            var next = carousel.children(":nth-last-child(" + atonce + ")");  
            } else {   
             var next = active.nextAll().slice(atonce-1,atonce);   
            }
            if (!active.is(next) ) {
                
                next.addClass('active');
            } else {
                carousel.children().eq(0).addClass('active');
            }
        } else {
            if(active.index() - atonce < 0){
            var next = carousel.children().eq(0); 
            } else {   
             var next = active.prevAll().slice(atonce-1,atonce);   
            }
            if (!active.is(next) ) {
                next.addClass('active');
            } else {
                carousel.children(":nth-last-child(" + atonce + ")").addClass('active');
            }

        }
        var index = carousel.children('.active').index();
        var pos = slideWidth * index * -1;
        carousel.addClass('transition').css('left', pos+'px');
        setTimeout(function() {
            carousel.removeClass('transition');
            if(carouselCon.is('.infiniteScroll') && !editmode){
                var active = carousel.children('.active');
                var  visible = active.nextAll().addBack().slice(atonce-1,atonce);  
                if(active.is('.cloned')){
                  var replace = carousel.children(".column:not('.cloned')").eq(active.data('index')); 
                }
                else if(visible.is('.cloned')){
                   var index = carousel.children(".column:not('.cloned')").index(active);
                   var replace = carousel.children('.cloned[data-index='+index+']');
                }
                
                if(replace){
                   var pos = slideWidth * replace.index() * -1; 
                   carousel.css('left', pos+'px');                   
                   carousel.children().removeClass('active');
                   replace.addClass('active');
                }
            }

            if(steps > 1){
                steps--;
              carousel.carousel('slide',direction,steps);  
            } else{
                carousel.carousel('play');
                
            } 
        }, 700);
        
        

    } else if (action == 'play') {
         var carousel = $(this);
         var carouselCon = carousel.closest('.carousel');
         clearInterval(carousel.data('int'));
                    if(carouselCon.is('.autoplay') && !editmode){
            var play = setInterval(function () {
                if(carouselCon.is('.dots')){
                    var nd = carouselCon.find('.dot.active').next();
                    if(nd.length > 0){
                        nd.click();
                    } else{
                       carouselCon.find('.dot').eq(0).click(); 
                    }
                    } else {
                   carousel.carousel('slide',1);      
                    } 
                         }, 3000);   
              carousel.data('int',play);  
            }
    }
};
