// Initialize app and store it to myApp variable for futher access to its methods
var myApp = new Framework7({
    modalTitle: 'Onze App'
    //hideToolbarOnPageScroll: 'true'
});

// We need to use custom DOM library, let's save it to $$ variable:
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we want to use dynamic navbar, we need to enable it for this view:
    dynamicNavbar: true
});


 var mySwiper = myApp.swiper('.swiper-container', {
    pagination:'.swiper-pagination'
  });

// Now we need to run the code that will be executed only for About page.

// Option 1. Using page callback for page (for "about" page in this case) (recommended way):
myApp.onPageInit('about', function (page) {
  // Do something here for "about" page
    if (page.name === 'about') {
      // Following code will be executed for page with data-page attribute equal to "about"
      // myApp.alert('Here comes About page');
      console.log('About page!');

      // document.getElementById('tabbar-custom').style.display = 'block';

      $$('a#tab-1').on('click', function () {
          myApp.alert('Tab 1 is visible');
      });

      // $$('.navbar').css('background-color','transparent');

      $$('<style>.navbar::after{background-color:transparent}</style>').appendTo('head');

      // $$('.statusbar-overlay').css('background','transparent');

    }
});


myApp.onPageInit('tabbar', function (page) {
  // Do something here for "about" page
    if (page.name === 'tabbar') {
      //myApp.alert('index2 page');
    }
});

$$('#intro_info').on('click', function(){
  myApp.alert('Info!');
});





