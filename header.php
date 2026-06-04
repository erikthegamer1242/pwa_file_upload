<?php
require_once("env.php");
$active = $_SERVER["REQUEST_URI"];

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadatak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<style>
.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(18rem, 1fr));
    gap: 1rem;
}

.image-grid .card {
    width: 100%;
}

.image-grid img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
foreach ($GLOBALS['links'] as $link) {
    $expaned_link = "$doc_root/$link.php";
    echo '<li class="nav-item">';
    if ($expaned_link == $active) {
        echo '<a class="nav-link active" aria-current="page" href="' . $expaned_link . '">'. ucfirst(strtolower($link)) .'</a>';
    } else {
        echo '<a class="nav-link" aria-current="page" href="' . $expaned_link . '">'. ucfirst(strtolower($link)) .'</a>';
    }
    echo '</li>';
}
echo  '</ul>
    </div>
  </div>
</nav>
<main class="container-sm">

';
