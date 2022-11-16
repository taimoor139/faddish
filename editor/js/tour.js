

function initTour(){
    
    let ttourhide = getCookie("ttour-hide");
  if (ttourhide != "") {
    return;
  }  
  

        var starter = '<style>.ttour-shadow{z-index:9999}.ttour-tip{min-width:290px}</style><div class="ttour-shadow ttour-start"><div class="ttour-overlay" style="left: 0px; top: 0px; width: 300px; height: 40px;"><div class="ttour-wrapper"><div class="ttour-tip tip-0 right"><div class="ttour-header"><h1>'+lang.tour.t0+'</h1></div><div class="ttour-body">'+lang.tour.d0+'</div><div class="ttour-footer" ><button class="prev ttour-close" style="background-color: #efefef;width: calc(50% - 10px);float: left;">'+lang.tour.close+'</button><button class="next ttour-show" style="width: 50%;">'+lang.tour.start+'</button><button class="prev ttour-hide" style="margin-top: 20px;width: 100%;">'+lang.tour.hide+'</button></div><div class="ttour-arrow"></div></div></div></div></div>';
    $('body').prepend(starter);
    
    $('.ttour-show').click(function(){
        $('.ttour-start').remove();
        tourStart(); 
    });
    
    $('.ttour-close').click(function(){
        $('.ttour-start').remove();
    });
    $('.ttour-start').click(function(e){
        if($(e.target).is('.ttour-start'))
        $('.ttour-start').remove();
    });
    
    $('.ttour-hide').click(function(){
        $('.ttour-start').remove();
        setCookie('ttour-hide',true,3650);
    });



function tourStart(){

  window.tour = new Tour({
    padding: 0,
    next: lang.tour.next,
    done: lang.tour.done,
    prev: lang.tour.prev,
    tipClasses: 'tip-class active',
    steps: [
      {
        element: '.site',
        frame: false,
        title: lang.tour.t1,
        description: lang.tour.d1,
        data: "Custom Data",
        position: "left"
      },
      {
        element: ".tool-templates",
        frame: false,
        title: lang.tour.t2,
        description: lang.tour.d2,
        position: "right"
      },
      {
        element: ".side.tool-templates",
        frame:false,
        title: lang.tour.t3,
        description: lang.tour.d3,
        position: "right"
      },
        {
        element: ".z-addel-con.elements",
        frame:false,
        title: lang.tour.t4,
        description: lang.tour.d4,
        position: "right"
      },
      {
        element: '.site',
        frame: false,
        title: lang.tour.t5,
        description: lang.tour.d5,
        data: "Custom Data",
        position: "left"
      },
      {
        element: ".tool-menu",
        frame:false,
        title: lang.tour.t6,
        description: lang.tour.d6,
        position: "right"
      },
       {
        element: ".tool-navigate",
        frame:false,
        title: lang.tour.t7,
        description: lang.tour.d7,
        position: "bottom"
      },
       {
        element: "#globalDesign",
        frame:false,
        title: lang.tour.t8,
        description: lang.tour.d8,
        position: "right"
      },
      {
      element: ".hcontrols",
        frame:false,
        title: lang.tour.t9,
        description: lang.tour.d9,
        position: "bottom"
      },
      {
        element: ".tool-views",
        frame:false,
        title: lang.tour.t10,
        description: lang.tour.d10,
        position: "bottom"
      },
       {
        element: ".tool-save:not('.draft')",
        frame:false,
        title: lang.tour.t11,
        description: lang.tour.d11,
        position: "left"
      },
        {
        element: ".tool-save",
        frame:false,
        title: lang.tour.t12,
        description: lang.tour.d12,
        position: "left"
      },

    ]
  })

  tour.override('showStep', function(self, step) {
    self(step);
  })

  tour.override('end', function(self, step) {
    self(step);
  })
tour.start();
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
} 

}