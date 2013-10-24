var kadaServices = angular.module('kadaServices', ['ngResource']);
 
kadaServices.factory('Kade', ['$resource', function($resource) {
	return $resource('https://emajliramokade.com/platform/Kada.svc/KadaIzvorPodataka/OdobreneKade?limit=10', {}, {
		query: { method:'GET', isArray:true }
	});
}]);
