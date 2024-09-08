<?php $this->layout("_admin"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>

            <div class="container-fluid">

                <div class="row justify-content-center">
                    <div class="col-12 ajax_response">
                        <?=flash();?>
                    </div>
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-12 ml-auto text-center">
                        <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/igrejas/adicionar")?>"
                            role="button"><i class="bi bi-telephone-plus me-2 mt-1"></i>Adicionar</a>
                        <?php if(!empty($registers->disabled)){ ?>
                            <a role="button" href="<?=url("/igrejas/desativadas")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Clique para acessar igrejas desativados" class="btn btn-outline-secondary btn-sm position-relative fw-semibold mt-1"><i class="bi bi-telephone-x text-danger me-2 mt-1">
                                </i> Desativados<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$registers->disabled?></span></a>
                        <?php } ?>

                    </div>
                </div>

                <table id="brands" class="table table-hover table-bordered table-sm border-<?=CONF_ADMIN_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_ADMIN_COLOR?>">
                    <tr>
                        <th class="text-center">EDITAR</th>
                        <th class="text-center">MARCA</th>
                        <th class="text-center">DESCRICAO</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">DESATIVAR</th>
                        <th class="text-center">EXCLUIR</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($brands as $lista): ?>
                    <tr>
                        <td class="text-center fw-semibold"><a href="<?= url("/beta/patrimonio/marcas/editar/{$lista->id}"); ?>" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                        data-bs-title="Clique para editar" class="btn btn-sm btn-outline-warning rounded-circle fw-bold me-2"><i class="bi bi-pencil text-dark"></i></a></td>
                        <td class="text-center fw-semibold"><?=(!empty($lista->brand_name) ? $lista->brand_name : "")?></td>
                        <td class="text-center fw-semibold"><?=(!empty($lista->description) ? $lista->description : "")?></td>
                        <td class="text-center fw-semibold"><?=$lista->statusBadge()?></td>
                        <td class="text-center fw-semibold"><?=$lista->id?></td>
                        <td class="text-center fw-semibold"><?=$lista->id?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>     
