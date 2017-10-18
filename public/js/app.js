angular.module('taskApp', ['datatables'])

.run(function() {
	
})

.config(function() {
	
});

$(function() {
  $('input[name="daterange"]').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    }
  });
});

// NProgress.start();
// setTimeout(function() {
// 	NProgress.done();
// }, 3000);