<?php 
$title = "Banka";
include("header.php");
?>


<div class="container">
	<h1>Bankéř</h1>
		
	<h2>Běžný převod</h2>
	<form action="prevod.php">
	    <input type="hidden" name="jmeno" value="banker">
	    <label>Od: </label>
	    <select name="od">
	    	<option value="banker">banker</option>
	    	<?php selecthracu(); ?>
	    </select><br>
	    <label>Komu: </label>
	    <select name="komu">
	    	<option value="banker">banker</option>
	    	<?php selecthracu(); ?>
	    </select><br>
	    <input type="number" name="castka" min="0" placeholder="Castka">
	    <input type="submit"> 
	</form>
	<h2>Projezd startem</h2>
	<form action="prevod.php">
	    <input type="hidden" name="jmeno" value="banker">
	    <input type="hidden" name="od" value="banker"><br>
	    <label>Komu: </label>
	    <select name="komu">
	    	<?php selecthracu(); ?>
	    </select><br>
	    <input type="number" name="castka" value="200" min="0">
	    <input type="submit"> 
	</form>
</div>
<script src="core/js/jquery.js"></script>
<script src="core/js/bootstrap.min.js"></script>
</body>
</html>