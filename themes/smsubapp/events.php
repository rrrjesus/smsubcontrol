<?php $this->layout("_theme"); ?>

<!-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 p-4">
    <div class="col">
        <div class="card border-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header fw-semibold fs-5 text-center">Setor 11 - Jaçanã</div>
            <div class="card-body text-secondary">
                <h5 class="card-title">Projeto Resgate</h5>
                <p class="card-text">Visitas em grupo para pessoas desanimadas de congregar.</p>
            </div>
        </div>
    </div>
</div>-->

<table id="events" class="table table-hover table-bordered table-sm border-<?=CONF_APP_COLOR?>" style="width:100%">
        <thead class="table-<?=CONF_APP_COLOR?>">
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Evento</th>
                <th>Descrição</th>
                <th>Modalidade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($registers->actived)){ ?>
                <?php foreach ($events as $lista): ?>
                    <tr>
                        <td><?=$lista->id?></td>
                        <td><?=date_fmt_br($lista->event_date)?></td>
                        <td><?=$lista->event_name?></td>
                        <td><?=$lista->description?></td>
                        <td><?=$lista->modality()->modality_name?></td>
                        <td><?=$lista->statusList()?></td>
                    </tr>
            <?php endforeach; ?>
                <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th>Evento</th>
                <th>Descrição</th>
                <th>Modalidade</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>