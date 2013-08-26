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
    <input type="text" name="od" placeholder="Od">
    <input type="text" name="komu" placeholder="Komu">
    <input type="text" name="castka" placeholder="Castka">
    <input type="submit"> 
</form>

</body>
</html>