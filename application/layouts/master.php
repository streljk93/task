<!DOCTYPE html>
<html>
<head>
	{part_meta}
	{part_link}
	<title>{page_name}</title>
</head>
<body ng-app="taskApp" ng-cloak>
	        
  <div class="mb-5">
    <nav class="navbar navbar-light bg-light">
      <div>
        <a href="#" class="navbar-brand">TASK</a>
      </div>
      <!-- <div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
          <span class="navbar-toggler-icon"></span>
        </button> 
      </div> -->
    </nav>
    <div class="collapse" id="exCollapsingNavbar">
      <div class="bg-inverse p-a">
        <h4>Collapsed content</h4>
        <span class="text-muted">Toggleable via the navbar brand.</span>
      </div>
    </div>  
  </div>

	{page_content}
	{part_script}
</body>
</html>