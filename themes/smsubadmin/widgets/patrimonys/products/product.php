<?php $this->layout("_admin"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

  <div class="row justify-content-center">
    <div class="col-xl-12">

        <?php if (!$produtos): ?>

        <!-- Cadastro de produtos -->
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                    <form class="row gy-2 gx-3 align-items-center needs-validation" id="product" novalidate action="<?= url("/painel/patrimonio/produtos/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="action" value="create"/>

                        <div class="ajax_response"><?=flash();?></div>

                        <?=csrf_input();?>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputNome"><strong><i class="bi bi-person me-1"></i> Marca</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome da marca" class="form-control form-control-sm brand_id"
                                    name="brand_id" placeholder="NOME">
                            </div>

                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputNome"><strong><i class="bi bi-person me-1"></i> Produto</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Nome" class="form-control form-control-sm"
                                    name="product_name" placeholder="NOME">

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
                                <a href="<?=url("/painel/patrimonio/produtos")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
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
                    <form class="row gy-2 gx-3 align-items-center needs-validation" id="product" novalidate action="<?= url("/painel/patrimonio/produtos/editar/{$produtos->id}"); ?>" method="post" enctype="multipart/form-data">
                        
                    <input type="hidden" name="action" value="update"/>

                        <div class="ajax_response"><?=flash();?></div>

                        <?=csrf_input();?>

                        <div class="row justify-content-center">

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputNome"><strong><i class="bi bi-person me-1"></i> Marca</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Digite o nome da marca" class="form-control form-control-sm brand_id"
                                    name="brand_id" placeholder="NOME" value="<?=$produtos->brand()->id.' - '.$produtos->brand()->brand_name?>">
                            </div>

                        </div>

                        <div class="row justify-content-center">  

                            <div class="col-md-6 mb-1">

                                <label class="col-form-label col-form-label-sm" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Nome" class="form-control form-control-sm"
                                    name="product_name" placeholder="NOME" value="<?=$produtos->product_name?>">

                            </div>

                        </div>

                        <div class="row justify-content-center">  

                            <div class="col-md-6 mb-1">
                                <label class="col-form-label col-form-label-sm" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Descrição</strong></label>
                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                    data-bs-title="Descrição" class="form-control form-control-sm"
                                    name="description" placeholder="DESCRIÇÃO" id="description" value="<?=$produtos->description?>" >
                            </div> 

                        </div>

                        <div class="row justify-content-center mt-4 mb-3">
                            <div class="col-auto">
                                <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                    data-bs-title="Clique para atualizar o produto" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                <a href="<?=url("/painel/patrimonio/produtos")?>" role="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Clique para listar as produtos" class="btn btn-sm btn-outline-smsub fw-bold me-2"><i class="bi bi-list me-2"></i>LISTAR</a>
                                <a href="<?= url("/painel/patrimonio/produtos/excluir/{$produtos->id}/delete"); ?>" class="btn btn-sm btn-outline-danger fw-bold me-2"><i class="bi bi-trash me-2"></i>EXCLUIR</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <?php endif; ?>

        <?php $this->start("scripts"); ?>
            <script>

                let brand_id = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace, queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: <?=$brands->completeBrand()?>
                });
                brand_id.initialize();
                $('.brand_id').typeahead({hint: true, highlight: true, minLength: 1}, {source: brand_id});

            </script>
        <?php $this->end(); ?>
    </div>