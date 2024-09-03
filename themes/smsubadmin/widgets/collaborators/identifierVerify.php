<?= $this->layout("_admin"); ?>


    <div class="row mb-0 justify-content-center">
        <div class="col-6 mb-0 text-center">
            <p class="display-1 text-dark" style="font-size: 80px;font-weight: 900">CCB</p>
        </div>
    </div>

            <div class="row mb-2 ms-2 justify-content-center">
                <div class="col-2 text-center">
                    <img height="125" width="105"
                    <?php
                    if(!empty($collaborator->photo)):
                        echo 'src="../../'.$collaborator->photo.'" class="img">';
                    else:  
                        echo 'src="themes/painel/assets/images/padrao.jpg" class="img">';
                    endif;
                    ?>
                </div>
                <div class="col-7 text-center">
                    <p class="h6 text-dark fw-bold mt-0 mb-0 ms-2">PROJETO RESGATE <?=$collaborator->adm?></p>
                    <p class="h6 text-dark ms-2 mt-0 mb-0" style="font-size: 40px;font-weight: 500"><?=$collaborator->first_name?></p>
                    <p class="h6 text-dark mt-0 mb-0 ms-2" style="font-size: 20px;font-weight: 800">GT </p>
                    <p class="h6 text-secondary mt-0 mb-0 ms-2" style="font-size: 40px;font-weight: 900"><?=date('Y')?></p>
                </div>

            </div>

            <div class="row mb-0 mt-0 justify-content-center">
                <div class="col-7 mb-0 text-center">
                    <p class="text-dark fw-bold" style="font-size: 0.60rem">"Atividade de caráter voluntário não gerando vínculo de qualquer espécie"</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-7 mb-0 text-center">
                    <p class="h6 text-dark fw-bold ms-4">Congregação Cristã no Brasil</p>
                    <p class="h6 text-dark fw-bold ms-4">Setor 11 - <?=$collaborator->churche_id?></p>
                </div>
            </div>
            <div class="row mb-0 mt-0 justify-content-center">
                <div class="col-8 text-center">
                    <p class="text-dark fw-bold mt-1 mb-2" style="font-size: 0.70rem">"Válido somente para Outubro de <?=date('Y')?>."</p>
                </div>
            </div>

            <div class="row mb-0" style="font-size: 0.80rem; margin-left:75px">
                <div class="col-8 text-start fw-bold">
                    <p class="text-dark mt-0 mb-0"><?=$collaborator->nome.' '.$collaborator->sobrenome?></p>
                </div>
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-7 text-center fw-bold">

                    <!-- Saída HTML -->
                    <?=$qr->printSVG();?>
                    
                </div>
            </div>
        </div>
            <div class="row mt-2">
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>

            <div class="row mb-0 mt-0  justify-content-center">
                <div class="col-8 text-center">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px">- Este cartão de identificação é pessoal e intransferível,</p>
                    <p class="text-dark fw-bold mb-0 mt-0" style="font-size: 0.70rem; margin-left:10px">de propriedade da CONGREGAÇÃO CRISTÃ NO BRASIL</p>
                    <p class="text-dark fw-bold mb-0 mt-0" style="font-size: 0.70rem; margin-left:10px">ADMINISTRAÇÃO <?=$collaborator->adm?>, devendo ser apresentado </p>
                    <p class="text-dark fw-bold" style="font-size: 0.70rem; margin-left:10px">e/ou devolvido quando solicitado.</p>
                </div>
                <br>
                <div class="col-8 text-start">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px">- Só terá valor com a apresentação do documento de</p>
                    <p class="text-dark fw-bold" style="font-size: 0.70rem; margin-left:10px">identidade.</p>
                </div>
                <br>
                <div class="col-8 text-start">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px">- Em caso de perda ou extravio, comunicar</p>
                    <p class="text-dark fw-bold" style="font-size: 0.70rem; margin-left:10px">imediatamente à Administração local ou à Regional.</p>
                </div>
                
                <div class="col-8 text-start mb-1">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>Para verificar a autenticidade do crachá escaneie</p>
                    <p class="text-dark fw-bold" style="font-size: 0.70rem; margin-left:10px">o qr code abaixo</strong></p>
                </div>
            
                <div class="col-8 text-center">

                    <!-- Saída HTML -->
                    <?=$qr->printSVG();?>

                </div>
                
                <div class="col-8 text-start mt-3">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>Telefone de Contato</strong>: (11) 2241-5079</p>
                </div>
                
                <div class="col-8 text-start">
                    <p class="text-dark fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>E-mail de Suporte</strong>: admjacana@gmail.com</p>
                </div>
            </div>
            <br><br><br><br><br><br>

        </div>
    </fieldset>

    </main>

</div>



</body>
</html>
