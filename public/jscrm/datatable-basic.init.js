/*************************************************************************************/
// -->Template Name: Bootstrap Press Admin
// -->Author: Themedesigner
// -->Email: niravjoshi87@gmail.com
// -->File: datatable_basic_init
/*************************************************************************************/

/****************************************
 *       Basic Table                   *
 ****************************************/
$('#zero_config').DataTable({
    "order": [[ 0, "desc" ]],
    dom: 'Blfrtip',
    buttons: [
        'excel', 'pdf'
    ],

    "language": {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
            "sFirst":      "Premier",
            "sPrevious":   "Pr&eacute;c&eacute;dent",
            "sNext":       "Suivant",
            "sLast":       "Dernier"
        },
        "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        },
        "select": {
            "rows": {
                _: "%d lignes séléctionnées",
                0: "Aucune ligne séléctionnée",
                1: "1 ligne séléctionnée"
            }
        }
    }
});
$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
$('.dataTables_length').css('float', 'left');
$('.dt-buttons').css('margin-bottom', '10px');

/****************************************
 *       Default Order Table           *
 ****************************************/
$('#default_order').DataTable({
    "order": [
        [3, "desc"]
    ]
});

/****************************************
 *       Multi-column Order Table      *
 ****************************************/
$('#multi_col_order').DataTable({
    columnDefs: [{
        targets: [0],
        orderData: [0, 1]
    }, {
        targets: [1],
        orderData: [1, 0]
    }, {
        targets: [4],
        orderData: [4, 0]
    }]
});

/****************************************
 *       Complex header Table          *
 ****************************************/
$('#complex_header').DataTable();

/****************************************
 *       DOM positioning Table         *
 ****************************************/
$('#DOM_pos').DataTable({
    "dom": '<"top"i>rt<"bottom"flp><"clear">'
});

/****************************************
 *     alternative pagination Table    *
 ****************************************/
$('#alt_pagination').DataTable({
    "pagingType": "full_numbers"
});

/****************************************
 *     vertical scroll Table    *
 ****************************************/
$('#scroll_ver').DataTable({
    "scrollY": "300px",
    "scrollCollapse": true,
    "paging": false
});

/****************************************
 * vertical scroll,dynamic height Table *
 ****************************************/
$('#scroll_ver_dynamic_hei').DataTable({
    scrollY: '50vh',
    scrollCollapse: true,
    paging: false
});

/****************************************
 *     horizontal scroll Table    *
 ****************************************/
$('#scroll_hor').DataTable({
    "scrollX": true
});

/****************************************
 * vertical & horizontal scroll Table  *
 ****************************************/
$('#scroll_ver_hor').DataTable({
    "scrollY": 300,
    "scrollX": true
});

/****************************************
 * Language - Comma decimal place Table  *
 ****************************************/
$('#lang_comma_deci').DataTable({
    "language": {
        "decimal": ",",
        "thousands": "."
    }
});

