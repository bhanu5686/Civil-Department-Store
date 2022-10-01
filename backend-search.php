<?php
require 'connection.php'; 
if(isset($_REQUEST["term"])){
		$results = $con->prepare('SELECT * FROM items WHERE name LIKE ? LIMIT 5');
		$results->execute(array('%' . $_REQUEST["term"] . '%'));
		$row_counts = $results->rowCount();
            if($row_counts > 0){
                while($row = $results->fetch(PDO::FETCH_ASSOC)){
                    echo "<p>" . $row["name"] . "</p>";
                }
            } else{
             //   echo "<p>No matches found</p>";
            }
        } 
?>