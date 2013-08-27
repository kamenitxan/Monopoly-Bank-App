<?php 
$jmeno = $_GET['jmeno'];
$title = "Účet hráče " . $jmeno;
include("header.php");
?>
<body>

<?php
echo $_GET['jmeno'];
?>
<br>
<?php

penizehrace($jmeno);

?>
<form action="prevod.php">
    <input type="hidden" name="jmeno" value="<?php echo $jmeno; ?>">
    <label>Od: </label><span><?php echo($jmeno); ?></span><br>
    <label>Komu: </label>
    <select name="komu">
    	<?php selecthracu(); ?>
    </select><br>
    <input type="number" name="castka" min="0" placeholder="Castka">
    <input type="submit"> 
</form>

</body>
</html>