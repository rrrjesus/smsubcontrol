<?php $this->layout("_beta"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-house-door"></i> Monitoramento</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="container-fluid">

            <div class="row">
                <!-- Usuários Totais da Agenda --> 
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fw-semibold text-uppercase mb-1 fs-5">Agenda</div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Contatos :  <?=$contacts->contacts?></div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Desativados : <?=$contacts->disableds?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral: <?=$contacts->totals?></div>
                                </div>
                                <div class="col-auto text-gray-300">
                                    <i class="bi bi-person-arms-up bi-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                        <div class="card-body text-<?=CONF_APP_COLOR?>">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fw-semibold text-uppercase mb-1 fs-5">Patrimônio</div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Patrimônio :  <?=$patrimonys->patrimonys?></div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Desativados :  <?=$patrimonys->disableds?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$patrimonys->totals?></div>
                                </div>
                                <div class="col-auto text-gray-300">
                                    <i class="bi bi-building bi-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fw-semibold text-uppercase mb-1 fs-5">Marcas</div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Marcas :  <?=$brands->brands?></div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Desativadas :  <?=$brands->disableds?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$brands->totals?></div>
                                </div>
                                <div class="col-auto text-gray-300">
                                    <i class="bi bi-building bi-2x"></i>
                                </div>Marcas                              </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fw-semibold text-uppercase mb-1 fs-5">Modelos</div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Modelos :  <?=$products->products?></div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Desativadas :  <?=$products->disableds?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$products->totals?></div>
                                </div>
                                <div class="col-auto text-gray-300">
                                    <i class="bi bi-building bi-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
