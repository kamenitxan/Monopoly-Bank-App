<?php 
$jmeno = $_GET['jmeno'];
$title = "Účet hráče " . $jmeno;
include("header.php");
?>

<div class="container">
	<h1>Účet hráče <?php echo $_GET['jmeno'];?></h1>
	<br>
	<?php penizehrace($jmeno); ?>
	<br>
	<form action="prevod.php">
	    <input type="hidden" name="jmeno" value="<?php echo $jmeno; ?>">
	    <input type="hidden" name="od" value="<?php echo $jmeno; ?>">
	    <label>Od: </label><span><?php echo($jmeno); ?></span><br>
	    <label>Komu: </label>
	    <select name="komu" class="form-control">
	    	<?php selecthracu(); ?>
	    </select>
	    <input type="number" name="castka" min="0" placeholder="Castka" class="form-control">
	    <input type="submit" class="btn btn-default"> 
	</form>
	<br>
	<?php novetransakce($_GET['jmeno']); ?>
</div>
<script src="core/js/jquery.js"></script>
<script src="core/js/bootstrap.min.js"></script>
</body>
</html>