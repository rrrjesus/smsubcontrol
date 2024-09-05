<?= $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_ADMIN_COLOR?>" href="<?=url("/painel")?>"><i class="bi bi-house-heart"></i> Painel</a></li>
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_ADMIN_COLOR?>" href="<?=url("/usuarios")?>"><i class="bi bi-person"></i> Usuarios</a></li>
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-list"></i> <?php

                                                                                                                                        use Source\App\Admin\Collaborators;
                                                                                                                                        use Source\Models\Collaborator;

 if(!empty($user->id)): echo "Editar ".$user->first_name; else : echo "Cadastrar"; endif;?></li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <?php if (!$user): ?>
        <div class="card mb-4">
        <div class="card-header text-center fw-bold fs-6 pt-1 pb-1 text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-qr-code pe-3"></i>   SISTEMA JAÇANA CONTROLE - 2024</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate id="user-register" action="<?=url("/painel/usuarios/adicionar")?>" method="post" enctype="multipart/form-data">

                                    <!-- ACTION SPOOFING-->
                                    <input type="hidden" name="action" value="create"/>

                                    <div class="row justify-content-center mb-3 mt-3">
                                        <div class="ajax_response col-xl-12 col-md-12">
                                            <?=flash();?>
                                        </div>
                                    </div>

                                    <?=csrf_input();?>

                                    <div class="row mb-1">
                                        <div class="col-md-1 mb-1">
                                            <a href="../themes/painel/assets/images/padrao.jpg" target="_blank">
                                                <img  height="90" width="90" src="../themes/painel/assets/images/padrao.jpg" class="img-thumbnail rounded-circle float-left" height="190" width="150" id="foto-cliente">
                                            </a>
                                        </div>
                                        <div class="col-md-5 mb-1">
                                            <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"> <strong> Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                            <input class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Selecione o arquivo da foto" name="photo" id="photo" value="photo" type="file">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-3 ms-3"></i> Nome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o nome do Colaborador" class="form-control form-control-sm"
                                                name="first_name" placeholder="NOME" id="first_name" onchange="upperCaseF(this)" autofocus>

                                        </div>

                                        <div class="col-md-4 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-3 ms-3"></i> SobreNome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o sobrenome do Colaborador" class="form-control form-control-sm"
                                                name="last_name" placeholder="SOBRENOME" id="last_name" onchange="upperCaseF(this)">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone ms-3 me-3"></i> Celular</strong></label>
                                            <input type="number" maxlength="11" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o nome do celular" class="form-control form-control-sm"
                                                id="phone" name="phone" placeholder="(11)991065284">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at ms-3 me-3"></i> E-mail</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o email" class="form-control form-control-sm"
                                                name="email" placeholder="exemplo@exemplo.com.br">
                                        </div>  

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Igreja</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Selecione a Igreja" name="churche_id" id="churche_id">
                                                <?=(new \Source\Models\Churche())->selectChurcheId()?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSetor"><strong><i class="bi bi-people ms-3 me-3"></i> Nivel</strong></label>    
                                        <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Selecione o level" name="level_id" id="level_id">
                                                <?=(new \Source\Models\Level())->selectLevelId()?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock ms-3 me-3"></i> Senha</strong></label>
                                            <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                name="password" placeholder="********">
                                        </div>  

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputStatus"><strong><i class="bi bi-check2-square ms-3 me-3"></i> Status</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Selecione Ativo ou Inativo" name="status" id="status">
                                                <option value="registered" selected>Registrado</option>
                                                <option value="confirmed">Confirmado</option>
                                                <option value="disable">Desabilitado</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row justify-content-center mt-4 mb-3">
                                        <div class="col-auto">
                                            <button data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Clique para gravar" class="btn btn-sm btn-outline-success fw-bold me-3"><i class="bi bi-disc-fill me-1"></i> GRAVAR</button>
                                            <a href="<?=url("/usuarios")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                               data-bs-title="Clique para listar as pessoas" class="btn btn-sm btn-outline-info fw-bold"><i class="bi bi-list-columns me-2"></i>LISTAR</a>
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
                            <form class="row gy-2 gx-3 align-items-center needs-validation" novalidate id="user-edit" action="<?=url("/painel/usuarios/editar/{$user->id}")?>" method="post" enctype="multipart/form-data">

                                <!-- ACTION SPOOFING-->
                                <input type="hidden" name="action" value="update"/>

                                <div class="row justify-content-center mb-3 mt-3">
                                    <div class="ajax_response col-xl-12 col-md-12">
                                        <?=flash();?>
                                    </div>
                                </div>

                                <?=csrf_input();?>

                                    <div class="row mb-1">
                                        <div class="col-md-1 mb-1">
                                            <a href="<?php if (file_exists($user->photo)) {echo '../../'.$user->photo;} 
                                                else {echo '../../themes/painel/assets/images/padrao.jpg';}?>" target="_blank">
                                            <img data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Foto" height="90" width="90" src="<?php if (file_exists($user->photo)) 
                                                {echo '../../'.$user->photo;} else{echo '../../themes/painel/assets/images/padrao.jpg';}?>" class="img-thumbnail rounded-circle float-left" height="190" width="150" id="foto-cliente">
                                            </a>
                                        </div>
                                        <div class="col-md-5 mb-1">
                                            <label for="formFileSm" class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>"> <strong> Extensões aceitas : .bmp ,.png, .svg, .jpeg e .jpg </strong></label>
                                            <input data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Clique para carregar o arquivo" class="form-control form-control-sm" name="photo" id="photo" value="<?=$user->photo?>" type="file">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputNome"><strong><i class="bi bi-person me-3 ms-3"></i> Nome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o nome do Colaborador" class="form-control form-control-sm"
                                                name="first_name" placeholder="NOME" id="first_name" value="<?=$user->first_name?>" onchange="upperCaseF(this)" autofocus>

                                        </div>

                                        <div class="col-md-4 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSobreNome"><strong><i class="bi bi-person-add me-3 ms-3"></i> SobreNome</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o sobrenome do Colaborador" class="form-control form-control-sm"
                                                name="last_name" placeholder="SOBRENOME" id="last_name" value="<?=$user->last_name?>"
                                                onchange="upperCaseF(this)">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputCelular"><strong><i class="bi bi-phone ms-3 me-3"></i> Celular</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Digite o nome do celular" class="form-control form-control-sm"
                                                id="phone" name="phone" value="<?=$user->phone?>" placeholder="(11)991065284">
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputEmail"><strong><i class="bi bi-envelope-at ms-3 me-3"></i> E-mail</strong></label>
                                            <input type="text" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o email" class="form-control form-control-sm"
                                                name="email" value="<?=$user->email?>" placeholder="exemplo@exemplo.com.br">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSetor"><strong><i class="bi bi-building ms-3 me-3"></i> Igreja</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a Igreja" name="churche_id" id="churche_id">
                                                <?=(new \Source\Models\Churche())->selectChurcheId()?>
                                                <option value="<?=$user->churche()->id?>" selected><?=$user->unit()->churche_name?></option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSetor"><strong><i class="bi bi-people ms-3 me-3"></i> Nivel</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite o level" name="level_id" id="level_id">
                                                <?=(new \Source\Models\Level())->selectLevelId()?>
                                                <option value="<?=$user->level()->id?>" selected><?=$user->level()->level_nome?></option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-1">
                                            <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputStatus"><strong><i class="bi bi-check2-square ms-3 me-3"></i> Status</strong></label>
                                            <select class="form-control form-control-sm" data-bs-togglee="tooltip" title="Ex: ATIVO/INATIVO"
                                                    name="status" id="status">                                                
                                                <?=$user->statusSelected()?>
                                            </select>
                                            
                                        </div>

                                        <div class="col-md-3 mb-1">
                                        <label class="col-form-label col-form-label-sm text-<?=CONF_ADMIN_COLOR?>" for="inputSenha"><strong><i class="bi bi-lock ms-3 me-3"></i>Alterar Senha</strong></label>
                                            <input type="password" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                                data-bs-title="Digite a senha" class="form-control form-control-sm"
                                                name="password" placeholder="********">
                                        </div>  
                                    </div>


                                <div class="row justify-content-center mt-4 mb-3">
                                    <div class="col-auto">
                                        <button data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para atualizar o colaborador" class="btn btn-sm btn-outline-success fw-bold me-3"><i class="bi bi-disc-fill me-2"></i>GRAVAR</button>
                                        <a href="<?=url("/usuarios")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para listar os usuarios" class="btn btn-sm btn-outline-info fw-bold text-dark">
                                            <i class="bi bi-list-columns me-2"></i>LISTAR</a>
                                            <a href="<?=url("/painel/usuarios/identidade/{$user->id}")?>" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Clique para imprimir crachá" class="btn btn-sm btn-outline-secondary fw-bold ms-3">
                                            <i class="bi bi-qr-code me-2"></i>CRACHA</a>
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
