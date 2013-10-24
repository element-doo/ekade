function IndexCtl($scope, Kade) {
	$scope.kade = Kade.query({}, function() {
		$scope.$broadcast('dataLoaded');
	});

	function rand(a, b) {
		return Math.floor(Math.random() * (b - a + 1) + a)
	}

	$scope.randSize = function(a, b, c, d) {
		return rand(a, b) + '/' + rand(c, d);
	}
}

