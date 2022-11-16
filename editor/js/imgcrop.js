$(document).ready(function() {
    
    var $side;
    var $rimg = $('#rcropimg');
    var $width;
    
    $(document).on('click', ".z-popmedia .cnt3 .myimages", function(e){
    $(this).toggleClass('active');
    $this = $(this);
    $this.siblings().removeClass('active');
    $side = $this.closest('.mediacon').children('.img-opt');
    if($this.is('.active')){
       $side.show(); 
       $side.find('.impreview').attr('style',$this.attr('style'));
       $side.find('#rcrop-width-controls').hide();
       $side.find('#rcrop-size-label').children('span').text($this.data('size'));
       $width = $side.find('.img-width');
       $width.attr('max',$this.data('width')).val($this.data('width'));
       setslider($width.closest('.slider-con'),'.z-popslider-default');
       $rimg.attr('src',$this.attr('src'));
    } else {
        $side.hide();
    }
    });
    
$(document).on('click', "#rcrop-insert", function(e){    
    var src = $('.myimages.active').attr('src');
$(".impr.active").css("background-image","url("+src+")");
//imageData(src,$(".impr.active"),true);
setstyle($('.wcontrol:visible'), cselem,'special input change',$(".impr.active"));

$('.z-popmedia').hide();
});

    
    $(document).on('slideStop', ".img-opt .img-width", function(e){
          $side.find('#rcrop-width-controls').show();  
    });

    
    var rcropRatio = false;
    var pop;
    $(document).on('click', "#rcrop-open", function() {
        pop = $('.z-popup#imcrop');


        rcrop('set', {
            'src': $('.myimages.active').attr('src')
        });
        pop.show();
    });
    
    $(document).on('click', "#rcrop-cancel", function() {
      $('.z-popup#imcrop').hide();

    });

    $(document).on('click', ".rcrop-resize, .rcrop-crop", function() {
    var id = $(this).attr('id');
    var post = {
        action: id,
        file: $('.myimages.active').attr('src'),
        width: $width.val()

    } 
    if($(this).is('.rcrop-crop')){
        var values = $rimg.rcrop('getValues');
        $.extend(post,values);
    }
    
    $side.find('#rcrop-width-controls').hide();
    
      getToken().then((token) => {  
  post[token.name] = token.value;
  
      $.ajax({
    type:'POST', 
    url: window.location.href+'/imgedit', 
    data: post, 
    success: function(response) {
        $('#imcrop').hide();
         addMyimage(response,id);
    }
    });
  
}).catch((error) => {
    console.log(error)
  })
    

            
    });
    
        $(document).on('click', "#rcrop-delete", function() {

    $side.find('#rcrop-width-controls').hide();
    var post = {
        action: 'delete',
        file: $('.myimages.active').attr('src'),

    }  
    getToken().then((token) => {  

    post[token.name] = token.value;  
      $.ajax({
    type:'POST', 
    url: window.location.href+'/delete', 
    data:post, 
    
    success: function(response) {
         $('.myimages.active').remove();
         $side.hide();
    }
    });
  
  
}).catch((error) => {
    console.log(error)
  })
    
    

            
    });
    
    
    $(document).on('clayfy-drag', ".clayfy-handler", function() {
      rcrop('size');  
    });
    
    $(document).on('clayfy-drop', ".clayfy-handler", function() {
        rcropRatio = false;
    });
    
    $rimg.on("load", function() {

        $rimg.rcrop({
            minSize: [20, 20],
            grid: true
        });
    });

    $rimg.on('rcrop-ready', function() {
      //  $rimg.css('opacity','1');
    });



    function rcrop(action, args = null) {
        if (action == 'set') {
            $rimg.rcrop('destroy');
            $rimg.attr('src', args.src);
        
        } else if(action == 'size'){

            if (!rcropRatio) {
            rcropRatio = $rimg[0].naturalWidth / $rimg.width();
            }
            var $cropArea = $('.rcrop-handler-wrapper');
            var nw = Math.round($cropArea.width() * rcropRatio);
            var nh = Math.round($cropArea.height() * rcropRatio);
            $('#rcrop-dimensions').text(nw + "px x " + nh + "px");
        }
    }


});
