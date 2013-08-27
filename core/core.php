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
            echo " Hráč: <a href='hrac.php?jmeno=" . $row[1] . "'>" . $row[1] . "</a><br>";
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
                echo "Stav uctu: " . $row[0];
            }
        } else {
            echo "Hrac " . $jmeno . " nenalezen";
        }
    
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return $e->getMessage();
    }

}
function prevod($od, $komu, $castka) {
     try {   
        $conn = new PDO('sqlite:core/Bank.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //zjistí jestli má dost peněz na převod
        $stmt = $conn->prepare('SELECT penize FROM ucty WHERE jmeno = :jmeno');
        $stmt->execute(array('jmeno' => $od));
        
        $result = $stmt->fetch(); 
        
        if ($result[0] >= $castka) {
             //odešle peníze             
            $stmt->execute(array('jmeno' => $komu)); 
            $zustatek_prijemce = $stmt->fetch();
            $zustatek = $zustatek_prijemce[0] + $castka;
            $stmt = $conn->prepare('UPDATE ucty SET penize = :castka WHERE jmeno = :jmeno');
            $stmt->execute(array(
                ':castka'   => $zustatek,
                ':jmeno' => $komu
            ));
            //odečtě peníze
            $zustatek = $result[0] - $castka;
            $stmt->execute(array(
                ':castka'   => $zustatek,
                ':jmeno' => $od
            ));
        echo "Převod proběhl úspěšně.";
        } else {
            echo "Nemáte dost peněz na účtě. Převod nebyl úspěšný.";
        }
       
      } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
      }
}
function selecthracu() {
	try {
	       $conn = new PDO('sqlite:core/Bank.db');
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    
	       $stmt = $conn->prepare('SELECT jmeno FROM ucty');
	       $stmt->execute(array());
	
	       # Get array containing all of the result rows
	       $result = $stmt->fetchAll(); 
	       # If one or more rows were returned...
	       if ( count($result) ) {
	           foreach($result as $row) {
	               echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	           }
	       } else {
	           echo "<option>Žádný hráč nenalezen</option>";
	       }
	   
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	   }
}