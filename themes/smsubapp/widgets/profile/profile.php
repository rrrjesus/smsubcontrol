<?php $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/beta/perfil"); ?>" method="post" enctype="multipart/form-data">
                
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
                            name="first_name" placeholder="NOME" value="<?=$user->login?>" disabled readonly>

                    </div>

                    <div class="col-md-2 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Nome" class="form-control form-control-sm"
                            name="first_name" placeholder="NOME" value="<?=$user->first_name?>" disabled readonly>

                    </div>

                    <div class="col-md-4 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> SobreNome</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Sobrenome" class="form-control form-control-sm"
                            name="last_name" placeholder="SOBRENOME" id="last_name" value="<?=$user->last_name?>" disabled readonly>
                    </div>

                    <div class="col-md-2 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i>Telefone Fixo</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                        data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="fixed_phone" value="<?=$user->fixed_phone?>" placeholder="(11)49343000">
                    </div>

                    <div class="col-md-2 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i>Telefone Celular</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                        data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="cell_phone" value="<?=$user->cell_phone?>" placeholder="(11)991065284">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Cargo</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Cargo" class="form-control form-control-sm"
                            name="position" placeholder="Unit" value="<?=$user->userPosition()->position_name?>" disabled readonly>
                    </div>

                    <div class="col-md-2 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Regime</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                        data-bs-title="Categoria" class="form-control form-control-sm"
                        name="category" placeholder="Categoria" value="<?=$user->userCategory()->category_name?>" disabled readonly>
                    </div>

                    <div class="col-md-3 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unit</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Unit" class="form-control form-control-sm"
                            name="unit" placeholder="Unit" value="<?='00'.$user->userUnit()->id.' - '.$user->userUnit()->unit_name?>" disabled readonly>
                    </div>

                    <div class="col-md-3 mb-1">
                        <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at me-1"></i> E-mail</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Email" class="form-control form-control-sm" name="email" value="<?=$user->email?>" disabled readonly>
                    </div>

                </div>

                <div class="row">

                <div class="col-md-2 mb-1">
                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Situação</strong></label>
                    <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                    data-bs-title="Categoria" class="form-control form-control-sm"
                    name="category" placeholder="Categoria" value="<?=$user->statusInput()?>" disabled readonly>
                </div>

                <div class="col-md-2 mb-1">
                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar4-week me-1"></i>Cadastro</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Cadastro" class="form-control form-control-sm" value="<?=date_fmt($user->created_at, 'd/m/Y')?>" disabled readonly>
                </div>  

                <div class="col-md-2 mb-1">
                    <label class="col-form-label col-form-label-sm text-<?=CONF_APP_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar2-x me-1"></i>Bloqueio</strong></label>
                        <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                            data-bs-title="Bloqueio" class="form-control form-control-sm" value="<?=date_fmt_null($user->blocked_at, 'd/m/Y')?>" disabled readonly>
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
                        data-bs-title=Observações" rows="3" disabled readonly><?=$user->observations?></textarea>
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