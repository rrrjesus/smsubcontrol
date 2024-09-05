<?php $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_ADMIN_COLOR?>" href="<?=url("/dashboard")?>"><i class="bi bi-house-door"></i> Lista</a></li>
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-person"></i> Usuários</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card mb-4 border-secondary">
            <div class="card-body">
                <div class="container-fluid">

                    <div class="row justify-content-center">
                        <div class="col-12 ajax_response">
                            <?=flash();?>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-12 ml-auto text-center">
                            <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
                               data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/painel/usuarios/adicionar")?>"
                               role="button"><i class="bi bi-telephone-plus me-2 mt-1"></i>Adicionar</a>
                            <?php if(!empty($registers->disabled)){ ?>
                                <a role="button" href="<?=url("/painel/usuarios/desativados")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                   data-bs-title="Clique para acessar usuarios desativados" class="btn btn-outline-secondary btn-sm position-relative fw-semibold"><i class="bi bi-telephone-x text-danger me-2 mt-1">
                                    </i> Desativados<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$registers->disabled?></span></a>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <table id="users" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                                <thead class="table-secondary">
                                <tr>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-unlock me-1"></i><br>ID</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person-gear me-1"></i><br>GERENCIAR</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person-circle me-1"></i><br>FOTO</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person me-1"></i><br>NOME</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person me-1"></i><br>SOBRENOME</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-building me-1"></i><br>UNIDADE</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-envelope-at me-1"></i><br>EMAIL</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-envelope-at me-1"></i><br>STATUS</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person me-1"></i><br>NIVEL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($registers->actived)){ ?>
                                <?php foreach ($users as $lista): ?>
                                    <tr>
                                        <td class="text-center"><?=$lista->id?></td>
                                        <td class="text-center"><a href="usuarios/editar/<?=$lista->id?>" data-bs-togglee="tooltip" 
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Clique para editar <?=$lista->first_name?>" role="button" 
                                            class="btn btn-info rounded-circle btn-md text-center">
                                            <i class="bi bi-person-gear text-dark"></i></a></td>
                                            <?php
                                                if(!empty($lista->photo)):
                                                    echo '<td class="text-center"><a href="'.$lista->photo.'" target="_blank">
                                                        <img src="'.$lista->photo.'" class="img-thumbnail rounded-circle float-left" height="40" 
                                                        width="40"></a></td>';
                                                else:
                                                    echo '<td class="text-center"><a href="themes/painel/assets/images/padrao.jpg" target="_blank">
                                                    <img src="themes/painel/assets/images/padrao.jpg" class="img-thumbnail rounded-circle float-left" height="40" 
                                                    width="40"></a></td>';
                                                endif;
                                            ?>                                      
                                        
                                        <td class="text-center"><?=$lista->first_name?></td>
                                        <td class="text-center"><?=$lista->last_name?></td>
                                        <td class="text-center fw-semibold"><?=(!empty($lista->userUnit()->unidade_nome) ? $lista->userUnit()->unidade_nome : "")?></td>
                                        <td class="text-center"><?=$lista->email?></td>
                                        <?php
                                            switch ($lista->status) {
                                                case 'registered':
                                                    echo '<td class="text-center"><span class="badge fw-semibold text-bg-warning pt-2 pb-2 mt-2" data-bs-togglee="tooltip" 
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Falta acesso ao e-mail de confirmação">
                                                            REGISTRADO</span></td>';
                                                    break;
                                                case 'confirmed':
                                                    echo '<td class="text-center"><span class="badge fw-semibold text-bg-success pt-2 pb-2 mt-2" data-bs-togglee="tooltip" 
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Usuário confirmou">CONFIRMADO</span></td>';
                                                    break;
                                                default:
                                                    echo '<td class="text-center"><span class="badge fw-semibold text-bg-danger pt-2 pb-2 mt-2">???</span></td>';
                                            }
                                        ?>
                                        <?php
                                            if(!empty($lista->level_id)):
                                                echo '<td class="text-center">'.$lista->level()->level_nome.'</td>';
                                            else:
                                                echo '<td class="text-center text-danger"><del>'.$lista->level()->level_nome.'<del></td>';
                                            endif;
                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>