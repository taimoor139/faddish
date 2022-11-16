(function($) {
    
    $('.loadshow').on('click', function(e) {
        if($(this).children('.btnspin').length != 0) {
            return false;
        } 
        $(this).append('<span class="btnspin spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        
    });
    
    var confirmed = false;
    $('.modal-confirm').on('click', function(e) {
     if(!$(this).data('confirmed')){   
        e.preventDefault();
     $delayedAction = $(this); 
     } 
    });
    
    $('.modal-continue').on('click', function() {
      $delayedAction.data('confirmed',true);
        if($delayedAction.attr('href')){
           window.location.href = $delayedAction.attr('href');
        } else {
         $delayedAction.closest('form').submit();   
        }

    });
 
    $('.btn.ajax').on('click', function(e) {
    e.preventDefault();
    var form = $(this).closest('form');
    var values = form.serialize();

        $.ajax({
        url: form.attr('action'),
        type: "post",
        data: values ,
        success: function (response) {
             
           if(response.redirect){
            window.location.href = response.redirect;
            }

            if(response.errors){
                $('.alert-window').show().find('.alert').html(response.errors);
            } else{
                $('.alert-window').hide();
            }

            runFunction(form.attr('onresponse'),response);
            form.find('.btnspin').remove();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            form.find('.btnspin').remove();
           console.log(textStatus, errorThrown);
        }
    });
      
    });
    
  $('input.live, select.live').on('change', function(e) {
  $('#step').val(1);   
  $(this).closest('form').find('.btn.ajax').click();
  $('.part2').removeClass('d-none');
  });
  
    $('#domain_manage input[name="type"]').on('change', function(e) {
        $('#domain_manage').find("#name,#customdomain").val('');
        $('#domain_manage').submit();
  });
  
  
 $(".dropdown-toggle").dropdown(); 
 
 $(document).mouseup(function(e) 
{
    var container = $("#dropdownMenuLink");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('.dropdown-menu').removeClass('show');
    }
});
    
})(jQuery);

function payform(response){
  
  if(response.token){
    $( "input[name='"+response.token.name+"']" ).val(response.token.value);
  }
  
  if(response.errors){
   $('form .total').hide();
   $('#step').val(1);
    } else if(response.inp.amount >= 0) {
   $('.total .amount').text(response.inp.amount);  
   $('.total .month').text(response.inp.month);     
   $('form .total').show();
   if(response.inp.amount == 0 && $('#period').val() != 1){ 
   return $('#period').val(1).change();
   }
   $('#period option').each(function(){
        if(response.inp.periods.includes(parseInt($(this).text()))){
            $(this).removeAttr('hidden');
        } else {
           $(this).attr('hidden',''); 
        }
   })
   $('#step').val(2); 
   if(response.form){
        $('body').prepend($(response.form));
       checkout();
   } 
    }
}

 function runFunction(fname){
 
    if(isset(fname)){
        var fn = window[fname];
    if (typeof fn === "function") fn.apply(this,[].slice.call(arguments, 1));
    }
 }
 function isset(v){
    if(typeof(v) != "undefined" && v !== null && v === v && v.length != 0){
     return true;   
    } else {
        return false;
    }
}