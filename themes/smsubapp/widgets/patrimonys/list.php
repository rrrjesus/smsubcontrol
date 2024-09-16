<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>


                <div class="row justify-content-center mt-4 mb-3">
                    <div class="col-auto">
                    <?=buttonLink("/beta/patrimonios/cadastrar", "top", "Clique para cadastrar patrimônio", "success", "building-add", "Cadastrar")?> 
                    <?php if(!empty($registers->disabled)){ ?>
                        <?=buttonLink("/beta/patrimonios/desativados", "top", "Clique para listar os patrimônios desativados", "secondary", "building-add", "Desativados<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>".$registers->disabled."</span>")?> 
                    <?php } ?>
                    </div>
                </div>
            
                <?=flash();?>
                
                <table id="patrimonys" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?> p-2" style="width:100%">
                    <thead class="table-<?=CONF_APP_COLOR?>">
                        <tr>
                            <th class="text-center">EDITAR</th>
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
                            <th class="text-center">OBSERVACOES</th>
                            <th class="text-center">TERMO</th>
                            <th class="text-center">ANEXO</th>
                            <th class="text-center">DESATIVAR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($patrimonys as $lista): ?>
                        <tr>
                            <td class="text-center fw-semibold"><a href="<?= url("/beta/patrimonios/editar/{$lista->id}"); ?>" role="button" aria-disabled="true" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Clique para editar" class="btn btn-sm btn-outline-warning rounded-circle fw-bold me-2"><i class="bi bi-pencil text-secondary"></i></a></td>
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
                            <td class="text-center fw-semibold"><?=$lista->observations?></td>
                            <td class="text-center fw-semibold"><?=$lista->termList();?></td>
                            <td class="text-center"><?=$lista->fileList()?></td>
                            <td class="text-center fw-semibold"><?=$lista->id?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

</div>     


