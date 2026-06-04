<?php
require_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * AS country FROM files";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $country = $user["country"];
            echo $user['ime'] . " " . $user['prezime'] . "($country)" ;
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return;
    }
}

require_once("footer.php");
?>