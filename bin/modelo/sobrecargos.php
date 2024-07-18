<?php 

  namespace modelo;

  use config\connect\DBConnect as DBConnect;
  use \PDO;
  class sobrecargos extends DBConnect{
    private $id;
    private $precio;
    private $descripcion;
    private $habilitado;

    public function __construct(){
    	parent::__construct();
    }
    public function getSobrecargos(){
      $this->getAll();
    } 
    private function getAll(){
      try{
        $this->conectarDB();
        $consulta = "SELECT * FROM tsobrecargos";
        $ejecucion=$this->con->prepare($consulta); 
        $ejecucion->execute();
        $data=$ejecucion->fetchAll(PDO::FETCH_ASSOC);
        $this->desconectarDB();
        die (json_encode($data));
      }catch (\PDOException $e) {       
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
      } 
    }
    public function getInsert($precio,$descripcion){
      $validarPrecio=array($precio);
      $this->validarSTA($validarPrecio,5);
      $validarDecripcion=array($descripcion);
      $this->validarSTA($validarDecripcion,6);
      $this->precio=$precio;
      $this->descripcion=$descripcion;
      $this->insert();
    }
    public function getUpdate($id,$precio,$descripcion){
      $validarPrecio=array($precio);
      $this->validarSTA($validarPrecio,5);
      $validarDecripcion=array($descripcion);
      $this->validarSTA($validarDecripcion,6);
      $validarId=array($id);
      $this->validarSTA($validarId,10);
      $this->id=$id;
      $this->precio=$precio;
      $this->descripcion=$descripcion;
      $this->update();
    }
    private function update(){
      try{
        $this->conectarDB();
        $consulta = "UPDATE tsobrecargos SET precio = :precio, descripcion = :descripcion WHERE idSobrecargo = :id";
        $ejecucion=$this->con->prepare($consulta);
        $ejecucion->bindParam(':precio', $this->precio);
        $ejecucion->bindParam(':descripcion', $this->descripcion);
        $ejecucion->bindParam(':id', $this->id);
        $ejecucion->execute();
        $this->desconectarDB();
      }catch (\PDOException $e) {
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
        }
    }
    private function insert(){
      try{
        $this->conectarDB();
        $consulta = "INSERT INTO tsobrecargos (precio,descripcion,habilitado) values (?,?,?)";
        $ejecucion=$this->con->prepare($consulta);
        $ejecucion->bindValue(1,$this->precio);
        $ejecucion->bindValue(2,$this->descripcion);
        $ejecucion->bindValue(3,1);
        $ejecucion->execute();
        $this->desconectarDB();
      }
      catch (\PDOException $e) {
        header('Content-Type: application/json');
        die(json_encode(array("error" => $e->getMessage())));
        }
    }
    public function getDelete($id,$habilitado){
      $validarId=array($id);
      $this->validarSTA($validarId,10);
      $validarHabilitado=array($habilitado);
      $this->validarSTA($validarHabilitado,1);
      $this->id=$id;
      $habilitado=(int)$habilitado;
      $habilitado = $habilitado == 1 ? 0 : 1;
      $this->habilitado=$habilitado;
      $this->delete();
    }
    private function delete(){
      try{
        $this->conectarDB();
        $consulta = "UPDATE tsobrecargos SET habilitado = :habilitado where idSobrecargo = :id";
        $ejecucion=$this->con->prepare($consulta);
        $ejecucion->bindParam(':habilitado', $this->habilitado);
        $ejecucion->bindParam(':id', $this->id);
        $ejecucion->execute();
        $this->desconectarDB();
        }
        catch (\PDOException $e) {
          header('Content-Type: application/json');
          die(json_encode(array("error" => $e->getMessage())));
        }
    }
    private function validarSTA($datoArray,$diff){
      $arrayLogico = array(0 => "/^[A-Za-z]{3,45}$/",
      1 => "/^[0-9]{1,45}$/", 
      2 => "/^[0-9A-Za-z- ]{0,45}$/", 
      3 => "/^[0-9:\/-]{1,45}$/", 
      4 => "/^[0-9A-Za-z ]{0,45}$/",
      5 => "/^[\d]+(\.[\d]{1,2})?$/",//valida precio
      6=> "/^.{0,200}$/",//validar descripcion
      7=>"/^\d{6}-[1-9]\d*$/",//valida la orden
      8=>"/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",//validar email
      9=>"/^202[4-9]-|203[0-9]-|20[1-9][0-9]-|(21[0-9][0-9]|220[0-9])-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]) (0[0-9]|1[0-9]|2[0-3]):(0[0-9]|[1-5][0-9])$/",//validar DATETIME YYYY-MM-DD HH:MM:SS
      10=>"/^SOB-\d{2}$/" //validar id Sobrecargo
      );
      foreach ($datoArray as $key) {
        $validador = preg_match_all($arrayLogico[$diff], $key);
        if($validador!=1){
          $respuesta = ["error" => "Datos Incorrectos."];
          return $respuesta;
        }
      }
      return 0;
    }



  }
?>