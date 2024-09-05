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

    <ul class="list-unstyled ps-0">
      <li class="mb-1">

        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Dashboard
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Overview</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Weekly</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Monthly</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Dashboard
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Overview</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Weekly</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Monthly</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Orders
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">New</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Processed</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Shipped</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Returned</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Account
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">New...</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Profile</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Settings</a></li>
            <li><a href="#" class="link-body-emphasis text-light d-inline-flex text-decoration-none rounded">Sign out</a></li>
          </ul>
        </div>
      </li>
    </ul>


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
