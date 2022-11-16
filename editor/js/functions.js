function columnResize(parent) {

  addHelpers(parent);

  //temp
  var cols = parent.find(".sitekly-col");
  cols.each(function () {



    var cclass = "col-md-";
    var pat = cclass + '(\\d+)';
    var re = new RegExp(pat, 'i');

    colc = $(this).attr("class").match(re);
    if (!colc) {
      $(this).addClass("col-md-12");
    }

    var cclass = "col-sm-";
    var pat = cclass + '(\\d+)';
    var re = new RegExp(pat, 'i');

    colc = $(this).attr("class").match(re);
    if (!colc) {
      $(this).addClass("col-sm-12");
    }

    var cclass = "col-xs-";
    var pat = cclass + '(\\d+)';
    var re = new RegExp(pat, 'i');

    colc = $(this).attr("class").match(re);
    if (!colc) {
      $(this).addClass("col-xs-12");
    }

  });
  //temp
  if (jQuery.inArray('column', activeWidgets) == -1) {
    return;
  }

  cols.resizable();
  cols.resizable("destroy");
  cols.resizable({
    start: function (event, ui) {
      ui.element.prepend('<div class="winfo">');
      var grid = ui.element.parent().width() / 12;

      cols.resizable("option", "grid", [grid]);
      lastcw = ui.element.width();
      f("#helper").hide();
      f("body").addClass("resizing");

    },
    resize: function (event, ui) {

      var cclass = "col-" + f(".sitekly-container").attr("id") + "-";
      var pat = cclass + '(\\d+)';
      var re = new RegExp(pat, 'i');

      colc = ui.element.attr("class").match(re);

      if (lastcw > ui.size.width) {
        var nw = parseInt(colc[1]) - 1;
      } else {
        var nw = parseInt(colc[1]) + 1;
      }

      if (nw > 0 && nw <= 12) {
        ui.element.data("lg" + nw);
        ui.element.removeClass(colc[0]).addClass(cclass + nw);
        lastcw = ui.size.width;
        ui.element.find(".winfo").eq(0).text(nw);
      }
    },
    stop: function (event, ui) {
      ui.element.find('.winfo').remove();
      ui.element.css("width", "");
      $(".helper2").css("display", "");
      f("body").removeClass("resizing");
      updateglobals(ui.element);
      addPoint("resize-column");
    }
  });
}

/**
 * helpers
 */

var helperInit = false;
function addHelpers(parent) {
  if (!helperInit) {
    ztool = $(".z-tools").eq(0).remove().clone()
    ztool.find('.gsave, .z-addc, .z-export').remove();
    ctool = $(".c-tools").eq(0).remove().clone();
    ctool.find('.gsave, .z-export').remove();
    btool = $(".b-tools").eq(0).remove().clone();

    helperInit = true;
  }

  parent.removeHelpers();

  if (activeWidgets.indexOf("block") != -1) {
    var h1 = $('<div id="helper" class="helper helper1">');
    h1.prepend(btool.clone());
    parent.find(".sitekly-block").prepend(h1.clone());
  }

  if (activeWidgets.indexOf("column") != -1) {
    var h2 = $('<div id="helper" class="helper helper2">');
    h2.prepend(ctool.clone());
    parent.find(".sitekly-col").prepend(h2.clone());
  }

  var h3 = $('<div id="helper" class="helper helper3"></div>');
  h3.prepend(ztool.clone());
  parent.find(".sitekly-edit:not('.sitekly-block')").prepend(h3);


  parent.find(".helper3").each(function () {
    elem = $(this).closest('.sitekly-edit');
    if (isset(elem.data('label'))) {
      $(this).find('span.label').text(elem.data('label'));
    } else {
      allowed = false;
      $('.wcontrol').each(function () {
        if (elem.is($(this).data('selector'))) {
          label = $(this).data('label');
          if (jQuery.inArray($(this).attr('id'), activeWidgets) != -1) {
            allowed = true;
          }
          return false
        }
      });

      if (!allowed) {
        $(this).remove();
        return;
      }
      if (isset(label)) {
        elem.data('label', label);
        $(this).find('span.label').text(label);
      }
    }
  });

  parent.find(".box-row, .slide-content2, .column").addBack(".box-row, .slide-content2, .column").prepend('<div class="inhelps ih-item"><div class="inhelp inh4 full"></div></div>');
  inhelps = '<div class="inhelps ih-item"><div class="inhelp top"></div><div class="inhelp bottom"></div></div>';
  parent.find(".sitekly-edit").prepend(inhelps);
  parent.find('.z-incont, .car-col').children('.inhelps').append('<div class="inhelp full"></div>');

  parent.find(".sitekly-col").prepend('<div class="inhelps ih-col"><div class="inhelp inh5a left"></div><div class="inhelp inh5a right"></div></div>');
  parent.find(".row").prepend('<div class="inhelps ih-col"><div class="inhelp inh5 top"></div><div class="inhelp inh5 bottom"></div></div>');

  parent.find(".sitekly-container").addBack(".sitekly-container").prepend('<div class="inhelps ih-block"><div class="inhelp inh6 full"></div></div>');
  parent.find(".sitekly-block").prepend('<div class="inhelps ih-block"><div class="inhelp inh6 top"></div><div class="inhelp inh6 bottom"></div></div>');
  parent.find('.slide-content').addClass('autoInhelp inhelp-item');

};

