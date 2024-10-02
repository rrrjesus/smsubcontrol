<?php $this->layout("_admin"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

  <div class="row justify-content-center">
    <div class="col-xl-12">

        <?php if (!$contratos): ?>

        <!-- Cadastro de contratos -->
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                    <form class="row gy-2 gx-3 align-items-center needs-validation" id="brand" novalidate action="<?= url("/painel/patrimonio/contratos/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="action" value="create"/>

                        <div class="ajax_response"><?=flash();?></div>

                        <?=csrf_input();?>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                            <label class="col-form-label col-form-label-sm" for="inputSei"><strong><i class="bi bi-person me-1"></i> Processo SEI</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o Número de Processo SEI - Ex : 6012.2019/0005605-6" class="form-control form-control-sm"
                                    name="sei_process" placeholder="6012.2019/0005605-6">

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                            <label class="col-form-label col-form-label-sm" for="inputProcess"><strong><i class="bi bi-person me-1"></i> Nome do Contrato</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do Contrato - Ex : Simpress Tabets/Impressoras 2021" class="form-control form-control-sm"
                                    name="process_name" placeholder="Simpress Tabets/Impressoras 2021">

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                            <label class="col-form-label col-form-label-sm" for="inputManager"><strong><i class="bi bi-person me-1"></i> Nome do Responsável</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do Responsável pelo Contrato" class="form-control form-control-sm user_manager"
                                    name="manager_id" placeholder="Responsável pelo Contrato">

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                            <label class="col-form-label col-form-label-sm" for="inputInspector"><strong><i class="bi bi-person me-1"></i> Nome do Fiscal</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do Fiscal do Contrato" class="form-control form-control-sm user_inspector"
                                    name="inspector_id" placeholder="Fiscal do Contrato">

                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                            <label class="col-form-label col-form-label-sm" for="inputDeputyInspector"><strong><i class="bi bi-person me-1"></i> Nome do Suplente</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome do Suplente do Contrato" class="form-control form-control-sm user_deputy_inspector"
                                    name="deputy_inspector_id" placeholder="Suplente do Contrato">

                            </div>

                        </div>

                        <div class="row justify-content-center">  

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Descrição" class="form-control form-control-sm"
                                    name="description" placeholder="DESCRIÇÃO" id="description">
                            </div>

                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-auto">
                                <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Clique para criar o registro" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                <a href="<?=url("/painel/patrimonio/contratos")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Clique para listar os usuarios" class="btn btn-sm btn-outline-dark fw-bold">
                                <i class="bi bi-list-columns me-2"></i>LISTAR</a>
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
                    <form class="row gy-2 gx-3 align-items-center needs-validation" id="brand" novalidate action="<?= url("/painel/patrimonio/contratos/editar/{$contratos->id}"); ?>" method="post" enctype="multipart/form-data">
                        
                    <input type="hidden" name="action" value="update"/>

                        <div class="ajax_response"><?=flash();?></div>

                        <?=csrf_input();?>

                        <div class="row justify-content-center">  

                            <div class="col-md-6 mb-1">

                                <label class="col-form-label col-form-label-sm" for="inputNome"><strong><i class="bi bi-person me-1"></i> PROCESSO SEI</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o Número de Processo SEI - Ex : 6012.2019/0005605-6" class="form-control form-control-sm"
                                    name="brand_name" placeholder="6012.2019/0005605-6" value="<?=$contratos->brand_name?>">

                            </div>

                        </div>

                        <div class="row justify-content-center">  

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Descrição" class="form-control form-control-sm"
                                    name="description" placeholder="DESCRIÇÃO" id="description" value="<?=$contratos->description?>" >
                            </div> 

                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-auto">
                                <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Clique para atualizar a marca" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                <a href="<?=url("/painel/patrimonio/contratos")?>" role="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Clique para listar as contratos" class="btn btn-sm btn-outline-smsub fw-bold me-2"><i class="bi bi-list me-2"></i>LISTAR</a>
                                <a href="<?= url("/painel/patrimonio/contratos/excluir/{$contratos->id}/delete"); ?>" class="btn btn-sm btn-outline-danger fw-bold me-2"><i class="bi bi-trash me-2"></i>EXCLUIR</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <?php endif; ?>

        <?php $this->start("scripts"); ?>
            <script>

                let user_manager = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$users->completeUser()?>
                });
                user_manager.initialize();
                $('.user_manager').typeahead({hint: true, highlight: true, minLength: 1}, {source: user_manager});

                let user_inspector = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$users->completeUser()?>
                });
                user_inspector.initialize();
                $('.user_inspector').typeahead({hint: true, highlight: true, minLength: 1}, {source: user_inspector});

                let user_deputy_inspector = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$users->completeUser()?>
                });
                user_deputy_inspector.initialize();
                $('.user_deputy_inspector').typeahead({hint: true, highlight: true, minLength: 1}, {source: user_deputy_inspector});
            </script>
        <?php $this->end(); ?>
    </div>