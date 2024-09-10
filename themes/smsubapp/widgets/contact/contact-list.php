<?= $this->layout("dashboard", ["head" => $head]); ?>

<div class="container-fluid">
    <div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-danger" href="<?=url("")?>"><i class="bi bi-house-door"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-danger" href="<?=url("/dashboard/listar-contatos")?>"><i class="bi bi-telephone"></i> Contatos</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-list"></i> Lista de Contatos</li>
            </ol>
        </nav>
    </div>

    <div class="pricing-header p-3 pb-md-2 mx-auto text-center">
        <p class="fs-3 fw-normal text-body-emphasis"><i class="bi bi-book-half me-2"></i> Lista de contatos SMSUB</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 ajax_response">
            <?=flash();?>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-12 ml-auto text-center">
            <a data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
               data-bs-title="Clique para cadastrar novo contato" class="btn btn-outline-success btn-sm me-3 fw-semibold" href="<?=url("/dashboard/cadastrar-contato")?>"
               role="button"><i class="bi bi-telephone-plus me-2"></i>Novo</a>
            <?php if(!empty($lixo)){ ?>
            <a role="button" href="<?=url("/dashboard/lixeira-contatos")?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                data-bs-title="Clique para acessar a lixeira de contatos" class="btn btn-outline-secondary btn-sm position-relative fw-semibold"><i class="bi bi-trash-fill text-danger me-2">
                    </i> Lixo<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?=$lixo?></span></a>
            <?php } ?>

        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-12">
            <table id="contactApp" class="table table-hover table-striped table-sm table-bordered border-danger" style="width:100%">
                <thead class="table-danger">
                <tr>
                    <th class="text-center">EDITAR</th>
                    <th class="text-center">SETOR</th>
                    <th class="text-center">NOME</th>
                    <th class="text-center">RAMAL</th>
                    <th class="text-center">EDITADO EM:</th>
                    <th class="text-center">LIXEIRA</th>
                    <th class="text-center">DEFINITIVO?</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($contactlista as $lista): ?>
                    <tr>
                        <td class="text-center"><?=$lista->id?></td>
                        <?php if(!empty($lista->sector) && $lista->sector()->status == "post"):
                            echo '<td class="text-center">'.$lista->sector()->sector_name;
                               else:
                            echo '<td class="text-center text-danger">
                                    <button type="button" class="btn btn-outline-success btn-sm rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#trashModal">
                                        <i class="bi bi-arrow-counterclockwise"></i></button>
                                        <div class="modal fade" id="trashModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary text-light">
                                                        <h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-trash me-2"></i> Setor '.$lista->sector()->sector_name.'</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body fw-semibold">Deseja reativar o setor : '.$lista->sector()->sector_name.' ?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>
                                                        <a href="reativar-setor/'.$lista->sector.'" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <del>'.$lista->sector()->sector_name.'<del>';
                        endif;
                        ?></td>
                        <td class="text-center"><?=$lista->collaborator?></td>
                        <td class="text-center"><?=$lista->ramal?></td>
                        <td class="text-center"><?=date('d/m/Y H\hi', strtotime($lista->updated_at))?></td>
                        <td class="text-center"><?=$lista->id?></td>
                        <td class="text-center"><?=$lista->id?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


