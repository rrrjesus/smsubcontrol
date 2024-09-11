$(function () {

    $('#patrimonio').DataTable({
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