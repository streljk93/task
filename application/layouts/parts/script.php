<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/libs.min.js"></script>

<!-- app -->
<script src="js/app.js"></script>

<!-- config -->
<script src="js/shared/config/config.js"></script>

<!-- services -->
<?php
foreach($script['services'] as $service)
{
	echo "<script src=\"js/shared/services/" . $service . ".js\"></script>\n";
}
?>

<!-- controllers -->
<script src="js/components/<?php echo $script['controller']; ?>/controller.js"></script>