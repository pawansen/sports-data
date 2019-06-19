$(document).ready(function() {
  $(".animsition").animsition({
    inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
    /******slider********* */
    function setCaptionHeight() {
      var outerDivHeight = $('.header_sec').innerHeight() + $('.footer_sec').innerHeight()
      windowHeight = $(window).innerHeight() - outerDivHeight;
      $('.signup_sec').css('min-height', windowHeight + 'px');
  };
       /******slider********* */
      //  if ($('.promotion_sliter').length > 0) { 
      //   $('.promotion_sliter').slick({
      //     dots: false,
      //     infinite: false,
      //     speed: 300,
         
      //     slidesToShow: 1,
      //     slidesToScroll: 1,
      //   });
      // }

      if ($('.mobile_slider').length > 0) { 
        $('.mobile_slider').slick({
          dots: false,
          infinite: false,
          arrows:false,
          speed: 300,
          slidesToShow: 5,
          slidesToScroll: 1,
        });
      }
      if ($('.affiliate_slider').length > 0) { 
        $('.affiliate_slider').slick({
          dots: true,
          infinite: false,
          arrows:false,
          speed: 300,
          slidesToShow: 1,
          slidesToScroll: 1,
        });
      }
      
      
        /******slider********* */
    if ($('.series_slider').length > 0) { 
        $('.series_slider').slick({
          dots: false,
          infinite: false,
          speed: 300,
          slidesToShow: 6,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1500,
              settings: {
                slidesToShow:4,
               
              }
            },
            {
              breakpoint: 375,
              settings: {
                slidesToShow:1,
               
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow:2,
               
              }
            },
            {
              breakpoint:800,
              settings: {
                slidesToShow:2,
               
              }
            },
            {
              breakpoint:1100,
              settings: {
                slidesToShow:2,
               
              }
            }
           
          ]
        });
      }

      $(".point_list li a").click(function(){
        $(this).parents(".match_left_body").toggleClass("show_list");
        
      })
  });


  function setHeight() {
    windowHeight = $(window).innerHeight() - $(".header_sec").height();
    $('.banner_sec,.banner-slider img').css('height', windowHeight + 'px');
}
;
setHeight();
$(window).resize(function () {
    setHeight();
});

var countDownDate = new Date("Jan 27, 2018 24:00:00").getTime();

// Update the count down every 1 second
    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//        document.getElementById("day").innerHTML = days;
//        document.getElementById("hour").innerHTML = hours;
//        document.getElementById("minute").innerHTML = minutes;
//        document.getElementById("second").innerHTML = seconds;
        document.getElementById("day").innerHTML = 0;
        document.getElementById("hour").innerHTML = 0;
        document.getElementById("minute").innerHTML = 0;
        document.getElementById("second").innerHTML = 0;

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);

