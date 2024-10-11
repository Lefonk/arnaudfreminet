// gallery-script.js

(function($) {
    $(document).ready(function() {
        console.log('Gallery script loaded');

        var $grid = $('.masonry-gallery');

        if ($grid.length > 0) {
            // Initialize Isotope after images have loaded
            $grid.imagesLoaded(function() {
                $grid.isotope({
                    itemSelector: '.masonry-item',
                    percentPosition: true,
                    layoutMode: 'masonry',
                    masonry: {
                        columnWidth: '.masonry-item',
                        gutter: 10
                    }
                });
                console.log('Isotope initialized');
            });
        } else {
            console.error('Grid element not found');
        }

        // Array to keep track of visible post IDs
        var visiblePostIds = [];

        // Update the array of visible post IDs based on filtering
        function updateVisiblePostIds() {
            visiblePostIds = [];
            $grid.find('.masonry-item').each(function() {
                var $this = $(this);
                if ($this.is(':visible')) {
                    var postId = $this.data('post-id');
                    visiblePostIds.push(postId.toString());
                }
            });
        }

        // Initial update
        updateVisiblePostIds();

        // Update when filters are applied
        $grid.on('arrangeComplete', function() {
            updateVisiblePostIds();
        });

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

        $('#main-filters, #modal-filters').on('click', '.filter-button', function(event) {
            event.preventDefault(); // Prevent default action
            event.stopPropagation(); // Stop the event from bubbling up

            var $this = $(this);
            var isAll = $this.data('filter') === '*';
            var $parentGroup = $this.closest('.filter-group');

            // Remove active class from all buttons in the parent group
            $parentGroup.find('.filter-button').removeClass('active');

            // Add active class to the clicked button
            $this.addClass('active');

            // Sync the other filter group
            var $otherGroup = $parentGroup.attr('id') === 'main-filters' ? $('#modal-filters') : $('#main-filters');
            $otherGroup.find('.filter-button').removeClass('active');

            // Add active class to the corresponding button in the other group
            $parentGroup.find('.filter-button.active').each(function() {
                $otherGroup.find('.filter-button[data-filter="' + $(this).data('filter') + '"]').addClass('active');
            });

            applyFilters();
        });

        // Clear filters
        $('#clear-filters, #clear-filters-mobile').on('click', function() {
            $('.filter-button').removeClass('active');
            $('.filter-button[data-filter="*"]').addClass('active');
            applyFilters();
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
                }).get().join('');
            }

            $grid.isotope({ filter: filterValue });
            updateFilterCounts();
            updateVisiblePostIds();
        }

        $('#apply-filters-mobile').on('click', function() {
            applyFilters();
            closeModal();
        });

        // Modal handlers
        $('#open-filter-modal').on('click', function() {
            $('#filter-modal').show();
            $('body').addClass('modal-open');
        });

        function closeModal() {
            $('#filter-modal').hide();
            $('body').removeClass('modal-open');
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

        // Initialize counts and layout
        updateFilterCounts();
        $grid.isotope('layout');

        // Handle click on gallery item
        $grid.on('click', '.gallery-item-link', function(e) {
            e.preventDefault();

            var $item = $(this).closest('.masonry-item');
            var postId = $item.data('post-id').toString();

            // Get the index of the clicked item in the visiblePostIds array
            var currentIndex = visiblePostIds.indexOf(postId);

            if (currentIndex !== -1) {
                openFancybox(postId, currentIndex);
            } else {
                console.error('Post ID not found in visible items.');
            }
        });

        function openFancybox(postId, currentIndex) {
            // Load the content via AJAX
            $.ajax({
                url: gallery_ajax_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_tableau_content',
                    post_id: postId,
                    nonce: gallery_ajax_params.nonce
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Open Fancybox with the retrieved content
                        Fancybox.show([{
                            src  : '<div class="custom-fancybox-content">' + response.data.content + '</div>',
                            type : 'html',
                        }], {
                            touch: false,
                            baseClass: 'custom-fancybox',
                            afterShow : function(instance, current) {
                                // Setup navigation
                                setupModalNavigation(instance, current, currentIndex);
                            },
                        });
                    } else {
                        console.error('Error:', response.data);
                        alert('An error occurred while loading the content.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while loading the content.');
                }
            });
        }

        function setupModalNavigation(instance, current, currentIndex) {
            // Use current.$content to select elements within the current modal
            var $content = current.$content;

            // Ensure previous handlers are unbound to prevent multiple bindings
            $content.find('#next-tableau').off('click').on('click', function() {
                currentIndex++;
                if (currentIndex >= visiblePostIds.length) {
                    currentIndex = 0; // Loop back to the first item
                }
                var nextPostId = visiblePostIds[currentIndex];
                instance.close(); // Close current instance
                openFancybox(nextPostId, currentIndex); // Open next item
            });

            $content.find('#prev-tableau').off('click').on('click', function() {
                currentIndex--;
                if (currentIndex < 0) {
                    currentIndex = visiblePostIds.length - 1; // Loop to the last item
                }
                var prevPostId = visiblePostIds[currentIndex];
                instance.close(); // Close current instance
                openFancybox(prevPostId, currentIndex); // Open previous item
            });
        }

        // Log initial item count
        console.log('Initial item count:', $('.masonry-item').length);
    });
})(jQuery);