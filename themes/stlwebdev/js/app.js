/**
 * Created by Scott on 5/31/2015.
 */
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
$(document).ready(function(){

    var count = 2;
    $(window).scroll(function(){

        if  ($(window).scrollTop() > $('#about').offset().top - $(window).height()+25) {
            var total = $("#content").attr('data-max');
            if (isNumeric(total)) {
                if (count > (parseInt(total) + parseInt(2))) {
                    return false;
                } else {

                    $('#loader').show();
                    loadArticle(count);
                }
                count++;
            }
        }
    });
    function loadArticle(pageNumber) {
        $.ajax({
            url: ajaxUrl,
            type:'POST',
            data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop',
            success: function(html){
               //
                $("#content").append(html);    // This will be the div where our content will be loaded
                $('#loader').hide();
            }
        });
        return false;
    }



    var $window = $(window);

    $('section[data-type="background"]').each(function () {
        // declare the variable to affect the defined data-type
        var $scroll = $(this);

        $(window).scroll(function () {
            // HTML5 proves useful for helping with creating JS functions!
            // also, negative value because we're scrolling upwards
            var yPos = -($window.scrollTop() / $scroll.data('speed'));

            // background position
            var coords = '50% ' + yPos + 'px';

            // move the background
            $scroll.css({backgroundPosition: coords});
        }); // end window scroll
    });  // end section function

});