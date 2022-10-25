<?php

	class Metas{

		private $con;

		function __construct($con){
			$this->con = $con;	
		}

		public function get_metas(){
			$result = array();
			$sql= "SELECT * FROM meta INNER JOIN categoria ON meta.id_categoriafk=categoria.id_categoria";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;
		}

	}

?>