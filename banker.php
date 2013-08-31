<?php 
$title = "Banka";
include("header.php");
?>


<div class="container">
	<h1>Bankéř</h1>
	<?php 
		if ($_COOKIE['hrac'] == prvnihrac()) {
	 ?>
	<h2>Běžný převod</h2>
	
	<form action="prevod.php" class="form-horizontal">
	    <input type="hidden" name="jmeno" value="banker" class="col-lg-2 control-label">
	    <label>Od: </label>
	    <select name="od" class="form-control">
	    	<option value="banker">banker</option>
	    	<?php selecthracu(); ?>
	    </select>
	    <label>Komu: </label>
	    <select name="komu" class="form-control">
	    	<option value="banker">banker</option>
	    	<?php selecthracu(); ?>
	    </select>
	    <label>Částka: </label>
	    <input type="number" name="castka" min="0" placeholder="Castka" class="form-control">
	    <input type="submit" class="btn btn-default"> 
	</form>
	<h2>Projezd startem</h2>
	<form action="prevod.php">
	    <input type="hidden" name="jmeno" value="banker">
	    <input type="hidden" name="od" value="banker"><br>
	    <label>Komu: </label>
	    <select name="komu" class="form-control">
	    	<?php selecthracu(); ?>
	    </select>
	    <label>Částka: </label>
	    <input type="number" name="castka" value="200" min="0" class="form-control">
	    <input type="submit" class="btn btn-default"> 
	</form>
	
	
	<h2>Všechny transakce</h2>
	<div class="table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				<th>Od</th>
				<th>Komu</th>
				<th>Částka</th>
				<th>Zobrazeno</th>
			</thead>
			<?php vsechnytransakce($_COOKIE['hrac']);?>
		</table>
	</div>	
	<?php } else { ?>
	<h2>Všechny transakce</h2>
	<div class="table-responsive">
		<table class="table table-condensed table-hover">
			<thead>
				<th>Od</th>
				<th>Komu</th>
				<th>Částka</th>
				<th>Zobrazeno</th>
			</thead>
			<?php vsechnytransakce($_COOKIE['hrac']);?>
		</table>
	</div>
	<?php } ?>
</div>
<script src="core/js/jquery.js"></script>
<script src="core/js/bootstrap.min.js"></script>
</body>
</html>