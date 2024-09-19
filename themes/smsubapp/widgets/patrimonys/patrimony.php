<?= $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <?php if (!$patrimonys): ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                    <form class="row gy-2 gx-3 align-items-center needs-validation" id="patrimony" novalidate action="<?= url("/beta/patrimonios/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                    
                        <input type="hidden" name="action" value="create"/>

                        <?=csrf_input();?>

                        <div class="ajax_response"><?=flash();?></div>

                        <div class="row mb-1">
                            <div class="col-md-4 mb-1">
                                <label for="formFileSm" class="col-form-label col-form-label-sm"> <strong><i class="bi bi-upload me-1"></i>  Extensões aceitas : .pdf </strong></label>
                                <input class="form-control form-control-sm" type="file" class="radius" name="file_terms"/>
                            </div>
                        </div>

                        <div class="row mb-1">

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputProduto"><i class="bi bi-person-add me-1"></i><strong>Produto</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do produto" class="form-control form-control-sm product_id"
                                    name="product_id" placeholder="PRODUTO">
                            </div>

                            <div class="col-md-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputImei"><i class="bi bi-person-add me-1"></i><strong>Tipo de Registro da Peça</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o tipo de número da peça" class="form-control form-control-sm type_part_number"
                                    name="type_part_number" placeholder="TIPO DE REGISTRO DA PEÇA">
                            </div>

                            <div class="col-md-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputNs"><i class="bi bi-person-add me-1"></i><strong>Número de Registro</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o numero de registro da peça" class="form-control form-control-sm"
                                    name="part_number" placeholder="NÚMERO DA PEÇA">
                            </div>
                        </div>

                        <div class="row mb-1">

                            <div class="col-md-5 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Usuario</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite a unidade" class="form-control form-control-sm user_id"
                                    name="user_id" id="user_id" placeholder="USUÁRIO">
                            </div>

                            <div class="col-md-7 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unidade</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite a unidade" class="form-control form-control-sm unit_id"
                                    name="unit_id" id="unit_id" placeholder="UNIDADE">
                            </div>

                        </div>

                        <div class="row">   
                            
                            <div class="mb-3 mb-1">
                                <label for="textareaObservacoes" class="col-form-label col-form-label-sm"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                data-bs-title=Observações" rows="2" name="observations"></textarea>
                            </div>

                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-auto">
                            <?=button("top", "Clique para gravar", "success", "disc-fill", "Gravar")?>
                            <?=buttonLink("/beta/patrimonios", "top", "Clique para listar os patrimônios", "dark", "list", "Listar")?>                                  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php else: ?>

        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                <form class="row gy-2 gx-3 align-items-center needs-validation" id="patrimony" novalidate action="<?= url("/beta/patrimonios/editar/{$patrimonys->id}"); ?>" method="post" enctype="multipart/form-data">
                        
                    <input type="hidden" name="action" value="update"/>

                        <div class="ajax_response"><?=flash();?></div>

                        <?=csrf_input();?>

                        <div class="row mb-1">

                            <div class="col-md-1 mb-1">
                                <a href="<?php if (file_exists(CONF_UPLOAD_DIR .'/'.$patrimonys->file_terms)) {echo '../../../'.CONF_UPLOAD_DIR .'/'.$patrimonys->file_terms;} 
                                    else {echo url('themes/'.CONF_VIEW_APP.'/assets/images/adobe_cinza.jpg');}?>" target="_blank">
                                <img data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Clique para abrir termo" height="90" width="90" src="<?php if ($patrimonys->file_terms && file_exists(CONF_UPLOAD_DIR .'/'.$patrimonys->file_terms)) 
                                    {echo url('themes/'.CONF_VIEW_APP.'/assets/images/adobe.jpg');}else {echo url('themes/'.CONF_VIEW_APP.'/assets/images/adobe_cinza.jpg');}?>" class="img-thumbnail rounded-circle float-left" id="foto-cliente">
                                </a>
                            </div>

                            <div class="col-md-4 mb-1">
                                <label for="formFileSm" class="col-form-label col-form-label-sm"> <strong><i class="bi bi-upload me-1"></i>  Extensões aceitas : .pdf </strong></label>
                                <input class="form-control form-control-sm" type="file" class="radius" name="file_terms"/>
                            </div>
                        </div>
                                
                        <div class="row mb-1">

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputProduto"><i class="bi bi-person-add me-1"></i><strong>Produto</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do produto" class="form-control form-control-sm product_id"
                                    name="product_id" placeholder="PRODUTO" value="<?php if($patrimonys->product_id){echo $patrimonys->product()->id.' - '.$patrimonys->product()->product_name;}else{echo '';}?>">
                            </div>

                            <div class="col-md-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputImei"><i class="bi bi-person-add me-1"></i><strong>Registro (NS/IMEI/SERVICE_TAG)</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o tipo de número da peça" class="form-control form-control-sm type_part_number"
                                    name="type_part_number" placeholder="TIPO DE REGISTRO DA PEÇA" value="<?=$patrimonys->type_part_number?>">
                            </div>

                            <div class="col-md-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputNs"><i class="bi bi-person-add me-1"></i><strong>Número de Registro</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o numero de registro da peça" class="form-control form-control-sm"
                                    name="part_number" placeholder="NÚMERO DA PEÇA" value="<?=$patrimonys->part_number?>">
                            </div>
                        </div>

                            <div class="row mb-1">

                                <div class="col-md-7 mb-1">
                                    <label class="col-form-label col-form-label-sm" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unidade</strong></label>
                                    <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title="Digite o nome da unidade" class="form-control form-control-sm unit_id"
                                        name="unit_id" placeholder="UNIDADE" value="<?php if($patrimonys->unit_id){echo $patrimonys->unit()->id.' - '.$patrimonys->unit()->unit_name;}else{echo '';}?>">
                                </div>

                                <div class="col-md-5 mb-1">
                                    <label class="col-form-label col-form-label-sm" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Usuario</strong></label>
                                    <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title="Digite o nome do usuário" class="form-control form-control-sm user_id"
                                        name="user_id" placeholder="USUÁRIO" value="<?php if($patrimonys->user_id){echo $patrimonys->userPatrimony()->id.' - '.$patrimonys->userPatrimony()->user_name;}else{echo '';}?>">
                                </div>

                            </div>

                            <div class="row">   

                                <div class="mb-3 mb-1">
                                    <label for="textareaObservacoes" class="col-form-label col-form-label-sm"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                    <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title=Observações" rows="2" name="observations"><?=$patrimonys->observations?></textarea>
                                </div>

                            </div>         

                            <div class="row justify-content-center mt-4 mb-3">
                                <div class="col-auto">
                                <?=button("top", "Clique para gravar", "success", "disc-fill", "Gravar")?>
                                <?=buttonLink("/beta/patrimonios", "top", "Clique para listar os patrimônios", "secondary", "list", "Listar")?>    
                                <?=buttonLink("/beta/patrimonios/termo/{$patrimonys->id}", "top", "Clique para listar os patrimônios", "primary", "file-earmark-word", "Termo")?>                                   
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-md-12 mb-1">
                                    <?php $this->insert("widgets/patrimonys/historyList"); ?>
                                </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>

        <?php  endif; ?>
        <?php $this->start("scripts"); ?>
            <script>

                let product_id = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$patrimonyscreates->completeProduct()?>
                });
                product_id.initialize();
                $('.product_id').typeahead({hint: true, highlight: true, minLength: 1}, {source: product_id});
                
                let type_part_number = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: ['CHIP', 'NS', 'IMEI', 'SERVICE_TAG']
                });
                type_part_number.initialize();
                $('.type_part_number').typeahead({hint: true, highlight: true, minLength: 1}, {source: type_part_number});
                
                let user_id = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$patrimonyscreates->completeUser()?>
                });
                user_id.initialize();
                $('.user_id').typeahead({hint: true, highlight: true, minLength: 1}, {source: user_id});

                let unit_id = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$patrimonyscreates->completeUnit()?>
                });
                unit_id.initialize();
                $('.unit_id').typeahead({hint: true, highlight: true, minLength: 1}, {source: unit_id});

            </script>
        <?php $this->end(); ?>

    </div>
</div>
