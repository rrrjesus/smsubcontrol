
<?= $this->layout("_theme", ["head" => $head]); ?>

<table id="contact" class="table table-hover table-bordered table-sm border-<?=CONF_WEB_COLOR?> p-2" style="width:100%">
    <thead class="table-<?=CONF_WEB_COLOR?>">
    <tr>
        <th class="text-center">NOME</th>
        <th class="text-center">SETOR</th>
        <th class="text-center">RAMAL</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($contact as $lista): ?>
    <tr>
        <td class="text-center fw-semibold" data-bs-togglee="tooltip" data-bs-placement="left" data-bs-custom-class="custom-tooltip"
            data-bs-title="O ramal <?=$lista->ramal." é de ".$lista->contact_name.' '.(!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "NÃO CADASTRADO")?>"><?=(!empty($lista->contact_name) ? $lista->contact_name : "")?></td>
        <td class="text-center fw-semibold">
        <?php if(!empty($lista->unit()->unit_name) && !empty($lista->unit()->status == "actived")):
            echo (!empty($lista->unit()->unit_name) ? $lista->unit()->unit_name : "NÃO CADASTRADO");
        else:
            echo "EXCLUÍDO";
        endif;
            ?>
            </td>
            <td class="text-center fw-semibold"><?=(!empty($lista->ramal )? $lista->ramal : "")?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
