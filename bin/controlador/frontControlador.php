<?php 

  namespace  bin\controlador;

  use config\configSistema\configSistema as configSistema;

  class frontControlador extends configSistema{
    private $url;
    private $nombreControlador;
    private $directory;
    private $controlador;

    public function __construct($url){
      $nombreControlador = str_replace("/", "", $url);
      if(strpos($nombreControlador, "?")) $nombreControlador = substr($nombreControlador, 0, strpos($nombreControlador, "?"));

      if(isset($nombreControlador)) {

        $this->nombreControlador = !!strlen($nombreControlador) ? $nombreControlador : 'inicio';
        $this->url = $url;
        $sistem = new configSistema();
        $this->directory = $sistem->_Dir_();
        $this->controlador = $sistem->_Control_();
        $this->validarURL();
      }else{
        die("<script>location='/'</script>");
      }
    }

    private function validarURL(){
      $pattern = preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$ ]{1,700}$/",$this->nombreControlador);
      if($pattern == 1){
        $this->_loadPage($this->nombreControlador);
      }else{
        die("<script>location='/404'</script>");
      }
    }

    private function _loadPage($url){
      if(file_exists($this->directory.$url.$this->controlador)){
        require_once($this->directory.$url.$this->controlador);
      }else{
        die("<script>location='/404'</script>");
      }
    }

  }
  
?>



