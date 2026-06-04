<?php
require_once("header.php");

$id = $_GET['id'] ?? NULL;

if ($id == NULL || $id <= 0) {
    echo "Invalid delete!";
    return;
}

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 0) {
        echo "Invalid id!";
        return;
    }

    $filepath = $file['filepath'];

    if (!unlink($filepath)) {
        die("Error deleting: $filepath");
    }

    $sql = "DELETE FROM files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);



} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}

require_once("footer.php");
