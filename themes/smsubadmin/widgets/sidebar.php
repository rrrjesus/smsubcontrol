<style>
    .sb-sidenav-menu a:hover {
        background: #424242;
        color: #ffffff;
    }
</style>


<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-light fw-semibold fs-6">SISTEMA</div>

                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/controle")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-speedometer bi-2xx"></i></div>
                    Monitoramento
                </a>

                <a class="nav-link text-light fw-semibold fs-6" target="_blank" rel="noopener" href="<?=url("/")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-link-45deg bi-2xx"></i></div>
                    Ver Site
                </a>
                    
                <a class="nav-link text-light fw-semibold fs-6" target="_blank" rel="noopener" href="<?=url("/beta")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-link-45deg bi-2xx"></i></div>
                    Ver Aplicativo
                </a>

                <div class="sb-sidenav-menu-heading text-light fw-semibold fs-6">CADASTROS</div>

                <!-- Sidebar de usuários -->
                <a class="nav-link text-light collapsed fw-semibold fs-6" href="" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Usuários
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionUser">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/usuarios")?>"><i class="bi bi-list bi-2xx me-2"></i> Listar</a>
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/usuarios/cadastrar")?>"><i class="bi bi-person-add bi-2xx me-2"></i> Cadastrar</a>
                    </nav>
                </div>

                <!-- Sidebar de Marcas -->
                <a class="nav-link text-light collapsed fw-semibold fs-6" href="" data-bs-toggle="collapse" data-bs-target="#collapseMarcas" aria-expanded="false" aria-controls="collapseMarcas">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Marcas
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-down"></i></div>
                </a>
                <div class="collapse" id="collapseMarcas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionMarcas">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/marcas")?>"><i class="bi bi-list bi-2xx me-2"></i> Listar</a>
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/marcas/cadastrar")?>"><i class="bi bi-person-add bi-2xx me-2"></i> Cadastrar</a>
                    </nav>
                </div>

                <!-- Sidebar de Modelos -->
                <a class="nav-link text-light collapsed fw-semibold fs-6" href="" data-bs-toggle="collapse" data-bs-target="#collapseModelos" aria-expanded="false" aria-controls="collapseModelos">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Modelos
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-down"></i></div>
                </a>
                <div class="collapse" id="collapseModelos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionModelos">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/modelos")?>"><i class="bi bi-list bi-2xx me-2"></i> Listar</a>
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/modelos/cadastrar")?>"><i class="bi bi-person-add bi-2xx me-2"></i> Cadastrar</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading text-light fw-semibold fs-6">UTILIDADES</div>

                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/logoff")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" 
                    data-bs-title="Clique para sair do sistema" data-bs-toggle="modal" data-bs-target="#modalSair">
                    <div class="sb-nav-link-icon"><i class="bi bi-link-45deg bi-2xx"></i></div>
                    Sair
                </a>

                <?= $this->insert("views/modalSystem"); ?>


            </div>
        </div>
        <div class="sb-sidenav-footer fw-semibold">
            <div class="small">Logado como:</div>
            <?=(new \Source\Models\Auth())->user()->first_name?>
        </div>
    </nav>
</div>