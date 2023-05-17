<?php
include("connect.php");

$VendorNames = $_GET["VendorName"];


    try 
    {

        $sqlSelect = "SELECT vendors.Name AS VendorName, vendors.ID_Vendors, cars.Name AS CarName
        FROM vendors INNER JOIN cars ON vendors.ID_Vendors = cars.FID_Vendors WHERE vendors.Name=:VendorName";

        $sth = $dbh->prepare($sqlSelect);
        $sth->bindValue(":VendorName",$VendorNames);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_NUM);
        

        foreach($res as $row)
        {
            echo "<tr><td>$row[0]</td><td>$row[2]</td></tr>";
        }

    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    $dbh = null;
?>