$.fn.removeHelpers = function () {
  $(this).find("#helper, .inhelps").remove();
  return this;
};
/**
 * form sliders
 */
//init
function sliderInit() {
  $(".z-popslider").slider({
    slide: function (event, ui) {
      var inp = $(this).next('.prop');
      inp.val(ui.value / $(this).data('multi')).trigger('livechange');
      setstyle($(this).closest('.inpcon'), cselem, 'slider live change', inp);
    },
    stop: function (event, ui) {
      var inp = $(this).next('.prop');
      inp.trigger('slideStop');
      setstyle($('.wcontrol:visible'), cselem, 'slider stop full', $(this).next('.prop'));
    }
  });

  $(".z-popslider-default").slider({
    slide: function (event, ui) {
      var inp = $(this).next('.prop');

      inp.val(ui.value / $(this).data('multi')).trigger('livechange');
    },
    stop: function (event, ui) {
      var inp = $(this).next('.prop');
      inp.trigger('slideStop');
    }
  });
}
//set value
function setslider(pop, selector = '.z-popslider') {


  pop.find(selector).each(function () {

    if (!isset($(this).slider("instance"))) {
      sliderInit();
    }
    var inp = $(this).next('.prop');
    var multi = 1;
    if (inp.attr("step") < 0.09) {
      multi = 100;
    } else if (inp.attr("step") < 0.9) {
      multi = 10;
    }
    $(this).data('multi', multi);
    var val = isset(inp.val()) ? inp.val() : inp.attr("init");
    $(this).slider("option", "min", parseFloat(inp.attr("min")) * multi);
    $(this).slider("option", "max", parseFloat(inp.attr("max")) * multi);
    $(this).slider("option", "step", parseFloat(inp.attr("step")) * multi);
    $(this).slider("option", "value", parseFloat(val * multi));
  });

}

/**
 * TEXT EDITOR
 */
