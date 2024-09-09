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
                data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/painel/unidades/cadastrar")?>"
                role="button"><i class="bi bi-telephone-plus me-2 mt-1"></i>Cadastrar</a>
                <?php if(!empty($registers->disabled)){ ?>
                <a role="button" href="<?=url("/painel/unidades/desativadas")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                    data-bs-title="Clique para acessar unidades desativadas" class="btn btn-outline-secondary btn-sm position-relative fw-semibold"><i class="bi bi-telephone-x text-danger me-2 mt-1">
                    </i> Desativadas<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$registers->disabled?></span></a>
            <?php } ?>
        </div>
       
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-12">
            <table id="units" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-center">EDITAR</th>
                        <th class="text-center">FOTO</th>
                        <th class="text-center">NOME</th>
                        <th class="text-center">TELEFONE</th>
                        <th class="text-center">DESCRIÇÃO</th>
                        <th class="text-center">ENDEREÇO</th>
                        <th class="text-center">CEP</th>
                        <th class="text-center">RESPONSAVEL</th>
                        <th class="text-center">TEL RESP</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">DESATIVAR</th>
                        <th class="text-center">EXCLUIR</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($brands)){ ?>
                <?php foreach ($brands as $lista): ?>
                <tr>
                    <td class="text-center fw-semibold"><a href="<?= url("/painel/unidades/editar/{$lista->id}"); ?>" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                    data-bs-title="Clique para editar" class="btn btn-sm btn-outline-warning rounded-circle fw-bold me-2"><i class="bi bi-pencil text-secondary"></i></a></td>
                    <td class="text-center fw-semibold"><?=(!empty($lista->brand_name) ? $lista->brand_name : "")?></td>
                    <td class="text-center fw-semibold"><?=(!empty($lista->description) ? $lista->description : "")?></td>
                    <td class="text-center fw-semibold"><?=$lista->statusBadge()?></td>
                    <td class="text-center fw-semibold"><?=$lista->id?></td>
                    <td class="text-center fw-semibold"><?=$lista->id?></td>
                </tr>
                <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>     
</div>