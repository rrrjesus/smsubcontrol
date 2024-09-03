$(function() {

    // Igrejas
    new DataTable ('#churches', {
        buttons: [
            {extend:'copy',title:'Igrejas',header: 'Igrejas',filename:'Igrejas',className: 'btn btn-outline-warning btn-sm mt-3',text:'<i class="bi bi-file-earmark-excel"></i>' },
            {extend: 'pdfHtml5', exportOptions: {columns: ':visible'},title:'Igrejas',header: 'Igrejas',filename:'Igrejas',orientation: 'portrait',pageSize: 'LEGAL',className: 'btn btn-outline-danger btn-sm mt-3',text:'<i class="bi bi-file-earmark-pdf"></i>'},
            {extend:'excel',title:'Igrejas',header: 'Igrejas',filename:'Igrejas',className: 'btn btn-outline-success btn-sm mt-3',text:'<i class="bi bi-file-earmark-excel"></i>' },
            {extend:'print', exportOptions: {columns: ':visible'},title:'Igrejas',header: 'Igrejas',filename:'Igrejas',orientation: 'portrait',className: 'btn btn-outline-secondary btn-sm mt-3',text:'<i class="bi bi-printer"></i>'},
            {extend:'colvis',titleAttr: 'Select Colunas',className: 'btn btn-outline-info btn-sm mt-3',text:'<i class="bi bi-list"></i>'}],
            "dom": "<'row'<'col-lg-2 col-sm-2 col-md-2 numporpag'l><'col-lg-7 col-sm-7 col-md-7 text-center'B><'col-lg-3 col-sm-3 col-md-3 searchbar'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "language": {
                "sEmptyTable": "Nenhum registro encontrado","sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros","sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoThousands": ".","sLengthMenu": "Resultados _MENU_","sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...","sZeroRecords": "Nenhum registro encontrado","sSearch": "Pesquisar",
                "oPaginate": {"sNext": "Próximo","sPrevious": "Anterior","sFirst": "Primeiro","sLast": "Último"},
                "oAria": {"sSortAscending": "Ordenar colunas de forma ascendente","sPrevious": "Ordenar colunas de forma descendente"}
            },
            "lengthMenu": [[7, 10, 25, 50, -1], [7, 10, 25, 50, "Todos"]],
            "aaSorting": [0, 'asc'], /* 'desc' Carregar table decrescente e asc crescente*/
            "aoColumnDefs": [
                {
                    "aTargets": [1], // o numero 6 é o nº da coluna
                    "mRender": function (data, type, full) { //aqui é uma funçãozinha para pegar os ids
                        return '<a href="igrejas/editar/' + full[1] + '" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                            'data-bs-title="Clique para editar '+ full[1] +'" role="button" class="btn btn-outline-warning rounded-circle btn-sm text-center pb-0"><i class="bi bi-pencil text-dark"></i></a>';
                    }
                },
                {
                    "aTargets": [3], // o numero da coluna
                    "mRender": function (data, type, full) { //função para pegar o id
                        return '<button type="button" data-bs-togglee="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"\n' +
                            'data-bs-title="Clique para desativar '+ full[3] +'" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#trashModal'+ full[3]+'">' +
                                    '<i class="bi bi-building text-danger"></i></button>' +
                                    '<div class="modal fade" id="trashModal' + full[0] + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
                                        '<div class="modal-dialog modal-sm">\n' +
                                            '<div class="modal-content">\n' +
                                                '<div class="modal-header bg-secondary text-white">\n' +
                                                    '<h6 class="modal-title text-center" id="exampleModalLabel"><i class="bi bi-qr-code text-danger me-2"></i> Desativar ID: '+ full[3] +'</h6>\n' +
                                                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n' +
                                                '</div>\n' +
                                                '<div class="modal-body fw-semibold">Deseja desativar o igreja : ' + full[2] + ' ?</div>\n' +
                                                    '<div class="modal-footer">\n' +
                                                        '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                                        '<a href="igrejas/desativar/' + full[3] + '" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                                    '</div>\n' +
                                                '</div>\n' +
                                        '</div>\n' +
                                    '</div>';
                    }
                },
                {
                    "aTargets": [4], // o numero da coluna
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
                                    '<div class="modal-body fw-semibold">Deseja excluir o igreja : ' + full[2] + ' ?</div>\n' +
                                    '<div class="modal-footer">\n' +
                                    '<button type="button" class="btn btn-outline-danger btn-sm fw-semibold" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Não</button>\n' +
                                    '<a href="igrejas/excluir/' + full[4] + '/delete" class="btn btn-outline-success btn-sm fw-semibold"><i class="bi bi-plus-circle" role="button" ></i> Sim</a>\n' +
                                    '</div>\n' +
                                '</div>\n' +
                            '</div>\n' +
                        '</div>';
                    }
                }
            ]
    });
});