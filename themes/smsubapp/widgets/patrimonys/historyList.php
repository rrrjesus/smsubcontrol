
                <table id="historyPatrimony" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_APP_COLOR?>">
                        <tr>
                            <th class="text-center">CRIADO</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">RF</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">TERMO</th>
                            <th class="text-center">TERMO ASS</th>
                            <th class="text-center">UNIDADE</th>
                            <th class="text-center">OBSERVACOES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($historico)){ ?>
                    <?php foreach ($historico as $lista): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?=date_fmt_null($lista->updated_at)?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->user_name) ? $lista->userPatrimony()->user_name : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->rf) ?$lista->userPatrimony()->rf : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->email) ? $lista->userPatrimony()->email : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->termList();?></td>
                            <td class="text-center"><?=$lista->fileList()?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->observations?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>

</div>     


