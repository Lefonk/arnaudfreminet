
/**
 * Sticky Column
 */
window.addEventListener('load', () => {
    let allStickyCol = document.querySelectorAll('.tpgb-column.tpgb-column-sticky,.tpgb-container-col.tpgb-column-sticky');
    if(allStickyCol){
        allStickyCol.forEach((sc)=>{
            tpgb_Sticky_Column(sc);
        });
    }
});

function tpgb_Sticky_Column(scope) {
    let settings = JSON.parse(scope.getAttribute('data-sticky-column'));
    let stickyInst = null,
    stickyInstOptions = {
        topSpacing: 40,
        bottomSpacing: 40,
        containerSelector: (scope.classList.contains('tpgb-container-col')) ? '.tpgb-container-row' : '.tpgb-container' ,
        innerWrapperSelector: (scope.classList.contains('tpgb-container-col')) ? '' :  '.tpgb-column',
        minWidth: 100,
    },
    screenWidth = screen.width ; 

    if ( scope.classList.contains('tpgb-column-sticky') ) {
        if( true === settings['sticky'] ){
            if( (screenWidth >= 1201  && -1 !== settings['stickyOn'].indexOf( 'desktop' )) || (screenWidth <= 1200 && screenWidth >= 768  && -1 !== settings['stickyOn'].indexOf( 'tablet' )) || (screenWidth <= 767 && -1 !== settings['stickyOn'].indexOf( 'mobile' ))){
                tpgb_stickyColumn();
                window.addEventListener('resize', ()=>{debounce(150, columnResizeDebounce)});
                window.addEventListener('orientationchange', ()=>{debounce(150, columnResizeDebounce)});
            }
        }
    }

    function tpgb_stickyColumn(){
        stickyInstOptions.topSpacing = settings['topSpacing'];
        stickyInstOptions.bottomSpacing = settings['bottomSpacing'];
        scope.setAttribute('data-stickyColumnInit', true);
        stickyInst = new StickySidebar( scope, stickyInstOptions );
    }

    function columnResizeDebounce() {
        var availableDevices  = settings['stickyOn'] || [];

        if ( [] !== availableDevices ) {
            scope.setAttribute( 'data-stickyColumnInit', true );
            stickyInst = new StickySidebar( scope, stickyInstOptions );
            stickyInst.updateSticky();
        } else {
            scope.setAttribute( 'data-stickyColumnInit', false );
            stickyInst.destroy();
        }
    }
}

function debounce( threshold, callback ) {
    var timeout;
    return function debounced( $event ) {
        function delayed() {
            callback.call( this, $event );
            timeout = null;
        }
        if ( timeout ) {
            clearTimeout( timeout );
        }
        timeout = setTimeout( delayed, threshold );
    };
}