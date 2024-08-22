<?= $this->layout("_theme"); ?>
    
<style type="text/css" media="print">         
    
    @media print {
        .navbar { display: none; }   
        .footer {display: none;}
        #sidenavAccordion {display: none;}
        .break { page-break-before: always; }
        .card{width: 26rem; height:39rem";}
    }

    @page {  
        html {
            margin: 0px;
        } /* this affects the margin on the html before sending to printer */
        body {
            margin: 0px;
            size: landscape;
        } /* margin you want for the content */ 
     }
</style>

        <?php

use Source\Models\Collaborator;

 if ($user): ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-center break">
                <div class="card mt-2" style="width: 26rem; height:39rem">
                        <div class="card-body">
                        
                            <div class="row justify-content-center mb-1 mt-0">
                                <div class="col-md-12 mb-0 text-center">
                                    <p class="display-1" style="font-size: 80px;font-weight: 900">CCB</p>
                                </div>
                            </div>
                    
                            <div class="row justify-content-center mb-1 mt-1">
                                <div class="col-3 text-center ps-3">
                                        <img height="125" width="105" src="<?=$photo?>" class="img">
                                </div>
                                <div class="col-9 text-center ps-0 pe-0">
                                    <p class="h6 fw-bold mt-0 mb-0 ms-1">PROJETO RESGATE <?=$user->adm_id?></p>
                                    <p class="h6 ms-2 mt-0 mb-0 text-uppercase" style="font-size: 40px;font-weight: 500"><?=mb_substr($user->first_name, 0, 13, 'UTF-8');?></p> <!-- strstr($user->first_name, ' ', true) -->
                                    <p class="h6 mt-0 mb-0 ms-1 text-uppercase" style="font-size: 20px;font-weight: 800">GT </p>
                                    <p class="h6 text-secondary mt-0 mb-0 ms-1" style="font-size: 40px;font-weight: 900"><?=date('Y')?></p>
                                </div>
                            </div>
                        
                        
                        <div class="row justify-content-center mb-0 mt-1">            
                            <div class="col-12 text-center">
                                <p class="fw-bold" style="font-size: 0.60rem">"Atividade de caráter voluntário não gerando vínculo de qualquer espécie"</p>
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <p class="h6 fw-bold ms-4">Congregação Cristã no Brasil</p>
                                <p class="h6 fw-bold ms-4">Setor 11 - Comum <?=$user->churche()->churche_name?></p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row mb-0 mt-0 justify-content-center">
                                <div class="col-12 text-center">
                                    <p class="fw-bold mt-1 mb-0" style="font-size: 0.70rem">"Válido somente durante o evento."</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row justify-content-center mb-2 mt-2">
                                <div class="col-12 text-start fw-bold">
                                    <p class="mt-0 mb-0"><?=$user->first_name.' '.$user->last_name?></p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mb-1 text-center">

                                    <!-- Saída HTML -->
                                    <?=$qr->printSVG();?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="d-flex justify-content-center break">
                <div class="card mt-2 mb-2" style="width: 26rem; height:39rem">
                    <div class="card-body">
                        <div class="row justify-content-center mb-1 mt-0">
                            <div class="col-md-12 mb-0 text-center">
                                <p class="display-1" style="font-size: 80px;font-weight: 900">CCB</p>
                            </div>
                        </div>
                
                        <div class="row justify-content-center mt-1 mb-1">
                            <div class="col-md-10 text-center">
                                <p class="text-center text-wrap fw-bold mb-0" style="font-size: 0.70rem;">
                                - Este cartão de identificação é pessoal e intransferível, de 
                                propriedade da CONGREGAÇÃO CRISTÃ NO BRASIL ADMINISTRAÇÃO JAÇANÀ,
                                devendo ser apresentado e/ou e/ou devolvido quando solicitado. <br>
                                - Só terá valor com a apresentação do documento de identidade. <br>
                                - Em caso de perda ou extravio, comunicar imediatamente à Administração local ou à Regional.</p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-0 text-center">
                                <p class="fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>Telefone de Contato</strong>: (11) 2241-5079</p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-0 text-center">
                                <p class="fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>E-mail de Suporte</strong>: admjacana@gmail.com</p>
                            </div>
                        </div>
                    
                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-0 mt-1 text-center">
                                <p class="fw-bold mb-0" style="font-size: 0.70rem; margin-left:10px"><strong>Para verificar a autenticidade do crachá escaneie</p>
                                <p class="fw-bold" style="font-size: 0.70rem; margin-left:10px">o qr code abaixo</strong></p>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-10 mb-0 text-center">
                                <p class="h6 fw-bold ms-4">Setor 11 - Comum <?=$user->churche()->churche_name?></p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row justify-content-center mb-2 mt-1">
                                <div class="col-12 text-start fw-bold">
                                    <p class="mt-0 mb-0"><?=$user->first_name.' '.$user->last_name?></p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="row justify-content-center">
                                <div class="col-md-10 mb-1 text-center">

                                    <!-- Saída HTML -->
                                    <?=$qr->printSVG();?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  endif; ?>