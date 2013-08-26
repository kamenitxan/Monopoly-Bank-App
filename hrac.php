<html>
<body>

<?php
echo $_GET['jmeno'];
?>
<br>
<?php

$jmeno = $_GET['jmeno'];;
try {
    $conn = new PDO('sqlite:Bank.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
     
    $stmt = $conn->prepare('SELECT penize FROM ucty WHERE jmeno = :jmeno');
    $stmt->execute(array('jmeno' => $jmeno));
 
    # Get array containing all of the result rows
    $result = $stmt->fetchAll(); 
    # If one or more rows were returned...
    if ( count($result) ) {
        foreach($result as $row) {
            echo "Hodnota na uctu: " . $row[0];
        }
    } else {
        echo "Hrac " . $jmeno . " nenalezen";
    }
    
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>

</body>
</html>