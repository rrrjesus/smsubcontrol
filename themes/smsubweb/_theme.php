<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2024-06-12T12:58:07-03:00+197772">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <!-- <script src="shared/scripts/color-modes.js"></script> -->

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>"/>

    <!-- <link rel="stylesheet" href="shared/styles/boot.css"/>
    <link rel="stylesheet" href="shared/styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="shared/styles/docs.min.css"> -->
    <link rel="stylesheet" href="<?=theme("/assets/style.css"); ?>"/>
    <!-- <link rel="stylesheet" href="shared/styles/datatables/dataTables.bootstrap5.css"/>
    <link rel="stylesheet" href="shared/styles/datatables/buttons.bootstrap5.min.css"/>
    <link rel="stylesheet" href="shared/styles/datatables/responsive.bootstrap5.min.css"/>
    <link rel="stylesheet" href="shared/styles/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="shared/styles/typeahead.css"/> -->
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<header class="navbar navbar-expand-lg bd-navbar-<?=color_month()?> sticky-top">
  <!-- Navbar-->
  <?= $this->insert("views/theme/navbar"); ?>
</header>

<!--CONTENT-->
<main class="container-sm">

<div class="col-12 ml-auto"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <?= $this->section("content"); ?>
</div>

</main>

<?php if ($this->section("optout")): ?>
    <?= $this->section("optout"); ?>
<?php else: ?>
    <div class="row justify-content-center text-center mt-5 mb-5">
        <div class="col-4">
            <p class="fw-bolder fs-3">Comece a utilizar o SmsubControl agora mesmo</p>
            <p class="fs-5">É rápido, simples e funcional!</p>
        </div>
    </div>
<?php endif; ?>

<!--FOOTER-->
<?= $this->insert("views/theme/footer"); ?>

<!-- <script src="shared/scripts/bootstrap/bootstrap.bundle.min.js"></script>
<script src="shared/scripts/bootstrap/color-modes.js"></script> -->

<!-- Bibliotecas Javascript Jquery do Sistema -->
<!-- <script src="shared/scripts/jquery/jquery.min.js"></script>
<script src="shared/scripts/jquery/jquery.form.js"></script>
<script src="shared/scripts/jquery/jquery-ui.min.js"></script>
<script src="shared/scripts/jquery/jquery.mask.js"></script>
<script src="shared/scripts/highcharts.js"></script>
<script src="shared/scripts/jquery/jquery.validate.min.js"></script>
<script src="shared/scripts/typeahead.bundle.js"></script> -->

<!-- Bibliotecas Javascript Datatables -->
<!-- <script src="shared/scripts/datatables/dataTables.js"></script>
<script src="shared/scripts/datatables/dataTables.bootstrap5.js"></script> -->

<!-- Bibliotecas Javascript Datatables Extensões (Botões, PDF, Fonts, Html, Print, Responsivo e Excel)-->
<!-- <script src="shared/scripts/datatables/dataTables.buttons.js"></script>
<script src="shared/scripts/datatables/buttons.bootstrap5.js"></script>
<script src="shared/scripts/datatables/pdfmake.min.js"></script>
<script src="shared/scripts/datatables/vfs_fonts.js"></script>
<script src="shared/scripts/datatables/buttons.html5.min.js"></script>
<script src="shared/scripts/datatables/buttons.print.min.js"></script>
<script src="shared/scripts/datatables/buttons.colVis.min.js"></script>
<script src="shared/scripts/datatables/dataTables.responsive.js"></script>
<script src="shared/scripts/datatables/responsive.bootstrap5.js"></script> -->

<!-- Javascript do Tema -->
<script src="<?= theme("assets/scripts.js")?>"></script>
<?= $this->section("scripts"); ?>

</body>
</html>