<?php $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="col-xl-12">
    <div class="card mb-4">

        <?php if (!$marcas): ?>

        <!-- Cadastro de marcas -->

            <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - CADASTRAR</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/patrimonio/marcas/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                                    
                                <input type="hidden" name="action" value="create"/>

                                    <div class="ajax_response"><?=flash();?></div>

                                    <?=csrf_input();?>

                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Nome" class="form-control form-control-sm"
                                                name="marca_nome" placeholder="NOME">

                                        </div>

                                    </div>

                                    <div class="row">   

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

                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para criar o registro" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>CADASTRAR</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - marcas - ID <?=$marcas->id?></div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/patrimonio/marcas/editar/{$marcas->id}"); ?>" method="post" enctype="multipart/form-data">
                                    
                                <input type="hidden" name="action" value="update"/>

                                    <div class="ajax_response"><?=flash();?></div>

                                    <?=csrf_input();?>

                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Nome" class="form-control form-control-sm"
                                                name="marca_nome" placeholder="NOME" value="<?=$marcas->marca_nome?>">

                                        </div>

                                    </div>

                                    <div class="row">   

                                        <div class="col-md-6 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Descrição" class="form-control form-control-sm"
                                                name="descricao" placeholder="DESCRIÇÃO" id="descricao" value="<?=$marcas->descricao?>" >
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Status</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o Status" name="status">
                                                <?=$marcas->statusSelect()?>
                                            </select>
                                        </div>   

                                    </div>

                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para atualizar a marca" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>ATUALIZAR</button>
                                            <a href="<?=url("/beta/patrimonio/marcas/lista")?>" role="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para listar as marcas" class="btn btn-sm btn-outline-smsub fw-bold me-2"><i class="bi bi-list me-2"></i>LISTAR</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger fw-bold me-2"
                                            data-post="<?= url("/beta/patrimonio/marcas/editar/{$marcas->id}"); ?>"
                                            data-action="delete"
                                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir o usuário e todos os dados relacionados a ele? Essa ação não pode ser feita!"
                                            data-user_id="<?= $marcas->id; ?>"><i class="bi bi-trash me-2"></i>Excluir</a>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>