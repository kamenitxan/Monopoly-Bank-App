<?php 
$jmeno = $_GET['jmeno'];
$title = "Převod " . $jmeno;
include("header.php");
?>
</head>
<body>
<h1>Převod</h1>
Od hráče: <?php echo $_GET['od']; ?><br>
Hráči: <?php echo $_GET['komu']; ?><br>
Částka: <?php echo $_GET['castka']; ?><br><br>

<?php echo prevod($_GET['od'],$_GET['komu'],$_GET['castka']); ?>

<br><br>
<?php 
	if ($jmeno != "banker") {
		 penizehrace($jmeno);
		 echo("<a href='hrac.php?jmeno=" . $jmeno . "'>Zpět</a>");
	}
	else {
		echo("<a href='banker.php'>Zpět do banky</a>");
	}

?>

</body>
</html>