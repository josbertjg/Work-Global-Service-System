window.onload = ()=>{
  
  document.getElementById("ancla").onclick = async ()=>{

    const respuesta = await service.post("inicio",{prueba: true})
    console.log(respuesta)

  }
}