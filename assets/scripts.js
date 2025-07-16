let d = new Date();
d.setDate(d.getDate() + (1 + 7 - d.getDay()) % 7);
let date = d.toLocaleDateString('ru-RU', { day: 'numeric', month: 'numeric', year: '2-digit' });
const date_js = document.querySelector('.date-js').innerHTML = date;

$(document).ready(function () {


    /* footer-bottom  - при отстутствиии контента */
    function footer_bottom() {
        let h_window = $(window).height(),
            h_body = $('body').outerHeight(),
            h_innerbody = $('.header').innerHeight() + $('.footer').innerHeight();
        if (h_body < h_window) {
            let margin_bottom = h_window - h_innerbody;
            $('.header').css('margin-bottom', margin_bottom);

        }
    } footer_bottom()

    $(window).on('resize', footer_bottom)




})