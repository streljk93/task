<div class="container" ng-controller="TaskController as task">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<div class="list-group-item d-flex justify-content-center align-items-center text-uppercase font-weight-bold">
					Операции
					<button ng-click="task.dtInstance.changeData()">asdfa</button>
				</div>
			  <a class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <p class="mb-1 font-weight-bold"><i class="fa fa-eye"></i> Просроченые задачи</p>
			      <small>(operation)</small>
			    </div>
			    <small>Задача считается просроченной, если дата ее окончания больше текущей и она не выполнена.</small>
			  </a>
			  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <p class="mb-1 font-weight-bold"><i class="fa fa-eye"></i> Все задачи, имеющие более одного исполнителя</p>
			      <small>(operation)</small>
			    </div>
			  </a>
			  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <p class="mb-1 font-weight-bold"><i class="fa fa-eye"></i> Топ 5 пользователей</p>
			      <small>(operation)</small>
			    </div>
			    <small>Которые выполнили наибольшее количество задач в текущем (выбранном) интервале времени</small>
			  </a>
			</div>
		</div>
		<div class="col-md-9">
			<!-- <div class="list-group mb-2"> -->
				<!-- <div class="list-group-item"> -->
					<div class="input-group input-daterange">
				    <div class="input-group-addon">Начало</div>
				    <input type="text" class="form-control" value="2012-04-05">
				    <div class="input-group-addon">Окончание</div>
				    <input type="text" class="form-control" value="2012-04-19">
					</div>
				<!-- </div> -->
			<!-- </div> -->
			<!-- <div class="table-responsive">
        <table id="dataTable" datatable="" dt-options="task.dtOptions" dt-columns="task.dtColumns" dt-instance="task.dtInstance" class="table table-striped table-responsive table-sm" style="font-size: 14px">
        </table>  
        <div class="datatable-layout"></div>
      </div> -->
			<div class="table-responsive">
				<table id="dataTable" datatable="" dt-options="task.dtOptions" dt-columns="task.dtColumns" dt-instance="task.dtInstance" class="table table-striped table-sm" style="font-size: 12.5px;">
					<thead>
						<tr class="font-weight-bold">
							<td style="padding: 10px 18px;">#</td>
							<td style="padding: 10px 18px;">name</td>
							<td style="padding: 10px 18px;">description</td>
							<td style="padding: 10px 18px;">start</td>
							<td style="padding: 10px 18px;">end</td>
							<td style="padding: 10px 18px;">important</td>
							<td style="padding: 10px 18px;">director</td>
							<td style="padding: 10px 18px;">users</td>
							<td style="padding: 10px 18px;">status</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot class="font-weight-bold">
						<tr>
							<td style="padding: 10px 18px;">#</td>
							<td style="padding: 10px 18px;">name</td>
							<td style="padding: 10px 18px;">description</td>
							<td style="padding: 10px 18px;">start</td>
							<td style="padding: 10px 18px;">end</td>
							<td style="padding: 10px 18px;">important</td>
							<td style="padding: 10px 18px;">director</td>
							<td style="padding: 10px 18px;">users</td>
							<td style="padding: 10px 18px;">status</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
