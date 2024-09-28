
                <table id="historyPatrimony" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_APP_COLOR?>">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">CRIADO</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">LOGIN</th>
                            <th class="text-center">RF</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">CEL</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">TERMO</th>
                            <th class="text-center">TERMO ASS</th>
                            <th class="text-center">UNIDADE</th>
                            <th class="text-center">OBSERVACOES</th>
                            <th class="text-center">EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($historico)){ ?>
                    <?php foreach ($historico as $lista): ?>
                        <tr>
                            <td class="text-center"><a role="button" href="<?=url("beta/patrimonios/historico/editar/{$lista->id}")?>" class="btn btn-warning rounded-circle btn-sm fw-semibold text-"><i class="bi bi-pencil text-secondary"></i></a></td>
                            <td class="text-center fw-semibold"><?=date_fmt_null($lista->created_history)?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->movement()->movement_name) ? $lista->movement()->movement_name : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->login) ? $lista->userPatrimony()->login : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->rf) ? $lista->userPatrimony()->rf : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->user_name) ? $lista->userPatrimony()->user_name : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->cell_phone) ? '('.substr($lista->userPatrimony()->cell_phone, 0, 2).')'.substr($lista->userPatrimony()->cell_phone, 2, 9) : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->email) ? $lista->userPatrimony()->email : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->termList();?></td>
                            <td class="text-center"><?=$lista->fileList()?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->observations?></td>
                            <td class="text-center"><button type="button" data-bs-togglee="modal" data-bs-toggle="modal" data-bs-target="#trash-<?=$lista->id;?>" 
                                class="btn btn-outline-danger rounded-circle btn-sm text-center"><i class="bi bi-trash"></i></b></td>
                                    <!-- Modal -->
                                <div class="modal fade" id="trash-<?=$lista->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header bg-danger text-light">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-trash me-2"></i> EXCLUIR <?=$lista->id;?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body fs-5 text-center">
                                            Deseja excluir o histórico id: <?=$lista->id?> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger fw-semibold" data-bs-dismiss="modal">Não</button>
                                            <a href="../historico/excluir/<?=$lista->id?>/delete" role="button" class="btn btn-outline-success fw-semibold">Sim</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </tr>
                        <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>


