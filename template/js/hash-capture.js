$(window).on('load',function() {
    
    var ha = {};
  $(".sitekly-container").find(".sitekly-block:not('.sitekly-edit')").each(function(index){
    h = parseFloat($(this).css('height'));
    ha[index] = h;
    });
$.get( "", { heights: JSON.stringify(ha), hashKey: hash} );

});