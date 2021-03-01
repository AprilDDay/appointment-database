<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Upload Dental Reports</title>
</head>
<body>
    <?php
    $dbh = new PDO("mysql:host=localhost; dbname=dental_mulcahy", "root", "");
    if(isset($_POST['btn'])){
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $dateRecd = $_FILES['dateRecd'];  
        $clientIden = $_FILES['clientIden'];
        $specialistIden = $_FILES['specialistIden'];
        $referralIden = $_FILES['referralIden'];

        $stmt = $dbh->prepare("insert into dentalreportsreceived values('',?,?,?,?,?,?,?)");
       /* $stmt = $dbh->prepare("insert into dentalreportsreceived values('',?,?,?)");*/
        $stmt->bindParam(1,$name);
        $stmt->bindParam(2,$type);
        $stmt->bindParam(3,$data);
        $stmt->bindParam(4,$dateRecd);
        $stmt->bindParam(5,$clientIden);
        $stmt->bindParam(6,$specialistIden);
        $stmt->bindParam(7,$referralIden);
        $stmt->execute();
    }

    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"/></br>

        <label for ="dateRecd">Date:</label><input type="date" name="dateRecd"/></br>
        <label for="clientIden"> Client Identification number:</label><input type ="number" name="clientIden"/></br>
        <label for = "specialistIden"> Specialist Identification number:</label><input type = "number" name = "specialistIden"/></br>
        <label for = "referralIden">Referral Identification number:</label><input type="number" name = "referralIden"/></br>
         <button name="btn">upload</button>
    </form>
    

    <p></p>
    <ol>
    <?php
    $stat = $dbh->prepare("select * from dentalreportsreceived");
    $stat->execute();
    while($row = $stat->fetch()){
        echo "<li><a target='_blank' href='view.php?id=".$row['id']."'>".$row['nameOfRep']."</a></li>";
    }
    ?>
    </ol>

</body>
</html>