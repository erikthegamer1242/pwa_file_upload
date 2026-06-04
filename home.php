<?php
require_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $current_page = $_GET['page'] ?? 1;
    $current_page--;
    try {
        $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM files";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $files_count = $stmt->rowCount();
        $page_counts = round($files_count / $page_cnt, 0);
        echo '<div class="container text-center image-grid p-3">';
        for ($idx = $current_page * $page_cnt; $idx < ($current_page + 1) * $page_cnt; $idx++) {
            if ($idx >= $files_count) {
                break;
            }

            $file = $files[$idx];

            echo '<div class="card m-3" style="width: 18rem;">
            <img src="' . $file['filepath'] . '"
                 class="card-img-top thumb"
                 alt="' . $file['filename'] . '"
                 height="150px"
                 width="150px"
                 style="cursor: pointer;"
                 data-bs-toggle="modal"
                 data-bs-target="#imageModal' . $file['id'] . '">

            <div class="card-body">
                <p class="card-text">' . $file['filename'] . '</p>
                <a style="font-size:80%" href="' . $doc_root . '/delete.php?id=' . $file['id'] . '" class="btn btn-danger p-1 float-end"><small>Delete image</small></a>
            </div>
        </div>

        <div class="modal fade" id="imageModal' . $file['id'] . '" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <img src="' . $file['filepath'] . '"
                             alt="' . $file['filename'] . '"
                             class="img-fluid"
                             style="object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>';
        }
        echo '</div>';
        if ($page_counts > 1) {
            echo '<ul class="pagination p-3">';
            for ($idx = 1; $idx < ($page_counts + 1); $idx++) {
                if ($idx - 1 == $current_page) {
                    echo '<li class="page-item"><a class="page-link active" href="' . $doc_root . '/home.php?page=' . $idx . '"> ' . $idx . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="' . $doc_root . '/home.php?page=' . $idx . '"> ' . $idx . '</a></li>';
                }
            }

            echo '</li>
            </ul>';
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return;
    }
}

require_once("footer.php");
