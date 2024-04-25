$(document).ready(()=>{
  document.getElementById("ancla").onclick = async ()=>{
    const respuesta = await service.post("inicio",{prueba: true})
  }
})