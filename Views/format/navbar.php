<?php
    $url_explode = explode("/", $_SERVER["REQUEST_URI"]);
    $size_url = sizeof($url_explode);
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/crud_basado_clases/Views/Home/Home.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="<?= ($url_explode[$size_url - 1] == "spa_crud.php") ? 'btn btn-info' : 'nav-link' ?>" href="/crud_basado_clases/Views/spa_crud.php">Crud SPA</a>
        </li>
        <li class="nav-item">
          <a class="<?= ($url_explode[$size_url - 1] == "reports.php") ? 'btn btn-info' : 'nav-link' ?>" href="/crud_basado_clases/Views/reports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="<?= ($url_explode[$size_url - 1] == "charts.php") ? 'btn btn-info' : 'nav-link' ?>" href="#">Charts</a>
        </li>
        <li class="nav-item">
          <a class="<?= ($url_explode[$size_url - 1] == "import_data.php") ? 'btn btn-info' : 'nav-link' ?>" href="#">Import Data</a>
        </li>
      </ul>
    </div>
  </div>
</nav>