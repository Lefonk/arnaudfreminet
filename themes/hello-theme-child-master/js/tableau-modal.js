(function($) {
    $(document).ready(function() {
        var $modal = $('#tableau-modal');
        var $modalContent = $('#tableau-modal-content');
        var currentPermalink = null;

        // Open modal
        $(document).on('click', '.tableau-modal-link', function(e) {
            e.preventDefault();
            var permalink = $(this).attr('href');
            openModal(permalink);
        });

        // Close modal
        $('.close-modal').on('click', closeModal);
        $(window).on('click', function(e) {
            if ($(e.target).is($modal)) {
                closeModal();
            }
        });

        function openModal(permalink) {
            console.log('Opening modal for permalink:', permalink);
            currentPermalink = permalink;
            loadTableauContent(permalink);
            $modal.show();
            $('body').addClass('modal-open');
            // Update URL without reloading the page
            history.pushState(null, null, permalink);
        }

        function closeModal() {
            console.log('Closing modal');
            $modal.hide();
            $('body').removeClass('modal-open');
            // Restore original URL
            history.pushState(null, null, '/');
        }

        function loadTableauContent(permalink) {
            console.log('Loading content for permalink:', permalink);
            console.log('AJAX URL:', tableau_ajax.ajaxurl);
            console.log('Nonce:', tableau_ajax.nonce);
            $modalContent.html('<p>Loading...</p>'); // Show loading indicator
            $.ajax({
                url: tableau_ajax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'load_tableau_content',
                    permalink: permalink,
                    _ajax_nonce: tableau_ajax.nonce // Use _ajax_nonce as the key
                },
                success: function(response) {
                    console.log('AJAX Response:', response);
                    if (response.success && response.data) {
                        $modalContent.html(response.data);
                        console.log('Content loaded into modal');
                        setupNavigation();
                        initializeIsotope();
                        initializeFancybox();
                    } else {
                        $modalContent.html('<p>Error loading content: ' + (response.data || 'Unknown error') + '</p>');
                        console.error('AJAX request was not successful:', response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $modalContent.html('<p>Error loading content. Please try again.</p>');
                    console.error('AJAX error:', textStatus, errorThrown);
                    console.error('Response Text:', jqXHR.responseText);
                }
            });
        }
     
        function setupNavigation() {
            console.log('Setting up navigation');
            $('.nav-button').on('click', function(e) {
                e.preventDefault();
                var nextPermalink = $(this).attr('href');
                console.log('Navigating to permalink:', nextPermalink);
                loadTableauContent(nextPermalink);
                // Update URL without reloading the page
                history.pushState(null, null, nextPermalink);
            });
        }

        // ... rest of the code remains the same ...

        // Handle browser back/forward buttons
        $(window).on('popstate', function() {
            var currentPath = window.location.pathname;
            if (currentPath.startsWith('/tableau/')) {
                openModal(currentPath);
            } else {
                closeModal();
            }
        });

        // ... rest of the code remains the same ...
    });
})(jQuery);