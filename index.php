<?php 
$title = "Monopoly Bank app";
include("header.php");
?>

<div class="container">
	<h1>Monopoly Bank APP</h1>
	<h2>Seznam hráčů</h2>
	<?php seznamhracu(); ?>
	
	<!--<hr>
	<h2>Reset hry</h2>
	<span>žádný resety neexistujou</span>-->
	
	<hr>
	<h2>Vytvoření nové hry</h2>
	<p>První hráč je bankéř.</p>
	<div class="alert alert-danger">Aktuální hra se smaže.</div>
	<form method="post" action="core/newdb.php" class="form-inline">
		<input type="text" name="h1" class="form-control"/>
		<input type="text" name="h2" class="form-control"/>
		<input type="text" name="h3" class="form-control"/>
		<input type="text" name="h4" class="form-control"/>
		<input type="text" name="h5" class="form-control"/>
		<input type="text" name="h6" class="form-control"/>
		<input type="submit" value="Vytvořit" class="btn btn-default"/>
	</form>
</div>
<script src="core/js/jquery.js"></script>
<script src="core/js/bootstrap.min.js"></script>
<script>
	function SetCookie(c_name,value,expiredays)
		{
			var exdate=new Date()
			exdate.setDate(exdate.getDate()+expiredays)
			document.cookie=c_name+ "=" +escape(value)+
			((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
		}
</script>
</body>
</html>