$(function () {

    $('#patrimonys').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            {extend:'csv',title:'Patrimonio',header: 'Patrimonio',filename:'Patrimonio',className: 'btn btn-outline-success mb-2 mt-2',text:'<i class="bi bi-file-earmark-excel"></i>' },
            //{extend: 'pdf',exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio SMSUB',filename:'Patrimonio SMSUB',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger mb-2 mt-2',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio',filename:'Patrimonio',orientation: 'portrait',className: 'btn btn-outline-secondary mb-2 mt-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-smsub mb-2 mt-2',text:'<i class="bi bi-list"></i>'},],
        "dom": "<'row justify-content-center'<'col-lg-5 col-sm-5 col-md-5 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-5 col-sm-5 col-md-5 searchbar mb-3 'f>>" +
            "<'row justify-content-center'<'col-12'tr>>" +
            "<'row justify-content-center'<'col-lg-8 col-md-8 col-sm-6 pb-2 pt-2'i><'col-lg-4 col-md-4 col-sm-6 pb-2 pt-2'p>>",
        responsive:
            {details:
                    {display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return data[0] + ' - ' + data[1] + ' - ' + data[2];
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
        "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc'],
        processing: true,
        serverside: true,
        ajax: '../themes/smsubapp/serverside/activedPatrimony.php',
        "aoColumnDefs": [
            {
            target: 1,
            visible: false
            },
            {
                target: 5,
                visible: false
            },
            {
                target: 10,
                visible: false
            },
            {
                target: 13,
                visible: false
            },
            {
                target: 14,
                visible: false
            },
            {
                "aTargets": [18], // o numero da coluna
                "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                    return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                        'data-bs-title="Clique para desativar '+ full[1] +'" class="btn btn-outline-warning btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#activedModal'+ full[18]+'">' +
                        '<i class="bi bi-person-dash text-secondary"></i></button>' +
                        '<div class="modal fade" id="activedModal' + full[18] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                            '<div class="modal-dialog modal-sm">\n' +
                                '<div class="modal-content">\n' +
                                    '<div class="modal-header bg-warning text-light">\n' +
                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-gift me-2"></i> Desativar ID: ' + full[18] + '</h6>\n' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                    '</div>\n' +
                                    '<div class="modal-body fw-semibold">Deseja desativar o patrimonio id : ' + full[18] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="patrimonios/desativar/' + full[18] + '/disabled" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                }
            }
        ]
    });
    
    $('#disabledPatrimony').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            {extend:'csv',title:'Patrimonio',header: 'Patrimonio',filename:'Patrimonio',className: 'btn btn-outline-success mb-2 mt-2',text:'<i class="bi bi-file-earmark-excel"></i>' },
            //{extend: 'pdf',exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio SMSUB',filename:'Patrimonio SMSUB',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger mb-2 mt-2',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio',filename:'Patrimonio',orientation: 'portrait',className: 'btn btn-outline-secondary mb-2 mt-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-smsub mb-2 mt-2',text:'<i class="bi bi-list"></i>'},],
            "dom": "<'row justify-content-center'<'col-lg-5 col-sm-5 col-md-5 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-5 col-sm-5 col-md-5 searchbar mb-3 'f>>" +
            "<'row justify-content-center'<'col-12'tr>>" +
            "<'row justify-content-center'<'col-lg-8 col-md-8 col-sm-8 pb-2 pt-2'i><'col-lg-4 col-md-4 col-sm-4 pb-2 pt-2'p>>",
        responsive:
            {details:
                    {display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return data[0] + ' - ' + data[1] + ' - ' + data[2];
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc'],
        processing: true,
        serverside: true,
        ajax: '../../themes/smsubapp/serverside/disabledPatrimony.php',
        "aoColumnDefs": [
            {
                target: 0,
                visible: false
            },   
           {
               target: 4,
               visible: false
           },
           {
               target: 8,
               visible: false
           },
           {
               target: 9,
               visible: false
           },
           {
               target: 11,
               visible: false
           },
           {
               target: 12,
               visible: false
           },
            {
                "aTargets": [14], // o numero da coluna
                "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                    return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                        'data-bs-title="Clique para desativar id : '+ full[14] +'" class="btn btn-outline-warning btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#activedModal'+ full[14]+'">' +
                        '<i class="bi bi-person-dash text-secondary"></i></button>' +
                        '<div class="modal fade" id="activedModal' + full[14] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                            '<div class="modal-dialog modal-sm">\n' +
                                '<div class="modal-content">\n' +
                                    '<div class="modal-header bg-warning text-dark">\n' +
                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-gift me-2"></i> Ativar ID: ' + full[14] + '</h6>\n' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                    '</div>\n' +
                                    '<div class="modal-body fw-semibold">Deseja ativar o patrimonio id : ' + full[14] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="ativar/' + full[14] + '/actived" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                }
            }
        ]
    });

    $('#historyPatrimony').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        responsive:
            {details:
                    {display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return data[0] + ' - ' + data[1] + ' - ' + data[2];
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc']
    });

    $('#patrimonysHistory').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            {extend:'csv',title:'Patrimonio',header: 'Patrimonio',filename:'Patrimonio',className: 'btn btn-outline-success mb-2 mt-2',text:'<i class="bi bi-file-earmark-excel"></i>' },
            //{extend: 'pdf',exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio SMSUB',filename:'Patrimonio SMSUB',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger mb-2 mt-2',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Patrimonio SMSUB',header: 'Patrimonio',filename:'Patrimonio',orientation: 'portrait',className: 'btn btn-outline-secondary mb-2 mt-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-smsub mb-2 mt-2',text:'<i class="bi bi-list"></i>'},],
        "dom": "<'row justify-content-center'<'col-lg-5 col-sm-5 col-md-5 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-5 col-sm-5 col-md-5 searchbar mb-3 'f>>" +
            "<'row justify-content-center'<'col-12'tr>>" +
            "<'row justify-content-center'<'col-lg-8 col-md-8 col-sm-6 pb-2 pt-2'i><'col-lg-4 col-md-4 col-sm-6 pb-2 pt-2'p>>",
        responsive:
            {details:
                    {display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return data[0] + ' - ' + data[1] + ' - ' + data[2];
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
        "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc'],
        processing: true,
        serverside: true,
        ajax: '../../themes/smsubapp/serverside/patrimonysHistory.php',
        "aoColumnDefs": [
            {
                target: 0,
                visible: false
            },   
            {
                target: 8,
                visible: false
            }, 
            {
                target: 13,
                visible: false
            },  
            {
                target: 14,
                visible: false
            }  
        ]
    });

    $('#contacts').DataTable({
        drawCallback: function() {
            $('body').tooltip({
                selector: '[data-bs-togglee="tooltip"]'
            });
        },
        buttons: [
            // {extend:'excel',title:'Contatos',header: 'Contatos',filename:'Contatos',className: 'btn btn-outline-success',text:'<i class="bi bi-file-earmark-excel"></i>' },
            // {extend: 'pdfHtml5',exportOptions: {columns: ':visible'},title:'Contatos SMSUB',header: 'Contatos SMSUB',filename:'Contatos SMSUB',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger mb-2 mt-2',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'print', exportOptions: {columns: ':visible'},title:'Contatos SMSUB',header: 'Contatos',filename:'Contatos',orientation: 'portrait',className: 'btn btn-outline-secondary mb-2 mt-2',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-smsub mb-2 mt-2',text:'<i class="bi bi-list"></i>'}],
        "dom": "<'row justify-content-center'<'col-lg-4 col-sm-4 col-md-4 numporpag'l><'col-lg-2 col-sm-2 col-md-2 text-center'B><'col-lg-4 col-sm-4 col-md-4 searchbar mb-3 'f>>" +
            "<'row justify-content-center'<'col-12'tr>>" +
            "<'row justify-content-center'<'col-lg-5 col-md-5 col-sm-5'i><'col-lg-5 col-md-5 col-sm-5'p>>",
        responsive:
            {details:
                    {display: DataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return data[0] + ' - ' + data[1] + ' - ' + data[2];
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "aaSorting": [0, 'asc']
    });
});