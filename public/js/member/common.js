$(function(){

    /**
     * mypage settings 周り
     */
    $(document).on('click', '.prof_open', function () {
        if ($('.prof_area').css('display') === 'none') {
            $('.prof_area').slideDown();
        } else {
            $('.prof_area').slideUp();
        }
    });

    // 別の部分が選択されたときに
    $(document).click(function (event) {
        if ($('.prof_area').css('display') !== 'none') {
            if (!$(event.target).closest('.prof_open').length && !$(event.target).closest('.prof_area').length ) {
                $('.prof_area').slideUp();
            }
        }
    });



})