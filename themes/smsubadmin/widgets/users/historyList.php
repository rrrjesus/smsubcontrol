
                <table id="historyPatrimony" class="table table-hover table-bordered table-sm border-<?=CONF_ADMIN_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_ADMIN_COLOR?>">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">CRIADO</th>
                            <th class="text-center">PATRIMONIO</th>
                            <th class="text-center">TIPO</th>
                            <th class="text-center">SERIAL</th>
                            <th class="text-center">RF</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">TERMO</th>
                            <th class="text-center">TERMO ASS</th>
                            <th class="text-center">UNIDADE</th>
                            <th class="text-center">OBSERVACOES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($userhistory)){ ?>
                    <?php foreach ($userhistory as $lista): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?=$lista->id?></td>
                            <td class="text-center fw-semibold"><?=date_fmt_null($lista->created_history)?></td>
                            <td class="text-center fw-semibold"><?=$lista->product()->product_name?></td>
                            <td class="text-center fw-semibold"><?=$lista->type_part_number?></td>
                            <td class="text-center fw-semibold"><?=$lista->part_number?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->rf) ? $lista->userPatrimony()->rf : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->user_name) ? $lista->userPatrimony()->user_name : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->termlistUser();?></td>
                            <td class="text-center"><?=$lista->fileList()?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->observations?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>


