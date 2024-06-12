$(document).ready(()=>{
  llenarSelect();
    $("#btnNuevo").click(function(){
        datos = 1; //crear         
        quimico_id=null;
        blankForm($("#FormServicio"));
        $("#FormServicio").trigger("reset");
        $("#selectedImg").removeAttr("src");
        $(".modal-header").css( "background-color", "#d32535");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Registrar Servicio");
        $('#modalCRUD').modal('show');
      });

})

async function llenarSelect(){
  let select= document.getElementById('quimico');
  const data = new FormData();
  data.append("solicitarQuimico",JSON.stringify(true));
  const respuesta = await service.post('servicios',data);
  respuesta.forEach(element => {
    let option= document.createElement('option');
    option.value=element.idQuimico;
    option.text=element.nombre;
    select.appendChild(option);
  });
}





