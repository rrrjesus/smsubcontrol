<?php $this->layout("_beta"); ?>

  <!-- Breacrumb-->
  <?= $this->insert("views/theme/breadcrumb"); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="container-fluid">

            <div class="row">
                <!-- Usuários Totais da Agenda --> 
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-<?=CONF_ADMIN_COLOR?> shadow h-100 py-2">
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="fw-semibold text-uppercase mb-1 fs-5">Agenda</div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Contatos :  <?=$contacts->contacts?></div>
                                    <div class="h6 mb-1 font-weight-bold text-gray-800">Desativados : <?=$contacts->disableds?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total Geral: <?=$contacts->totals?></div>
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
                        <div class="card-body text-<?=CONF_APP_COLOR?>">
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
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
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
                        <div class="card-body text-<?=CONF_APP_COLOR?>"">
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


            <!-- https://www.highcharts.com/demo/highcharts/donut-chart -->

            <div class="row">
                <div class="col-6 mb-2 mt-2">
                    <figure class="highcharts-figure">
                        <div id="containerPrinters"></div>
                        <p class="highcharts-description text-center">
                            Gráfico em tempo real com percentuais e totais de estoque e entrega de impressoras.
                        </p>
                    </figure>
                </div>
                
                <div class="col-6 mb-2 mt-2">
                    <figure class="highcharts-figure">
                        <div id="containerTablets"></div>
                        <p class="highcharts-description text-center">
                            Gráfico em tempo real com percentuais e totais de estoque e entrega de tablets.
                        </p>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start("scripts"); ?>
    <script type="text/javascript">
        $(function () {
            Highcharts.setOptions({
                colors: [
                    '#266b2f', '#28a745'
                ]
            });
            Highcharts.chart('containerPrinters', {
                chart: {
                    type: 'pie',
                    custom: {},
                    events: {
                        render() {
                            const chart = this,
                                series = chart.series[0];
                            let customLabel = chart.options.chart.custom.label;

                            if (!customLabel) {
                                customLabel = chart.options.chart.custom.label =
                                    chart.renderer.label(
                                        '<h5>Estoque : <strong><?=$estoqueprinters?></strong></h5><br/>' +
                                        '<h5>Entregues : <strong><?=$printers?></strong></h5>'
                                    )
                                        .css({
                                            color: '#000',
                                            textAnchor: 'middle'
                                        })
                                        .add();
                            }

                            const x = series.center[0] + chart.plotLeft,
                                y = series.center[1] + chart.plotTop -
                                (customLabel.attr('height') / 2);

                            customLabel.attr({
                                x,
                                y
                            });
                            // Set font size based on chart diameter
                            customLabel.css({
                                fontSize: `${series.center[2] / 14}px`
                            });
                        }
                    }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                title: {
                    text: 'Entrega de Impressoras Honeywell RP4'
                },
                subtitle: {
                    text:
                    'Entrega das Impressoras Térmicas Portáteis aos Fiscais de Posturas'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        borderRadius: 8,
                        dataLabels: [{
                            enabled: true,
                            distance: 50,
                            format: '{point.name}'
                        }, {
                            enabled: true,
                            distance: -15,
                            format: '{point.percentage:.0f}%',
                            style: {
                                fontSize: '0.9em'
                            }
                        }],
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Honeywell RP4',
                    colorByPoint: true,
                    innerSize: '65%',
                    data: [
                            {
                                name: 'Em Estoque',
                                y: <?=$chartprinterstotais;?>
                            },
                            {
                                name: 'Entregues',
                                sliced: true,
                                selected: true,
                                y: <?=$chartprinters;?>
                            }
                        ]
                }]
            });

                Highcharts.chart('containerTablets', {
                chart: {
                    type: 'pie',
                    custom: {},
                    events: {
                        render() {
                            const chart = this,
                                series = chart.series[0];
                            let customLabel = chart.options.chart.custom.label;

                            if (!customLabel) {
                                customLabel = chart.options.chart.custom.label =
                                    chart.renderer.label(
                                        '<h5>Estoque : <strong><?=$estoquetablets?></strong></h5><br/>' +
                                        '<h5>Entregues : <strong><?=$tablets?></strong></h5>'
                                    )
                                        .css({
                                            color: '#000',
                                            textAnchor: 'middle'
                                        })
                                        .add();
                            }

                            const x = series.center[0] + chart.plotLeft,
                                y = series.center[1] + chart.plotTop -
                                (customLabel.attr('height') / 2);

                            customLabel.attr({
                                x,
                                y
                            });
                            // Set font size based on chart diameter
                            customLabel.css({
                                fontSize: `${series.center[2] / 14}px`
                            });
                        }
                    }
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                title: {
                    text: 'Entrega de Tablets Samsung A9 + 5G'
                },
                subtitle: {
                    text:
                    'Entrega dos Tablets aos Fiscais de Posturas - Contrato Simpress'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        borderRadius: 8,
                        dataLabels: [{
                            enabled: true,
                            distance: 20,
                            format: '{point.name}'
                        }, {
                            enabled: true,
                            distance: -15,
                            format: '{point.percentage:.0f}%',
                            style: {
                                fontSize: '0.9em'
                            }
                        }],
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Honeywell RP4',
                    colorByPoint: true,
                    innerSize: '65%',
                    data: [
                            {
                                name: 'Em Estoque',
                                y: <?=$charttabletstotais;?>
                            },
                            {
                                name: 'Entregues',
                                sliced: true,
                                selected: true,
                                y: <?=$charttablets;?>
                            }
                        ]
                }]
            });
        });
    </script>
<?php $this->end(); ?>