// aqui en las funciones necesitamos mandar 3 parametros
//columnas sera una variable que haremos en el JS para cuando lo vayamos a inicializar
//url es para la url del archivo de la consulta del Ajax
//opcion es para cuando hagamos los switch de las consultas
function iniciarTabla(columnas,url,opcion){
    let Tabla=$('#TableData').DataTable({
        //configuracion del lenguaje de la tabla en este caso esta en español
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
        //activamos la opcion responsive
        responsive: true,
         //para usar los botones   
         responsive: "true",
         dom: 'Bfrtilp',       
         buttons:[ 
             {
                 extend:    'excelHtml5',
                 text:      '<i class="fas fa-file-excel"></i> ',
                 titleAttr: 'Exportar a Excel',
                 className: 'btn btn-success'
             },
             {
                 extend:    'pdfHtml5',
                 text:      '<i class="fas fa-file-pdf"></i> ',
                 titleAttr: 'Exportar a PDF',
                 className: 'btn btn-danger'
             },
             {
                 extend:    'print',
                 text:      '<i class="fa fa-print"></i> ',
                 titleAttr: 'Imprimir',
                 className: 'btn btn-info'
             },
         ],
         //se inicia el AJAX para devolver todo en un JSON 
        "ajax":{
        "url":url,
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion},
        "dataSrc":""
        },
        //columnas es el array
        "columns": columnas
    });
    return Tabla;
}
/**
 * // usuarios.js
$(myDocument).ready(function(){
    var columnas = [
        {"data":"user_id"},
        {"data":"username"},
        {"data":"first_name"},
        {"data":"last_name"},
        // ... (aquí van las columnas específicas para el módulo de usuarios)
    ];
    iniciarDataTable(columnas);
});

 */