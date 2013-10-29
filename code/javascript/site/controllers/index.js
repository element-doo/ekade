function IndexCtl($scope, Kade) {
	$scope.kade = Kade.query({}, function() {
		$scope.$broadcast('dataLoaded');
	});
	$scope.thumbnail = function(kada) {
		return 'https://static.emajliramokade.com/thumbnail/' + kada.URI + '/' + kada.slikeKade.thumbnail.filename;
	}
	$scope.web = function(kada) {
		return 'https://static.emajliramokade.com/web/' + kada.URI + '/' + kada.slikeKade.web.filename;
	}
}