function tinyInit() {
  if (typeof tinymce == 'undefined') {
    setTimeout(() => {
      tinyInit();
    }, 20);
    return;
  }
  console.log('tiny');
  $('body').append('<textarea class="tiny title">');
  tinymce.init({
    selector: '.tiny.title',
    resize: false,
    height: 211,
    menubar: false,
    branding: false,
    invalid_elements: 'div,p,h1,h2,h3,h4,h5,h6',
    force_br_newlines: true,
    force_p_newlines: false,
    forced_root_block: '',
    content_css: "editor/vendor/tinymce/custom.css",

    //  plugins: [
    //    'advlist autolink lists link charmap print preview anchor',
    //    'searchreplace visualblocks code fullscreen',
    //    'insertdatetime media table paste code help wordcount'
    //  ],

    plugins: [
      'link code wordcount'
    ],

    //toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
    // toolbar1: 'undo redo removeformat code bold italic strikethrough forecolor link',
    toolbar: 'bold italic underline strikethrough forecolor link removeformat code',
    //toolbar1: 'bold italic underline strikethrough forecolor link removeformat code', 
    setup: function (editor) {
      editor.on('init', function () {

        $('.tox.tox-tinymce').hide();
        $(".tox-split-button[aria-label='Text color']").find('.tox-split-button__chevron').addClass('tinyColorDrop');
      });
      editor.on('change', function () {

        var html = editor.getContent();

        activeText.val(html).change().next('.tiny-preview').html(html);
      });
    }
  }
  );




  $('body').append('<textarea class="tiny master">');
  tinymce.init({
    selector: '.tiny.master',
    // skin: "sitekly",
    resize: false,
    height: 311,
    menubar: false,
    branding: false,
    invalid_elements: 'div',
    content_css: "editor/vendor/tinymce/custom.css",
    //  plugins: [
    //    'advlist autolink lists link charmap print preview anchor',
    //    'searchreplace visualblocks code fullscreen',
    //    'insertdatetime media table paste code help wordcount'
    //  ],

    plugins: [
      'lists link code wordcount'
    ],
    //toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code',
    // toolbar: 'alignleft aligncenter alignright alignjustify bullist numlist removeformat bold italic strikethrough underline forecolor link code',
    toolbar1: 'alignleft aligncenter alignright alignjustify bullist numlist removeformat',
    toolbar2: 'bold italic strikethrough underline forecolor link code',

    setup: function (editor) {
      editor.on('init', function () {
        $('.tox.tox-tinymce').hide();
        $(".tox-split-button[aria-label='Text color']").find('.tox-split-button__chevron').addClass('tinyColorDrop');
      });
      editor.on('change', function () {

        var html = editor.getContent();
        activeText.val(html).change().next('.tiny-preview').html(html);
      });
    }
  }
  );



};

function hideTiny(e) {
  if ($('.tox-tinymce.active').length != 0) {
    if ($(e.target).closest('.tox, .tiny-preview').length == 0 && $(e.target).closest('.sp-container').length == 0) {
      tinyMCE.activeEditor.save();
      $('.tox-tinymce.active').removeClass('active').hide();
    }
  }
}
function tinyClean() {

}
var activeText;
$(document).on('mousedown', ".tiny-preview", function (e) {

  if ($('.tox-tinymce.active').length != 0) {
    tinyMCE.activeEditor.save();
    $('.tox-tinymce.active').removeClass('active').hide();
  }

  activeText = $(this).prev('.tiny');
  if (activeText.is('.t')) {
    var tid = $('.tiny.title').attr('id');
    var mtop = 39;
  } else {
    var tid = $('.tiny.master').attr('id');
    var mtop = 78;
  }

  tinyMCE.get(tid).setContent(activeText.val());
  var top = $(this).offset().top - $(window).scrollTop() - mtop;
  $('#' + tid).next('.tox').css('top', top).addClass('active').show();
  $('.sp-cancel:visible').click();
});

function initCodeMirror(pop) {
  pop.find('#code.init').each(function () {
    editor = CodeMirror.fromTextArea(this, {
      mode: 'htmlmixed',
      autoCloseTags: true,
      styleActiveLine: true,
      lineNumbers: true,
      lineWrapping: true,
      autoCloseBrackets: true
    });
    this.editor = editor;
    $(this).removeClass('init');
  })
}
$(document).on('click', ".cmirrorUpdate", function (e) {
  var ta = $(this).prev().find('#code');
  var ed = ta[0].editor;
  var c = $('<div>').html(ed.getValue()).html();
  $(ta).val(c).change();
  ed.setValue(c);
});
/**
 * css cleanup and clone
 */
