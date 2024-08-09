<?php $this->layout("_theme"); ?>
    <div class="app_main_box">
        <section class="app_main_left">
            <article class="app_widget">
                <header class="app_widget_title">
                    <h2 class="icon-bar-chart">Controle</h2>
                </header>
                <div id="control"></div>
            </article>
        </section>

        <section class="app_main_right">

            <section class="app_widget app_widget_blog">
                <header class="app_widget_title">
                    <h2 class="icon-graduation-cap">Aprenda:</h2>
                </header>
                <div class="app_widget_content">
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <article class="app_widget_blog_article">
                                <div class="thumb">
                                    <img alt="<?= $post->title; ?>" title="<?= $post->title; ?>"
                                         src="<?= image($post->cover, 300); ?>"/>
                                </div>
                                <h3 class="title">
                                    <a target="_blank" href="<?= url("/blog/{$post->uri}"); ?>"
                                       title="<?= $post->title; ?>"><?= str_limit_chars($post->title, 50); ?></a>
                                </h3>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <a target="_blank" href="<?= url("/blog"); ?>" title="Blog"
                       class="app_widget_more transition">Ver Mais...</a>
                </div>
            </section>
        </section>
    </div>

<?php $this->start("scripts"); ?>
    <script type="text/javascript">
        $(function () {
            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });

            var chart = Highcharts.chart('control', {
                chart: {
                    type: 'areaspline',
                    spacingBottom: 0,
                    spacingTop: 5,
                    spacingLeft: 0,
                    spacingRight: 0,
                    height: (9 / 16 * 100) + '%'
                },
                title: null,
                xAxis: {
                    categories: [<?= $chart->categories;?>],
                    minTickInterval: 1
                },
                yAxis: {
                    allowDecimals: true,
                    title: null,
                },
                tooltip: {
                    shared: true,
                    valueDecimals: 2,
                    valuePrefix: 'R$ '
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                series: [{
                    name: 'Receitas',
                    data: [<?= $chart->income;?>],
                    color: '#61DDBC',
                    lineColor: '#36BA9B'
                }, {
                    name: 'Despesas',
                    data: [<?= $chart->expense;?>],
                    color: '#F76C82',
                    lineColor: '#D94352'
                }]
            });

            $("[data-onpaid]").click(function (e) {
                setTimeout(function () {
                    $.post('<?= url("/app/dash");?>', function (callback) {
                        if (callback.chart) {
                            chart.update({
                                xAxis: {
                                    categories: callback.chart.categories
                                },
                                series: [{
                                    data: callback.chart.income
                                }, {
                                    data: callback.chart.expense
                                }]
                            });
                        }

                        if (callback.wallet) {
                            $(".app_wallet").removeClass("gradient-red gradient-green").addClass(callback.wallet.status);
                            $(".app_flex_amount").text("R$ " + callback.wallet.wallet);
                            $(".app_flex_balance .income").text("R$ " + callback.wallet.income);
                            $(".app_flex_balance .expense").text("R$ " + callback.wallet.expense);
                        }
                    }, "json");
                }, 200);
            });
        });
    </script>
<?php $this->end(); ?>