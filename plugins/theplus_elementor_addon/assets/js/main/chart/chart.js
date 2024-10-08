/*chart js*/
( function( $ ) {
	"use strict";
	var WidgetChartHandler = function ($scope, $) {
		var container = $scope.find('.tp-chart-wrapper'),
			canvas = container.find( '> canvas' ),
			data_settings  = container.data('settings');

		if(container.length){
            var $this = canvas,
            ctx = $this[0].getContext('2d');
            new Chart(ctx, data_settings);
		}		
	};
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tp-chart.default', WidgetChartHandler);
	});
})(jQuery);
