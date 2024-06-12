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
         dom: 'Bfrtilp',       
         buttons:[ 
             {
                 extend:    'excelHtml5',
                 text:      '<i class="fa-regular fa-file-excel"></i> ',
                 titleAttr: 'Exportar a Excel',
                 className: 'btn btn-success'
             },
             {
                 extend:    'pdfHtml5',
                 text:      '<i class="fa-regular fa-file-pdf"></i> ',
                 titleAttr: 'Exportar a PDF',
                 className: 'btn btn-danger'
             },
             {
                 extend:    'print',
                 text:      '<i class="fa-solid fa-print"></i>',
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


function deshabilitar(url, id, Tabla, modulo, habilitado) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    let title = habilitado ? `¿Estás seguro de que quieres deshabilitar este ${modulo}?` : `¿Estás seguro de que quieres habilitar este ${modulo}?`;
    let confirmText = habilitado ? "¡Sí, deshabilita!" : "¡Sí, habilita!";
    let successTitle = habilitado ? "¡Deshabilitado!" : "¡Habilitado!";
    let successText = habilitado ? `El ${modulo} ha sido deshabilitado.` : `El ${modulo} ha sido habilitado.`;

    swalWithBootstrapButtons.fire({
        title: title,
        text: "¿Estas seguro de la accion?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: "¡No, cancela!",
        reverseButtons: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const data = new FormData();
                data.append("delete", JSON.stringify(true));
                data.append("habilitado", JSON.stringify(habilitado));
                data.append("id", id);
                const respuesta = await service.post(url, data);
                if ("error" in respuesta) {
                    showFormAlerts(respuesta.error);
                } else {
                    Tabla.ajax.reload(null, false);
                    swalWithBootstrapButtons.fire(
                        successTitle,
                        successText,
                        'success'
                    );
                }
            } catch (error) {
                console.error("Error:", error);
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                `El ${modulo} no ha sido modificado. `,
                'error'
            );
        }
    });
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