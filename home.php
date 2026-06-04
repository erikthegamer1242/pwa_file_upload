<?php
require_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM files";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container text-center p-3">
  <div class="row">';
        foreach ($files as $file) {
            echo '<div class="col">';
            echo '<div class="card" style="width: 18rem;">
                    <img src="' . $file['filepath'] . '" class="card-img-top" alt="' . $file['filename'] . '" height="300px" width="300px">
                    <div class="card-body">
                        <p class="card-text">' . $file['filename'] . '</p>
                        <a style="font-size:80%" href="' . $doc_root . '/delete.php?id=' . $file['id'] . '" class="btn btn-danger p-1 float-end"><small>Delete image</small></a>
                    </div>';
            echo '</div>';
        }
        echo '</div>';
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return;
    }
}

require_once("footer.php");
