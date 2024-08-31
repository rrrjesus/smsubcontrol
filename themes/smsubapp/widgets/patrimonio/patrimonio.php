<?php $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="col-xl-12">
    <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person"></i>   <?=CONF_SITE_NAME?> 2024 - PATRIMONIO</div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/patrimonio"); ?>" method="post" enctype="multipart/form-data">
                                
                            <input type="hidden" name="update" value="true"/>

                                <div class="ajax_response"></div>

                                <?=csrf_input();?>
                                    
                                <div class="row mb-1">
    
                                    <div class="col-md-1 app_formbox_photo mb-1">
                                        <div class="rounded-circle j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>"> <strong><i class="bi bi-upload me-1"></i>  Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                        <input class="form-control form-control-sm" data-image=".j_profile_image" type="file" class="radius" name="photo"/>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-2 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Login</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Nome" class="form-control form-control-sm"
                                            name="first_name" placeholder="NOME" value="<?=$patrimonio->login?>" disabled readonly>

                                    </div>

                                    <div class="col-md-2 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Nome" class="form-control form-control-sm"
                                            name="first_name" placeholder="NOME" value="<?=$patrimonio->first_name?>" disabled readonly>

                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> SobreNome</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Sobrenome" class="form-control form-control-sm"
                                            name="last_name" placeholder="SOBRENOME" id="last_name" value="<?=$patrimonio->last_name?>" disabled readonly>
                                    </div>

                                    <div class="col-md-2 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Celular</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="phone" value="<?=$patrimonio->phone?>" placeholder="(11)991065284">
                                    </div>

                                    <div class="col-md-2 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Situação</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title="Categoria" class="form-control form-control-sm"
                                        name="category" placeholder="Categoria" value="<?=$patrimonio->statusInput()?>" disabled readonly>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Cargo</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Cargo" class="form-control form-control-sm"
                                            name="position" placeholder="Unidade" value="<?=$patrimonio->userPosition()->position_name?>" disabled readonly>
                                    </div>

                                    <div class="col-md-2 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Regime</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title="Categoria" class="form-control form-control-sm"
                                        name="category" placeholder="Categoria" value="<?=$patrimonio->userCategory()->category_name?>" disabled readonly>
                                    </div>

                                    <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unidade</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Unidade" class="form-control form-control-sm"
                                            name="unit" placeholder="Unidade" value="<?='00'.$patrimonio->unit()->id.' - '.$patrimonio->unit()->unit_name?>" disabled readonly>
                                    </div>

                                    <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at me-1"></i> E-mail</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Email" class="form-control form-control-sm" name="email" value="<?=$patrimonio->email?>" disabled readonly>
                                    </div>

                                </div>

                                <div class="row">

                                <div class="col-md-2 mb-1">
                                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar4-week me-1"></i>Cadastro</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Cadastro" class="form-control form-control-sm" value="<?=date_fmt($patrimonio->created_at, 'd/m/Y')?>" disabled readonly>
                                </div>  

                                <div class="col-md-2 mb-1">
                                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar2-x me-1"></i>Bloqueio</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Bloqueio" class="form-control form-control-sm" value="<?=date_fmt_null($patrimonio->blocked_at, 'd/m/Y')?>" disabled readonly>
                                </div>

                                <div class="col-md-3 mb-1">
                                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock me-1"></i>Senha</strong></label>
                                        <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite a senha" class="form-control form-control-sm"
                                            name="password" placeholder="********">
                                    </div>  

                                    <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><i class="bi bi-lock me-1"><strong></i>Repetir Senha</strong></label>
                                            <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                name="password_re" placeholder="********">
                                    </div>  

                                </div>

                                <div class="row">   
                                    
                                    <div class="mb-3 mb-1">
                                        <label for="textareaObservacoes" class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                        <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                        data-bs-title=Observações" rows="3" disabled readonly><?=$patrimonio->observations?></textarea>
                                    </div>
                                </div>


                                <div class="row justify-content-center mt-4 mb-3">
                                    <div class="col-auto">
                                        <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para atualizar o colaborador" class="btn btn-sm btn-outline-success fw-bold me-2"><i class="bi bi-disc-fill me-2"></i>ATUALIZAR</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>