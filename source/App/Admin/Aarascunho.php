// Contratos
    $('#contracts').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            {extend:'excel',title:'Contratos',header: 'Contratos',filename:'Contratos',className: 'btn btn-outline-success btn-sm mb-2',text:'<i class="bi bi-file-earmark-excel"></i>' },
            //{extend: 'pdfHtml5',exportOptions: {columns: ':visible'},title:'Contratos',header: 'Contratos',filename:'Contratos',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Contratos',header: 'Contratos',filename:'Contratos',orientation: 'portrait',className: 'btn btn-outline-secondary btn-sm mb-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-info btn-sm mb-2',text:'<i class="bi bi-list"></i>'}],
                "dom": "<'row'<'col-lg-5 col-sm-5 col-md-5 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-5 col-sm-5 col-md-5 searchbar'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            responsive:
            {details:
                {display: DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return data[0] + ' ' + data[1];
                },
                update: true
            }),
            renderer: DataTable.Responsive.renderer.tableAll({})}},
        "language": {
            "sEmptyTable": "Nenhum registro encontrado","sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros","sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoThousands": ".","sLengthMenu": "_MENU_ Resultados por Página","sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...","sZeroRecords": "Nenhum registro encontrado","sSearch": "Pesquisar",
            "oPaginate": {"sNext": "Próximo","sPrevious": "Anterior","sFirst": "Primeiro","sLast": "Último"},
            "oAria": {"sSortAscending": "Ordenar colunas de forma ascendente","sPrevious": "Ordenar colunas de forma descendente"}
        },
        // dom: "lBftipr",
        "lengthMenu": [[7, 10, 25, 50, -1], [7, 10, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc'], /* 'desc' Carregar table decrescente e asc crescente*/
        "aoColumnDefs": [
            {
                "aTargets": [4], // o numero da coluna
                "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                    return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                        'data-bs-title="Clique para desativar '+ full[1] +'" class="btn btn-outline-warning btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#activedModal'+ full[4]+'">' +
                        '<i class="bi bi-person-dash text-secondary"></i></button>' +
                        '<div class="modal fade" id="activedModal' + full[4] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                            '<div class="modal-dialog modal-sm">\n' +
                                '<div class="modal-content">\n' +
                                    '<div class="modal-header bg-warning text-light">\n' +
                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-gift me-2"></i> Desativar ID: ' + full[4] + '</h6>\n' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                    '</div>\n' +
                                    '<div class="modal-body fw-semibold">Deseja desativar o contrato : ' + full[1] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="contratos/desativar/' + full[4] + '/disabled" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                }
            },
            {
                "aTargets": [5], // o numero da coluna
                "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                    return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                        'data-bs-title="Clique para excluir definitivamente '+ full[4] +'" class="btn btn-outline-danger btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#trashModalFim'+ full[4]+'">' +
                        '<i class="bi bi-trash"></i></button>' +
                        '<div class="modal fade" id="trashModalFim' + full[4] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                            '<div class="modal-dialog modal-sm">\n' +
                                '<div class="modal-content">\n' +
                                    '<div class="modal-header bg-danger text-light">\n' +
                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-trash me-2"></i> Excluir ID: ' + full[4] + '</h6>\n' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                    '</div>\n' +
                                    '<div class="modal-body fw-semibold">Deseja excluir o contrato : ' + full[1] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="contratos/excluir/' + full[4] + '/delete" data-action="delete" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                }
            }
        ]
    });

      // Contratos
      $('#contractsDisabled').DataTable( {
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            {extend:'excel',title:'Contratos',header: 'Contratos',filename:'Contratos',className: 'btn btn-outline-success btn-sm mb-2',text:'<i class="bi bi-file-earmark-excel"></i>' },
            //{extend: 'pdfHtml5',exportOptions: {columns: ':visible'},title:'Contratos',header: 'Contratos',filename:'Contratos',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Contratos',header: 'Contratos',filename:'Contratos',orientation: 'portrait',className: 'btn btn-outline-secondary btn-sm mb-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-info btn-sm mb-2',text:'<i class="bi bi-list"></i>'}],
                "dom": "<'row'<'col-lg-5 col-sm-5 col-md-5 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-5 col-sm-5 col-md-5 searchbar'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            responsive:
            {details:
                {display: DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return data[0] + ' ' + data[1];
                },
                update: true
            }),
            renderer: DataTable.Responsive.renderer.tableAll({})}},
        "language": {
            "sEmptyTable": "Nenhum registro encontrado","sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros","sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoThousands": ".","sLengthMenu": "_MENU_ Resultados por Página","sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...","sZeroRecords": "Nenhum registro encontrado","sSearch": "Pesquisar",
            "oPaginate": {"sNext": "Próximo","sPrevious": "Anterior","sFirst": "Primeiro","sLast": "Último"},
            "oAria": {"sSortAscending": "Ordenar colunas de forma ascendente","sPrevious": "Ordenar colunas de forma descendente"}
        },
        // dom: "lBftipr",
        "lengthMenu": [[7, 10, 25, 50, -1], [7, 10, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc'], /* 'desc' Carregar table decrescente e asc crescente*/
        "aoColumnDefs": [
            {
                "aTargets": [4], // o numero da coluna
                "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                    return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                        'data-bs-title="Clique para ativar '+ full[1] +'" class="btn btn-outline-warning btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#modalAtivar'+ full[4]+'">' +
                        '<i class="bi bi-person-check"></i></button>' +
                        '<div class="modal fade" id="modalAtivar' + full[4] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                            '<div class="modal-dialog modal-sm">\n' +
                                '<div class="modal-content">\n' +
                                    '<div class="modal-header bg-warning text-light">\n' +
                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-trash me-2"></i> Ativar ID: ' + full[4] + '</h6>\n' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                    '</div>\n' +
                                    '<div class="modal-body fw-semibold">Deseja ativar o contrato : ' + full[2] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="ativar/' + full[4] + '/actived" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                }
            }
        ]
    });