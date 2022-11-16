$(document).ready(function(){
      $("form.ajaxform").submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var url = $('base').attr('href')+'ajaxform/'+form.attr('id');
    
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