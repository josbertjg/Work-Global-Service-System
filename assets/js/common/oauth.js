function loginUser(userObj){
  //Guardando en el local storage
  localStorage.setItem("user",JSON.stringify(userObj));

  // Revisando si el usuario tiene o no foto de perfil
  _.isEmpty(userObj.fotoPerfil) ? userObj.fotoPerfil = "assets/img/user.svg" : null;

  // Mostrando la info del usuario
  $(".header-avatar").attr("src"," ")
  $(".header-avatar").attr("src",userObj.fotoPerfil)
  $(".header-user-name").text(`${userObj.nombre} ${Array.from(userObj.apellido).shift().toUpperCase()}.`)
  $(".profile-dropdown-menu").empty();
  $(".profile-dropdown-menu").append(`
    <li><a class="dropdown-item navigation-link" href="perfil">Perfil</a></li>
    <li><a class="dropdown-item navigation-link" href="servicios">Servicios</a></li>
    <li><a class="dropdown-item navigation-link" href="alertas">Alertas</a></li>
    <li><hr class="dropdown-divider m-0 p-0"></li>
    <li><a class="dropdown-item navigation-link" href="ayuda"><i class="fa-solid fa-circle-info me-1"></i> Ayuda</a></li>
    <li><a class="dropdown-item logout" href="#"><i class="fa-solid fa-right-to-bracket me-1"></i> Cerrar Sesión</a></li>
  `);
  $(".close-acceder-modal").trigger("click")

  $(".servicios-header-btn").removeClass("d-none");
  $(".servicios-header-btn").removeClass("d-inline-block");
  $(".alertas-header-dropdown").removeClass("d-none");
  $(".alertas-header-dropdown").removeClass("d-inline-block");
  $(".ofrecerServicios-header-btn").removeClass("d-inline-block");
  $(".ofrecerServicios-header-btn").addClass("d-none");

  $(".footer-tabs").empty();
  $(".footer-tabs").append(`
    <a href="/" class="tab-item navigation-link active">
    <i class="fa-solid fa-house-chimney"></i>
      <span>Home</span>
    </a>
    <a href="servicios" class="tab-item navigation-link">
      <i class="fa-solid fa-calendar"></i>
      <span>Servicios</span>
    </a>
    <a href="alertas" class="tab-item navigation-link">
      <i class="fa-solid fa-bell"></i>
      <span>Alertas</span>
    </a>
    <a href="perfil" class="tab-item navigation-link">
    <i class="fa-solid fa-user"></i>
      <span>Perfil</span>
    </a>
  `);

  // Toast de sesion exitosa
  Toast.fire({
    icon: "success",
    title: "Sesión iniciada correctamente!"
  });
}

async function logoutUser(){
  localStorage.clear();
  const respuesta = await service.post("oauth",{logout: true})
  if("logout" in respuesta){
    $(".header-avatar").attr("src","assets/img/user.svg");
    $(".header-user-name").text("Acceder");
    $(".profile-dropdown-menu").empty();
    $(".profile-dropdown-menu").append(`
      <li>
        <a type="button" class="iniciarSesion-btn" data-bs-toggle="modal" data-bs-target="#acceder-modal">
          <i class="fa-solid fa-right-to-bracket me-1"></i>
          Iniciar Sesión
        </a>
      </li>
      <li>
        <a type="button" class="crearCuenta-btn" data-bs-toggle="modal" data-bs-target="#acceder-modal">
          <i class="fa-solid fa-user-plus me-1"></i>
          Crear Cuenta
        </a>
      </li>
    `);
    $(".servicios-header-btn").removeClass("d-inline-block");
    $(".servicios-header-btn").addClass("d-none");
    $(".alertas-header-dropdown").removeClass("d-inline-block");
    $(".alertas-header-dropdown").addClass("d-none");
    $(".ofrecerServicios-header-btn").removeClass("d-none");
    $(".ofrecerServicios-header-btn").addClass("d-inline-block");

    $(".footer-tabs").empty();
    $(".footer-tabs").append(`
      <a href="/" class="tab-item navigation-link active">
        <i class="fa-solid fa-house-chimney"></i>
        <span>Home</span>
      </a>
      <a href="#" class="tab-item crearCuenta-footer-btn">
        <i class="fa-solid fa-user-plus"></i>
        <span>Crear Cuenta</span>
      </a>
      <a href="#" class="tab-item  iniciarSesion-footer-btn">
        <i class="fa-solid fa-right-to-bracket"></i>
        <span>Iniciar Sesión</span>
      </a>
    `);

    initGoogleOAUTH();
  }else{
    Toast.fire({
      icon: "error",
      title: "No se pudo cerrar la sesión debido a un error inesperado, intentalo mas tarde..."
    });
  }
}
