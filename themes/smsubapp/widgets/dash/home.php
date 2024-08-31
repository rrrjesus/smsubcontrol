<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>

<div class="col-xl-12">
    <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - INÍCIO</div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="col-12">

                        <div class="card border-<?=CONF_APP_COLOR?> mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-<?=CONF_APP_COLOR?> text-<?=CONF_APP_COLOR?>"><h5 class="card-title"><i class="bi bi-card-heading mb-2 fs-4 me-2"></i> Contratos</h5></div>
                                <div class="card-body text-<?=CONF_APP_COLOR?>">
                                    <p class="card-text"><strong>Em Vigência</strong> : 50</p>
                                    <p class="card-text"><strong>Finalizados</strong> : 23</p>
                                    <p class="card-text"><strong>Total</strong> : 73</p>
                                </div>
                            <!-- <div class="card-footer bg-transparent">Footer</div> -->
                        </div>
                        
                        <div class="card border-<?=CONF_APP_COLOR?> mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-transparent border-<?=CONF_APP_COLOR?> text-<?=CONF_APP_COLOR?>"><h5 class="card-title"><i class="bi bi-card-heading mb-2 fs-4 me-2"></i> Bens Móveis</h5></div>
                                <div class="card-body text-<?=CONF_APP_COLOR?>">
                                    <p class="card-text"><strong>Ativos</strong> : 50</p>
                                    <p class="card-text"><strong>Inativos</strong> : 23</p>
                                    <p class="card-text"><strong>Total</strong> : 73</p>
                                </div>
                            <!-- <div class="card-footer bg-transparent">Footer</div> -->
                        </div>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>