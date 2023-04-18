(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 48)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });


  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    loop: true,
    effect:'fade',
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    }
});


// fancy select
$('#language_select').fancySelect();

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 54
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100 || $(window).width() <= 480 ) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };


  $(window).resize(function(){
    if ($(window).width() <= 480) {  
      $('nav.navbar').addClass('navbar-shrink');
    }     
  });



  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // parallax - min
  !function(a,b,c){function d(a,b){var c=null;return function(){var d=this,e=arguments;clearTimeout(c),c=setTimeout(function(){a.apply(d,e);},b)}}function e(a,b){this.el=a,this.$el=c(a),this.animationFrame=null,this.scrolling=!1,this.currentTransforms=[],this.firstTops=[],this.speeds=[],this._setup(),this._events()}function f(a){var b=Array.prototype.slice.call(arguments,1),d=c(this),f=d.data("parallax");f||d.data("parallax",f=new e(this,a)),"string"==typeof a&&f[a]&&"_"!==a[0]&&f[a].apply(f,b)}!function(){for(var a=0,c=["ms","moz","webkit","o"],d=0;d<c.length&&!b.requestAnimationFrame;++d)b.requestAnimationFrame=b[c[d]+"RequestAnimationFrame"],b.cancelAnimationFrame=b[c[d]+"CancelAnimationFrame"]||b[c[d]+"CancelRequestAnimationFrame"];b.requestAnimationFrame||(b.requestAnimationFrame=function(c,d){var e=(new Date).getTime(),f=Math.max(0,16-(e-a)),g=b.setTimeout(function(){c(e+f)},f);return a=e+f,g}),b.cancelAnimationFrame||(b.cancelAnimationFrame=function(a){clearTimeout(a)})}(),Function.prototype.bind||(Function.prototype.bind=function(a){var b=this;return function(){return b.apply(a,arguments)}}),e.prototype._setup=function(){this.$window=c(b),this.lastScrollTop=null,this._cacheValues(),this._parallax()},e.prototype._events=function(){this.$window.on("scroll.parallax.begin",this._beginScroll.bind(this)),this.$window.on("scroll.parallax.debounce",d(function(){cancelAnimationFrame(this.animationFrame),this.scrolling=!1,this.$window.on("scroll.parallax.begin",this._beginScroll.bind(this))}.bind(this),250)),this.$window.on("resize.parallax",d(this.refresh.bind(this),250))},e.prototype._beginScroll=function(){this.scrolling||(this._go(),this.scrolling=!0,this.$window.off("scroll.parallax.begin"))},e.prototype._cacheValues=function(){var a=this;this.$el.each(function(b,d){var e=c(this),f=a.currentTransforms[b],g=e.offset().top,h=void 0!==f?g-f:g;a.firstTops[b]=h,a.speeds[b]=e.attr("data-speed")})},e.prototype._go=function(){this.animationFrame=requestAnimationFrame(this._go.bind(this)),this._parallax()},e.prototype._isInView=function(a){var c=a.getBoundingClientRect();return c.top<b.innerHeight&&c.bottom>0},e.prototype._parallax=function(){var a=this.$window.scrollTop();if(a===this.lastScrollTop)return!1;this.lastScrollTop=a;for(var b=0,d=this.$el.length;d>b;b++){var e=this.$el[b];if(this._isInView(e)){var f=c(e);this.currentTransforms[b]=(a-this.firstTops[b])*this.speeds[b],f.css("transform","translate3d(0, "+this.currentTransforms[b]+"px,0)")}}},e.prototype.refresh=function(){this.lastScrollTop=null,this._cacheValues(),this._parallax()},c.fn.jQueryParallax=f}(document,window,jQuery);

  // parallax 효과
  $('[data-parallax]').jQueryParallax();

  // Scroll Trigger 
  $.fn.scrollTrigger = function(options) {
    var settings = $.extend({
      offset: 60,
      target: this
    }, options),
    el = this;
    var activate = function() {
      el.each(function(k, v) {
        var sT = $(window).scrollTop(),
        wH = $(window).height();
        if(settings.target != el) {
          if(sT > $(el[0]).offset().top - wH + settings.offset) {
            $(settings.target).addClass('active');
          } else {
            $(settings.target).removeClass('active');
          }
        } 
        else {
          if(sT > $(v).offset().top - wH + settings.offset) {
            $(v).addClass('active');
          } else {
            $(v).removeClass('active');
          }
        }
      });
    };
    var didScroll = false;
    $(window).scroll(function() {
      didScroll = true;
    });
    setInterval(function() {
      if(didScroll) {
        activate();
        didScroll = false;
      }
    }, 250);
  };

    // Trigger 클래스 정의
    $('.scroll_tg').scrollTrigger();
    $(window).scroll();

    $('.keyvisual').addClass('active');
  

  if ($(window).width() <= 480) {  
      $('nav.navbar').addClass('navbar-shrink');
    }  

})(jQuery); // End of use strict
