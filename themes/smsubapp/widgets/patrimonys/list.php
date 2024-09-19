<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>
<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">

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
                                <th class="text-center">CEL</th>
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
                        <tbody class="text-center">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>     


