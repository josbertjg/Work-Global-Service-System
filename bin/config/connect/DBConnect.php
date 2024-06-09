<?php 

  namespace config\connect;
  use config\configSistema\configSistema as configSistema;
  use \PDO;

  class DBConnect extends configSistema{

    protected $con;
    private $usuario;
    private $contra;
    private $local;
    private $nameBD;

    private $modulo;
    private $rol;

    
    public function __construct(){

      $this->usuario = parent::_USER_();
      $this->contra = parent::_PASS_();
      $this->local = parent::_LOCAL_();
      $this->nameBD = parent::_BD_();
    }

    protected function conectarDB(){
      try {
        $this->con = new \PDO("mysql:host={$this->local};dbname={$this->nameBD}", $this->usuario, $this->contra);  
      } catch (\PDOException $e) {       
        die("¡Error!: " . $e->getMessage());
      }
    }

    protected function desconectarDB(){
      $this->con = NULL;  
    }

    protected function registrarBitacora($modulo, $usuario, $descripcion){
      try {
        $this->conectarDB();
        $new = $this->con->prepare("INSERT INTO tbitacoras(modulo, usuario, descripcion) VALUES (?,?,?)");
        $new->bindValue(1, $modulo);
        $new->bindValue(2, $usuario);
        $new->bindValue(3, $descripcion);
        $new->execute();
        $this->desconectarDB();
      } catch (\PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        $this->desconectarDB();
        die();
      }
    }

    protected function uniqueID(){
      return bin2hex(random_bytes(5));
    }

    public function getPermisosRol($rol){
      $this->rol = $rol;
      return $this->consultarPermisos();
    }

    private function consultarPermisos(){

      try {
        $this->conectarDB();
        $new = $this->con->prepare('SELECT idModulo, nombre FROM tmodulos');
        $new->execute();
        $modulos = $new->fetchAll(\PDO::FETCH_OBJ);
        $permisos = [];
        foreach ($modulos as $modulo) { $permisos[$modulo->nombre] = []; }

        $new = $this->con->prepare("
          SELECT
            a.idAcceso,
            r.idRol     AS idRol,
            r.nombre    AS nombreRol,
            m.idModulo  AS idModulo,
            m.nombre    AS nombreModulo,
            p.idPermiso AS idPermiso,
            p.nombre    AS nombrePermiso
          FROM taccesos a
          JOIN troles r ON a.rol = r.idRol
          JOIN tmodulos m ON a.modulo = m.idModulo
          JOIN tpermisos p ON a.permiso = p.idPermiso
          WHERE r.IdRol = ? AND a.status = 1;
        ");
        $new->bindValue(1,$this->rol);
        $new->execute();
        $accesos = $new->fetchAll(\PDO::FETCH_OBJ);

        foreach ($accesos as $acceso) {
          $permisos[$acceso->nombreModulo][$acceso->nombrePermiso] = $acceso->nombrePermiso;
        }

        $this->desconectarDB();

        return $permisos;

      } catch (\PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      }

    }

  }


?>