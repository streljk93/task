angular.module('taskApp', ['datatables'])

.run(function() {
	
})

.config(function() {
	
});

$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});

NProgress.start();
setTimeout(function() {
	NProgress.done();
}, 3000);