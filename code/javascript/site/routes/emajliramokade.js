var emajliramokade = angular.module('emajliramokade', ['kadaServices']);

/*
emajliramokade.config(function($routeProvider) {
	$routeProvider.
		when('/', { controller: IndexCtl });
});
*/

emajliramokade.directive('flexslider', ['$timeout', function($timeout) {
	return {
		link: function($scope, element, attrs) {
			$scope.$on('dataLoaded', function() {
				$timeout(function() {
					FlexSlider();
				}, 0, false);
			})
		}
	};
}]);

function FlexSlider() {
	// flexslider
	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 210,
		itemMargin: 5,
		asNavFor: '#slider'
	});

	$('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		keyboard: true,
		sync: "#carousel"
	});

	// fancybox
	$(".fancybox").fancybox({
		openEffect  : 'elastic',
		closeEffect : 'elastic',
		helpers : {
		title : {
			type : 'inside'
		}
		}
	});


	// go to the top smooth
	$('a[href*=#]').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
		&& location.hostname == this.hostname) {
		var $target = $(this.hash);
		$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
		if ($target.length) {
			var targetOffset = $target.offset().top;
			$('html,body').animate({scrollTop: targetOffset}, 1000);
			return false;
		}
		}
	});

	// admin gallery hover
	$( ".thumbnail" ).hover(
		function() {
		$( this ).find('.js-admin-hover').stop( true, true ).fadeIn('fast');
		}, function() {
		$( this ).find('.js-admin-hover').stop( true, true ).fadeOut('fast');
		}
	);

	// tooltips
	$('.js-tooltip').tooltip();


	// js-btn-send
	$( ".js-btn-send" ).click(function() {
		$(this).find('i').removeClass('icon-location-arrow');
		$(this).find('i').addClass('icon-spinner icon-spin');
	});

	// bootstrap input style
	$('input[type=file]').bootstrapFileInput();
}
