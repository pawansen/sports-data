$(document).ready(function(){
});

$(window).load(function(){
});

$(window).bind("load resize", function() {
	sizingheight();
});

function sizingheight(){
}


    // testimonial

         $(document).ready(function(){
             $("#testimonial-slider-page1").owlCarousel({
                 items:3,
                 itemsDesktop:[1000,1],
                 itemsDesktopSmall:[979,2],
                 itemsTablet:[768,1],
                 pagination:true,
                 navigation:false,
                 navigationText:["",""],
                 slideSpeed:1000,
                 dots: true,
                 arrows: true,
                 autoPlay:false
             });
         });
      
     
     // customer logo

         $(document).ready(function(){
             $('.customer-logos').slick({
                 slidesToShow: 5,
                 slidesToScroll: 1,
                 autoplay: false,
                 autoplaySpeed: 1500,
                 arrows: false,
                 dots: false,
                 pauseOnHover: false,
                 responsive: [{
                     breakpoint: 768,
                     settings: {
                         slidesToShow: 4
                     }
                 }, {
                     breakpoint: 520,
                     settings: {
                         slidesToShow: 2
                     }
                 }]
             });
         });








//  Accordion

$(function() {
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.link');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el;
      $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
    };
  } 

  var accordion = new Accordion($('#accordion'), false);
});




         // Get the modal
         var modal = document.getElementById('myModal');
         
         // Get the button that opens the modal
         var btn = document.getElementById("myBtn");
         
         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close_popup")[0];
         
         // When the user clicks the button, open the modal 
         btn.onclick = function() {
           modal.style.display = "block";
         }
         
         // When the user clicks on <span> (x), close the modal
         span.onclick = function() {
           modal.style.display = "none";
         }
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
           if (event.target == modal) {
             modal.style.display = "none";
           }
         }
    



   