<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>


                <div class="row justify-content-center mt-4 mb-3">
                    <div class="col-auto">
                    <?=buttonLink("/beta/patrimonios/cadastrar", "top", "Clique para cadastrar patrimônio", "success", "building-add", "Cadastrar")?> 
                    </div>
                </div>
            
                <?=flash();?>
                <table id="patrimonio" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_APP_COLOR?>">
                        <tr>
                            <th class="text-center">EDITAR</th>
                            <th class="text-center">ENTRADA</th>
                            <th class="text-center">IMEI</th>
                            <th class="text-center">NS</th>
                            <th class="text-center">MARCA</th>
                            <th class="text-center">MODELO</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">LOGIN</th>
                            <th class="text-center">RF</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">UNIDADE</th>
                            <th class="text-center">RESPONSAVEL UN.</th>
                            <th class="text-center">TELEFONE UN.</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($patrimonys as $lista): ?>
                        <tr>
                            <td class="text-center fw-semibold"><a href="<?= url("/beta/patrimonio/editar/{$lista->id}"); ?>" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para editar" class="btn btn-sm btn-outline-warning rounded-circle fw-bold me-2"><i class="bi bi-pencil text-secondary"></i></a></td>
                            <td class="text-center fw-semibold"><?=date_fmt_null($lista->created_at)?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->imei ) ? $lista->imei : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->ns)? $lista->ns : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->productBrand($lista->product()->brand_id)->brand_name;?></td>
                            <td class="text-center fw-semibold"><?=$lista->product()->product_name?></td>
                            <td class="text-center fw-semibold"><?=$lista->userPatrimony()->user_name?></td>
                            <td class="text-center fw-semibold"><?=$lista->userPatrimony()->login?><?=$lista->statusBadgeUser($lista->userPatrimony()->status)?></td>
                            <td class="text-center fw-semibold"><?=$lista->userPatrimony()->rf?></td>
                            <td class="text-center fw-semibold"><?=$lista->userPatrimony()->email?></td>
                            <td class="text-center fw-semibold"><?=$lista->unit()->unit_name;?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->it_professional) ? $lista->unit()->it_professional : "Não Cadastrado");?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->telephone) ? $lista->unit()->telephone : "");?></td>
                            <td class="text-center fw-semibold"><?=$lista->statusBadge()?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

</div>     


