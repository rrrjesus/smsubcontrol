<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2024-06-12T12:58:07-03:00+197772">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <script src="shared/scripts/color-modes.js"></script>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>"/>
    <link rel="stylesheet" href="shared/styles/bootstrap.min.css"/>
    <link rel="stylesheet" href="shared/styles/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="shared/styles/docs.min.css">
    <link rel="stylesheet" href="shared/styles/boot.css"/>
    <link rel="stylesheet" href="shared/styles/typeahead.css"/>
    <link rel="stylesheet" href="<?=theme("/assets/css/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<header class="navbar navbar-expand-lg bd-navbar sticky-top">
  <!-- Navbar-->
  <?= $this->insert("views/theme/navbar"); ?>
</header>

<!--CONTENT-->
<main class="container-sm" style="padding-right: 0;padding-left: 0">
    <?= $this->section("content"); ?>
</main>

<?php if ($this->section("optout")): ?>
    <?= $this->section("optout"); ?>
<?php else: ?>

        <div class="row justify-content-center text-center mt-5 mb-5">
            <div class="col-md-4">
                <i class="bi bi-book-half display-1 text-smsub"></i>
                <p class="fw-bolder fs-3">Comece a utilizar a agenda inteligente agora mesmo</p>
                <p class="fs-5">É rápida, simples e funcional!</p>
            </div>
        </div>
<?php endif; ?>

<!--FOOTER-->
<?= $this->insert("views/theme/footer"); ?>

<script src="shared/scripts/bootstrap.bundle.min.js"></script>
<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<script src="shared/scripts/jquery.validate.min.js"></script>
<script src="shared/scripts/typeahead.bundle.js"></script>
<script src="<?= theme("assets/js/scripts.js")?>"></script>
<script src="<?= theme("assets/js/card_email.js")?>"></script>
<?= $this->section("scripts"); ?>

</body>
</html>