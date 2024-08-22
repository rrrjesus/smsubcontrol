<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.ico", CONF_VIEW_APP); ?>"/>

    <link rel="stylesheet" href="<?= theme("/assets/style.css", CONF_VIEW_APP); ?>"/>

</head>
<body>

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>

    <?= $this->insert("views/theme/color-theme"); ?>

<header class="navbar sticky-top bg-smsub flex-md-nowrap p-0 shadow">

 <!-- Navbar-->
<?= $this->insert("views/theme/navbar"); ?>

</header>

<div class="container-fluid">
  <div class="row">
    
  <?= $this->insert("views/sidebar"); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <?= $this->section("content"); ?>

    </main>

    <?php if ($this->section("optout")): ?>
    <?= $this->section("optout"); ?>
    <?php else: ?>
        <div class="row justify-content-center text-center mt-5 mb-5">
            <div class="col-md-4">
                <i class="bi bi-book-half display-1 text-<?=CONF_WEB_COLOR;?>"></i>
                <p class="fw-bolder fs-3">Comece a utilizar a agenda inteligente agora mesmo</p>
                <p class="fs-5">É rápida, simples e funcional!</p>
            </div>
        </div>
    <?php endif; ?>

    <!--FOOTER-->
    <?= $this->insert("views/theme/footer"); ?>
  </div>
</div>

<script src="<?= theme("/assets/scripts.js", CONF_VIEW_APP); ?>"></script>
<?= $this->section("scripts"); ?>

</html>
