(function ($) {
    $(document).off('click', 'details summary');
    $(document).on('click', 'details summary', function (e) {
        e.preventDefault();
        if ($(this).parent().children('div').is(':visible')) {
            $(this).parent().children('div').slideUp(400);
        } else if (!$('#block-poz-admin-content').children().hasClass('system-modules')) {
            $(this).parent().attr('open', true);
            $(this).parent().children('div').css("display", "none");
            $('details').children('div').slideUp(400);
            $(this).parent().children('div').slideDown(400);
        } else {
            $(this).parent().attr('open', true);
            $(this).parent().children('div').css("display", "none");
            $(this).parent().children('div').slideDown(400);
        }
    })
})(jQuery);