angular.module('taskApp').service('UserService', function($http, config) {
	
	this.loadTop5 = function(daterange) {
		return $http({
			method: 'GET',
			url: config.url.base + 'user/load_top_5',
			params: {
				daterange: daterange,
			},
		});
	};

})