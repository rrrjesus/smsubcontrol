<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-smsub">
    <div class="offcanvas-md offcanvas-end bg-smsub" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header bg-smsub text-white">
            <h5 class="offcanvas-title" id="sidebarMenuLabel"><img width="130" height="40" src="<?=theme("/assets/images/smsub_logo/SUBPREFEITURAS_HORIZONTAL_FUNDO_ESCURO.png")?>"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <a href="<?=url("/beta/perfil")?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <?php if (user()->photo()): ?>
                <img class="rounded-circle m-2" width="32" height="32" alt="<?= user()->first_name; ?>" title="<?= user()->first_name; ?>"
                        src="<?= image(user()->photo, 260, 260); ?>"/>
            <?php else: ?>
                <img class="rounded-circle m-2" width="32" height="32" alt="<?= user()->first_name; ?>" title="<?= user()->first_name; ?>"
                        src="<?= theme("/assets/images/avatar.jpg", CONF_VIEW_APP); ?>"/>
            <?php endif; ?>
            <span class="fw-semibold fs-6"><?= user()->first_name; ?></span><?=user()->levelBadge()?>
            </a>
            <hr>
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2" aria-current="page" href="<?=url("/beta")?>">
                    <i class="bi bi-house-fill mb-2"></i>
                    Início
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2" aria-current="page" href="<?=url("/")?>">
                    <i class="bi bi-globe mb-2"></i>
                    Ver Site
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover"
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/patrimonio/bens/lista")?>">
                <i class="bi bi-card-heading mb-2"></i>
                Patrimonio/Bens
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover"
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/patrimonio/marcas/lista")?>">
                <i class="bi bi-card-heading mb-2"></i>
                Patrimonio/Marcas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover"
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/patrimonio/modelos/lista")?>">
                <i class="bi bi-card-heading mb-2"></i>
                Patrimonio/Modelos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover"
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/patrimonio/historicos/lista")?>">
                <i class="bi bi-card-heading mb-2"></i>
                Patrimonio/Historico
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover" 
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/contatos")?>">
                <i class="bi bi-card-checklist mb-2"></i>
                Agenda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 icon-link icon-link-hover" 
                style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="<?=url("/beta/perfil")?>">
                <i class="bi bi-person mb-2"></i>
                Perfil
                </a>
            </li>
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link link-light d-flex align-items-center fs-6 gap-2 mb-4 icon-link icon-link-hover" href="<?=url("/beta/logoff")?>">
                <i class="bi bi-door-closed mb-2"></i>
                Sair
                </a>
            </li>
            </ul>
        </div>
    </div>
</div>
