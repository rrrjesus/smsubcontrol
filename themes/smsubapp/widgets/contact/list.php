
<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>

<div class="container-fluid">

<?php if(user()->level_id > 3){;?>
    <div class="row justify-content-center">
        <div class="col-12 ajax_response">
            <?=flash();?>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-12 ml-auto text-center">
            <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/contatos/cadastrar")?>"
                role="button"><i class="bi bi-telephone-plus me-2 mt-1"></i>Cadastrar</a>
            <?php if(!empty($registers->disabled) && user()->level_id > 3){ ?>
                <a role="button" href="<?=url("/beta/contatos/desativados")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                    data-bs-title="Clique para acessar usuarios desativados" class="btn btn-outline-secondary btn-sm position-relative fw-semibold"><i class="bi bi-telephone-x text-danger me-2 mt-1">
                    </i> Desativados<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$registers->disabled?></span></a>
            <?php } ?>

        </div>
    </div>
    

    <div class="d-flex justify-content-center">
        <div class="col-12">
            <table id="contacts" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                <thead class="table-secondary">
                <tr>
                    <th class="text-center"><i class="bi bi-unlock me-1"></i><br>EDITAR</th>
                    <th class="text-center"><i class="bi bi-person-gear me-1"></i><br>NOME</th>
                    <th class="text-center"><i class="bi bi-person-circle me-1"></i><br>SETOR</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>RAMAL</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>STATUS</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($contacts)){ ?>
                <?php foreach ($contacts as $lista): ?>
                    <tr>
                        <td class="text-center"><a href="contatos/<?=$lista->id?>" data-bs-togglee="tooltip" 
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Clique para editar <?=$lista->contact_name?>" role="button" 
                            class="btn btn-outline-warning rounded-circle btn-md text-center <?php if(user()->level_id < 3){echo 'disabled';}?>"><i class="bi bi-pencil text-secondary"></i></a></td>
                        <td class="text-center"><?=$lista->contact_name;?></td>
                        <td class="text-center"><?=$lista->unit()->unit_name;?></td>
                        <td class="text-center"><?=$lista->ramal;?></td>
                        <td class="text-center"><?=$lista->statusBadge();?></td>
                    </tr>
                <?php endforeach; ?>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php }else{;?>

    <div class="d-flex justify-content-center">
        <div class="col-12">
            <table id="contacts" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                <thead class="table-secondary">
                <tr>
                    <th class="text-center"><i class="bi bi-person-gear me-1"></i><br>NOME</th>
                    <th class="text-center"><i class="bi bi-person-circle me-1"></i><br>SETOR</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>RAMAL</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>STATUS</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($contacts)){ ?>
                <?php foreach ($contacts as $lista): ?>
                    <tr>
                        <td class="text-center"><?=$lista->contact_name;?></td>
                        <td class="text-center"><?=$lista->unit()->unit_name;?></td>
                        <td class="text-center"><?=$lista->ramal;?></td>
                        <td class="text-center"><?=$lista->statusBadge();?></td>
                    </tr>
                <?php endforeach; ?>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>



