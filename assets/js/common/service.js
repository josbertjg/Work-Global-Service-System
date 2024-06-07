function convertirParams(objeto){
  const datos = new URLSearchParams();

  for (const propiedad in objeto) {
    datos.append(propiedad,objeto[propiedad])
  }

  return datos;
}

function typeOfBody(body){
  if(body instanceof FormData) return "FormData";
  if(body instanceof URLSearchParams) return "URLSearchParams";
  return "Object"
}

const service = {
  post: async (url = "",body = {}) => {
    let datos;

    if(typeOfBody(body) === "Object"){

      if(!Object.entries(body).length){
        Swal.fire({
          icon: "error",
          title: "Oops, ocurrió un error.",
          text: "Debes pasar un objeto con los valores de la solicitud para poder usar el método POST."
        });
        return "Debes pasar un objeto con los valores de la solicitud para poder usar el método POST.";
      } 

      datos = convertirParams(body)
    }else{
      datos = body;
    }

    return fetch(`${urlBase+url}`,{
      method: "POST",
      body: datos
    })

    .then((response)=>{
      if(response.ok){
        try{
          return response.json();
        }catch(e){
          console.error("Error al tratar de retornar un json en la respuesta de la promesa");
          return JSON.stringify(e);
        }
      }else{
        return Swal.fire({
          icon: "error",
          title: "Oops, ocurrió un error.",
          text: JSON.stringify(response.statusText)
        });
      }
    })

    .then((response) => response)

    .catch((e)=>{
      console.log("error!",e);
      return Swal.fire({
        icon: "error",
        title: "Oops, algo salió mal con el servidor desde el post.",
        text: JSON.stringify(e)
      });
    })

  },

  get: async (url = "") => {
    return fetch(`${urlBase+url}`)
    .then((response)=>{
      if(response.ok){
        try{
          return response.json();
        }catch(e){
          console.error("Error al tratar de retornar un json en la respuesta de la promesa");
          return JSON.stringify(e);
        }
      }else{
        return Swal.fire({
          icon: "error",
          title: "Oops, ocurrió un error.",
          text: JSON.stringify(response.statusText)
        });
      }
    })
    .then((response) => response )
    .catch((e)=>{
      console.log("error!",e);
      return Swal.fire({
        icon: "error",
        title: "Oops, algo salió mal con el servidor desde el get.",
        text: JSON.stringify(e)
      });
    })
  },

}