function manageCss(elem, action) {
  if (action == 'd' && elem.is('.global')) {
    return elem;
  }
  if (action == 'e') {
    var all = $('<div>').prepend(elem);
    var selectors = [];
  } else if (action == 'er') {
    var all = $('<div>').prepend(elem.clone());
    var selectors = [];
  } else {
    var all = $('<div>').prepend(elem);
  }
  all.find(".sitekly-block, .sitekly-col, .sitekly-edit, .slide").each(function () {
    el = $(this);

    if (el.is('.global') && !el.is(elem)) {
      return true;
    }

    var id = $(el).attr('id');
    if (id) {

      if (action == 'c') {
        var newid = "s-" + makeid(8);
        el.attr('id', newid);
      }

      if (action == 'e' || action == 'er') {
        var id = el.attr('id');
        var cl = el.attr('class').match(/\bs-[a-zA-Z0-9]+/);
        if (isset(id)) {
          selectors.push(id);
        }
        if (isset(cl)) {
          selectors.push(cl[0]);
        }
      }

      f('.astyles').each(function () {
        var filter = new RegExp("#" + id + "[^{}]*{[^{}]*}", "g");
        var astyle = $(this);
        if (matches = astyle.html().match(filter)) {
          matches.forEach(function (item, index) {
            if (action == 'c') {
              nitem = item.replaceAll(id, newid);
              astyle.html(astyle.html().replaceAll(item, item + nitem));
            } else if (action == 'e') {
              var css = elem.data(astyle.attr('id'));
              css = (isset(css)) ? css : "";
              elem.data(astyle.attr('id'), css + item);
            } else if (action == 'er') {
              var css = elem.data(astyle.attr('id'));
              css = (isset(css)) ? css : "";
              elem.data(astyle.attr('id'), css + item);
              astyle.html(astyle.html().replaceAll(item, ""));
            } else {
              astyle.html(astyle.html().replaceAll(item, ""));
            }
          });
        }

      });
    }

    var cl = el.attr('class').match(/\bs-[a-zA-Z0-9]+/);

    if (cl != null) {

      if (action == 'c') {
        var newcl = "s-" + makeid(8);
        el.addClass(newcl).removeClass(cl[0]);
      }

      f('.astyles').each(function () {

        var filter = new RegExp("." + cl[0] + "[^{}]*{[^{}]*}", "g");
        var astyle = $(this);
        if (matches = astyle.html().match(filter)) {

          matches.forEach(function (item, index) {
            if (action == 'c') {
              nitem = item.replaceAll(cl[0], newcl);
              astyle.html(astyle.html().replaceAll(item, item + nitem));
            } else if (action == 'e') {
              var css = elem.data(astyle.attr('id'));
              css = (isset(css)) ? css : "";
              elem.data(astyle.attr('id'), css + item);
            } else if (action == 'er') {
              var css = elem.data(astyle.attr('id'));
              css = (isset(css)) ? css : "";
              elem.data(astyle.attr('id'), css + item);
              astyle.html(astyle.html().replaceAll(item, ""));
            }
            else {

              astyle.html(astyle.html().replaceAll(item, ""));
            }
          });
        }

      });
    }


  });

  refreshSS();

  if (action == 'e' || action == 'er') {
    elem.data('selectors', selectors);
    return elem;
  } else {
    return $(all.html());
  }
}

var drop1;
function dropzones() {

  $("#imgform").addClass('dropzone');
  drop1 = new Dropzone("#imgform", {
    autoProcessQueue: false,
    acceptedFiles: ".jpg,.png,.gif",
    maxFilesize: 5,
    timeout: 0,
  });

  drop1.on("addedfile", function (file) {
    dropUpload(file);
  });

  drop1.on("success", function (file, data) {
    addMyimage(data, 'save');

    drop1.removeFile(file);
  });

  drop1.on("error", function (file, data) {
  });

}

function dropUpload(file) {
  getToken().then((token) => {
    $("#imgform").find('input[name="' + token.name + '"]').val(token.value);
    drop1.processFile(file);
  }).catch((error) => {
    console.log(error)
  })
}

function addMyimage(data, action) {
  var response = JSON.parse(data);
  var con = $(".z-popmedia .img-con");
  if (isset(response.file)) {
    var rthumb = response.thumb;
    //+'?v='+Math.floor(Date.now() / 1000);

    //$( ".myimages[src='"+response.file+"']" ).remove();
    $('<div class="myimages">').css("background-image", "url(" + rthumb + ")").attr('src', response.file).attr('data-width', response.width).attr('data-size', response.size).insertAfter(con.find('#imgform'));

    if (action == 'update') {
      var ourl = $('.myimages.active').attr('src');
      $('.myimages.active').remove();
      f('.astylec').html(f('.astylec').html().replaceAll(ourl, response.file));
      f("img[src='" + ourl + "']").attr('src', response.file);

      f('.gallery .img').each(function () {
        console.log($(this).attr('style').includes(ourl));
        if ($(this).attr('style').includes(ourl)) {
          $(this).attr('style', $(this).attr('style').replaceAll(ourl, response.file));
          $(this).attr('src', response.file);
        }
      });

      allpages.find("content").each(function () {
        $(this).html($(this).html().replaceAll(ourl, response.file));
      });
    }

    // if(exist.length != 0){
    //    exist.remove();
    $('.myimages').eq(0).click();
    //  }
  } else if (isset(response.error)) {
    alert(response.error);
  }
}


