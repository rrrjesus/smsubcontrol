
<?= $this->layout("_theme", ["head" => $head]); ?>

  <!-- Navbar-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <p class="fs-2 fw-normal text-body-emphasis pb-0"><i class="bi bi-book-half fs-2 me-3 text-<?=CONF_WEB_COLOR?>"></i> Agenda Inteligente SMSUB</p>
    <p class="fs-6 text-body-secondary pt-0">Na barra <strong>Pesquisar</strong> cada espaço aplicado interliga as palavras digitadas para a pesquisa inteligente</p>
</div>

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
            data-bs-title="O ramal <?=$lista->ramal." é de ".$lista->contact_name.' '.(!empty($lista->sector()->sector_name) ? $lista->sector()->sector_name : "NÃO CADASTRADO")?>"><?=(!empty($lista->contact_name) ? $lista->contact_name : "")?></td>
        <td class="text-center fw-semibold">
        <?php if(!empty($lista->sector()->sector_name) && !empty($lista->sector()->status == "actived")):
            echo (!empty($lista->sector()->sector_name) ? $lista->sector()->sector_name : "NÃO CADASTRADO");
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
