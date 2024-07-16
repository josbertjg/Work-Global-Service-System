$(document).ready(async ()=>{
    var columnas =[
        {"data":"idSobrecargo"},
        {"data":"precio",
        "render":function(data,type,row){
          return "$"+data;
        }},
        {"data":"descripcion"},
        {"data":"habilitado"},
        {"data": null,
            "render": function(data, type, row) {
                if (type === 'display') {
                    let buttonClass = data.habilitado == 1 ? 'btn-success' : 'btn-danger';
                    let icon = data.habilitado == 1 ? '<i class="fa-solid fa-toggle-on"></i>' : '<i class="fa-solid fa-toggle-off"></i>';
                    let buttons = `<div class='text-center'><div class='btn-group'>`;
                    buttons += `<button class='btn btn-primary btn-sm btnEditar'><i class="fa-regular fa-pen-to-square"></i></button>`;
                    buttons += `<button class='btn ${buttonClass} btn-sm btnBorrar'>${icon}</button>`;
                    buttons += `</div></div>`;
                    return buttons;
                }
                return data;
            }
        }
    ];
    let idSobrecargo;
    let opcion=2;
    //const sobrecargoL= await service.post("sobrecargos",{opcion:true});
   // console.log(sobrecargoL);
    TablaSobrecargo=iniciarTabla(columnas,'sobrecargos',opcion);
    validarPrecio($("#number"));
    validarDescripcion($("#Descripcion"),255);
    $("#btnNuevo").click(function(){
        datos = 1; //crear         
        idSobrecargo=null;
        blankForm($("#FormSobrecargos"));
        $("#FormSobrecargo").trigger("reset");
        $(".modal-header").css( "background-color", "#d32535");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Registrar Sobrecargo");
        $('#modalCRUD').modal('show');
      });

      $("#FormSobrecargos").on("submit", async(event)=>{
        event.preventDefault();
        const form = $("#FormSobrecargos");
        const formValid = checkFormValidity(form);
        if(formValid){
          //console.log($("#number").val());
             const formHTML = document.getElementById("FormSobrecargos");
            const data = new FormData(formHTML)
            switch(datos){
              case 1:
                data.append("insert",JSON.stringify(true));
                break
              case 2:
                idPrecio="prueba";
                break;
              case 3:
                data.append("update",JSON.stringify(true));
                break
            }
            data.append("idSobrecargo",idSobrecargo);
            const respuesta = await service.post("sobrecargos",data);
            if("error" in respuesta){
              showFormAlerts(form,respuesta.error);
              blankForm(form);
            }else{
              TablaSobrecargo.ajax.reload(null,false);
              Swal.fire({
                title: "Exito!",
                text: "se ha ingresado la entrada con exito!",
                icon: "success"
              });
              $('#modalCRUD').modal('hide');
            }
           }
      })


      $(document).on("click", ".btnEditar", function(){		        
        datos = 3;//editar
        var tr = $(this).closest('tr');
        var table = $('#TableData').DataTable();
        var row = table.row(tr);
        var data = row.data();
        blankForm($("#FormSobrecargos"));
        $("#FormSobrecargos").trigger("reset");
        idSobrecargo = data.idSobrecargo; 
        $("#Descripcion").val(data.descripcion);
        $("#number").val(data.precio);
        $(".modal-header").css("background-color", "#d32535");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Sobrecargo");	
        setValidInput($("#number"));
        setValidInput($("#Descripcion"));
        $('#modalCRUD').modal('show');		   
    });

    $(document).on("click", ".btnBorrar", async function(){
      var tr = $(this).closest('tr');
      var table = $('#TableData').DataTable();
      var row = table.row(tr);
      var data = row.data();
      idSobrecargo=data.idSobrecargo;
      let habilitado = data.habilitado; 
      deshabilitar("sobrecargos",idSobrecargo,TablaSobrecargo,"Sobrecargo",habilitado);
    });
});