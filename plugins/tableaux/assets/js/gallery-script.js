(function($) {
    $(document).ready(function() {
        console.log('Gallery script loaded');

        var $grid = $('.masonry-gallery');
        var scrollPosition;

        if ($grid.length > 0) {
            $grid.isotope({
                itemSelector: '.masonry-item',
                layoutMode: 'masonry'
            });
            console.log('Isotope initialized');
        } else {
            console.error('Grid element not found');
        }

        function updateFilterCounts() {
            $('.filter-button').each(function() {
                var filterValue = $(this).attr('data-filter');
                var count = filterValue === '*' ? $grid.find('.masonry-item').length : $grid.find(filterValue).length;
                
                var $count = $(this).find('.filter-count');
                if ($count.length === 0) {
                    $count = $('<span class="filter-count"></span>').appendTo($(this));
                }
                $count.text(count);
            });
        }

        // Filter button click handler for both main and modal filters
        $('#main-filters, #modal-filters').on('click', '.filter-button', function() {
            var $this = $(this);
            var isAll = $this.data('filter') === '*';
            var $parentGroup = $this.closest('.filter-group');

            if (isAll) {
                $parentGroup.find('.filter-button').removeClass('active');
                $this.addClass('active');
            } else {
                $parentGroup.find('.filter-button[data-filter="*"]').removeClass('active');
                $this.toggleClass('active');
            }

            // Sync the other filter group
            var $otherGroup = $parentGroup.attr('id') === 'main-filters' ? $('#modal-filters') : $('#main-filters');
            $otherGroup.find('.filter-button').removeClass('active');
            $parentGroup.find('.filter-button.active').each(function() {
                $otherGroup.find('.filter-button[data-filter="' + $(this).data('filter') + '"]').addClass('active');
            });

            if (!isSmallScreen()) {
                applyFilters();
            }
        });

        // Clear filters
        $('#clear-filters, #clear-filters-mobile').on('click', function() {
            $('.filter-button').removeClass('active');
            $('.filter-button[data-filter="*"]').addClass('active');
            if (!isSmallScreen()) {
                applyFilters();
            }
        });

        // Apply filters
        function applyFilters() {
            var $activeFilters = $('#main-filters .filter-button.active');
            var filterValue;

            if ($activeFilters.length === 0 || $activeFilters.filter('[data-filter="*"]').length > 0) {
                filterValue = '*';
            } else {
                filterValue = $activeFilters.map(function() {
                    return $(this).attr('data-filter');
                }).get().join(', ');
            }
            
            console.log('Filter value:', filterValue);
            $grid.isotope({ filter: filterValue });
            $grid.isotope('layout');
            updateFilterCounts();
            console.log('Visible items:', $grid.isotope('getFilteredItemElements').length);
        }

        $('#apply-filters-mobile').on('click', function() {
            applyFilters();
            closeModal();
        });

        // Modal handlers
        $('#open-filter-modal').on('click', function() {
            scrollPosition = $(window).scrollTop();
            $('#filter-modal').show();
            $('body').addClass('modal-open');
        });

        function closeModal() {
            $('#filter-modal').hide();
            $('body').removeClass('modal-open');
            $(window).scrollTop(scrollPosition);
            setTimeout(function() {
                $grid.isotope('layout');
            }, 100);
        }

        $('.close-button').on('click', closeModal);

        $(window).on('click', function(event) {
            if ($(event.target).is('#filter-modal')) {
                closeModal();
            }
        });
        // Function to check if the screen is small
        function isSmallScreen() {
            return $(window).width() <= 768;
        }

        // Log initial item count
        console.log('Initial item count:', $('.masonry-item').length);
    });
})(jQuery);