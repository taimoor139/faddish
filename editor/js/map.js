function mapUpdate(pop,el,elem,inp){
    var src = el.attr('src');
    var l = elem.data('location');
    var s = elem.data('sat');
    var z = parseInt(elem.data('zoom'));
    z = (z) ? z : 13;
    var url = encodeURI('https://maps.google.com/maps?q='+l+'&t='+s+'&z='+z+'&ie=UTF8&iwloc=&output=embed');
    if(src != url){
    el.attr('src',url);
    }  
}