function runFunction(fname) {

  if (isset(fname)) {
    var fn = window[fname];
    if (typeof fn === "function") fn.apply(this, [].slice.call(arguments, 1));
  }
}


function htmlEntities(html) {
  return String(html).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}


function ignore() {

}

function getPalette() {
  var all = palette_allCss();
  var colors = design_get_val(all, 'sbg');
  var gcolors = design_get_val(all, 'gbg');
  var fcolors = design_get_val(all, 'fc');

  for (var i = 0; i < gcolors.length; i++) {
    var c = gcolors[i].split(":");
    if (colors.indexOf(c[0]) === -1) {
      colors.push(c[0]);
    }
    if (colors.indexOf(c[1]) === -1) {
      colors.push(c[1]);
    }
  }
  var ocolors = ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
    "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
    "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
    "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
    "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
    "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
    "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
    "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
    "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
    "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"];

  return [colors, fcolors, ocolors];

}
var cpickerActive;
var isTiny;
var colorSet;
function cpicker(con) {



  var labels = [lang.bcolors, lang.txtcolors, lang.othercolors];
  var pallete = getPalette();
  colorSet = false;
  $(".cpicker").spectrum("destroy");
  cpickerActive = con.find(".cpicker");
  isTiny = cpickerActive.is('.tiny');
  cpickerActive.spectrum({
    color: "#ECC",
    showInput: true,
    className: "full-spectrum",
    showInitial: true,
    paletteLabels: labels,
    showPalette: true,
    showAlpha: true,
    showSelectionPalette: false,
    hideAfterPaletteSelect: true,
    allowEmpty: true,
    maxSelectionSize: 10,
    showButtons: true,
    chooseText: lang.select,
    cancelText: lang.cancel,
    preferredFormat: "hex",
    localStorageKey: "spectrum.demo",
    beforeShow: function (color) {
      $(this).spectrum("set", $(this).css("background-color"));
    },
    change: function (color) {
      var c = (color) ? color.toRgbString() : "";
      cpickerActive.css("background-color", c);
      if (isTiny) {
        var hc = color ? color.toHex() : false;
        return tinyColor(hc);
      }
      setstyle($('.wcontrol:visible'), cselem, 'cpicker change', cpickerActive);
    },

    move: function (color) {
      if (isTiny) {
        return;
      }

      if ($(".z-pop16").is(":visible")) {
        var c = (color) ? color.toRgbString() : "";
        cpickerActive.css("background-color", c);
        if ($(this).is('.scol')) {
          setstyle($(".z-pop16 .fcol").parent(), cselem, 'cpicker live change', cpickerActive);
        } else {
          setstyle(cpickerActive.parent(), cselem, 'cpicker live change', cpickerActive);
        }

      }

    },
    palette: pallete
  });
}

function tinyColor(color) {
  if (colorSet) return;
  colorSet = true;

  if (cpickerActive.is('.inlinecp')) {
    $d = f;
  } else {
    $d = $;
  }
  if ($d('.tox-tbtn--enabled').length == 0) {
    $d('.tinyColorDrop:visible').click();
  }

  if (!color) {
    checkElement('.tox-swatch--remove').then((selector) => {
      $d(selector).click();
    });
  } else {
    checkElement('.tox-swatches__picker-btn').then((selector) => {
      $d('.tox-swatches__picker-btn').last().click();
      checkElement('.tox-textfield').then((selector) => {
        $d('.tox-textfield').last().val(color);
        $d('.tox-dialog__footer .tox-button').last().click();
      });
    });
  }
}

const checkElement = async selector => {
  while ($d(selector).length == 0) {
    await new Promise(resolve => requestAnimationFrame(resolve))
  }
  return $d(selector)[0];
};

