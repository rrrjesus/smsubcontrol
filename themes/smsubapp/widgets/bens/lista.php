<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>


    <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - BENS</div>
        <div class="card-body">
            <div class="container-fluid">

                <div class="row justify-content-center mt-4 mb-3">
                    <div class="col-auto">
                        <a href="<?= url("/beta/patrimonio/bens/cadastrar"); ?>" role="button" aria-disabled="false" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para inserir patrimônio" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>Novo</a>
                    </div>
                </div>
            
                <?=flash();?>
                <table id="patrimonio" class="table table-hover table-bordered table-sm border-<?=CONF_WEB_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_WEB_COLOR?>">
                    <tr>
                        <th class="text-center">EDITAR</th>
                        <th class="text-center">NOME</th>
                        <th class="text-center">MARCA</th>
                        <th class="text-center">MODELO</th>
                        <th class="text-center">DESCRICAO</th>
                        <th class="text-center">UNIDADE</th>
                        <th class="text-center">IMEI</th>
                        <th class="text-center">STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($patrimonio as $lista): ?>
                    <tr>
                        <td class="text-center fw-semibold"><a href="<?= url("/beta/patrimonio/bens/editar/{$lista->id}"); ?>" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                        data-bs-title="Clique para editar" class="btn btn-sm btn-outline-warning fw-bold me-2"><i class="bi bi-pencil me-2"></i><?=$lista->id?></a></td>
                        <td class="text-center fw-semibold"><?=(!empty($lista->bens_nome) ? $lista->bens_nome : "")?></td>
                        <td class="text-center fw-semibold">
                            <?php if(!empty($lista->bemModelo()->marca_id) && !empty($lista->bemModelo()->status == "actived")):
                                echo $lista->bemMarcas($lista->bemModelo()->marca_id)->marca_nome;
                        else:
                            echo "EXCLUÍDO";
                        endif;
                        ?>
                        </td>
                        <td class="text-center fw-semibold">
                            <?php if(!empty($lista->bemModelo()->modelo_nome) && !empty($lista->bemModelo()->status == "actived")):
                                echo (!empty($lista->bemModelo()->modelo_nome) ? $lista->bemModelo()->modelo_nome : "NÃO CADASTRADO");
                        else:
                            echo "EXCLUÍDO";
                        endif;
                        ?>
                        </td>
                        <td class="text-center fw-semibold"><?=(!empty($lista->descricao) ? $lista->descricao : "")?></td>
                        <td class="text-center fw-semibold">
                        <?php if(!empty($lista->BemUnit()->unit_name) && !empty($lista->BemUnit()->status == "actived")):
                            echo (!empty($lista->BemUnit()->unit_name) ? $lista->BemUnit()->unit_name : "NÃO CADASTRADO");
                        else:
                            echo "EXCLUÍDO";
                        endif;
                            ?>
                            </td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->imei )? $lista->imei : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->statusBadge()?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>     
        </div>
    </div>
