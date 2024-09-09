<?php $this->layout("_admin"); ?>

<div class="col-md-12 ml-auto mt-3"> <!-- https://getbootstrap.com/docs/4.0/layout/grid/#mix-and-match -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item fw-semibold active" aria-current="page"><i class="bi bi-house-door"></i> Monitoramento</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card mb-4 border-secondary">
            <div class="card-body">
                <div class="container-fluid">

                    <div class="row justify-content-center">
                        <div class="col-12 ajax_response">
                            <?=flash();?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Usuários Totais da Agenda --> 
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-semibold text-uppercase mb-1 fs-5">Usuarios</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Usuários :  <?=$users->users?></div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Administradores :  <?=$users->admins?></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$users->totals?></div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                            <i class="bi bi-person-arms-up bi-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-semibold text-uppercase mb-1 fs-5">Patrimônio</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Patrimônio :  <?=$patrimonys->patrimonys?></div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Desativados :  <?=$patrimonys->disableds?></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$patrimonys->totals?></div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                            <i class="bi bi-building bi-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-semibold text-uppercase mb-1 fs-5">Marcas</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Marcas :  <?=$brands->brands?></div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Desativadas :  <?=$brands->disableds?></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$brands->totals?></div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                            <i class="bi bi-building bi-2x"></i>
                                        </div>Marcas                              </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-semibold text-uppercase mb-1 fs-5">Modelos</div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Modelos :  <?=$products->products?></div>
                                            <div class="h6 mb-1 font-weight-bold text-gray-800">Desativadas :  <?=$products->disableds?></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral:  <?=$products->totals?></div>
                                        </div>
                                        <div class="col-auto text-gray-300">
                                            <i class="bi bi-building bi-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="d-flex justify-content-center">
                <div class="col-12 col-md-12">
                    <div class="fw-semibold text-<?=CONF_ADMIN_COLOR?> text-uppercase mb-3 fs-5"><i class="bi bi-bar-chart-line-fill"></i> Online agora : 
                        <span class="trafic_count"><?= $onlineCount; ?></span>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="app_dash_home_trafic_list">
                                <?php if (!$online): ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="bi bi-info-circle-fill p-2"></i>
                                            <strong>Não existem usuários online navegando no site neste momento. Quando tiver, você
                                            poderá monitoriar todos por aqui.</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php else: ?>
                                    <table id="online" class="table table-bordered table-sm border-secondary table-hover" style="width:100%">
                                        <thead class="table-secondary">    
                                            <tr>
                                                <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-emoji-grin me-1"></i><br>DATA/USUARIO</th>
                                                <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-clipboard-check me-1"></i><br>QTD PÁGINAS</th>
                                                <th class="text-center text-<?=CONF_ADMIN_COLOR?>"><i class="bi bi-binoculars me-1"></i><br>ÚLTIMO ACESSO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($online as $onlineNow): ?>
                                            <tr>
                                                <td class="text-center"><?= date_fmt($onlineNow->created_at, "H\hm"); ?> - <?= date_fmt($onlineNow->updated_at, "H\hm"); ?> 
                                                    <?= ($onlineNow->user ? $onlineNow->user()->fullName() : "Usuário Convidado"); ?></td>
                                                <td class="text-center"><?= $onlineNow->pages; ?> páginas vistas</td>
                                                <td class="text-center"><a target="_blank" href="<?= url("/{$onlineNow->url}"); ?>"><b>
                                                    <?= strtolower(CONF_SITE_NAME); ?></b><?= $onlineNow->url; ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>



    <?php $this->start("scripts"); ?>
    <script>
        $(function () {
            setInterval(function () {
                $.post('<?= url("/painel/controle/inicial");?>', {refresh: true}, function (response) {
                    // count
                    if (response.count) {
                        $(".trafic_count").text(response.count);
                    } else {
                        $(".trafic_count").text(0);
                    }

                    //list
                    var list = "";
                    if (response.list) {
                        list += "<table id='online' class='table table-bordered table-sm border-secondary table-hover' style='width:100%'>";
                        list += "<thead class='table-secondary'>";    
                        list += "<tr>";
                        list += "<th class='text-center text-secondary'><i class='bi bi-emoji-grin me-1'></i><br>DATA/USUARIO</th>";
                        list += "<th class='text-center text-secondary'><i class='bi bi-clipboard-check me-1'></i><br>QTD PÁGINAS</th>";
                        list += "<th class='text-center text-secondary'><i class='bi bi-binoculars me-1'></i><br>ÚLTIMO ACESSO</th>";
                        list += "</tr>";
                        list += "</thead>";
                        list += "<tbody>";
                        $.each(response.list, function (item, data) {
                            var url = '<?= url();?>' + data.url;
                            var title = '<?= strtolower(CONF_SITE_NAME);?>';

                            list += "<tr>";
                            list += "<td class='text-center'>" + data.dates + " " + data.user + "</td>";
                            list += "<td class='text-center'>" + data.pages + " páginas vistas</td>";
                            list += "<td class='text-center'><a target='_blank' href='" + url + "'><b>" + title + "</b>" + data.url + "</a></td>";
                            list += "</tr>";
                        });
                        list += "</tbody>";
                        list += "</table>";
                    } else {
                        list = "<div class='row justify-content-center'><div class='col-12'><div class='alert alert-warning alert-dismissible fade show' role='alert'><i class='bi bi-info-circle-fill p-2'></i>\n" +
                                "<strong>Não existem usuários online navegando no site neste momento. Quando tiver, você poderá monitoriar todos por aqui.</strong>\n" +
                                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></div></div></div>"
                    }

                    $(".app_dash_home_trafic_list").html(list);
                }, "json");
            }, 1000 * 10);
        });
    </script>
<?php $this->end(); ?>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Area Chart Example
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Bar Chart Example
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
