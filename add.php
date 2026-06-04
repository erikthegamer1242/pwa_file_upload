<?php
require_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<h1>Add new image to the server</h1>";
    echo '<form enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label for="img_name" class="form-label">Image name</label>
                <input type="text" class="form-control" id="img_name" name="img_name" aria-describedby="img_name" required>
            </div>
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
            <div class="mb-3">
                <label for="img_file" class="form-label">Select image file</label>
                <input type="file" accept=".jpg,.png" class="form-control" id="img_file" name="img_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $img_name = $_POST["img_name"];
    $file = $_FILES["img_file"];
    if ($img_name == "" || !isset($file)) {
        echo "Invalid upload!";
        return;
    }
    $mime = mime_content_type($file["tmp_name"]);

    if (!isset($allowedTypes[$mime])) {
        die("Only JPG and PNG files are allowed");
    }

    $img_file_name = strtolower(str_replace(" ", "_", $img_name));

    $uploadfile = $GLOBALS['uploaddir'] . $img_file_name . "." . $allowedTypes[$mime];

    echo '<pre>';
    if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
        echo 'Here is some more debugging info:';
        print_r($_FILES);
    }
    print "</pre>";
}

require_once("footer.php");
