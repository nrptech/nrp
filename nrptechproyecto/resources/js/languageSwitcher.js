$(document).ready(function () {

    let currentLanguage = $('html').attr('lang');

    $('.language-switch').on('click', function (e) {
        e.preventDefault();

        let language = $(this).data('language');

        if (language !== currentLanguage) {
        
            let currentUrl = window.location.href;
            let newUrl = currentUrl.replace('/' + currentLanguage + '/', '/' + language + '/');
            window.location.href = newUrl;
        }
    });
});
