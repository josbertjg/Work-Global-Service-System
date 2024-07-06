$(document).ready(async ()=>{
    var columnas = [
        {"data":"idFactura"},
        {"data":"orden"},
        {"data":"fecha",
         "render":function(data,type,row){
            const [dia,hora]=data.split(" ");
            var fechaT=fecha(dia);
            return fechaT;
         }},
        {"data":"precioFinal",
         "render":function(data,type,row){
            var p="$"+data;
            return p;
         }},
         {
            "data": "pagado",
            "render": function(data, type, row) {
                if (type === 'display') {
                    let iconClass = data == 1 ? 'fa-check' : 'fa-circle-xmark';
                    let iconHtml = `<i class="fa-solid ${iconClass}"></i>`;
                    let iconWithClass = `<span class="${data == 1 ? 'text-success' : 'text-danger'}">${iconHtml}</span>`;
                    return iconWithClass;
                }
                return data;
            }
        },
        {"defaultContent":"<div class='text-center'><button class='btn btn-primary btn-sm btnDetalles'><i class='fa-solid fa-info'></i></button></div>"}
    ];
    let datos=2;
    TablaFacturas=iniciarTabla(columnas,'facturas',datos);
    $(document).on("click", ".btnDetalles", async function(){
        var tr = $(this).closest('tr');
        var table = $('#TableData').DataTable();
        var row = table.row(tr);
        var data = row.data();
        const [dia,hora]=data.fecha.split(" ");
        var fechaT=fecha(dia);
        $('#contenidoModal').empty();
        var body=`
                <div class="modal-body">
                <table class="table table-borderless">
                <thead>
                <th scope="col"></th>
                <th scope="col"></th>
                </thead>
                <tbody>
                <tr>
                  <th scope="row">Factura</th>
                  <td>${data.idFactura}</td>
                </tr>
                <tr>
                <th scope="row">Orden</th>
                <td>${data.orden}</td>
              </tr>
                <tr>
                  <th scope="row">Cliente</th>
                  <td>${data.Cliente}</td>
                </tr>
                <tr>
                  <th scope="row">Fecha</th>
                  <td>${fechaT}</td>
                </tr>
                <tr>
                  <th scope="row">Precio Inicial</th>
                  <td>$ ${data.precioInicial}</td>
                </tr>
                <tr>
                    <th scope="row">Sobrecargos</th>
                    <td>$ ${data.Sobrecargo}</td>
                </tr>
                <tr>
                    <th scope="row">Precio Total</th>
                    <td>$ ${data.precioFinal}</td>
                </tr>
                `;
        var bodyend=`</tbody></table></div>`;
        body+=bodyend;
        $('#contenidoModal').append(`<div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>`);
      $(".modal-header").css("background-color", "#d32535");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Factura"+" "+data.idFactura);	
        $('#contenidoModal').append(body);	
        $('#contenidoModal').append(`<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>`)
        $('#modalCRUD').modal('show');		

    });
});



function hora(data){
    const [hours, minutes, seconds] = data.split(':');
    // Convierte las horas a formato 12 horas con AM/PM
    let formattedHours = (parseInt(hours) % 12).toString();
    formattedHours = formattedHours === '0' ? '12' : formattedHours; // Ajuste para 12:00:00
    const formattedTime = `${formattedHours.padStart(2, '0')}:${minutes} ${hours >= 12 ? 'PM' : 'AM'}`;
    return formattedTime;
}

function fecha(data){
    const [year, month, day] = data.split('-');
    // Formatea la fecha en el formato deseado (por ejemplo, "DD-MM-YY")
    const formattedDate = `${day}-${month}-${year.slice(-2)}`;
    return formattedDate;
}
