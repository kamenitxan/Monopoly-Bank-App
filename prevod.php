<?php 
$jmeno = $_GET['jmeno'];
$title = "Převod " . $jmeno;
include("header.php");
?>
<body>
<h1>Převod</h1>
Od hráče: <?php echo $_GET['jmeno']; ?><br>
Hráči: <?php echo $_GET['komu']; ?><br>
Částka: <?php echo $_GET['castka']; ?><br>

<?php
echo prevod($_GET['od'],$_GET['komu'],$_GET['castka']);

penizehrace($jmeno);
?>

<a href="hrac.php?jmeno=<?php echo $jmeno ?>">Zpět</a>
</body>
</html>