(function ($) {
  setTimeout(function () {
    // init animations
    wowInit();
    // nav hamburger
    navHamburger();
    // nav search
    navSearchInit();
    // top bar lang selectior
    langSelectorInit();
    // accordion init
    accordionInit();
    // sticky navigation on scroll
    stickyNav();
    // calculate basic page height
    calculateBasicPageHeight();
    // turn off preloader;
    turnOffPreloader();
    // init fancybox
    setDefaultFancybox();
    // init all counters
    initCounters();
    // init paralax elements
    initializeParalax();
    // init tabs elements
    initializeTabs();
  }, 300);

  $('.ps-menu-links .ps-nav > li').on('click', function () {
      $(this).animate({height: "show"},2000, 'swing');
  })

  // function
  function turnOffPreloader() {
    setTimeout(function () {
      $('#loading').fadeOut(500);
    }, 500)
  }

  function calculateBasicPageHeight() {
    (function () {
      setTimeout(function () {
        let headerHeight = jQuery('.layout-container > header').first().height();
        let mainHeight = jQuery('.layout-container > main').first().height();
        let footerHeight = jQuery('.layout-container > footer').first().height();
        let bodyHeight = jQuery('body').first().height();
        let windowHeight = jQuery(window).height();

        if (bodyHeight < windowHeight) {
          let add = 0;
          if (jQuery('body').first().css('padding-top')) {
            add = parseInt(jQuery('body').first().css('padding-top').replace("px", ""));
          }
          let calculate = mainHeight + (windowHeight - bodyHeight) - add - 1;
          jQuery('.layout-container > main').first().css('min-height', (calculate) + 'px');
        }
      }, 200);
    })();
  }

  function langSelectorInit() {
    jQuery(document).on('click', '.lang-selector', function () {
      jQuery(this).toggleClass('actived');
    });
  }

  function navHamburger(){
    $(document).on('click','#ps-main-navigation .hamburger',function(){
      $(this).toggleClass('is-active');
      $(this).parent().find('.ps-menu-nav').eq(0).toggleClass('active');
    })
  }

  function accordionInit() {
    //-----------------------------------------
    //--------------- Accordion ---------------
    //-----------------------------------------

    $('.ps-accordion h4').hover(function () {
      if ($(this).parent().hasClass('ps-accordion-v1')) {
        $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down ps-accordion-hover');
      }
      else if ($(this).parent().hasClass('ps-accordion-v2')) {
        $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        $(this).addClass('ps-accordion-hover');
      }
      else if ($(this).parent().hasClass('ps-accordion-v3')) {
        $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        $(this).parent().addClass('ps-accordion-hover');
      }
    }, function () {
      if ($(this).parent().hasClass('ps-accordion-v1')) {
        if (!$(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down ps-accordion-hover').addClass('fa-chevron-right');
        }
      }
      else if ($(this).parent().hasClass('ps-accordion-v2')) {
        if (!$(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
          $(this).removeClass('ps-accordion-hover');
        }
      }
      else if ($(this).parent().hasClass('ps-accordion-v3')) {
        if (!$(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
          $(this).parent().removeClass('ps-accordion-hover');
        }
      }
    });
    $(document).on('click', '.ps-accordion h4', function () {
      if ($(this).parent().hasClass('ps-accordion-v1')) {
        $('.ps-accordion .ps-accordion-text').slideUp();
        if ($(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down ps-accordion-hover').addClass('fa-chevron-right');
          $(this).removeClass('ps-accordion-active');
          $(this).next().slideUp();
        }
        else {
          $('.ps-accordion').removeClass('ps-accordion-hover');
          $('.ps-accordion i').removeClass('fa-chevron-down ps-accordion-hover').addClass('fa-chevron-right');
          $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down ps-accordion-hover');
          $('.ps-accordion h4').removeClass('ps-accordion-active ps-accordion-hover');
          $(this).addClass('ps-accordion-active');
          $(this).next().slideDown();
        }
      }
      else if ($(this).parent().hasClass('ps-accordion-v2')) {
        $('.ps-accordion .ps-accordion-text').slideUp();
        if ($(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
          $(this).removeClass('ps-accordion-active ps-accordion-hover');
          $(this).next().slideUp();
        }
        else {
          $('.ps-accordion').removeClass('ps-accordion-hover');
          $('.ps-accordion i').removeClass('fa-chevron-down ps-accordion-hover').addClass('fa-chevron-right');
          $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
          $('.ps-accordion h4').removeClass('ps-accordion-active ps-accordion-hover');
          $(this).addClass('ps-accordion-active ps-accordion-hover');
          $(this).next().slideDown();
        }
      }
      else if ($(this).parent().hasClass('ps-accordion-v3')) {
        $('.ps-accordion .ps-accordion-text').slideUp();
        if ($(this).hasClass('ps-accordion-active')) {
          $(this).children('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
          $(this).removeClass('ps-accordion-active');
          $(this).parent().removeClass('ps-accordion-hover ps-accordion-active-border');
          $(this).next().slideUp();
        }
        else {
          $('.ps-accordion i').removeClass('fa-chevron-down ps-accordion-hover').addClass('fa-chevron-right');
          $(this).children('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
          $('.ps-accordion h4').removeClass('ps-accordion-active ps-accordion-hover');
          $('.ps-accordion').removeClass('ps-accordion-hover ps-accordion-active-border');
          $(this).addClass('ps-accordion-active');
          $(this).parent().addClass('ps-accordion-hover ps-accordion-active-border');
          $(this).next().slideDown();
        }
      }
    });
  }

  function stickyNav() {
    let navigation = $('.navigation-container');
    let navigationOffset = navigation.offset().top;

    $(document).scroll(function () {
      let height = navigation.parent().height();
      let bodyPadding = parseInt($("body").css("padding-top"));

      if ($(window).scrollTop() > (navigationOffset - bodyPadding)) {
        navigation.addClass('ps-sticky');
        navigation.parent().css('min-height', (height) + "px");
        navigation.css("top", bodyPadding + "px");
      }
      else {
        navigation.removeClass('ps-sticky');
        navigation.parent().css('min-height', 0);
        navigation.css("top", 0 + "px");
      }
    });
  }

  function navSearchInit() {
    //-----------------------------------------
    //---------------- Search -----------------
    //-----------------------------------------
    let placehoderText = "";

    placehoderText = $(".ps-input-search").first().attr('placeholder');
    $(".ps-input-search").attr("placeholder", "");

    $(document).on('click', '.ps-search-button', function () {
      $('.ps-input-search').attr("placeholder", placehoderText);
      $(".search").toggleClass("close");
      $(".ps-input-search").toggleClass("square");
      $(".ps-nav li:not(:last-child)").toggleClass('ps-hide');
      if ($('.search').hasClass('close')) {
        $('input').focus();
      }
      else {
        $('.ps-input-search').attr("placeholder", '');
        $('input').blur();
      }
    });
  }

  function wowInit() {
    if (WOW) {
      new WOW().init();
    }
    else {
      setTimeout(wowInit(), 200)
    }
  }

  function setDefaultFancybox() {
    $.fancybox.defaults.protect = true;
  }

  function initCounters() {
    $.fn.psCounter = function () {
      $(this).each(function () {
        let thisElement = $(this);
        let settings = {
          start: thisElement.data('from') || 0,
          end: thisElement.data('to') || 100,
          easing: 'swing',
          duration: thisElement.data('speed') || 400,
          complete: ''
        };

        $({count: settings.start}).animate({count: settings.end}, {
          duration: settings.duration,
          easing: settings.easing,
          step: function () {
            let mathCount = Math.ceil(this.count);
            thisElement.text(mathCount);
          },
          complete: settings.complete
        });
      });
    };
    $.fn.isInViewport = function () {
      let elementTop = $(this).offset().top;
      let elementBottom = elementTop + $(this).outerHeight();
      let viewportTop = $(window).scrollTop();
      let viewportBottom = viewportTop + $(window).height();
      return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    function checkCounters() {
      $('.ps-counter-number').each(function () {
        if ($(this).isInViewport() && !$(this).data('counterStart')) {
          $(this).psCounter();
          $(this).data('counterStart', true);
        }
      });
    }

    $(window).on('resize scroll', function () {
      checkCounters();
    });

    checkCounters();
  }

  function initializeParalax() {
    $('.ps-paralax').jarallax({
      speed: 0.2
    });
  }

  function initializeTabs() {
    let tabsElement = $('.tabs-menu-container');

    tabsElement.each(function () {
      let tabContainer = $(this).find('.tabs-menu-container--tabs');
      let tabItem = $(this).find(".tabs-menu-container--content > .ps-shortcode-render-container");
      let containerContent = $(this).find(".tabs-menu-container--content");

      $(document).off('click', '.tabs-menu-container > .tabs-menu-container--tabs > .tabs-menu-item-name');
      $(document).on('click', '.tabs-menu-container > .tabs-menu-container--tabs > .tabs-menu-item-name', function () {
        $('.tabs-menu-container > .tabs-menu-container--tabs > .tabs-menu-item-name').removeClass('tabs-menu-item-active');
        $(this).addClass('tabs-menu-item-active');

        let index = $(this).data("tabs-id");

        $('.tabs-menu-container > .tabs-menu-container--content > .ps-shortcode-render-container').removeClass('tabs-menu-item-active');
        let actualItem = $('.tabs-menu-container > .tabs-menu-container--content > .ps-shortcode-render-container').eq(index);
        if (actualItem) {
          actualItem.addClass('tabs-menu-item-active');
          containerContent.animate({
            height: actualItem.height()
          },300);
        }
      });

      tabItem.each(function (index) {
        let itemName = $(this).find('.tabs-menu-item-name');
        let itemElement = $(this).find('.tabs-menu-item');
        itemName.data("tabs-id", index);
        itemElement.parent().data("tabs-id", index);

        if (index <= 0) {
          itemName.addClass("tabs-menu-item-active");
          itemElement.parent().addClass("tabs-menu-item-active");
          containerContent.animate({
            height: itemElement.height()
          },300);
        }

        itemName.detach().appendTo(tabContainer);
      });

    });
  }

})(jQuery);

