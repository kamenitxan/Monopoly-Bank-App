<?php 
$title = "Monopoly Bank app";
include("header.php");
?>
</head>
<body>
<h1>Monopoly Bank APP</h1>
<h2>Seznam hráčů</h2>
<?php seznamhracu(); ?>

<hr>
<h2>Reset hry</h2>
<span>žádný resety neexistujou</span>

<hr>
<h2>Vytvoření nové hry</h2>
<p>Poznámka: Aktuální hra se smaže.</p>
<form method="post" action="core/newdb.php">
	<input type="text" name="h1"/>
	<input type="text" name="h2"/>
	<input type="text" name="h3"/>
	<input type="text" name="h4"/>
	<input type="text" name="h5"/>
	<input type="text" name="h6"/>
	<input type="submit" value="Vytvořit" />
</form>
</body>
</html>