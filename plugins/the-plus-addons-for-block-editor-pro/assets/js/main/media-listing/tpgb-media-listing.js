/**
 * Media Listing
 */
document.addEventListener('DOMContentLoaded', () => {
    let allGallery = document.querySelectorAll('.tpgb-gallery-list');
    if(allGallery){
        allGallery.forEach((glr)=>{
            if(glr.classList.contains('gallery-style-2') || glr.classList.contains('gallery-style-3')){
                let gItem = glr.querySelectorAll('.grid-item');
                if(gItem){
                    gItem.forEach((gi)=>{
                        if(glr.classList.contains('gallery-style-2')){
                            let gtContent = gi.querySelector('.tpgb-gallery-list-content');
                            if(gtContent){
                                gtContent.addEventListener('mouseenter',(e)=>{
                                    let hvrCnt = e.currentTarget.querySelector('.post-hover-content');
                                    if(hvrCnt){
                                        slideDownP(hvrCnt, 300)
                                    }
                                });
                                gtContent.addEventListener('mouseleave',(e)=>{
                                    let hvrCnt = e.currentTarget.querySelector('.post-hover-content');
                                    if(hvrCnt){
                                        slideUpP(hvrCnt, 300)
                                    }
                                });
                            }
                        }
                        if(glr.classList.contains('gallery-style-3')){
                            jQuery(gi).hoverdir();
                        }
                    });
                }
            }

            let BoxID = glr.getAttribute("data-id"),
                Setting = JSON.parse(glr.getAttribute("data-fancy-option"));
                                
            jQuery('[data-fancybox="'+BoxID+'"]').fancybox({
                buttons : Setting.button,
                image: {
                    preload: true
                },

                loop: Setting.loop,
                infobar: Setting.infobar,
                animationEffect:  Setting.animationEffect,
                animationDuration: Setting.animationDuration,
                transitionEffect: Setting.transitionEffect,
                transitionDuration: Setting.transitionDuration,
                arrows: Setting.arrows,

                //false, close, next, nextOrClose, toggleControls, zoom
                clickContent:'next',
                clickSlide:'close',
                dblclickContent: false,
                dblclickSlide: false,

            });
        });
    }
});