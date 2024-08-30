<?php $this->layout("_theme"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="col-xl-12">
    <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_APP_COLOR?>"><i class="bi bi-person pe-3"></i>   <?=CONF_SITE_NAME.' 2024 - Perfil de '.$user->login?></div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/app/profile"); ?>" method="post" enctype="multipart/form-data">
                                
                            <input type="hidden" name="update" value="true"/>

                                <div class="ajax_response"></div>

                                <?=csrf_input();?>
                                    
                                <div class="row mb-1">
    
                                    <div class="col-md-1 app_formbox_photo mb-1">
                                        <div class="rounded-circle j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>"> <strong><i class="bi bi-upload ms-2 me-2 mb-2"></i>  Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                        <input class="form-control form-control-sm" data-image=".j_profile_image" type="file" class="radius" name="photo"/>
                                    </div>

                                    <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person ms-2 me-2 mb-2"></i> Nome</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o nome do Colaborador" class="form-control form-control-sm"
                                            name="first_name" placeholder="NOME" id="first_name" value="<?=$user->first_name?>" onchange="upperCaseF(this)" autofocus>

                                    </div>

                                    <div class="col-md-4 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add ms-2 me-2 mb-2"></i> SobreNome</strong></label>
                                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o sobrenome do Colaborador" class="form-control form-control-sm"
                                            name="last_name" placeholder="SOBRENOME" id="last_name" value="<?=$user->last_name?>"
                                            onchange="upperCaseF(this)">
                                    </div>
                                </div>

                                    <div class="row">

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone ms-2 me-2 mb-2"></i> Celular</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="phone" value="<?=$user->phone?>" placeholder="(11)991065284">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at ms-2 me-2 mb-2"></i> E-mail</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o email" class="form-control form-control-sm"
                                                name="email" value="<?=$user->email?>" placeholder="exemplo@exemplo.com.br">
                                        </div>

                                        <div class="col-md-4 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add ms-2 me-2 mb-2"></i> Cargo</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Unidade" class="form-control form-control-sm"
                                                name="unit" placeholder="Unidade" id="unit" value="<?=$user->position()->position_name?>" disabled readonly>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add ms-2 me-2 mb-2"></i> Unidade</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Unidade" class="form-control form-control-sm"
                                                name="unit" placeholder="Unidade" id="unit" value="<?=$user->unit()->unit_name?>"
                                                onchange="upperCaseF(this)">
                                        </div>

                                    </div>

                                    <div class="row">                          
                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock ms-2 me-2 mb-2"></i>Senha</strong></label>
                                                <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                    name="password" placeholder="********">
                                        </div>  

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock ms-2 me-2 mb-2"></i>Repetir Senha</strong></label>
                                            <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                name="password_re" placeholder="********">
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