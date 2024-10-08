/**
 * Scroll Navigation
*/
document.addEventListener('DOMContentLoaded', () => {
    let allScrolNav = document.querySelectorAll('.tpgb-scroll-nav');
    if(allScrolNav){
        allScrolNav.forEach((sn)=>{
            jQuery(".tpgb-scroll-nav-item").mPageScroll2id({
                highlightSelector : ".tpgb-scroll-nav-item",
                highlightClass : "active",
                scrollSpeed : 50,
            });

            let navItems = sn.querySelectorAll('.tpgb-scroll-nav-item');
            if(navItems){
                navItems.forEach((ni)=>{
                    ni.addEventListener('click',(e)=>{
                        e.preventDefault();
                        let closeMain = e.currentTarget.closest('.tpgb-scroll-nav');
                        let actNavItm = closeMain.querySelector('.tpgb-scroll-nav-item.active');
                        if(actNavItm){
                            actNavItm.classList.remove('active');
                            e.currentTarget.classList.add('add');
                        }
                    });
                });
            }

            if(sn.classList.contains('scroll-view')){
                var container_scroll_view = sn.querySelector('.tpgb-scroll-nav-inner');
                if(container_scroll_view){
                    window.addEventListener('scroll', function() {
                        const scrollVal = window.pageYOffset || document.documentElement.scrollTop;
                        let scroll_view_value = sn.getAttribute('data-scroll-view');
                        
                        if (scroll_view_value && scrollVal > scroll_view_value) {
                            sn.classList.add('show');
                        } else {
                            sn.classList.remove('show');
                        }
                    });
                }
            }
        });
    }
});