$(window).scroll(function(){
    if($(document).scrollTop() > 10){
        $('#navbar').removeClass('navbar-dark');
        $('#navbar').addClass('show-nav');
        $('#navbar').addClass('navbar-light');
        $('#navbar .navbar-brand img').attr("src", "../img/Website logos/small/SAFM Solutions website logo small clear.png")
    }else{
        $('#navbar').removeClass('show-nav');
        $('#navbar').removeClass('navbar-light');
        $('#navbar').addClass('navbar-dark');
        $('#navbar .navbar-brand img').attr("src", "../img/Website logos/small/SAFM Solutions website logo small clear white.png")
    }
});

$(function(){
  var includes = $('[data-include]');
  jQuery.each(includes, function(){
      var file = $(this).data('include') + '.html';
      $(this).load(file);
  });
});


$(document).ready(function(){


    window.sr = ScrollReveal();
    sr.reveal('.js-reveal', {
      duration: 200,
      delay: 100,
      easing: 'ease-out',
      scale: 1,
      distance: '2rem',
      interval: 80
    });

    $('body').click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".navbar-collapse").hasClass("collapse");
        if (_opened === true && !clickover.hasClass("navbar-toggler")) {
            $(".navbar-collapse").collapse('hide');
        }

    });
});
