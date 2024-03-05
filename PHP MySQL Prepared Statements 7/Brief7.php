<?php
$true = $err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["age"]) && !empty($_POST["tél"])){
    $host = 'localhost';
    $dbname = 'datadell';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST["username"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $tel = $_POST["tél"];

        $username2 = $_POST["username2"];
        $email2 = $_POST["email2"];
        $age2 = $_POST["age2"];
        $tel2 = $_POST["tél2"];

        $stmt = $pdo->prepare("INSERT INTO user (username, email, age, tél) VALUES (:username, :email, :age, :tel)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':tel', $tel);

        $stmt->execute();

   $stmt2 = $pdo->prepare("INSERT INTO user (username, email, age, tél) VALUES (:username2, :email2, :age2, :tel2)");
        $stmt2->bindParam(':username2', $username2);
        $stmt2->bindParam(':email2', $email2);
        $stmt2->bindParam(':age2', $age2);
        $stmt2->bindParam(':tel2', $tel2);

        $stmt2->execute();

        $last_id = $pdo->lastInsertId();
        $true = "<P class='LastId' >New record created successfully. Last inserted ID is: $last_id</P>";
    } catch(PDOException $e) {
        $err = "Error: " . $e->getMessage();
    }

    $pdo = null;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new test</title>
</head>
<body>
  <h1>PHP MySQL Prepared Statements</h1>
    <form method="post">
 <div>
     <div class="design">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="email" placeholder="email">
        <input type="text" name="age" placeholder="age">
        <input type="text" name="tél" placeholder="tél">
        <?php if(!empty($true)) echo $true;?>
        <?php if(!empty($err)) echo $err;?>
        </div>
        <!-- --------------------------------------- -->
        <div class="design">
        <input type="text" name="username2" placeholder="username">
        <input type="text" name="email2" placeholder="email">
        <input type="text" name="age2" placeholder="age">
        <input type="text" name="tél2" placeholder="tél">
        <?php if(!empty($true)) echo $true;?>
        <?php if(!empty($err)) echo $err;?>  
        </div>
 </div>
        <button type="submit" class="sub">Insert prepared statements
</button>

    </form>

<style>
  body {
  position: relative;
  background-color: white;
  background-repeat: no-repeat;
  height: 100vh;
  background-color:#F1F1F1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
form div{
 width:600px;
 display: flex;
 justify-content: space-between;
 align-items: center;
 
}
form {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-direction: column;
}

.sub{
  border-radius: 10px;
  height: 50px;
  width: 210px;
  background-color:#B4D5A6;
}
.LastId{
 color: #86d7d0;
}
input {
  background-color: ;
  border-radius: 10px;
  height: 30px;
  width: 250px;
  text-align:center;
  }
  .design{
   display: flex;
   flex-direction: column;
  }
</style>
   </body>

</html>
