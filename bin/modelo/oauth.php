<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class oauth extends DBConnect{

    private $nombre;
    private $apellido;
    private $email;
    private $fotoPerfil;
    private $contraseña;
    private $oauth_type;
    private $emailVerificado;
    private $idRol;
    private $clientID;

    public function __construct(){
      parent::__construct();
    } 

    public function gmail_oauth($credentials=""){
      $respuesta = null;

      if(empty($credentials)) die(json_encode(array("error"=>"Se esperaba un valor en la propiedad credentials")));

      list($header, $payload, $signature) = explode(".", $credentials);

      $responsePayload = json_decode(base64_decode($payload));

      if(!empty($responsePayload)) 
        return $this->registerGmailOAUTH($responsePayload);
      else 
        $respuesta = array("error" => "Ocurrio un error con la respuesta de google, vuelve a intentarlo.");

      die(json_encode($respuesta));
    }

    private function registerGmailOAUTH($responsePayload){
      // User profile info
      $this->nombre = !empty($responsePayload->given_name) ? $responsePayload->given_name:'';
      $this->apellido = !empty($responsePayload->family_name) ? $responsePayload->family_name:'';
      $this->email = !empty($responsePayload->email) ? $responsePayload->email:'';
      $this->fotoPerfil = !empty($responsePayload->picture) ? $responsePayload->picture:'';
      $this->oauth_type = "gmail_oauth";
      $this->idRol = "CLWGS1";

      $usuarioEncontrado = $this->buscarUsuario($this->email);

      if(empty($usuarioEncontrado)){
        try{
          parent::conectarDBS();
          
          $this->fotoPerfil = $this->uploadGoogleUserImage($this->fotoPerfil);
          $new = $this->con->prepare("INSERT INTO `tusuarios`(`email`, `nombre`, `apellido`, `fotoPerfil`, `oauth_type`, `idRol`, `emailVerificado`, `activo`) VALUES (?,?,?,?,?,?,1,1)");
          $new->bindValue(1, $this->email);
          $new->bindValue(2, $this->nombre);
          $new->bindValue(3, $this->apellido); 
          $new->bindValue(4, $this->fotoPerfil);
          $new->bindValue(5, $this->oauth_type);
          $new->bindValue(6, $this->idRol);
          $exito = $new->execute();
          parent::desconectarDB();
          if($exito){
            //$this->registrarWGS();
            $respuesta = $this->userInfo();
            $this->saveUserSession();
            $this->registrarBitacora("registro",$this->email,"Usario se ha registrado con Google al sistema");
          }else{
            $respuesta = array("error" => $new->errorCode());
          }
  
        }catch(exection $error){
          $respuesta = array("error" => json_encode($error));
        }

      }else{
        if($usuarioEncontrado->activo == 1){
          if($usuarioEncontrado->oauth_type === "account_password"){
  
            $this->conectarDBS();
            $new = $this->con->prepare("UPDATE tusuarios SET `oauth_type`= 'multi_oauth' ,`emailVerificado`= 1 WHERE email = ?");
            $new->bindValue(1, $this->email);
            $exito = $new->execute();
            parent::desconectarDB();

            if($exito){
               
              $this->registrarBitacora("Iniciar Sesión",$this->email,"Inicio sesión con GMAIL habiendose registrado previamente con usuario y contraseña.");

            }else{
              $respuesta = array("error" => $new->errorCode());
            }
  
          }else{
            $this->registrarBitacora("Iniciar Sesión",$this->email,"Inicio sesión en el sistema con GMAIL.");
          }
          if($usuarioEncontrado->idRol=="CLWGS1"){
          try{
            parent::conectarDB();
            $new = $this->con->prepare("SELECT * FROM tclientes WHERE email = ?");
            $new->bindValue(1, $this->email);
            $new->execute();
            $cliente = $new->fetch(\PDO::FETCH_OBJ);
            $this->clientID = $cliente->id;
            parent::desconectarDB();
    
          }catch(exception $error){
            $respuesta = ["error" => $error];
          }}
          $this->fotoPerfil = $usuarioEncontrado->fotoPerfil;
          $this->nombre = $usuarioEncontrado->nombre;
          $this->apellido = $usuarioEncontrado->apellido;
          $this->idRol = $usuarioEncontrado->idRol;

          $respuesta = $this->userInfo();
          $this->saveUserSession();

        }else{
          $respuesta = ["error" => "Usuario no activo o inhabilitado."];
        }
      }

      die(json_encode($respuesta));
    }

    public function account_password_login($email,$contraseña){
      
      $emailIsValid = $this->validarEmail($email);
      if(!$emailIsValid) {
        $error = array("error" => "El correo electrónico no es válido");
        die(json_encode($error));
      }
      
      $passwordIsValid = $this->validarPassword($contraseña);
      if(!$passwordIsValid) {
        $error = array("error" => "La contraseña no es valida, debe tener al menos un número, una letra minúscula, una letra mayúscula, un caracter especial y una longitud de 8 caracteres.");
        die(json_encode($error));
      }

      $this->email      = $email;
      $this->contraseña = $contraseña;

      $this->loginAccountPassword();
      
    }

    private function loginAccountPassword(){

      $usuarioEncontrado = $this->buscarUsuario($this->email);

      $resultado = null;
      if(!empty($usuarioEncontrado)){
        if(password_verify($this->contraseña,$usuarioEncontrado->contraseña)){
          if($usuarioEncontrado->activo == 0){
            $resultado = ['error' => 'Usuario desactivado o inhabilitado.'];
          }else{
            try{
              parent::conectarDB();
              $new = $this->con->prepare("SELECT * FROM tclientes WHERE email = ?");
              $new->bindValue(1, $this->email);
              $new->execute();
              $usuario = $new->fetch(\PDO::FETCH_OBJ);
              $this->clientID = $this->usuario->id;
              parent::desconectarDB();
      
            }catch(exception $error){
              $respuesta = ["error" => $error];
            }
            $this->nombre     = $usuarioEncontrado->nombre;
            $this->apellido   = $usuarioEncontrado->apellido;
            $this->fotoPerfil = $usuarioEncontrado->fotoPerfil;
            $this->idRol      = $usuarioEncontrado->idRol;
            $resultado        = $this->userInfo();
            $this->saveUserSession();
            $this->registrarBitacora("Iniciar Sesión",$this->email,"Inicio sesión en el sistema con usuario y contraseña");
          }
        }else{
          if($usuarioEncontrado->oauth_type === "gmail_oauth")
            $resultado = ['error' => 'Ya existe un usuario con este email que fue autenticado a través de google, inicia sesión con google para loguearte correctamente.'];
          else
            $resultado = ['error' => 'Usuario o contraseña incorrectos.'];
        }
      }else{
        $resultado = ['error' => 'Usuario o contraseña incorrectos.'];
      }
      
      die(json_encode($resultado));
    }

    public function account_password_register($nombre, $apellido, $email, $contraseña, $confirmarContraseña){
      $emailIsValid = $this->validarEmail($email);
      if(!$emailIsValid) {
        $error = array("error" => "El correo electrónico no es válido");
        die(json_encode($error));
      }
      
      $passwordIsValid = $this->validarPassword($contraseña);
      if(!$passwordIsValid) {
        $error = array("error" => "La contraseña no es valida, debe tener al menos un número, una letra minúscula, una letra mayúscula, un caracter especial y una longitud de 8 caracteres.");
        die(json_encode($error));
      }

      $passwordConfirmIsValid = $this->validarConfirmarContraseña($contraseña,$confirmarContraseña);
      if(!$passwordConfirmIsValid) {
        $error = array("error" => "Ambas contraseñas deben coincidir.");
        die(json_encode($error));
      }

      $usuarioEncontrado = $this->buscarUsuario($email);
      if(!empty($usuarioEncontrado)){
        $error = ["error" => "Ya existe un usuario registrado con este correo electrónico."];
        die(json_encode($error));
      }

      $this->email      = $email;
      $this->nombre     = $nombre;
      $this->apellido   = $apellido;
      $this->contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
      $this->idRol      = "CLWGS1";
      $this->oauth_type = "account_password";

      $this->registerAccountPassword();
    }

    private function registerAccountPassword(){
      $this->conectarDBS();

      $new = $this->con->prepare("INSERT INTO `tusuarios`(`email`, `nombre`, `apellido`, `contraseña`, `idRol`, `oauth_type`, `activo`) VALUES (?,?,?,?,?,?,1)"); 
      $new->bindValue(1 , $this->email);
      $new->bindValue(2 , $this->nombre);
      $new->bindValue(3 , $this->apellido);
      $new->bindValue(4 , $this->contraseña);
      $new->bindValue(5 , $this->idRol);
      $new->bindValue(6 , $this->oauth_type);
      $exito = $new->execute();
      
      $this->desconectarDB();
      
      $resultado = null;
      if($exito){
        $resultado = ['success' => "Usuario registrado exitosamente."];
        $this->registrarWGS();
        $this->registrarBitacora("Registro", $this->email, "Se ha registrado con usuario y contraseña.");
      }else{
        $resultado = ['error' => 'Usuario o contraseña incorrectos.'];
      }
      
      die(json_encode($resultado));
    }

    private function validarEmail($email){
      $regExp = '/^(?:(?:[^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@(?:(?:\[(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i';
      return preg_match_all($regExp, $email);
    }

    private function validarPassword($contraseña){
      $regExp = '/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()_+[\]{};\\":|,.<>\/?]).{8,}$/';
      return preg_match_all($regExp, $contraseña);
    }

    private function validarConfirmarContraseña($contraseña, $confirmarContraseña){
      return $contraseña === $confirmarContraseña;
    }

    private function buscarUsuario($email){
      try{
				parent::conectarDBS();
        $new = $this->con->prepare("SELECT * FROM tusuarios WHERE email = ?");
        $new->bindValue(1, $email);
        $new->execute();
        $usuario = $new->fetch(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        return $usuario;

      }catch(exection $error){
        return $error;
      }
    }

    private function userInfo(){
      $usuario = array(
        "clientID"   => $this->clientID,
        "nombre"     => $this->nombre,
        "apellido"   => $this->apellido,
        "email"      => $this->email,
        "fotoPerfil" => $this->fotoPerfil,
        "idRol"      => $this->idRol,
        "permisos"   => $this->getPermisosRol($this->idRol)
      );
      return $usuario;
    }

    private function saveUserSession(){
      $_SESSION["clientID"]   = $this->clientID;
      $_SESSION["email"]      = $this->email;
      $_SESSION["nombre"]     = $this->nombre;
      $_SESSION["apellido"]   = $this->apellido;
      $_SESSION["fotoPerfil"] = $this->fotoPerfil;
      $_SESSION["idRol"]      = $this->idRol;
    }

    private function uploadGoogleUserImage($url){
      $nombre = $this->email . ".jpg";
      $dir    = "assets/img/perfil/";
      $imagen = file_get_contents($url);
      file_put_contents($dir.$nombre,$imagen);
      return $dir.$nombre;
    }
    private function registrarWGS(){
      try{
				parent::conectarDB();
        $new = $this->con->prepare("INSERT INTO tclientes (email) VALUES (?)");
        $new->bindValue(1,$this->email);
        $new->execute();
        $this->clientID = $this->con->lastInsertId();
        parent::desconectarDB();
      }catch(exection $error){
        return $error;
      }
    }
  }
?>