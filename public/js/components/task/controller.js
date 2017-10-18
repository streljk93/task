angular.module('taskApp').controller('TaskController', function($scope, DTOptionsBuilder, DTColumnBuilder, config, $compile) {
	
	var ctrl = this;
	$scope.loaded = {};

	ctrl.dtInstance = {};
	ctrl.dtOptions = DTOptionsBuilder.newOptions()
		.withOption('ajax', {
			url: config.url.base + 'task/pagination',
			type: 'GET',
			// data: data,
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
	  		console.log(full.user_list);
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

	$scope.changeData = function() {
		// ctrl.dtOptions = DTOptionsBuilder.newOptions()
		// 	.withOption('ajax', {
		// 		url: config.url.base + 'task/pagination',
		// 		type: 'GET',
		// 		// data: data,
		// 		headers: {'Content-Type':'application/x-www-form-urlencoded'},
		// 	})
		//    // or here
		// 	.withDataProp('data')
		// 	.withOption('processing', false)
		// 	// .withOption('scrollY', '3000px')
		// 	.withOption('serverSide', true)
		// 	.withOption('bFilter', false)
		// 	.withOption('bLengthChange', true)
		// 	.withOption('displayLength', 20)
		// 	.withOption('order', [0, 'asc'])
		// 	.withPaginationType('full_numbers');

		// ctrl.dtOptions.withOption('fnRowCallback',
	 //    function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
	 //      $compile(nRow)($scope);
	 //  });
	};

});