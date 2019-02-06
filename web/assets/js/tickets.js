$(document).ready(function () {
    $('.my-selector').collection({
    });
    $('select').formSelect();
    
//    $.fn.dataTable.moment('DD-MMM-YYYY');
    $('#table_id').DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"},
        columnDefs: [ {
            "targets": 3,
                       "render" : function(data){return moment(data).format('DD-MM-YYYY');}
            },
         ],
        responsive: true,
        select: true,
        retrieve: true,
        paging: false,
        "ordering": false,
        destroy: true,
        dom: "frtip"

    });
});
