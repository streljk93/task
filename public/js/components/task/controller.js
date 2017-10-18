angular.module('taskApp').controller('TaskController', function($scope, DTOptionsBuilder, DTColumnBuilder, config, $compile, TaskService, UserService) {
	
	var ctrl = this;
	$scope.loaded = {};

	$scope.request = function(data) {
		data = data || false;

		ctrl.dtOptions = DTOptionsBuilder.newOptions()
			.withOption('ajax', {
				url: config.url.base + 'task/pagination',
				type: 'GET',
				data: {
					pagination_data: data,
				},
				headers: {'Content-Type':'application/x-www-form-urlencoded'},
			})
		   // or here
			.withDataProp('data')
			.withOption('processing', false)
			// .withOption('scrollY', '3000px')
			.withOption('serverSide', true)
			.withOption('bFilter', false)
			.withOption('bLengthChange', true)
			.withOption('displayLength', 20)
			.withOption('order', [0, 'asc'])
			.withPaginationType('full_numbers');
	};

	ctrl.dtInstance = {};
	$scope.request();

	ctrl.dtOptions.withOption('fnRowCallback',
    function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $compile(nRow)($scope);
  });

	ctrl.dtColumns = [
	  DTColumnBuilder.newColumn('id').withTitle('#')
	    .renderWith(function(data, type, full) {
        return full.id;
	    }),

	  DTColumnBuilder.newColumn('name').withTitle('name')
	  	.renderWith(function(data, type, full) {
	  		return full.name;
	  	}),

	  DTColumnBuilder.newColumn('description').withTitle('description')
	  	.renderWith(function(data, type, full) {
	  		return full.description;
	  	}),

	  DTColumnBuilder.newColumn('start').withTitle('start')
	  	.renderWith(function(data, type, full) {
	  		return full.start;
	  	}),

	  DTColumnBuilder.newColumn('end').withTitle('end')
	  	.renderWith(function(data, type, full) {
	  		return full.end;
	  	}),	

	  DTColumnBuilder.newColumn('important').withTitle('important')
	  	.renderWith(function(data, type, full) {
	  		return full.important;
	  	}),

	  DTColumnBuilder.newColumn('firstname').withTitle('director')
	  	.renderWith(function(data, type, full) {
	  		// return full.director_firstname + ' ' + full.director_middlename + ' ' + full.director_lastname;
	  		return full.director_firstname;
	  	}),

	  DTColumnBuilder.newColumn('firstname').withTitle('users')
	  	.renderWith(function(data, type, full) {
	  		var row = '';
	  		if(full.user_list !== undefined) {
	  			full.user_list.forEach(function(user) {
	  				row += '<div>' + user.firstname + '</div>';
	  			});
	  		}
	  		return row;
	  	}),

	  DTColumnBuilder.newColumn('status_id').withTitle('status')
	  	.renderWith(function(data, type, full) {
	  		return full.status_name;
	  	}),
	];

	$scope.getMaxDate = function() {
		TaskService.loadMaxDate().then(function(response) {
			if(response.data.success) {
				$scope.loaded.maxDate = true;
				$scope.maxDate = response.data.info;
			}
		});
	};

	$scope.getMinDate = function() {
		TaskService.loadMinDate().then(function(response) {
			if(response.data.success) {
				$scope.loaded.minDate = true;
				$scope.minDate = response.data.info;

				$scope.getMaxDate();
			};
		});
	};
	$scope.getMinDate();

	$scope.$watch('loaded.maxDate', function(data) {
		if(data && $scope.loaded.minDate) {
			$scope.daterange = $scope.minDate + ' - ' + $scope.maxDate;
		}
	});

	var requestNum = 1;
	$scope.requestDateRange = function(daterange) {
		if(requestNum !== 1) {
			daterange = daterange.split(' - ');
			$scope.daterangeArr = daterange;
			$scope.request({
				daterange: {
					start: daterange[0],
					end: daterange[1],
				},
			});
		}
		requestNum++;
	};

	$scope.requestOverdue = function() {
		var data = {
			overdue: true
		};
		if($scope.daterangeArr !== undefined) {
			data.daterange = {
				start: $scope.daterangeArr[0],
				end: $scope.daterangeArr[1],
			};
		}
		$scope.request(data);
	};

	$scope.requestNotOnceUser = function() {
		var data = {
			not_once_user: true
		};
		if($scope.daterangeArr !== undefined) {
			data.daterange = {
				start: $scope.daterangeArr[0],
				end: $scope.daterangeArr[1],
			}
		};
		$scope.request(data);
	};

	$scope.requestTop5 = function() {
		var daterange = false;
		if($scope.daterangeArr !== undefined) {
			daterange = {
				start: $scope.daterangeArr[0],
				end: $scope.daterangeArr[1],
			}
		};
		UserService.loadTop5(daterange).then(function(response) {
			$scope.loaded.userList = true;
			if(response.data.success) {
				$scope.userList = response.data.info;
			}
		});
	};

	$scope.requestSearchDirector = function(queryDirector) {
		var data = {
			query_director: queryDirector,
		};
		if($scope.daterangeArr !== undefined) {
			data.daterange = {
				start: $scope.daterangeArr[0],
				end: $scope.daterangeArr[1],
			}
		};
		$scope.request(data);
	}


});