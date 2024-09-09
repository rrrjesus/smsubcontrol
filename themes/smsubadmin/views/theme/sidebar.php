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

                <!-- Sidebar de setores -->
                <a class="nav-link text-light collapsed fw-semibold fs-6" href="" data-bs-toggle="collapse" data-bs-target="#collapseUnits" aria-expanded="false" aria-controls="collapseUnits">
                    <div class="sb-nav-link-icon"><i class="bi bi-building bi-2xx"></i></div>
                    Unidades
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-double-down"></i></div>
                </a>
                <div class="collapse" id="collapseUnits" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionUnit">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/unidades")?>"><i class="bi bi-list bi-2xx me-2"></i> Listar</a>
                        <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/unidades/cadastrar")?>"><i class="bi bi-building-add bi-2xx me-2"></i> Cadastrar</a>
                    </nav>
                </div>

                <!-- Sidebar Patrimônio -->
                <a class="nav-link text-light collapsed fw-semibold fs-6" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePatrimonys" aria-expanded="false" aria-controls="collapsePatrimonys">
                    <div class="sb-nav-link-icon"><i class="bi bi-journal-text bi-2xx"></i></div>
                    Patrimônio
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePatrimonys" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link text-light collapsed fw-semibold fs-6" href="#" data-bs-toggle="collapse" data-bs-target="#patrimonyCollapseBrand" aria-expanded="false" aria-controls="pagesCollapseBrand">
                            Marcas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="patrimonyCollapseBrand" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionBrands">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/patrimonio/marcas/cadastrar")?>">Cadastrar</a>
                                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/patrimonio/marcas")?>">Listar</a>
                            </nav>
                        </div>
                        <a class="nav-link text-light collapsed fw-semibold fs-6" href="#" data-bs-toggle="collapse" data-bs-target="#patrimonyCollapseProduct" aria-expanded="false" aria-controls="pagesCollapseProduct">
                            Produtos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="patrimonyCollapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionProducts">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/patrimonio/produtos/cadastrar")?>">Cadastrar</a>
                                <a class="nav-link text-light fw-semibold fs-6" href="<?=url("/painel/patrimonio/produtos")?>">Listar</a>
                            </nav>
                        </div>
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
        <div class="sb-sidenav-footer text-light fw-semibold fs-6">
            <div class="sb-sidenav-menu-heading text-light fw-semibold fs-6">Logado como: <?=get_current_user();?></div>
            <div class="sb-sidenav-menu-heading text-light fw-semibold fs-6">Hostname : <?=gethostname();?></div>
        </div>
    </nav>
</div>