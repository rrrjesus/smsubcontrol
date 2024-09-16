<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-12 ml-auto text-center">
                    <?=buttonLink("/beta/patrimonios", "top", "Clique para sair", "danger", "arrow-right-circle", "Sair")?> 
                    </div>
                </div>
            
                <?=flash();?>
                <table id="disabledPatrimony" class="table table-hover table-bordered table-sm border-warning p-2" style="width:100%">
                    <thead class="table-warning">
                        <tr>
                            <th class="text-center">ENTRADA</th>
                            <th class="text-center">TIPO PN</th>
                            <th class="text-center">PARTNUMBER</th>
                            <th class="text-center">MARCA</th>
                            <th class="text-center">MODELO</th>
                            <th class="text-center">NOME</th>
                            <th class="text-center">LOGIN</th>
                            <th class="text-center">RF</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">UNIDADE</th>
                            <th class="text-center">RESPONSAVEL UN.</th>
                            <th class="text-center">TELEFONE UN.</th>
                            <th class="text-center">ATIVAR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($patrimonys)){ ?>
                    <?php foreach ($patrimonys as $lista): ?>
                        <tr>
                            <td class="text-center fw-semibold"><?=date_fmt_null($lista->created_at)?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->type_part_number ) ? $lista->type_part_number : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->part_number)? $lista->part_number : "")?></td>
                            <td class="text-center fw-semibold"><?=$lista->productBrand($lista->product()->brand_id)->brand_name;?></td>
                            <td class="text-center fw-semibold"><?=$lista->product()->product_name?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->user_name) ? $lista->userPatrimony()->user_name : "")?></td>
                            <td class="text-center fw-semibold">
                            <?php
                            if(!empty($lista->user_id)):
                                echo $lista->userPatrimony()->login.' '.$lista->statusBadgeUser($lista->userPatrimony()->status);
                            else:
                                echo '';
                            endif;
                            ?>
                            </td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->rf) ?$lista->userPatrimony()->rf : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->userPatrimony()->email) ? $lista->userPatrimony()->email : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "")?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->it_professional) ? $lista->unit()->it_professional : "Não Cadastrado");?></td>
                            <td class="text-center fw-semibold"><?=(!empty($lista->unit()->telephone) ? $lista->unit()->telephone : "");?></td>
                            <td class="text-center fw-semibold"><?=$lista->id?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php }else{redirect("/beta/patrimonios");} ?>
                    </tbody>
                </table>

</div>     


