var kadaServices = angular.module('kadaServices', ['ngResource']);
 
kadaServices.factory('Kade', ['$resource', function($resource) {
	return $resource('https://emajliramokade.com/platform/Kada.svc/KadaIzvorPodataka/OdobreneKade', { offset: 0, limit:100 }, {
		query: { method:'GET', isArray:true }
	});
}]);
