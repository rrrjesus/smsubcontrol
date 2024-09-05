<?= $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="<?=url("/painel")?>"><i class="bi bi-house-heart"></i> Painel</a></li>
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="<?=url("/usuarios")?>"><i class="bi bi-person"></i> Usuarios</a></li>
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-list"></i> <?php

 if(!empty($user->id)): echo "Editar ".$user->first_name; else : echo "Cadastrar"; endif;?></li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <?php if (!$user): ?>
        <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person pe-3"></i> <?=CONF_SITE_NAME?> - CADASTRAR USUÁRIO - <?=date("Y")?></div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/painel/usuarios/cadastrar"); ?>" method="post" enctype="multipart/form-data">
                                
                                <input type="hidden" name="action" value="create"/>
    
                                    <div class="ajax_response"></div>
    
                                    <?=csrf_input();?>
                                        
                                    <div class="row mb-1">
        
                                        <div class="col-md-1 app_formbox_photo mb-1">
                                            <div class="rounded-circle j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
                                        </div>
    
                                        <div class="col-md-4 mb-1">
                                            <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"> <strong><i class="bi bi-upload me-1"></i>  Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                            <input class="form-control form-control-sm" data-image=".j_profile_image" type="file" class="radius" name="photo"/>
                                        </div>
    
                                    </div>
    
                                    <div class="row">
    
                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputLogin"><strong><i class="bi bi-person me-1"></i> Login</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Login" class="form-control form-control-sm"
                                                name="login" placeholder="d123456">
    
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> RF</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Registro Funcional" class="form-control form-control-sm"
                                                name="rf" placeholder="d123456">
    
                                        </div>
    
                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Nome" class="form-control form-control-sm"
                                                name="first_name" placeholder="NOME">
    
                                        </div>
    
                                        <div class="col-md-5 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> SobreNome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Sobrenome" class="form-control form-control-sm"
                                                name="last_name" placeholder="SOBRENOME">
                                        </div>
    
                                    </div>
    
                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at me-1"></i> E-mail</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Email" class="form-control form-control-sm" name="email">
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Celular</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="phone" placeholder="(11)991065284">
                                        </div>
    
                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Situação</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Categoria" class="form-control form-control-sm"
                                            name="status" placeholder="Categoria" value="Registrado" disabled readonly>
                                        </div>
    
                                        <div class="col-md-5 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Cargo</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Cargo" class="form-control form-control-sm"
                                                name="position" placeholder="Cargo">
                                        </div>
    
                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Regime</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Regime" class="form-control form-control-sm"
                                            name="regime" placeholder="Regime">
                                        </div>
    
                                        <div class="col-md-5 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unidade</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Unidade" class="form-control form-control-sm"
                                                name="unidade" placeholder="Unidade">
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar4-week me-1"></i>Cadastro</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Cadastro" class="form-control form-control-sm">
                                        </div>  
    
                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar2-x me-1"></i>Bloqueio</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Bloqueio" class="form-control form-control-sm">
                                        </div>
    
                                    </div>
    
                                    <div class="row">
    
                                    
    
                                    <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock me-1"></i>Senha</strong></label>
                                            <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                name="password" placeholder="********">
                                        </div>  
    
                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><i class="bi bi-lock me-1"><strong></i>Repetir Senha</strong></label>
                                                <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                    name="password_re" placeholder="********">
                                        </div>  
    
                                    </div>
    
                                    <div class="row">   
                                        
                                        <div class="mb-3 mb-1">
                                            <label for="textareaObservacoes" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                            <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title=Observações" rows="3"></textarea>
                                        </div>

                                    </div>
    
    
                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para atualizar o colaborador" class="btn btn-sm btn-outline-success fw-bold me-3"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                            <a href="<?=url("/usuarios")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Clique para listar os usuarios" class="btn btn-sm btn-outline-info fw-bold text-dark">
                                                <i class="bi bi-list-columns me-2"></i>LISTAR</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="card mb-4">
                <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-qr-code pe-3"></i>   SISTEMA JAÇANA CONTROLE - 2024</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate action="<?= url("/painel/usuarios/editar/{$user->id}"); ?>" method="post" enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="action" value="update"/>
        
                                        <div class="ajax_response"></div>
        
                                        <?=csrf_input();?>
                                            
                                        <div class="row mb-1">
            
                                            <div class="col-md-1 app_formbox_photo mb-1">
                                                <div class="rounded-circle j_profile_image thumb" style="background-image: url('<?= $photo; ?>')"></div>
                                            </div>
        
                                            <div class="col-md-4 mb-1">
                                                <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"> <strong><i class="bi bi-upload me-1"></i>  Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                                <input class="form-control form-control-sm" data-image=".j_profile_image" type="file" class="radius" name="photo"/>
                                            </div>
        
                                        </div>
        
                                        <div class="row">
    
                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputLogin"><strong><i class="bi bi-person me-1"></i> Login</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Login" class="form-control form-control-sm"
                                                    name="login" placeholder="d123456" value="<?=$user->login?>">

                                            </div>

                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> RF</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Registro Funcional" class="form-control form-control-sm"
                                                    name="rf" placeholder="d123456" value="<?=$user->rf?>">

                                            </div>

                                            <div class="col-md-3 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-1"></i> Nome</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Nome" class="form-control form-control-sm"
                                                    name="first_name" placeholder="NOME" value="<?=$user->first_name?>">

                                            </div>

                                            <div class="col-md-5 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> SobreNome</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Sobrenome" class="form-control form-control-sm"
                                                    name="last_name" placeholder="SOBRENOME" value="<?=$user->last_name?>">
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-3 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at me-1"></i> E-mail</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Email" class="form-control form-control-sm" name="email" value="<?=$user->email?>">
                                            </div>

                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone me-1"></i> Celular</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o nome do celular" class="form-control form-control-sm" name="phone" placeholder="(11)991065284" value="<?=$user->phone?>">
                                            </div>

                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Situação</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Categoria" class="form-control form-control-sm"
                                                name="status" placeholder="Categoria" value="Registrado" value="<?=$user->status?>">
                                            </div>

                                            <div class="col-md-5 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-1"></i> Cargo</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Cargo" class="form-control form-control-sm"
                                                    name="position" placeholder="Cargo" value="<?=$user->userPosition()->position_name?>">
                                            </div>

                                            <div class="col-md-3 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCategoria"><strong><i class="bi bi-person-add me-1"></i> Regime</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Regime" class="form-control form-control-sm"
                                                name="regime" placeholder="Regime">
                                            </div>

                                            <div class="col-md-5 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><i class="bi bi-person-add me-1"></i><strong>Unidade</strong></label>
                                                <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Unidade" class="form-control form-control-sm"
                                                    name="unidade" placeholder="Unidade">
                                            </div>

                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar4-week me-1"></i>Cadastro</strong></label>
                                                    <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                        data-bs-title="Cadastro" class="form-control form-control-sm">
                                            </div>  

                                            <div class="col-md-2 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-calendar2-x me-1"></i>Bloqueio</strong></label>
                                                    <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                        data-bs-title="Bloqueio" class="form-control form-control-sm">
                                            </div>

                                        </div>

                                        <div class="row">



                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock me-1"></i>Senha</strong></label>
                                                <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                    data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                    name="password" placeholder="********">
                                            </div>  

                                            <div class="col-md-3 mb-1">
                                                <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><i class="bi bi-lock me-1"><strong></i>Repetir Senha</strong></label>
                                                    <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                        data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                        name="password_re" placeholder="********">
                                            </div>  

                                        </div>

                                        <div class="row">   
                                            
                                            <div class="mb-3 mb-1">
                                                <label for="textareaObservacoes" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-exclamation-diamond me-1"></i><strong>Observações</strong></label>
                                                <textarea class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title=Observações" rows="3"></textarea>
                                            </div>
                                            
                                        </div>
        
        
                                        <div class="row justify-content-center mt-4 mb-3">
                                            <div class="col-auto">
                                                <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Clique para atualizar o colaborador" class="btn btn-sm btn-outline-success fw-bold me-3"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                                <a href="<?=url("/usuarios")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Clique para listar os usuarios" class="btn btn-sm btn-outline-info fw-bold text-dark">
                                                    <i class="bi bi-list-columns me-2"></i>LISTAR</a>
                                                <button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Clique para excluir <?=$user->first_name?>" class="btn btn-outline-danger fw-bold btn-sm ms-3" data-bs-toggle="modal" 
                                                    data-bs-target="#trashModal<?=$user->id?>"><i class="bi bi-trash me-2"></i>EXCLUIR</button>
                                            </div>
                                        </div>
                                    </form>
                                <?= $this->insert("views/modalUser"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php  endif; ?>
    </div>
</div>
