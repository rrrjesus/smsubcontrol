<?php $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-danger" href="<?=url("/dashboard")?>"><i class="bi bi-house-door"></i> Lista</a></li>
            <li class="breadcrumb-item fw-semibold active text-danger" aria-current="page"><i class="bi bi-person"></i> Usuários Desativados</li>
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
                               data-bs-title="Clique para cadastrar novo colaborador" class="btn btn-outline-danger btn-sm me-3 fw-semibold" href="<?=url("/painel/usuarios")?>"
                               role="button"><i class="bi bi-arrow-right-circle me-2 mt-1"></i>Sair</a>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <table id="usersDisabled" class="table table-bordered table-sm border-danger table-hover" style="width:100%">
                                <thead class="table-danger">
                                <tr>
                                    <th class="text-center text-danger"><i class="bi bi-unlock me-1"></i><br>ID</th>
                                    <th class="text-center text-danger"><i class="bi bi-pencil me-1"></i><br>EDITAR</th>
                                    <th class="text-center text-danger"><i class="bi bi-person-circle me-1"></i><br>FOTO</th>
                                    <th class="text-center text-danger"><i class="bi bi-person me-1"></i><br>NOME</th>
                                    <th class="text-center text-danger"><i class="bi bi-person me-1"></i><br>SOBRENOME</th>
                                    <th class="text-center text-danger"><i class="bi bi-building me-1"></i><br>COMUM</th>
                                    <th class="text-center text-danger"><i class="bi bi-envelope-at me-1"></i><br>EMAIL</th>
                                    <th class="text-center text-danger"><i class="bi bi-envelope-at me-1"></i><br>STATUS</th>
                                    <th class="text-center text-danger"><i class="bi bi-person me-1"></i><br>NIVEL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($users)){ ?>
                                <?php foreach ($users as $lista): ?>
                                    <tr>
                                        <td class="text-center text-danger"><?=$lista->id?></td>
                                        <td class="text-center"><a href="<?=url("/painel/usuarios/editar/{$lista->id}")?>" data-bs-togglee="tooltip" 
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
                                        
                                        <td class="text-center text-danger"><?=$lista->first_name?></td>
                                        <td class="text-center text-danger"><?=$lista->last_name?></td>
                                        <?php
                                            if(!empty($lista->churche_id) && $lista->churche()->status == "actived"):
                                                echo '<td class="text-center text-danger">'.$lista->churche()->churche_name.'</td>';
                                            else:
                                                echo '<td class="text-center text-danger"><del>'.$lista->churche()->churche_name.'<del></td>';
                                            endif;
                                            ?>
                                        <td class="text-center text-danger"><?=$lista->email?></td>
                                        <?php
                                            if(!empty($lista->status == 'disabled')):
                                                echo '<td class="text-center"><span class="badge fw-semibold text-bg-danger pt-2 pb-2 mt-2" data-bs-togglee="tooltip" 
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Foi desativado">
                                                            DESATIVADO</span></td>';
                                            else:
                                                echo '<td class="text-center"><span class="badge fw-semibold text-bg-warning pt-2 pb-2 mt-2" data-bs-togglee="tooltip" 
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Verificar ...">
                                                            ???</span></td>';
                                            endif;
                                            ?>
                                        <?php
                                            if(!empty($lista->level_id)):
                                                echo '<td class="text-center text-danger">'.$lista->level()->level_name.'</td>';
                                            else:
                                                echo '<td class="text-center text-danger"><del>'.$lista->level()->level_name.'<del></td>';
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