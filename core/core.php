<?php
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
            echo "" . $row[0];
            echo " Hráč: <a href='hrac.php?jmeno=" . $row[1] . "' onclick=SetCookie('hrac','" . $row[1] . "','1')>" . $row[1] . "</a><br>";
        }
    } else {
        echo "Hrac " . $jmeno . " nenalezen";
    }
    
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
function prvnihrac() {
    try {
        $conn = new PDO('sqlite:core/Bank.db');
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	     
	    $stmt = $conn->prepare('SELECT jmeno FROM ucty ORDER BY ID LIMIT 1');
	    $stmt->execute(array());
	 
	    # Get array containing all of the result rows
	    $result = $stmt->fetchAll(); 
	    # If one or more rows were returned...
	    if ( count($result) ) {
	        foreach($result as $row) {
	            return $row[0];
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
function prevod($od, $komu, $castka, $pujcka) {
     try {   
        $conn = new PDO('sqlite:core/Bank.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //zjistí peníze na účtu
        $stmt = $conn->prepare('SELECT penize, dluh FROM ucty WHERE jmeno = :jmeno');
        $stmt->execute(array('jmeno' => $komu)); 
        $zustatek_prijemce = $stmt->fetch();
        
        if ($pujcka >= 10) {
        	
        	$castka = $zustatek_prijemce[0] + $pujcka;
        	$dluh = $zustatek_prijemce[1] + $pujcka + $pujcka*0.1;
        	$stmt = $conn->prepare('UPDATE ucty SET penize = :castka, dluh = :dluh WHERE jmeno = :jmeno');
        	$stmt->execute(array(
        	    ':castka' => $castka,
        	    ':dluh'   => $dluh,
        	    ':jmeno'  => $komu
        	));
        	
        	$stmt = $conn->prepare('INSERT INTO log VALUES(null, :od, :komu, :castka, :zobrazeno)');
        	$stmt->execute(array(
        	    ':castka'    => $pujcka,
        	    ':od' 		 => 'Půjčka',
        	    ':komu'		 => $komu,
        	    ':zobrazeno' => 'false'
        	));
        } else {
        	$stmt->execute(array('jmeno' => $od));
        	$result = $stmt->fetch();
	        if ($od == "banker") {
	        	$result[0]=9999999999;
	        } 
	        
	        if ($result[0] >= $castka) {
	             //odešle peníze             
	            $zustatek = $zustatek_prijemce[0] + $castka;
	            $stmt = $conn->prepare('UPDATE ucty SET penize = :castka WHERE jmeno = :jmeno');
	            $stmt->execute(array(
	                ':castka' => $zustatek,
	                ':jmeno'  => $komu
	            ));
	            //odečtě peníze
	            if ($od != "banker") {
	            	$zustatek = $result[0] - $castka;
	            	$stmt->execute(array(
	            	    ':castka' => $zustatek,
	            	    ':jmeno'  => $od
	            	));
	            }
	            
	            $stmt = $conn->prepare('INSERT INTO log VALUES(null, :od, :komu, :castka, :zobrazeno)');
	            $stmt->execute(array(
	                ':castka'    => $castka,
	                ':od' 		 => $od,
	                ':komu'		 => $komu,
	                ':zobrazeno' => 'false'
	            ));
	                    
	        echo "<div class='alert alert-success'>Převod proběhl úspěšně.</div>";
	        } else {
	            echo "<div class='alert alert-danger'>Nemáte dost peněz na účtě. Převod nebyl úspěšný.</div>";
	        }
	    }  
     } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
     }
}
function dluh($jmeno) {
	try {
	       $conn = new PDO('sqlite:core/Bank.db');
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    
	       $stmt = $conn->prepare('SELECT dluh FROM ucty WHERE jmeno = :jmeno');
	       $stmt->execute(array('jmeno' => $jmeno));
	
	       $result = $stmt->fetch(); 
	       return $result[0];
	   
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	       return $e->getMessage();
	   }
	
}
function dluznici() {
	try {
	       $conn = new PDO('sqlite:core/Bank.db');
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    
	       $stmt = $conn->prepare('SELECT jmeno, dluh FROM ucty');
	       $stmt->execute(array());
	
	       $result = $stmt->fetchAll(); 
	       foreach($result as $row) {
	       			if ($row[1] > 0) {
	       				echo("<tr><td>$row[0]</td><td>$row[1]kč</td></tr>");
	       			}
	       			
	       }
	   
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	       return $e->getMessage();
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
	           		if ($row[0] != "") {
	           			echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
	           		}           
	           }
	       } else {
	           echo "<option>Žádný hráč nenalezen</option>";
	       }
	   
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	   }
}
function novetransakce($komu) {
		try {
			$conn = new PDO('sqlite:core/Bank.db');
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    
	       $stmt = $conn->prepare('SELECT * FROM log WHERE komu = :komu AND zobrazeno = "false"');
	       $stmt->execute(array(
	       		':komu' => $komu
	       ));
	
	       # Get array containing all of the result rows
	       $result = $stmt->fetchAll(); 
	       # If one or more rows were returned...
	       if ( count($result) ) {
	           foreach($result as $row) {
	           			echo("<div class='alert alert-info'>" . 
	           				"Nová transakce od hráče $row[1]. Na účet bylo připsáno $row[3] korun </div>");
	           }
	       }
	       
	       $stmt = $conn->prepare('UPDATE log SET zobrazeno = :stav WHERE komu = :komu');
	       $stmt->execute(array(
	           ':komu' => $komu,
	           ':stav' => "true"
 	       ));
 	    
	   
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	   }
}
function vsechnytransakce($jmeno) {
	try {
			$conn = new PDO('sqlite:core/Bank.db');
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    
	       if ($jmeno == prvnihrac()) {
	       		$stmt = $conn->prepare('SELECT * FROM log ORDER BY ID DESC');
	       		$stmt->execute(array());
	       } else {
	       		$stmt = $conn->prepare('SELECT * FROM log WHERE komu = :jmeno ORDER BY ID DESC');
	       		$stmt->execute(array(
	       				':jmeno' => $jmeno
	       		));
	       }
	       # Get array containing all of the result rows
	       $result = $stmt->fetchAll(); 
	       # If one or more rows were returned...
	       if ( count($result) ) {
	           foreach($result as $row) {
	           			echo("<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]kč</td><td>$row[4] </td></tr>");
	           }
	       }
	   } catch(PDOException $e) {
	       echo 'ERROR: ' . $e->getMessage();
	   }
}