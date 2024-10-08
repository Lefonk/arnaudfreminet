(function($) {
    'use strict';

    $(document).ready(function() {
        const mainImage = $('.main-image');
        const magnifier = $('.magnifier');
        const magnifiedImage = $('.magnifier img');
        const magnifiedView = $('.magnified-view');
        const magnifiedViewImage = $('.magnified-view img');

        const missingElements = [];
        if (!mainImage.length) missingElements.push('.main-image');
        if (!magnifier.length) missingElements.push('.magnifier');
        if (!magnifiedImage.length) missingElements.push('.magnifier img');
        if (!magnifiedView.length) missingElements.push('.magnified-view');
        if (!magnifiedViewImage.length) missingElements.push('.magnified-view img');

        if (missingElements.length > 0) {
            console.warn('Image Magnifier: The following elements were not found:', missingElements.join(', '));
            return;
        }

        mainImage.on('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const boundedX = Math.max(0, Math.min(x, rect.width));
            const boundedY = Math.max(0, Math.min(y, rect.height));

            magnifier.css('display', 'block');
            magnifiedView.css('display', 'block');
            magnifier.css({
                left: `${boundedX - magnifier.width() / 2}px`,
                top: `${boundedY - magnifier.height() / 2}px`
            });

            const magnifyScale = 2;
            const magnifiedImageWidth = mainImage.width() * magnifyScale;
            const magnifiedImageHeight = mainImage.height() * magnifyScale;

            magnifiedImage.css({
                width: `${magnifiedImageWidth}px`,
                height: `${magnifiedImageHeight}px`,
                left: `-${boundedX * magnifyScale - magnifier.width() / 2}px`,
                top: `-${boundedY * magnifyScale - magnifier.height() / 2}px`
            });

            magnifiedViewImage.css({
                width: `${magnifiedImageWidth}px`,
                height: `${magnifiedImageHeight}px`,
                left: `-${boundedX * magnifyScale - magnifiedView.width() / 2}px`,
                top: `-${boundedY * magnifyScale - magnifiedView.height() / 2}px`
            });
        });

        mainImage.on('mouseleave', function() {
            magnifier.css('display', 'none');
            magnifiedView.css('display', 'none');
        });

        mainImage.on('dragstart', function(e) {
            e.preventDefault();
        });
    });

})(jQuery);