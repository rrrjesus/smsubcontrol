<?php $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_ADMIN_COLOR?>" href="<?=url("/dashboard")?>"><i class="bi bi-house-door"></i> Lista</a></li>
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-person"></i> Colaboradores</li>
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
                               data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/painel/colaboradores/adicionar")?>"
                               role="button"><i class="bi bi-telephone-plus me-2 mt-1"></i>Adicionar</a>
                            <?php if(!empty($registers->disabled)){ ?>
                                <a role="button" href="<?=url("/colaboradores/desativados")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                   data-bs-title="Clique para acessar colaboradores desativados" class="btn btn-outline-secondary btn-sm position-relative fw-semibold mt-1"><i class="bi bi-telephone-x text-danger me-2 mt-1">
                                    </i> Desativados<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$registers->disabled?></span></a>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <table id="collaborators" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                                <thead class="table-secondary">
                                <tr>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-unlock me-1"></i><br>ID</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-pencil me-1"></i><br>EDITAR</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person-circle me-1"></i><br>FOTO</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-qr-code me-1"></i><br>CRACHA</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-people me-1"></i><br>GRUPO</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-building me-1"></i><br>COMUM</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-person me-1"></i><br>NOME</th>
                                    <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-envelope-at me-1"></i><br>EMAIL</th>
                                </tr>
                                </thead>
                                <tbody>
                    <?php if(!empty($registers->actived)){ ?>
                    <?php foreach ($collaborators as $lista): ?>
                        <tr>
                            <td class="text-center"><?=$lista->id?></td>
                            <td class="text-center"><?=$lista->id?></td>
                            <?php
                            if(!empty($lista->photo)):
                                echo '<td class="text-center">'.$lista->photo.'</td>';
                            else:
                                echo '<td class="text-center">themes/painel/assets/images/padrao.jpg</td>';
                            endif;
                            ?>
                            <td class="text-center"><a href="colaboradores/identidade/<?=$lista->id?>" data-bs-togglee="tooltip" 
                                data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Clique para exibir identificador" 
                                class="btn btn-outline-secondary rounded-circle btn-sm text-center"><i class="bi bi-qr-code"></i></a>
                            </td>
                            <?php
                            if(!empty($lista->group_id) && $lista->group()->status == "actived"):
                                echo '<td class="text-center">'.$lista->group()->group_name.'</span></td>';
                            else:
                                echo '<td class="text-center"><del>'.$lista->group()->group_name.'</span></td>';
                            endif;
                            ?>
                            <?php
                            if(!empty($lista->churche_id) && $lista->churche()->status == "actived"):
                                echo '<td class="text-center">'.$lista->churche()->churche_name.'</td>';
                            else:
                                echo '<td class="text-center text-danger"><del>'.$lista->churche()->churche_name.'<del></td>';
                            endif;
                            ?>
                            <td class="text-center"><?=$lista->first_name.' '.$lista->last_name?></td>
                            <td class="text-center"><?=$lista->email?></td>
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