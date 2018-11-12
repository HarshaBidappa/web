// Preloader
  $(document).ready(function() {
  $(window).load(function() {
    var preloaderFadeOutTime = 500;
    function hidePreloader() {
      var preloader = $('.spinner-wrapper');
      setTimeout(function() {
        preloader.fadeOut(preloaderFadeOutTime);
      }, 500);
    }
    hidePreloader();
  });
  });


// Scrollspy
$('body').scrollspy({
        target: '#main-navbar',
        offset: 100
    }); 


//Smoothscroll
$('.navbar-nav a, a.page-scroll').on('click', function(event) {
  var $anchor = $(this);
  $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top - 70
  }, 1000);
  event.preventDefault();
});


//Bootstrap menu fix
$(".navbar-toggler").on("click", function(){
    $body.addClass("mobile-menu-activated");
});
$("ul.navbar-nav li a").on("click", function(){
    $(".navbar-collapse").removeClass("in");
});


// Scroll to Top
jQuery.noConflict();
(function($) {
  $(window).on('scroll', function() {
    if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
      $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
      $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
  });
  $('#return-to-top').on('click', function() { // When arrow is clicked
    $('body,html').animate({
      scrollTop: 0 // Scroll to top of body
    }, 500);
  });
})(jQuery);


// Contact Form
var contactForm = $(".contact-form");
if(contactForm.length){
  var contactFormInput = contactForm.find(".form-control.required");
  var contactResault = contactForm.find(".form-resault");

  contactFormInput.on("blur", function(){
    if(!$.trim($(this).val())){
      $(this).parent().addClass("input-error");
    }
  });

  contactFormInput.on("focus", function(){
    $(this).parent().removeClass("input-error");
  });

  contactForm.on("submit", function() { 
    var form_data1 = $(this).serialize();
    if(!contactFormInput.parent().hasClass("input-error") && contactFormInput.val()){
      $.ajax({
        type: "POST", 
        url: "php/contact.php", 
        data: form_data1,
        success: function() {
          contactResault.addClass("correct");
          contactResault.html("Your data has been sent!");
          setTimeout(function(){
            contactResault.removeClass("incorrect").removeClass("correct");
          }, 4500);
        }
      });
    } else{ 
      if(contactFormInput.val() == ""){
        var contactFormInputEmpty = contactFormInput.filter(function(){ 
          return $(this).val() == ""; 
        });
        contactFormInputEmpty.parent().addClass("input-error");
      }
      contactResault.addClass("incorrect");
      contactResault.html("You must fill in all required fields");
      setTimeout(function(){
        contactResault.removeClass("incorrect").removeClass("correct");
      }, 4500);
    }
    return false;
  }); 
}


