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
                            <th class="text-center">ESTADO</th>
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
                            <th class="text-center">OBSERVAÇÕES</th>
                            <th class="text-center">ATIVAR</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                    </tbody>
                </table>

</div>     


