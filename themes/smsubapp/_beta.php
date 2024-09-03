<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= theme("/assets/images/favicon/apple-touch-icon.png", CONF_VIEW_APP); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= theme("/assets/images/favicon/favicon-32x32.png", CONF_VIEW_APP); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= theme("/assets/images/favicon/favicon-16x16.png", CONF_VIEW_APP); ?>">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <link rel="mask-icon" href="<?= theme("/assets/images/favicon/safari-pinned-tab.svg", CONF_VIEW_APP); ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
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
    
  <?= $this->insert("views/theme/sidebar"); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <?= $this->section("content"); ?>

      <?php if ($this->section("optout")): ?>
    <?= $this->section("optout"); ?>
    <?php else: ?>
        <!--FOOTER-->
        <?= $this->insert("views/theme/footer"); ?>
    <?php endif; ?>

    </main>

  </div>
</div>

<script src="<?= theme("/assets/scripts.js", CONF_VIEW_APP); ?>"></script>
<script src="shared/scripts/datatables/pdfmake.min.js"></script>
<?= $this->section("scripts"); ?>

</html>