$(document).on('mousedown', ".tinyColorDrop", function (e) {
  if ($('.sp-container:visible').length != 0) return;
  $('.cpicker.active').removeClass('active');
  var cp = activeText.siblings('.cpicker');
  cp.addClass('active');
  cpicker(cp.parent());
  cp.spectrum("show");
});
$(document).on('mouseup', ".tinyColorDrop.tox-tbtn--enabled", function (e) {
  $('.sp-cancel:visible').click();
});
$(document).on('mouseup', '.sp-clear', function (e) {

  setTimeout(function () {
    if (isTiny) {
      return tinyColor(false);
    }
    setstyle($('.wcontrol:visible'), cselem, 'cpicker clear', cpickerActive);
  }, 30);
});

$(document).on('dragstop.spectrum', ".z-pop16 .cpicker", function (e) {
  if (isTiny) {
    return;
  }

  setstyle($('.wcontrol:visible'), cselem, 'cpicker change dragstop', cpickerActive);
});

$(document).on('mousedown', ".z-pop16 .cpicker", function (e) {
  $('.cpicker.active').removeClass('active');
  $(this).addClass('active');
  //$(this).data('last',$(this).css('background-color'));
  cpicker($(this).parent());
});


$(document).on('keyup input paste livechange', ".z-pop16 .anchor-offset", function (e) {
  $frame.contents().scrollTop(f('.sitekly-block.active .anchor').offset().top);
});
$(document).on('keyup input paste livechange', ".z-pop16 .section-include", function (e) {
  var val = parseInt($(this).val()) - 1;
  var sections = f('.sitekly-block.active').nextAll().addBack();
  var last = sections.eq(val);

  if (last.length <= 0) { return true; }
  var off = last.offset().top + last.outerHeight() - $('.sitecon').height();

  f('body, html').animate({ scrollTop: off }, 1000);

});
$(document).on('change slideStop', ".z-pop16 .animation-preview", function (e) {
  var con = $(this).closest('.intabcon1');
  var el = con.find('.animation-enable').data().el;
  var type = con.find('.animation-type').val();
  el.addClass('animated ' + type);
});

function searchSelect() {
  $('.searchSelect').each(function () {
    var fav = ($(this).is('.favorite')) ? true : false;
    $(this).bselect({
      data: $(this).data('options'),
      search: true,
      width: '200px',
      favorite: fav,
      defaultText: lang.select,
      defaultTextSearch: lang.search
    });
  });
  $(document).on('select.bselect clear.bselect', '#sectionCategory, #themeName, #themeName2, #pageName', function (e, params) {
    var cont = $(this).closest('.z-pop-cont');
    var elems = cont.find('.isection');

    if (e.type == 'clear') {
      $(e.target).find('.bselect-default-text').text(lang.select);
      $(e.target).closest('.searchSelect').bselect("close");
      return elems.show();
    }
    var ft = $(this).attr('id');
    var v = params.element.data('id');
    cont.find('.searchSelect').not(this).find('.bselect-default-text').text(lang.select);
    elems.hide().filter(function (i) {
      var iparams = $(this).data('params');
      return iparams[ft].indexOf(v) !== -1;
    }).show();
    $('.favbutton:visible').removeClass('active');

  });

  $(document).on('click', '.bselect-fav', function (e) {
    $(this).toggleClass('active');
    globalSettings['editor']['favorites'] = [];
    $(this).closest('.bselect-list').find('.bselect-fav.active').each(function () {
      globalSettings['editor']['favorites'].push($(this).attr('id'));
    })
  });
  $(document).on('click', '.favbutton', function (e) {
    $(this).toggleClass('active');
    var con = $(this).closest('.z-pop-cont');
    con.find('.searchSelect').trigger('clear');
    if ($(this).is('.active')) {
      var ft = $(this).attr('id');
      con.find('.isection').hide().filter(function (i) {
        var iparams = $(this).data('params');
        return globalSettings['editor']['favorites'].includes(iparams[ft]);
      }).show();

    }
  });

  $('#themeName, #themeName2').on('opened.bselect', function (e, params) {
    if (!isset(globalSettings['editor'])) {
      globalSettings['editor'] = {};
    }
    if (!isset(globalSettings['editor']['favorites'])) {
      globalSettings['editor']['favorites'] = [];
    }
    favs = $('#themeName, #themeName2').find('.bselect-fav').removeClass('active');
    $.each(globalSettings['editor']['favorites'], function (index, value) {
      favs.closest('#' + value).addClass('active');
    });

  });

}
function emailTo(pop, el, elem, inp, settings, option, action) {
  if (action == 'get') {
    if (isset(globalSettings['forms']) && isset(globalSettings['forms'][elem.attr('id')])) {
      inp.val(globalSettings['forms'][elem.attr('id')][inp.attr('id')]);
    } else {
      inp.val('');
    }
  } else {
    if (!isset(globalSettings['forms'])) {
      globalSettings['forms'] = {};
    }
    if (!isset(globalSettings['forms'][elem.attr('id')]) || typeof (globalSettings['forms'][elem.attr('id')]) != 'object') {
      globalSettings['forms'][elem.attr('id')] = {};
    }

    globalSettings['forms'][elem.attr('id')][inp.attr('id')] = inp.val();
  }
}
$(document).on('change', '.bg-stretch', function (e) {
  cselem.children('.z-back').css({ 'padding-top': '', 'top': '' });
  $frame[0].contentWindow.stretch();
  $frame[0].contentWindow.paralax();
});

