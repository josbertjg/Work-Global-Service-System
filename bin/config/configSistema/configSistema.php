<?php 

	namespace config\configSistema;

	define("_URL_", "http://localhost:3000/");
	define("_BD_", "workglobalservice");
	define("_BDS_", "swgs");
	define("_PASS_", "");
	define("_USER_", "root");
	define("_LOCAL_", "localhost");
	define("DIRECTORY", "bin/controlador/");
	define("MODEL", "modelo/");
	define("CONTROLADOR", "Controlador.php");
	define("GOOGLE_MAPS_API_KEY", "AIzaSyAq3r4lu7C6eoWH8Z3yrjt_kTQSNR5otN8");
	define("GOOGLE_CLIENT_ID", "693975473678-b86p297jev500g49ped7f9hpl2ijku1p.apps.googleusercontent.com");
	class configSistema{

		public function _int(){
			if(!file_exists("bin/controlador/frontControlador.php")){
				return "Error configSistema";
			}
		}

		public function _URL_(){
			return _URL_;
		}
		public function _BD_(){
			return _BD_;
		}
		public function _BDS_(){
			return _BDS_;
		}
		public function _PASS_(){
			return _PASS_;
		}
		public function _USER_(){
			return _USER_;
		}
		public function _LOCAL_(){
			return _LOCAL_;
		}
		public function _Dir_(){
			return DIRECTORY; 
		}
		public function _MODEL_(){
			return MODEL;
		}
		public function _Control_(){
			return CONTROLADOR;
		}
		public function GMAP_API_KEY(){
			return GOOGLE_MAPS_API_KEY;
		}
		public function GMAP_CLIENT_ID(){
			return GOOGLE_CLIENT_ID;
		}
	}

 ?>