var livetemps = [];
function setstyle(pop, elem, event, initInput) {
  console.log("set___" + event);

  popChangesMade = true;
  var type = gettype(elem);
  var live = false;
  if (event == "slider live change" || event == 'live input change' || event == 'cpicker live change') {
    live = true;
  }
  livetemps = [];
  var tempstyle = f("style.tempstyle");




  if (pop.is('.z-popup')) {
    pop.find('.wcontrol').not('#' + type).hide();
    pop = pop.find('.wcontrol#' + type);
    pop.show();
  }

  if (initInput) {

    var settings = getPropSettings(initInput, type);

    if (settings && settings.noFullChange) {
      pop = initInput.parent();
    }

  }


  var full = (pop.is('.wcontrol')) ? true : false;

  var repeaters = [];
  pop.find(".prop").each(function () {
    var inp = $(this);
    if (inp.is('.special')) {
      return true;
    }
    if (inp.closest(".z-pop-cont").is(".off")) {
      var off = true;
    } else {
      var off = false;
    }


    var settings = getPropSettings(inp, type);


    if (settings.show == "0") {
      return true;
    }
    //inore for live change
    if (settings.ignoreLive && live) {
      return true;
    }




    if (inp.closest(".altcon").is(".disabled")) {
      return true;
    }
    if (inp.closest(".depend").is(".disabled")) {
      //prevent clearing value
      if (settings.onDisabled == 'ignore') {
        return true;
      }
      off = true;
    }
    el = prepareTemp(settings, elem, inp);

    if (settings.customSet && settings.customSet.length > 0) {
      runFunction(settings.customSet, pop, el, elem, inp, settings, initInput, 'set');
    } else if (settings.special && settings.special.length > 0) {


      if (settings.special == "gradient") {

        if (pop.is('.z-popup') && !inp.is('#fcol')) {

        } else {
          var intabcon = inp.closest('.intabcon');
          var fc = intabcon.find('#fcol').css('background-color');
          var sc = intabcon.find('#scol').css('background-color');
          var loc1 = intabcon.find('#loc1').val();
          var loc2 = intabcon.find('#loc2').val();
          var angl = intabcon.find('#angl').val();
          var gtype = intabcon.find('#gtypes').val();
          var xaxis = intabcon.find('#xaxis').val();
          var yaxis = intabcon.find('#yaxis').val();
          if (!loc1) {
            loc1 = 0;
            intabcon.find('#loc1').val(loc1);
            setslider(intabcon.find('#loc1').closest('.inpcon'));
          }
          if (!loc2) {
            loc2 = 100;
            intabcon.find('#loc2').val(loc2);
            setslider(intabcon.find('#loc2').closest('.inpcon'));
          }

          if (gtype == 'linear-gradient') {
            if (!angl) {
              angl = 0;
              intabcon.find('#angl').val(angl);
            }
            ival = 'linear-gradient(' + angl + 'deg, ' + fc + ' ' + loc1 + '% , ' + sc + ' ' + loc2 + '%)';

          } else {
            if (!xaxis) {
              xaxis = 50;
              intabcon.find('#xaxis').val(xaxis);
            }
            if (!yaxis) {
              yaxis = 50;
              intabcon.find('#yaxis').val(yaxis);
            }
            ival = 'radial-gradient( at ' + xaxis + '% ' + yaxis + '%, ' + fc + ' ' + loc1 + '% , ' + sc + ' ' + loc2 + '%)';
          }


          el.css('background-image', ival);
          el.css('background-color', '');
        }
        ival = gtype;
      }
      else if (settings.special == "border") {

        if (pop.is('.z-popup') && !inp.is('#t')) {

        } else {

          var ival = '';
          var suffix = inp.closest('.bradcon').find('.z-pop-inp').eq(0).attr('suffix');
          var set = false;

          inp.closest('.bradcon').find('.z-pop-inp').each(function () {
            if ($(this).val()) {
              var iv = $(this).val();
              set = true;
            } else { var iv = 0 };

            ival += iv + suffix + ' ';
          });

          if (!set) {
            ival = '';
          }
          el.css(settings.iprop, ival);

        }

      } else if (settings.special == "shadow") {
        var con = inp.closest('.intabcon1');
        var colors = con.find('.bshc');
        var c1 = colors.eq(0).prop('style')['background-color'];
        if (colors.eq(1).length != 0) {
          var c2 = colors.eq(1).prop('style')['background-color'];
        }
        var type = con.find('.bsht').val();
        if (type == 'none') {
          colors.eq(0).data('el').css('box-shadow', 'none');
          colors.eq(1).data('el').css('box-shadow', 'none');

        } else if (type == 'default') {
          colors.eq(0).data('el').css('box-shadow', '');
          colors.eq(1).data('el').css('box-shadow', '');
        } else {
          var v = con.find('.bsh').map(function () {
            return isset(this.value) ? this.value + 'px' : '0px';
          }).get().join(' ');
          if (type == 'inside') {
            v += ' inset';
          }
          colors.eq(0).data('el').css('box-shadow', v + ' ' + c1);
          if (isset(c2)) {
            colors.eq(1).data('el').css('box-shadow', v + ' ' + c2);
          } else if (colors.eq(1).length != 0) {
            colors.eq(1).data('el').css('box-shadow', '');
          }
        }
      }
      else if (settings.special == "bpos") {
        var ival = (!off) ? $('.z-popcin.active').attr("alt") : "";
        el.css(settings.iprop, ival);
      }
      else if (settings.special == "class") {

        var prefix = '';
        if (settings.prefix) {
          if (settings.prefix == 'viewport') {
            prefix = f('.sitekly-container').attr('id');
          } else if (settings.prefix == 'viewport-col') {
            prefix = "col-" + f('.sitekly-container').attr('id') + "-";
            var filter = new RegExp(prefix + "[0-9]+", 'g');
            el.attr('class', function (i, c) {
              return c.replace(filter, '');
            });

          } else {
            prefix = settings.prefix;
          }
        }
        if (inp.is('select')) {
          inp.children("option").each(function () {
            el.removeClass(prefix + $(this).val());
            ival = prefix + inp.val();
          });
        } else if (inp.is('.checker')) {
          var onv = (isset(inp.attr("data-on"))) ? prefix + inp.attr("data-on") : '';
          var offv = (isset(inp.attr("data-off"))) ? prefix + inp.attr("data-off") : '';

          if (inp.prop('checked')) {
            el.removeClass(offv);
            ival = onv;

          } else {
            el.removeClass(onv);

            ival = offv;
          }

        } else {
          ival = prefix + inp.val();
        }
        if (!off && isset(ival) && ival != prefix) {
          el.addClass(ival);
        } else {
          ival = '';
        }
      }


      else if (settings.special == "icon") {
        el.attr('class', inp.find('i').attr('class'));
      }

    } else {
      if (settings.sattr == "css") {
        var ival = inp.prop('style')[settings.sprop];
      } else if (settings.sattr == "val" || settings.sattr == "code") {
        var ival = inp.val();
      } else if (settings.sattr == "tinyval") {
        var ival = inp.data('html');
      } else if (settings.sattr == "check") {
        var ival = (inp.is(':checked')) ? inp.attr('data-on') : inp.attr('data-off');
      }
      else {
        var ival = inp.attr(settings.sattr);
      }

      if (inp.attr("suffix") && ival.length > 0) {
        ival = ival + inp.attr("suffix");
      }
      if (off) {
        ival = "";
      }

      //filters
      if (settings.filter) {
        if (settings.filter == "flex-calc") {
          ival = 100 / ival + "%";
        } else if (settings.filter == "relativePath") {
          ival = relativePath(ival);
        } else if (settings.filter == "upperLower") {
          ival = ival.substr(0, 1).toUpperCase() + ival.substr(1);
        } else {
          ival = runFunction(settings.filter, ival, pop, el, elem, inp, settings, 'set');
        }

      }

      if (settings.iprop) {
        el.css(settings.iprop, ival);
      } else if (settings.inlineProp) {
        el.css(settings.inlineProp, ival);
      }
      else {
        if (settings.iattr == 'src') {
          ival = url2src(ival);
        }
        if (settings.iattr == 'text') {
          el.text(ival);
        } else if (settings.iattr == 'tinyhtml') {
          el.html(ival);
        } else if (settings.iattr == 'html') {
          el.html(ival);
        } else if (settings.iattr == 'brhtml') {
          el.html(ival.replace(/\n/g, "<br>"));
        }
        else if (settings.iattr == "val") {
          el.val(ival);
        } else if (settings.iattr == "text-tag") {
          var nt = $('<' + ival + '>');
          nt.prepend(el.html());
          nt.attr('class', el.attr('class'));
          el.replaceWith(nt);

        }
        else if (settings.iattr == "tag" || settings.iattr == "options") {

          var itag = el.prop("tagName");
          var c = el.attr('class');
          var n = el.attr('name');
          var p = el.attr('placeholder');
          var s = el.attr('style');

          console.log(itag);
          console.log(ival);

          var synt = {
            text: '<input type="text" name="' + n + '" style="' + s + '" class="' + c + '" placeholder="' + p + '">',
            TEXTAREA: '<textarea  name="' + n + '" style="' + s + '" class="' + c + '" placeholder="' + p + '"></textarea>',
            SELECT: '<select  name="' + n + '" style="' + s + '" class="' + c + '"></select>',
            email: '<input type="email" name="' + n + '" style="' + s + '" class="' + c + '" placeholder="' + p + '">',
            checkbox: '<input type="checkbox" name="' + n + '" style="' + s + '" class="' + c + '"><span style="' + s + '" class="label"></span>',

            date: '<input type="date" name="' + n + '" style="' + s + '" class="' + c + '" >',
            number: '<input type="number" name="' + n + '" style="' + s + '" class="' + c + '" >',
            radio: '<input type="radio" name="' + n + '" style="' + s + '" class="' + c + '" >',
            file: '<input type="file" name="' + n + '" style="' + s + '" class="' + c + '" >',
            // checkbox : '<div name="'+n+'" type="checkbox" class="'+c+'"></div><span name="'+n+'" style="'+s+'" class="'+c+'"></span>',
          };
          var igparent = el.parent('.input-group');
          igparent.removeClass('inline multi');
          if (settings.iattr == "options") {
            ivala = ival.split("\n");
            ivala = ivala.filter(function (el) {
              return el != null && el.length != 0;
            });
            if (el.is('select')) {
              el.html("");
              ivala.forEach(function (item, index) {
                el.append('<option>' + item + '</option>');
              });
            } else {
              igparent.addClass('inline');
              if (ival.length != 0) {

                var itype = el.attr('type');
                if (itype == 'checkbox') {
                  igparent.find('span').text(ival);
                }
                else if (itype == 'radio') {
                  igparent.html("");
                  igparent.addClass('multi');
                  var radio = $(synt[itype]);
                  ivala.forEach(function (item, index) {
                    radio.val(item);
                    igparent.append(radio.clone());
                    igparent.append('<span>' + item + '</span>');
                  });
                } else {
                  igparent.html("");
                  ivala.forEach(function (item, index) {
                    igparent.append(synt[itype] + '<span>' + item + '</span>');
                  });
                }

              }
            }

          }
          else if (itag != ival) {
            console.log(synt[ival]);
            igparent.html(synt[ival]);
          }

        } else if (settings.iattr.indexOf('data-') !== -1) {
          if (settings.suffixAttr) {
            if (settings.suffixAttr == 'viewport') {
              settings.iattr += "-" + f('.sitekly-container').attr('id');
            } else {
              settings.iattr += suffixAttr;
            }
          }
          el.attr(settings.iattr, ival);
          el.data(settings.iattr.split('data-')[1], ival);
        }

        else {

          if (isset(ival)) {
            el.attr(settings.iattr, ival);
          } else {
            el.removeAttr(settings.iattr);
          }


        }

      }

    }
    //set label for repeater
    if (settings.copylabel) {
      repeaterLabel(ival, inp);
    }
    //clone value to same element
    if (settings.duplicate) {
      if (Array.isArray(settings.duplicate.iprop)) {

        settings.duplicate.iprop.forEach(function (iprop, index) {
          el.css(iprop, ival);
        });

      } else {
        el.css(settings.duplicate.iprop, ival);
      }
    }

    //use value with other elems
    if (settings.clonecss) {
      cel = prepareTemp(settings.clonecss, elem, inp);
      if (ival.length == 0) {
        iv = "";
      } else if (settings.clonecss.action == 'oposite') {
        iv = "-" + ival;

      } else if (settings.clonecss.action == 'share100percent') {

        iv = 100 - parseInt(ival) + "%";
      } else {
        iv = ival;
      }

      cel.css(settings.clonecss.iprop, iv);

    }
    if (settings.cloneattr) {
      cel = prepareTemp(settings.cloneattr, elem, inp);
      cel.attr(settings.cloneattr.iattr, ival);

    }
    dependeds(settings, inp, ival);

  });


  tempstyle.html("");

  $.each(tempElems, function (index, v) {
    if (!full && jQuery.inArray(index, livetemps) == -1) {
      return true;
    }

    var s = v.attr('style');

    if (s !== undefined && s.length > 0) {
      var ns = index + "{" + s + "}";
    } else {
      var ns = "";
    }


    if (full) {
      var rul = index + "{";
      rul = escapeRegExp(rul);
      var filter = new RegExp("^" + rul + "(.*?)}|}" + rul + "(.*?)}");

      var astyle = f(".astyles#" + f(".sitekly-container").attr('id'));

      var match = astyle.html().match(filter);

      if (match !== null) {

        if (match[1] !== undefined) {
          var so = match[1];
        } else {
          so = match[2];
        }
        var so = index + "{" + so + "}";
        astyle.html(astyle.html().replace(so, ns));
      } else {

        astyle.append(ns);
      }
      tempstyle.html("");

    } else {

      tempstyle.append(ns);


    }

  });



  if (full) {
    pop.trigger("afterUpdate");
    updateglobals(elem);
  }

}