function tp_woo_listing( $scope, listing, widget ) {
    $ = jQuery;

    var container = listing;
    var login  = $('body').hasClass('logged-in') ? 'true' : 'false',
        tprow  = container[0].querySelectorAll('.tp-row'),
        listing_type = JSON.parse( tprow[0].getAttribute('data-wooattr') );
    let	option = [];
    let	shopList = [];

    if( container[0].classList.contains('tp-pro-l-type-wishlist') || container[0].classList.contains('tp-dy-l-type-wishlist') ) {
        listing_type = 'wishlist';
        if( widget === 'products' ) {
            var shopName = 'tpwishlist';
        } else if( widget === 'dynamic' ) {
            var shopName = $scope[0].querySelector('.dynamic-listing.tp-dy-l-type-wishlist').dataset.wid;
        }
    } else if ( container[0].classList.contains('tp-pro-l-type-recently_viewed') ) {
        listing_type = 'recently_viewed';
    }

    if ( tprow.length ) {
        tprow.forEach( function( item, index ) {
            option[index] = item.dataset.wooattr ? JSON.parse(item.dataset.wooattr) : [];
            // option[index] = item.dataset.wooattr ? item.dataset.wooattr : [];

            if( login == 'false' ){
                if ( 'wishlist' == listing_type ) {
                    getlsvaluewlnl = [];
                    if( item.offsetParent.classList.contains('product-list') ){
                        let notloginl = item.dataset.wid;
                        var getlsvaluewlnl = JSON.parse( localStorage.getItem( notloginl ) );

                        shopList[index] = getlsvaluewlnl ? getlsvaluewlnl : [];
                    }
                    else if( item.offsetParent.classList.contains('dynamic-listing') ){
                        let notloginl = item.offsetParent.dataset.wid;
                        var getlsvaluewlnl = JSON.parse( localStorage.getItem( notloginl ) );

                        shopList[index] = getlsvaluewlnl ? getlsvaluewlnl : [];
                    }
                }
            }
        });
    }

    if( container.length ) {
        var getlsvaluewlnl = [];

        if( login == 'false' ) {
            if ( 'wishlist' == listing_type ) {
                // if ( JSON.parse( localStorage.getItem(shopName) ) != null ) {
                //     getlsvaluewlnl = JSON.parse( localStorage.getItem(shopName) ); 
                // }
            } else if ( 'recently_viewed' == listing_type ) {
                let nonlogincookies = Cookies.get('tpwoorplnonlogin');
                if ( !nonlogincookies ) {
                    console.log('');
                } else if ( nonlogincookies.length != 0 ) {
                    if ( nonlogincookies.includes("|")) {
                        getlsvaluewlnl = nonlogincookies.split("|");
                    } else {
                        getlsvaluewlnl = nonlogincookies.split(" ");
                    }
                    shopList = getlsvaluewlnl;
                }
            }
        }

        $.ajax({
            type: 'POST',
            url: theplus_ajax_url,
            data: {
                'action': 'tp_wl_get_all_data_ajax',
                'listingtype': listing_type,
                'dataType': 'json',
                'option': option,
                'login': login,
                'notloginwl': shopList,
                'security': theplus_nonce,
            },
            success:function(response) {
                tprow.forEach(function(item, index) {
                    var wishlistarray = JSON.parse(response[index].htmljsondata);

                    if ( wishlistarray.listdata != null && wishlistarray.listdata.length != 0 ) {
                        if( container[0].querySelector('.tp-row .theplus-posts-not-found') ){
                            container[0].querySelector('.tp-row .theplus-posts-not-found').remove();
                        }

                        container[0].querySelector('.tp-row').insertAdjacentHTML("afterbegin", response[index].HtmlData);

                        tpgbSkeleton_filter("visible");

                        setTimeout( function(){
                            tpgbSkeleton_filter("hidden");

                            if( widget === 'products' ) {
                                var containermetro = document.querySelectorAll('.product-list.list-isotope-metro'),
                                    gridlayout = document.querySelectorAll('.product-list .tp-row.layout-fitRows'),
                                    masonrylayout = document.querySelectorAll('.product-list .tp-row.layout-masonry'),
                                    slicklayout = document.querySelectorAll('.product-list .list-carousel-slick > .post-inner-loop');
                            } else if( widget === 'dynamic' ) {
                                var containermetro = document.querySelectorAll('.dynamic-listing.list-isotope-metro'),
                                    gridlayout = document.querySelectorAll('.dynamic-listing .tp-row.layout-fitRows'),
                                    masonrylayout = document.querySelectorAll('.dynamic-listing .tp-row.layout-masonry'),
                                    slicklayout = document.querySelectorAll('.dynamic-listing.list-carousel-slick > .post-inner-loop');
                            }

                            if( gridlayout.length || masonrylayout.length ){
                                $(container[0].querySelector('.tp-row')).isotope('reloadItems').isotope();
                            }
                            
                            if( slicklayout.length ) {                                                    
                                $(container[0].querySelector('.list-carousel-slick > .post-inner-loop')).slick('setPosition');
                            }

                            if( containermetro.length ) {                                              
                                theplus_setup_packery_portfolio('all');                                                    
                            }

                        },1000);
                    } else {
                        item.innerHTML = '';

                        var notFound = response[index].HtmlError ? response[index].HtmlError : '';
                            item.insertAdjacentHTML("afterbegin", `<h3 class="theplus-posts-not-found tp-pl-nf-space">${notFound}</h3>`);
                            item.style.cssText = 'height: 75px;';
                    }
                });
            }
        });                         

        /** Remove from list - Wishlist*/
        $(container).on('click', '.tp-pro-wl-remove-item', function(e){
            e.preventDefault();
            var $this = $(this);
            var currentProduct = $this.data('product');
                currentProduct = currentProduct.toString();

            jQuery(".tp-woo-wishlist .tp_wishlist_remove").each(function(){
                var $this1 = $(this);
                var testdata = $this1.data('product');                                
                if ( testdata.toString() === currentProduct ) {
                    $(this).trigger( "click" );
                }
            });
        });
    }

    var tpgbSkeleton_filter = function(val1) {
        let skeleton = $scope[0].querySelectorAll('.tp-skeleton');
        if( skeleton.length > 0 ){
            skeleton.forEach(function(self) {
                if( self.style.visibility == 'visible' && self.style.opacity == 1 ){
                    if(val1 == "hidden"){
                        self.style.cssText = "visibility: hidden; opacity: 0;";
                    }
                }else{
                    if(val1 == "visible"){
                        self.style.cssText = "visibility: visible; opacity: 1;";
                    }
                }
            });
        }
    }
}