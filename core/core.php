<?php
function vytvordb(){
    $dbname='Bank.db';
    if(!class_exists('SQLite3'))
      die("SQLite 3 NOT supported.");
 
    $base=new SQLite3($dbname, 0666);
    echo "SQLite 3 supported."; 
    

    $dbname='Bank.db';
    $mytable ="ucty";
 
    if(!class_exists('SQLite3'))
       die("SQLite 3 NOT supported.");
 
    $base=new SQLite3($dbname, 0666); 
 
    $query = "CREATE TABLE $mytable(
                ID bigint(20) NOT NULL PRIMARY KEY,
                jmeno text,
                penize bigint          
                )";
    $results = $base->exec($query);
}


function seznamhracu() {
    try {
        $conn = new PDO('sqlite:core/Bank.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
     
    $stmt = $conn->prepare('SELECT * FROM ucty');
    $stmt->execute(array());
 
    # Get array containing all of the result rows
    $result = $stmt->fetchAll(); 
    # If one or more rows were returned...
    if ( count($result) ) {
        foreach($result as $row) {
            echo "ID: " . $row[0];
            echo " Hráč: " . $row[1] . "<br>";
        }
    } else {
        echo "Hrac " . $jmeno . " nenalezen";
    }
    
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}

function penizehrace($jmeno) {
    try {
        $conn = new PDO('sqlite:core/Bank.db');
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

}

?>

