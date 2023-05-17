<?php
include("connect.php");
$CostOfRent = $_GET["CostOfRent"];

    try 
    {

        $sqlSelect = "SELECT Date_start, Date_end, Cost FROM rent WHERE Date_end =:CostOfRent";
       
        $sth = $dbh->prepare($sqlSelect);
        $sth->bindValue(":CostOfRent",$CostOfRent);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_NUM);
        
        
        foreach($res as $row)
        {
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
        }
    
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    $dbh = null;
?>