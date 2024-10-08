/**
 * Social Feed
 */
document.addEventListener('DOMContentLoaded', () => {
    let allSocFeed = document.querySelectorAll('.tpgb-social-feed');
    if(allSocFeed){
        allSocFeed.forEach((sf)=>{
            let BoxID = sf.getAttribute("data-id"),
                Setting = (sf.getAttribute("data-fancy-option")) ? JSON.parse(sf.getAttribute("data-fancy-option")) : '',
                Get_SN = (sf.getAttribute("data-scroll-normal")) ? JSON.parse(sf.getAttribute("data-scroll-normal")) : '';

            jQuery('[data-fancybox="'+BoxID+'"]', this).fancybox({
                buttons : Setting.button,
                image: { 
                    preload: 0 
                },
                loop: Setting.loop,
                infobar: Setting.infobar,
                animationEffect: Setting.animationEffect,
                animationDuration: Setting.animationDuration,
                transitionEffect: Setting.transitionEffect,
                transitionDuration: Setting.transitionDuration,
                arrows: Setting.arrows,
                clickContent: Setting.clickContent,
                clickSlide: Setting.slideclick,
                dblclickContent: false,
                dblclickSlide: false,
                smallBtn: false,
                iframe : {
                    preload : 0
                },
                youtube : {
                    autoplay : 0
                },
                vimeo : {
                    autoplay : 0
                },
                mp4 : {
                    autoplay : 0
                },                    
                video: {
                    autoStart: 0
                },
            });

            let gridItem = sf.querySelectorAll('.grid-item.feed-Facebook');
            if(gridItem){
                gridItem.forEach((gi)=>{
                    let itemindex = gi.getAttribute('data-index');
                    jQuery('[data-fancybox="album-'+itemindex+'-'+BoxID+'"]',this).fancybox({
                        buttons : Setting.button,
                        image: { preload: true },
                        loop: Setting.loop,
                        infobar: Setting.infobar,
                        animationEffect:  Setting.animationEffect,
                        animationDuration: Setting.animationDuration,
                        transitionEffect: Setting.transitionEffect,
                        transitionDuration: Setting.transitionDuration,
                        arrows: Setting.arrows,
                        clickContent: Setting.clickContent,
                        clickSlide: Setting.slideclick,
                        dblclickContent: false,
                        dblclickSlide: false,
                    });
                })
            }

            if(Get_SN && Get_SN.ScrollOn === true && Get_SN.TextLimit === false) {
                let SF_Text = sf.querySelectorAll('.tpgb-message');
                if(SF_Text){
                    SF_Text.forEach(function(textElement) {
                        if (textElement.clientHeight >= Get_SN.Height) {
                            textElement.classList.add(Get_SN.className);
                            textElement.style.height = Get_SN.Height+"px";
                        }
                    });
                }
            }

            if (Get_SN.FancyScroll === true && Get_SN.TextLimit === false) {
                let SF_FyText = sf.querySelectorAll('.fancybox-si .tpgb-message');
                SF_FyText.forEach(function(textElement) {
                    textElement.classList.add(Get_SN.Fancyclass);
                    textElement.style.height = Get_SN.FancyHeight+"px";
                });
            }

            document.addEventListener('click', function(event) {
                readmoreText(event);
            });  

            function readmoreText(event){
                var target = event.target;
                if (target.classList.contains('readbtn') && target.closest('.tpgb-social-feed')) {
                    let getCsEl = target.closest('.tpgb-social-feed');
                    let gtCuText =  target.getAttribute('aria-label');
                    var div = target.closest('.tpgb-message');
                    var container = div.closest('.tpgb-isotope .post-loop-inner');
                    var scrollNormal = Get_SN;
                    var showText = div.querySelector('.showtext');
            
                    if(div.classList.contains('show-text')) {
                        div.classList.remove('show-text', 'show-less');
                        target.innerHTML = gtCuText;
                        div.querySelector('.sf-dots').style.display = 'inline';
            
                        if (scrollNormal.ScrollOn === true && scrollNormal.TextLimit === true) {
                            showText.classList.remove(scrollNormal.className);
                            showText.removeAttribute('style');
                        }
                    }else{
                        div.classList.add('show-text', 'show-less');
                        target.innerHTML = 'Show Less';
                        div.querySelector('.sf-dots').style.display = 'none';
            
                        var SF_Text = sf.querySelectorAll('.showtext');
                        if (scrollNormal.ScrollOn === true && scrollNormal.TextLimit === true && SF_Text) {
                            SF_Text.forEach(function(textElement) {
                                if (textElement.clientHeight >= scrollNormal.Height) {
                                    showText.classList.add(scrollNormal.className);
                                    showText.style.height = scrollNormal.Height+"px";
                                }
                            });
                        }
                    }
            
                    if (container) {
                        var isotope = new Isotope(container, {
                            itemSelector: ".grid-item",
                            resizable: true,
                            sortBy: "original-order"
                        });
                        isotope.layout();
                    }
                }

                if (target.classList.contains('readbtn') && target.closest('.fancybox-si')) {
                    let div = target.closest('.tpgb-message');
                    let Scroll = Get_SN;
                    let FcyMsg = target.closest('.tpgb-message');
            
                    if (div.classList.contains('show-text')) {
                        div.classList.remove('show-text', 'show-less');
                        target.innerHTML = 'Show More';
                        div.querySelector('.sf-dots').style.display = 'inline';
            
                        if (Scroll.FancyScroll === 'true' && Scroll.TextLimit === 'true') {
                            FcyMsg.classList.remove(Scroll.Fancyclass);
                            FcyMsg.removeAttribute('style');
                        }
                    } else {
                        div.classList.add('show-text', 'show-less');
                        target.innerHTML = 'Show Less';
                        div.querySelector('.sf-dots').style.display = 'none';
            
                        if (Scroll.FancyScroll === 'true' && Scroll.TextLimit === 'true') {
                            Array.from(FcyMsg).forEach(function(item) {
                                if (item.clientHeight >= Scroll.FancyHeight) {
                                    item.classList.add(Scroll.Fancyclass);
                                    item.style.height = Scroll.FancyHeight+"px";
                                }
                            });
                        }
                    }
                }
                this.removeEventListener('click',(event)=>{
                    readmoreText(event);
                })
            }

            //Load More
            let loadFeed_click = sf.querySelector('.feed-load-more');
            if(loadFeed_click){
                loadFeed_click.addEventListener('click', function(e) {
                    e.preventDefault();
                    let loadFeed = loadFeed_click.getAttribute('data-loadattr'),
                        display = loadFeed_click.getAttribute('data-display'),
                        loadFview = loadFeed_click.getAttribute('data-loadview'),
                        loadclass = loadFeed_click.getAttribute('data-loadclass'),
                        loadlayout = loadFeed_click.getAttribute('data-layout'),
                        loadloadingtxt = loadFeed_click.getAttribute('data-loadingtxt'),
                        current_text = loadFeed_click.textContent;

                    let BlockClass = e.currentTarget.closest('.tpgb-block-'+loadclass);
                
                    if (loadFeed_click.dataset.requestRunning && loadFeed_click.dataset.requestRunning=='true') {
                        return;
                    }
                    loadFeed_click.dataset.requestRunning = "true";
                    loadFeed_click.textContent = loadloadingtxt;
            
                    fetch(tpgb_load.ajaxUrl, {
                        method: 'POST',
                        headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'action=tpgb_feed_load&view=' + display + '&loadFview=' + loadFview + '&loadattr=' + loadFeed
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        var HtmlData = (data && data.HTMLContent) ? data.HTMLContent : '',
                        totalFeed = (data && data.totalFeed) ? data.totalFeed : '',
                        FilterStyle = (data && data.FilterStyle) ? data.FilterStyle : '',
                        Allposttext = (data && data.allposttext) ? data.allposttext : '';
                
                        if (data == '') {
                            loadFeed_click.classList.add('hide');
                        } else {
                            var CategoryClass = BlockClass.querySelector('.all .tpgb-category-count');
                            var PostLoopClass = BlockClass.querySelector('.post-loop-inner');
                            PostLoopClass.insertAdjacentHTML('beforeend', HtmlData);
                
                            var Totalcount = BlockClass.querySelectorAll('.grid-item').length;
                            if(CategoryClass){
                                CategoryClass.innerHTML = '';
                                CategoryClass.insertAdjacentHTML('beforeend', Totalcount);
                            }
                
                            if (FilterStyle == 'style-2' || FilterStyle == 'style-3') {
                                var Categoryload = sf.querySelectorAll('.tpgb-filter-list .tpgb-category-list:not(.all)');
                    
                                if(Categoryload){
                                    Categoryload.forEach(function(value) {
                                        var span2 = value.querySelector('span:nth-child(2)').dataset.hover;
                                        var Toatal2 = BlockClass.querySelectorAll('.grid-item.' + span2).length;
                                        value.querySelector('span:nth-child(1).tpgb-category-count').innerHTML = '';
                                        value.querySelector('span:nth-child(1).tpgb-category-count').insertAdjacentHTML('beforeend', Toatal2);
                                    });
                                }
                            }

                            if (loadlayout == 'grid' || loadlayout == 'masonry') {
                                if (sf.classList.contains('tpgb-isotope')) {                            
                                    jQuery(PostLoopClass).isotope('layout').isotope('reloadItems');
                                }
                            }
                
                            if (Totalcount >= totalFeed) {
                                loadFeed_click.classList.add('hide');
                                loadFeed_click.parentNode.insertAdjacentHTML('beforeend', '<div class="tpgb-feed-loaded">' + Allposttext + '</div>');
                            } else {
                                loadFeed_click.textContent = current_text;
                            }
                        }
                        
                        display = Number(display) + Number(loadFview);
                        loadFeed_click.setAttribute('data-display', display);
                    })
                    .finally(function() {
                        loadFeed_click.dataset.requestRunning = "false";
                
                        if (loadlayout == 'grid' || loadlayout == 'masonry') {
                            if (sf.classList.contains('tpgb-isotope')) {
                                setTimeout(function() {
                                    var container = sf.querySelector('.post-loop-inner');
                                    jQuery(container).isotope({
                                        itemSelector: ".grid-item",
                                        resizable: !0,
                                        sortBy: "original-order"
                                    });
                                }, 100);
                            }
                        }
                
                        if (BlockClass.classList.contains('tpgb-isotope')) {
                            if (loadlayout == 'grid' || loadlayout == 'masonry') {
                                var fancySplide = BlockClass.querySelectorAll('.tpgb-carousel:not(.is-initialized)');
                    
                                fancySplide.forEach(function(obj) {
                                    if (typeof splide_init === 'function') {
                                        splide_init(obj);
                                    }
                                });
                            }
                        }
                    });
                });
            }

            //Lazyload
            let lazyLoad = sf.querySelector('.tpgb-feed-lazy-load')
            if (lazyLoad && sf.classList.contains('tpgb-isotope')) {
                var windowWidth, windowHeight, documentHeight, scrollTop, containerHeight, containerOffset;
                var $window = window;
                
                var recalcValues = function() {
                  windowWidth = $window.innerWidth;
                  windowHeight = $window.innerHeight;
                  documentHeight = document.querySelector('body').offsetHeight;
                  containerHeight = sf.offsetHeight;
                  containerOffset = sf.offsetTop + 50;
                  setTimeout(function() {
                    containerHeight = sf.offsetHeight;
                    containerOffset = sf.offsetTop + 50;
                  }, 50);
                };
                
                recalcValues();
                $window.addEventListener('resize', recalcValues);
                $window.addEventListener('scroll', function(e) {
                  e.preventDefault();
                  recalcValues();
                  scrollTop = $window.pageYOffset;
                    containerHeight = sf.offsetHeight;
                    containerOffset = sf.offsetTop + 50;
                    
                    if (sf.querySelector('.tpgb-feed-lazy-load') && scrollTop < documentHeight && (scrollTop + 60 > (containerHeight + containerOffset - windowHeight))) {
                        let lazyFeed_click = lazyLoad.querySelector('.feed-lazy-load'),
                            lazyFeed = lazyFeed_click.dataset.lazyattr,
                            totalfeed = lazyFeed_click.dataset.totalfeed,
                            display = lazyFeed_click.getAttribute('data-display'),
                            loadFview = lazyFeed_click.dataset.lazyview,
                            loadclass = lazyFeed_click.dataset.lazyclass,
                            loadlayout = lazyFeed_click.dataset.lazylayout,
                            current_text = lazyFeed_click.innerHTML;

                      let BlockClass = lazyFeed_click.closest('.tpgb-block-'+loadclass);
                      
                      if (lazyFeed_click.dataset.requestRunning && lazyFeed_click.dataset.requestRunning=="true") {
                        return;
                      }
                      
                      lazyFeed_click.dataset.requestRunning = "true";
                      
                      if (Number(totalfeed) >= Number(display)) {
                        fetch(tpgb_load.ajaxUrl, {
                            method: 'POST',
                            headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'action=tpgb_feed_load&view=' + display + '&loadFview=' + loadFview + '&loadattr=' + lazyFeed
                        })
                        .then(function(response) {
                          return response.json();
                        })
                        .then(function(data) {
                          var HtmlData = (data && data.HTMLContent) ? data.HTMLContent : '';
                          var totalFeed = (data && data.totalFeed) ? data.totalFeed : '';
                          var FilterStyle = (data && data.FilterStyle) ? data.FilterStyle : '';
                          var Allposttext = (data && data.allposttext) ? data.allposttext : '';
                          
                          if (data === '') {
                            lazyFeed_click.classList.add('hide');
                          } else {
                            var CategoryClass = BlockClass.querySelector('.all .tpgb-category-count');
                            var PostLoopClass = BlockClass.querySelector('.post-loop-inner');
                            PostLoopClass.insertAdjacentHTML('beforeend', HtmlData);
                            var Totalcount = BlockClass.querySelectorAll('.grid-item').length;
                            if(CategoryClass){
                                CategoryClass.innerHTML = '';
                                CategoryClass.appendChild(document.createTextNode(Totalcount));
                            }
                            
                            if (FilterStyle === 'style-2' || FilterStyle === 'style-3') {
                                var Categoryload = BlockClass.querySelectorAll('.tpgb-filter-list .tpgb-category-list:not(.all)');
                                if(Categoryload){
                                    Categoryload.forEach(function(value) {
                                        var span2 = value.querySelector('span:nth-child(2)').dataset.hover;
                                        var Toatal2 = BlockClass.querySelectorAll('.grid-item.' + span2).length;
                                        value.querySelector('span:nth-child(1).tpgb-category-count').innerHTML = '';
                                        value.querySelector('span:nth-child(1).tpgb-category-count').appendChild(document.createTextNode(Toatal2));
                                    });
                                }
                            }
                            
                            if (loadlayout === 'grid' || loadlayout === 'masonry') {
                                if (BlockClass.classList.contains('tpgb-isotope')) {
                                    jQuery(PostLoopClass).isotope('layout').isotope('reloadItems');
                                }
                            }
                            
                            if (Totalcount >= Number(totalFeed)) {
                              if (!lazyFeed_click.nextElementSibling || !lazyFeed_click.nextElementSibling.classList.contains('tpgb-feed-loaded')) {
                                lazyFeed_click.classList.add('hide');
                                var feedLoadedDiv = document.createElement('div');
                                feedLoadedDiv.classList.add('tpgb-feed-loaded');
                                feedLoadedDiv.innerHTML = Allposttext;
                                lazyFeed_click.parentNode.appendChild(feedLoadedDiv);
                              }
                            } else {
                              lazyFeed_click.innerHTML = current_text;
                            }
                          }
                          
                          display = Number(display) + Number(loadFview);
                          lazyFeed_click.setAttribute('data-display', display);
                        })
                        .finally(function() {
                          lazyFeed_click.dataset.requestRunning = "false";
                        })
                        .then(function() {
                          if (BlockClass.classList.contains('tpgb-isotope')) {
                            if (loadlayout === 'grid' || loadlayout === 'masonry') {
                                var container = BlockClass.querySelector(' .post-loop-inner');
                                setTimeout(()=>{
                                    jQuery(container).isotope({
                                        itemSelector: ".grid-item",
                                        resizable: !0,
                                        sortBy: "original-order"
                                    });
                                }, 100)
                            }
                            
                            var fancySplide = BlockClass.querySelectorAll('.tpgb-carousel:not(.is-initialized)');
                            fancySplide.forEach(function(obj) {
                              if (typeof splide_init === 'function') {
                                splide_init(obj);
                              }
                            });
                          }
                        });
                      }
                    }
                });
            }              
        });
    }
});