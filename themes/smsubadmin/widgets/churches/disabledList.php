<?php $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_ADMIN_COLOR?>" href="<?=url("/dashboard")?>"><i class="bi bi-house-door"></i> Lista</a></li>
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-person"></i> Igrejas</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card mb-4 border-secondary">
            <div class="card-body">
                <div class="container-fluid">

                    <div class="row justify-content-center">
                        <div class="col-12 ajax_response">
                            <?=flash();?>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-12 ml-auto text-center">
                            <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                               data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-danger btn-sm me-3 fw-semibold" href="<?=url("/igrejas")?>"
                               role="button"><i class="bi bi-arrow-right-circle me-2 mt-1"></i>Sair</a>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <table id="churchesDisabled" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                                <thead class="table-secondary">
                                <tr>
                                <th class="text-center">ID</th>
                                    <th class="text-center">NOME</th>
                                    <th class="text-center">ATIVAR</th>
                                    <th class="text-center">EXCLUIR</th>
                                </tr>
                                </thead>
                                <tbody>
                    <?php if(!empty($registers->disabled)){ ?>
                    <?php foreach ($churches as $lista): ?>
                        <tr>
                            <td class="text-center"><?=$lista->id?></td>
                            <td class="text-center"><?=$lista->churche_name?></td>
                            <td class="text-center"><?=$lista->id?></td>
                            <td class="text-center"><?=$lista->id?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>