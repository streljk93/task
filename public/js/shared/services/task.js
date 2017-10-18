angular.module('taskApp').service('TaskService', function($http, config) {
	
	this.loadMaxDate = function() {
		return $http({
			method: 'GET',
			url: config.url.base + 'task/load_max_date',
		});
	};

	this.loadMinDate = function() {
		return $http({
			method: 'GET',
			url: config.url.base + 'task/load_min_date',
		});
	};

})