function loadDelayed() {
  var len = $('.delaysrc').length;
  i = 0;
  var inter = setInterval(function () {
    if (i > len) {
      clearInterval(inter);

    }

    var img = $('.delaysrc').eq(i);
    //console.log(img);
    img.attr('src', img.attr('dsrc'));
    i++;
  }, 50);
}
$(document).on('click', "#cform.wcontrol .addInput", function (event) {
  var rep = $('#cform.wcontrol .repeater').last();
  var rcon = $('#cform.wcontrol .repeater-container');
  var isel = rcon.data('parent');
  var item = cselem.find(isel).eq(rep.index());



  if (isset(rcon.data('limit')) && rcon.children().length == parseInt(rcon.data('limit'))) {
    alert(lang.limitReached);
    return false;
  }


  var nitem = item.clone();
  nitem.insertAfter(item);
  if (rep.is('.active')) {
    rep.removeClass('active');

  }
  var nrep = rep.clone();
  nrep.find('.z-pop-inp.prop').val('');
  nrep.find('input.z-pop-inp.prop').eq(0).val('Label');
  nrep.insertAfter(rep);
  nrep.find('select.prop').eq(0).val('text').change();


});


onframe('mousedown', ".tinyColorDrop", function (e) {
  $d = f;
  checkElement('.tox-swatches__picker-btn').then((selector) => {
    f('.tox-swatch:not(".tox-swatch--remove, .tox-swatches__picker-btn")').remove();
    f('.tox-swatches__row-label').remove();
    f('.tox-swatches__row:empty').remove();
    var palette = getPalette();
    var labels = [lang.bcolors, lang.txtcolors, lang.othercolors];
    $.each(palette, function (i, arr) {
      if (i == 2) return;
      var row = $('<div class="tox-swatches__row tox-swatches__row-label">');
      row.text(labels[i]).css('color', "#fff");
      f('.tox-swatches').append(row);

      $.each(arr, function (si, l) {
        if (si % 10 === 0) {
          row = $('<div class="tox-swatches__row">');
          f('.tox-swatches').append(row);
        }
        var swatch = $('<div class="tox-swatch replaced">').css("background-color", l).attr('title', l);
        row.append(swatch);
      });
    });
  });

});

onframe('mousedown', ".tox-swatch.replaced", function (e) {
  f('body').css('overflow', 'auto');
  checkElement('.tox-swatches__picker-btn').then((selector) => {
    f('.tox-swatches__picker-btn').last().click();
    checkElement('.tox-textfield').then((selector) => {
      f('.tox-dialog-wrap').css('display', 'none');
      var color = rgba2hex($(this).css('background-color'));
      f('.tox-textfield').last().val(color);

      setTimeout(function () {
        f('.tox-dialog__footer .tox-button').last().click();
        f('body').css('overflow', '');
      }, 1);

    });
  });
});

