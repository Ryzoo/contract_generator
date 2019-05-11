(function ($) {
    $(function () {
        let tabsDetails = $('.vertical-tabs details');
        $.each(tabsDetails, function () {
            if ($(this).is(':visible')) {
                $(this).css("opacity", 1);
            }
        });
    });

    $(document).on('click', '.vertical-tabs .vertical-tabs__menu a', function () {
        let tabsDetails = $('.vertical-tabs details');
        tabsDetails.css("opacity", 0);
        $.each(tabsDetails, function () {
            if ($(this).is(':visible')) {
                $(this).css("opacity", 1);
            }
        });
    });

    let sidebarContent = $('.layout-region-node-secondary');
    let sidebarContentClone = sidebarContent.clone();
    sidebarContent.replaceWith("<div class='sidebar-content'><i class='sidebar-button fas fa-cog'></i></div>");
    sidebarContentClone.appendTo('.sidebar-content');
    if($('.sidebar-content')[0]){
      $(document).on('click', '.sidebar-button', function () {
        $('.layout-region-node-secondary').animate({
          width: "toggle"
        });
      });
    }
})(jQuery);