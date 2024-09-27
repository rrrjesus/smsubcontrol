<?php $this->layout("_beta"); ?>

<!-- Breacrumb-->
<?= $this->insert("views/theme/breadcrumb"); ?>
<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                <div class="col-12">
                
                    <?=flash();?>
                    
                    <table id="patrimonysHistory" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?> p-2" style="width:100%">
                        <thead class="table-<?=CONF_APP_COLOR?>">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">ID PAT</th>
                                <th class="text-center">ENTRADA</th>
                                <th class="text-center">ESTADO</th>
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
                                <th class="text-center">OBSERVACOES</th>
                                <th class="text-center">TERMO</th>
                                <th class="text-center">ANEXO</th>
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


