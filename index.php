<!-- "Варіант 6" -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent</title>
    <script>
        let ajax = new XMLHttpRequest();
        function RentOfDate() 
    {
        let CostOfRent = document.getElementById("CostOfRent").value;
        ajax.onreadystatechange = load1;
        ajax.open("GET","RentOfDate.php?CostOfRent=" + CostOfRent);
        ajax.send();
    }
    function load1() 
    {
        if (ajax.readyState === 4) 
        {
            if (ajax.status === 200) 
            console.log(ajax);
            document.getElementById("res1").innerHTML = ajax.response;
            
         }
    }
    </script>
    <script>
        let ajax1 = new XMLHttpRequest();
        function Vendorcars() 
        {
            let VendorName = document.getElementById("VendorName").value;
            
            ajax1.onreadystatechange = load2();
            ajax1.open("GET","Vendorcars.php?VendorName=" + VendorName);
            ajax1.send();
        }
        function load2()
        {
            if(ajax1.readyState === 4)
            {   if(ajax1.status === 200)
                console.log(ajax1);
                document.getElementById("res2").innerHTML = ajax1.response;
            }
            
        }
    </script>
    <script>
        let ajax2 = new XMLHttpRequest();
        function FreeCars() 
        {
            let FreeCars = document.getElementById("FreeCars").value;
            
            ajax2.onreadystatechange = load3();
            ajax2.open("GET","FreeCars.php?FreeCars=" + FreeCars);
            ajax2.send();
        }
        function load3()
        {
            if(ajax2.readyState === 4)
            {   if(ajax2.status === 200)
                console.log(ajax2);
                document.getElementById("res3").innerHTML = ajax2.response;
            }
            
        }
    </script>
</head>
<body>
    <h2>Отриманий дохід з прокату станом на обрану дату</h2>
        <select name="CostOfRent" id="CostOfRent">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT Date_end FROM rent") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
    <input type="button" value="Результат" onclick="RentOfDate()">
    <table border = '1'>
    <thead><tr><th>Start day rent</th><th>Last day rent</th><th>Cost</th></tr></thead>
    <tbody id= "res1"></tbody>
    </table>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------->
   
    <h2>Автомобілі обраного виробника</h2>
        <select name="VendorName" id="VendorName">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT Name FROM vendors") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
    <input type="button" value="Результат" onclick="Vendorcars()">
    <table border = '1'>
    <thead><tr><th>Vendor</th><th>Car name</th></tr></thead>
    <tbody id= "res2"></tbody>
    </table>

<!---------------------------------------------------------------------------------------------------------------------------->

<h2>Вільні автомобілі на обрану дату</h2>
        <select name="FreeCars" id="FreeCars">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT Date_start FROM rent") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
    <input type="button" value="Результат" onclick="FreeCars()">
    <table border = '1'>
    <thead><tr><th>ID_Cars</th><th>Name</th></tr></thead>
    <tbody id= "res3"></tbody>

</body>
</html>