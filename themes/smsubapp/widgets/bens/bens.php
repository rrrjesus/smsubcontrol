<?php $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="col-xl-12">
    <div class="card mb-4">

        <?php if (!$bens): ?>

        <!-- Cadastro de Bens -->

            <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - CADASTRAR</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/patrimonio/bens/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                                    
                                <input type="hidden" name="action" value="create"/>

                                    <div class="ajax_response"><?=flash();?></div>

                                    <?=csrf_input();?>

                                    <div class="row">    

                                        <div class="col-md-4 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> ID/Marca/Modelo</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a Marca" name="modelo_id">
                                                <?=$benscreates->marcamodeloSelect()?>
                                            </select>
                                        </div> 

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Imei</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Imei" class="form-control form-control-sm" name="imei" placeholder="15 NUMEROS">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Usuario</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite ò Usuario" name="user_id">
                                                <?=$benscreates->userSelect()?>
                                            </select>
                                        </div>  

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Data Entrega</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Data Devolução" class="form-control form-control-sm mask-date" name="returned_at" placeholder="15 NUMEROS">
                                        </div>

                                    </div>

                                    <div class="row">   

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Unit</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a Unit" name="unit_id">
                                                <?=$benscreates->unitSelect()?>
                                            </select>
                                        </div>  

                                        <div class="col-md-6 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Descrição" class="form-control form-control-sm"
                                                name="descricao" placeholder="DESCRIÇÃO" id="descricao">
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Status</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a Igreja" name="status">
                                                <option value="actived" selected>Ativo</option>
                                                <option value="disabled">Inativo</option>
                                            </select>
                                        </div>   

                                    </div>

                                    <div class="row">   
                                        <div class="mb-3 mb-1">
                                            <label for="textareaObservacoes" class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                            <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Observações" rows="2" name="observacoes"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-5">
                        <strong><label for="inputLogoTitle" class="col-4 col-form-label col-form-label-sm">SMSUB/SUBS</label></strong>
                        <input tabindex="8" data-bs-togglee="tooltip" data-bs-placement="top" maxlength="50" data-bs-custom-class="custom-tooltip"
                                value="SMSUB" data-bs-title="Digite a Secretaria ou Subprefeitura" class="form-control form-control-sm border-<?=CONF_WEB_COLOR;?> secsubinp" name="secsubinp" id="secsubinp" type="text" placeholder="DIGITE A SECRETARIA/SUBPREFEIRURA"/>
                    </div>


                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para criar o registro" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>CADASTRAR</button>
                                            <a href="<?=url("/beta/patrimonio/bens/lista")?>" role="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para listar os bens" class="btn btn-sm btn-outline-smsub fw-bold me-2"><i class="bi bi-list me-2"></i>LISTAR</a>
                                        </div>
                                    </div>
                                </form>

                                <?php $this->start("scripts"); ?>
                                    <script>
                                        let secsubinp = new Bloodhound({
                                            datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                                            local: <?=(new \Source\Models\Unit())->completeName("unit_name")?>
                                        });
                                        secsubinp.initialize();
                                        $('.secsubinp').typeahead({limit: 10, hint: true, highlight: true, minLength: 1}, {source: secsubinp});
                                    </script>
                                <?php $this->end(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - BENS - ID <?=$bens->id?></div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/patrimonio/bens/editar/{$bens->id}"); ?>" method="post" enctype="multipart/form-data">
                                    
                                <input type="hidden" name="action" value="update"/>

                                    <div class="ajax_response"><?=flash();?></div>

                                    <?=csrf_input();?>
                                        
                                    <div class="row">

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Data Entrada</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Data Entrada" class="form-control form-control-sm mask-date" name="created_at" value="<?=date_fmt($bens->created_at, "d/m/Y");?>" placeholder="00/00/0000"  disabled readonly>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> ID/Marca/Modelo</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o Modelo" name="modelo_id">
                                                <option value="<?=$bens->bemModelo()->id?>" selected><?=$bens->bemModelo()->id.' - '.$bens->bemMarcas($bens->bemModelo()->marca_id)->marca_nome.' - '.$bens->bemModelo()->modelo_nome?></option>
                                                <?=$benscreates->marcamodeloSelect()?>
                                            </select>
                                        </div> 

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Imei</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Imei" class="form-control form-control-sm mask-imei" name="imei" value="<?=$bens->imei?>" placeholder="15 NUMEROS">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Usuario</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite ò Usuario" name="user_id">
                                                <option value="<?=$bens->user()->id?>" selected><?=$bens->user()->login.' - '.$bens->user()->fullName()?></option>
                                                <?=$benscreates->userSelect()?>
                                            </select>
                                        </div>  

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Data Entrega</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Data Devolução" class="form-control form-control-sm mask-date" name="returned_at" value="<?=date_fmt($bens->returned_at, "d/m/Y");?>" placeholder="15 NUMEROS">
                                        </div>

                                    </div>

                                    <div class="row">   

                                        <div class="col-md-4 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Unit</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a Unit" name="unit_id">
                                                <option value="<?=$bens->bemUnidade()->id?>" selected><?=$bens->bemUnidade()->unit_name?></option>
                                                <?=$benscreates->unitSelect()?>
                                            </select>
                                        </div>  

                                        <div class="col-md-5 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Descrição" class="form-control form-control-sm"
                                                name="descricao" placeholder="DESCRIÇÃO" id="descricao" value="<?=$bens->descricao?>" >
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Status</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o Status" name="status">
                                                <?=$bens->statusSelect()?>
                                            </select>
                                        </div>   

                                    </div>

                                    <div class="row">
                                        <div class="mb-3 mb-1">
                                            <label for="textareaObservacoes" class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                            <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Observações" name="observacoes" rows="2" ><?=$bens->observacoes?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-4">
                        <strong><label for="inputCargo" class="col-4 col-form-label col-form-label-sm">CARGO</label></strong>
                        <input tabindex="2" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Digite o cargo que você ocupa" class="form-control form-control-sm border-<?=CONF_WEB_COLOR;?> cargoinp" type="text" maxlength="62" name="cargoinp" id="cargoinp" placeholder="DIGITE O CARGO"/>
                    </div>


                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para atualizar o colaborador" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>ATUALIZAR</button>
                                            <a href="<?=url("/beta/patrimonio/bens/lista")?>" role="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para listar os bens" class="btn btn-sm btn-outline-smsub fw-bold me-2"><i class="bi bi-list me-2"></i>LISTAR</a>
                                        </div>
                                    </div>
                                </form>

                                <?php $this->start("scripts"); ?>
                                <script>
                                    let cargoinp = new Bloodhound({
                                        datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                                        local: ['ANALISTA DE ORDENAMENTO TERRITORIAL' , 'ANALISTA FISCAL DE SERVICOS' , 'ASSESSOR I' , 'ASSESSOR II' , 'ASSESSOR III' ,
                                            'ASSESSOR IV' , 'ASSESSOR JURIDICO II' , 'ASSESSOR V' , 'ASSESSOR VI' , 'ASSISTENTE ADMINISTRATIVO DE GESTAO' , 'ASSISTENTE DE SAUDE' ,
                                            'ASSISTENTE DE SUPORTE OPERACIONAL' , 'CHEFE DE ASSESSORIA II' , 'CHEFE DE GABINETE' , 'COORDENADOR I' , 'DIRETOR I' , 'DIRETOR II' , 'DIRETOR JURIDICO I' ,
                                            'FISCAL DE POSTURAS MUNICIPAIS' , 'PROCURADOR DO MUNICIPIO' , 'PROFISSIONAL ENG, ARQ, AGRONOMIA,GEOLOGIA - AGRONOMIA' , 'PROFISSIONAL ENG, ARQ, AGRONOMIA,GEOLOGIA - ARQUITETURA' ,
                                            'PROFISSIONAL ENG, ARQ, AGRONOMIA,GEOLOGIA - ENGENHARIA CIVIL' , 'PROFISSIONAL ENG, ARQ, AGRONOMIA,GEOLOGIA - ENGENHARIA QUIMICA' , 'PROFISSIONAL ENG, ARQ, AGRONOMIA,GEOLOGIA - GEOLOGIA' ,
                                            'SECRETARIO ADJUNTO' , 'SECRETARIO EXECUTIVO ADJUNTO' , 'SECRETARIO MUNICIPAL']
                                    });
                                    cargoinp.initialize();
                                    $('.cargoinp').typeahead({hint: true, highlight: true, minLength: 1}, {source: cargoinp});

                                    </script>
                                <?php $this->end(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="fw-semibold text-body-emphasis text-center">Histórico do Patrimônio</h4>
                <div class="card-footer">
                     <!-- Histórico-->
                                <?= $this->insert("widgets/bens/listahistorico"); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    