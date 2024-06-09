<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;

  class roles extends DBConnect{

    private $rol;

    public function __construct(){
    	parent::__construct();
    } 

    public function getModulos(){
      $this->modulos();
    }

    private function modulos(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM tmodulos WHERE status = 1"); 
        $new->execute();
        $permisos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($permisos));

      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }
    }

    public function getRoles(){
      $this->roles();
    }

    private function roles(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("SELECT * FROM troles WHERE status = 1"); 
        $new->execute();
        $permisos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($permisos));

      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }
    }

    public function getRolesPermisos($rolID){
      $this->rol = $rolID;
      $this->rolesPermisos();
    }

    private function rolesPermisos(){
      try{
        parent::conectarDB();
        $new = $this->con->prepare("
        SELECT
          a.idAcceso  AS idAcceso,
          r.IdRol     AS idRol,
          r.nombre    AS nombreRol,
          m.idModulo  AS idModulo,
          m.nombre    AS nombreModulo,
          p.idPermiso AS idPermiso,
          p.nombre    AS nombrePermiso
        FROM taccesos a
        JOIN troles r ON a.rol = r.idRol
        JOIN tmodulos m ON a.modulo = m.idModulo
        JOIN tpermisos p ON a.permiso = p.idPermiso
        WHERE r.IdRol = ? AND a.status = 1
        "); 
        $new->bindValue(1 , $this->rol);
        $new->execute();
        $permisos = $new->fetchAll(\PDO::FETCH_OBJ);
        parent::desconectarDB();

        die(json_encode($permisos));

      }catch(exection $error){
        die(json_encode(["error" => $error]));
      }
    }

  }

?>