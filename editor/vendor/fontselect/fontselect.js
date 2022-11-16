/**
 * font select input
 */
 var flist = false;
function initFontselect(con){

    if(!flist){
        flist = $('ul.gflist').clone();
        var slist = "";
       var systemFonts = 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats'.split(';');
       systemFonts.forEach(function (font, index) {
       font = font.split('=');
       slist +='<li style="font-family:'+font[1]+'">'+font[0]+'</li>';
       });
       
       flist.prepend(slist);
        
    }
    con.find('ul.custom-select, .nprop.fontSelect').remove();
    
    con.find("input.fontselectinp").each(function(){
    $(this).hide();
    flist.clone().insertAfter($(this)); 
    var fs = $('<input class="nprop fontSelect">');
    fs.val($(this).val());
    fs.insertAfter($(this));   
    });
    

    con.find("input.quickfontinp").each(function(){
    $(this).hide();
    qflist = fontSets();
    qflist.clone().insertAfter($(this)); 
    var fs = $('<input class="nprop fontSelect">');
    fs.val($(this).val());
    fs.insertAfter($(this));   
    });
    
}

function filterFunction(that, event) {
    let container, input, filter, li, input_val;
    container = $(that).closest(".psg");
    input_val = container.find("input.fontSelect").val().toUpperCase();
console.log(input_val);
    if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
        keyControl(event, container)
    } else {
        li = container.find("ul li");
        li.each(function (i, obj) {
            if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        container.find("ul li").removeClass("selected");
        setTimeout(function () {
            container.find("ul li:visible").first().addClass("selected");
        }, 100)
    }
}

function keyControl(e, container) {
    if (e.key == "ArrowDown") {

        if (container.find("ul li").hasClass("selected")) {
            if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
            }

        } else {
            container.find("ul li:first-child").addClass("selected");
        }

    } else if (e.key == "ArrowUp") {

        if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
            container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
        }
    } else if (e.key == "Enter") {
        //cval = container.find("ul li.selected").text();
        container.find("ul li.selected").click();
        container.find("input.fontSelect").blur();
    }

    container.find("ul li.selected")[0].scrollIntoView({
        behavior: "smooth",
    });
}
var quickFontsets = {};
function fontSets(){
    console.time();
    quickFontsets = {};
    var keys = [];
    var style = palette_allCss();
    var item = $('<div>');
    var result = style.match(/{[^{]+}/g);
    
    var qflist = $('<ul class="qflist custom-select"></ul>');
    var dff = f('body').css('font-family');
    
    $.each( result, function( index, value ){
    item.attr('style',value.slice(1,-1));
    var ff = item.css('font-family');
    var fs = item.css('font-size');
    var fc = item.css('color');
    var fw = item.css('font-weight');
    var lh = item.css('line-height');
    var set = 'f'+ff+'f'+fs+'f'+fw+'f'+fc;
        var data = {
            'font-family':ff,
            'font-size':fs,
            'font-weight':fw,
            'color':fc,  
        }
        
        var data = [fc,ff,fs,fw,lh];
    if(data.filter(Boolean).length < 2){
        return true;
    }
    
    if(!isset(quickFontsets[set])){
        quickFontsets[set] = data;
      keys.push(set);  
    }
});

keys.sort();

$.each( keys, function( index, value ){
var data = quickFontsets[value];
var label = data.slice(1,-1).filter(Boolean).join(', ');
var dff = isset(data[1]) ? data[1] : dff;  
qflist.append('<li value="'+value+'" style="font-family:'+dff+';font-weight:'+data[3]+';"><div class="con"><span style="background-color:'+data[0]+'"></span></div>'+label+'</li>');
});

console.timeEnd();    
return qflist;
}


var cval;
$(document).on('focus', 'input.fontSelect', function () {
    $('input.fontSelect.active').removeClass('active');
    $(this).addClass('active');
    cval = $(this).val();
    $(this).val("");
    $(this).closest(".psg").find("ul").show();
    $(this).closest(".psg").find("ul li").show();
    $(this).data('last',cval);
});
$(document).on('blur', 'input.fontSelect', function () {
    let that = this;
    setTimeout(function () {
        $(that).closest(".psg").find("ul").hide();
        $(that).val(cval);
        $(that).prev(".fontselectinp").val(cval).change();
    }, 200);
});

$(document).on('click', 'ul.gflist li', function () {
    cval = $(this).text();
    $(this).blur();
    
loadFont(cval);
    
});
function loadFont(font){
     if (gfonts[font]) {
    var link = 'https://fonts.googleapis.com/css?family='+font+":"+gfonts[font]+'&subset=latin-ext';
    if(f( "link[href='"+link+"']" ).length != 0){
        return;
    }
 f('body').append('<link href="'+link+'" rel="stylesheet" type="text/css">');
 }
}

$(document).on('click', 'ul.qflist li', function () {
    cval = $(this).text();
    $(this).blur();
    var data = quickFontsets[$(this).attr('value')];
    var con = $(this).closest('.intabcon1');
    var el = $(con.find('#lineHeight').data('el'));
    
    el.css({'color':data[0],'font-family':data[1],'font-size':data[2],'font-weight':data[3],'line-height':data[4]});
    con.find('.fontSelect').eq(1).val(data[1]);
  
  new Promise((resolve, reject) => {
  resolve(getstyle(con,cselem,true));
  }).then(data => {
    con.find('#lineHeight').change();
    });
    
});

$(document).on('keyup', 'input.fontSelect', function (event) {
    filterFunction(this,event)
});
