<style>
    .sb-sidenav-menu a:hover {
        background: #736D6B;
        color: #ffffff;
    }
</style>


<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-secondary" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link fw-semibold fs-6" target="_blank" href="<?=url("/")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-link-45deg bi-2xx"></i></div>
                    Ver Site
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Layouts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div>

                    
                <a class="nav-link fw-semibold fs-6" target="_blank" href="<?=url("/aplicativo")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-mouse2 bi-2xx"></i></div>
                    Ver Aplicativo
                </a>
                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/controle")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-speedometer bi-2xx"></i></div>
                    Monitoramento
                </a>
                <div class="sb-sidenav-menu-heading fw-semibold fs-6">CADASTROS</div>

                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/colaboradores")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Colaboradores
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-right"></i></div>
                </a>                
                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/igrejas")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-building bi-2xx"></i></div>
                    Igrejas
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-right"></i></div>
                </a>
                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/grupos")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-people bi-2xx"></i></div>
                    Grupos
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-right"></i></div>
                </a>

                <div class="sb-sidenav-menu-heading fw-semibold fs-6">FERRAMENTAS</div>

                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/usuarios")?>">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Usuários
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-right"></i></div>
                </a>

                <a class="nav-link fw-semibold fs-6" href="<?=url("/painel/logoff")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" 
                    data-bs-title="Clique para sair do sistema" data-bs-toggle="modal" data-bs-target="#modalSair"><div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Sair
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-right"></i></div>
                </a>

                <?= $this->insert("views/modalSystem"); ?>

                <!-- <a class="nav-link collapsed fw-semibold fs-6" href="" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="bi bi-person bi-2xx"></i></div>
                    Usuários
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-down"></i></div>
                </a>
                <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionUser">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link fw-semibold fs-6" href=""><i class="bi bi-list bi-2xx me-2"></i> Usuários</a>
                        <a class="nav-link fw-semibold fs-6" href=""><i class="bi bi-person-add bi-2xx me-2"></i> Novo Usuário</a>
                    </nav>
                </div>-->
            </div>
        </div>
        <div class="sb-sidenav-footer fw-semibold">
            <div class="small">Logado como:</div>
            <?=(new \Source\Models\Auth())->user()->first_name?>
        </div>
    </nav>
</div>