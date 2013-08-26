<?php 
$title = "Hret";
include("header.php");
?>
<body>

<?php
echo $_GET['jmeno'];
?>
<br>
<?php

$jmeno = $_GET['jmeno'];

penizehrace($jmeno);



?>

</body>
</html>