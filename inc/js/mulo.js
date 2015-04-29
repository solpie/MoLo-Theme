/**
 * Created by toramisu on 2015/4/21.
 */

$(function ($) {
    $window = $(window);
    $document = $(document);
    apiPage = $('data').data('ajax') + "?action=mulo_page";
    pageIdx = 1;
    lastRequestTimestamp = 0;
    function onScroll(e) {
        // Only check when we're not still waiting for data.
        if (!isLoading) {
            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var closeToBottom = ($window.scrollTop() + $window.height() > $document.height() - 100);
            if (closeToBottom) {
                // Only allow requests every second
                var currentTime = new Date().getTime();
                if (lastRequestTimestamp < currentTime - 1000) {
                    lastRequestTimestamp = currentTime;
                    loadData();
                }
            }
        }
        var $timeline_block = $('.cd-timeline-block');
        //on scolling, show/animate timeline blocks when enter the viewport
        //$(window).on('scroll', function () {
        $timeline_block.each(function () {
            if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden')) {
                $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
            }
        });
        //});
    }

    function loadData() {
        isLoading = true;
        $.ajax({
//                type: 'POST',
            url: apiPage,
            dataType: 'json',
//                dataType: 'jsonp', // 跨域 Set to jsonp if you use a server on a different domain and change it's setting accordingly
            data: {idx: pageIdx}, // Page parameter to make sure we load new data
//                complete: onLoadData
            success: onLoadData
        });

    }

    function onLoadData(response) {
//            if (response.status == 200) {
        isLoading = false;
        // Increment page index for future calls.
        pageIdx++;
        //php only
        for (i = 0; i < response.length; i++) {
            m = response[i];
            m.content = m.content.replace('>.<\/a>', '\/>');
            var muloData = $("<div>" + m.content + "</div>").find('.molu-data');
            m.audio = muloData.data('audio');
            m.cover = muloData.data('cover');
        }
        var template = $('.mulo-tpl').html();
        var $newImages = Mustache.render(template, {data: response});
        // Disable requests if we reached the end
        if (response.message == 'End') {
            $document.off('scroll', onScroll);
        }
        //console.log('onLoadData', $newImages);
        $('#cd-timeline').append($newImages);
        //hide timeline blocks which are outside the viewport
        $('.cd-timeline-block').each(function () {
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
        });
        // Apply layout.
//            }
    }

    // Capture scroll event.
    $document.on('scroll', onScroll);
    // Load first data from the API.
    loadData();
});