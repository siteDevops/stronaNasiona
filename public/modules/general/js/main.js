
$(document).ready(function(){
	$('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);

        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 550);

        event.preventDefault();
    });

	$('body').scrollspy({
        target: '.navbar-default',
        offset: 51
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.sidebar .category .titleCategory span.toggleList').click(function(){
        $(this).parent().parent().toggleClass('active');
    })
});
