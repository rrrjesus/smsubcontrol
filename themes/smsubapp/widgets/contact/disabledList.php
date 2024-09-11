<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>

<?php 
    if(user()->level_id < 3){
        redirect("/beta/usuarios");
    }
?>

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-12 ajax_response">
            <?=flash();?>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-12 ml-auto text-center">
            <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                data-bs-title="Clique para sair" class="btn btn-outline-danger btn-sm me-3 fw-semibold" href="<?=url("/beta/contatos")?>"
                role="button"><i class="bi bi-arrow-right-circle me-2 mt-1"></i>Sair</a>

        </div>
    </div>
    

    <div class="d-flex justify-content-center">
        <div class="col-12">
            <table id="contacts" class="table table-bordered table-sm border-warning table-hover" style="width:100%">
                <thead class="table-warning">
                <tr>
                    <th class="text-center"><i class="bi bi-unlock me-1"></i><br>REATIVAR</th>
                    <th class="text-center"><i class="bi bi-person-gear me-1"></i><br>NOME</th>
                    <th class="text-center"><i class="bi bi-person-circle me-1"></i><br>SETOR</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>RAMAL</th>
                    <th class="text-center"><i class="bi bi-person me-1"></i><br>STATUS</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($contacts) && user()->level_id > 3){ ?>
                <?php foreach ($contacts as $lista): ?>
                    <tr>
                        <td class="text-center"><a href="../contatos/ativar/<?=$lista->id?>/actived" data-bs-togglee="tooltip" 
                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Clique para reativar <?=$lista->contact_name?>" role="button" 
                            class="btn btn-outline-warning rounded-circle btn-md text-center"><i class="bi bi-telephone-outbound text-secondary"></i></a></td>
                        <td class="text-center"><?=$lista->contact_name;?></td>
                        <td class="text-center"><?=$lista->unit()->unit_name;?></td>
                        <td class="text-center"><?=$lista->ramal;?></td>
                        <td class="text-center"><?=$lista->statusBadge();?></td>
                    </tr>
                <?php endforeach; ?>
                <?php }else{redirect("/beta/contatos");} ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



