$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
});
$("#toTop").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 1000);
});