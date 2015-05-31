/**
 * Created by Scott on 5/31/2015.
 */
$(document).ready(function(){

    var count = 2;
    $(window).scroll(function(){
        console.log($(window).scrollTop());
        console.log($('#about').offset().top - $(window).height());

        if  ($(window).scrollTop() < $('#about').offset().top - $(window).height()+200){
            var total = $("#content").attr('data-max');
            console.log(total);
            if (count > total+1){
                return false;
            }else{
                loadArticle(count);
            }
            count++;
        }
    });
    function loadArticle(pageNumber) {
        $.ajax({
            url: ajaxUrl,
            type:'POST',
            data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop',
            success: function(html){
                $("#content").append(html);    // This will be the div where our content will be loaded
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