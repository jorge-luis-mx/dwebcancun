<?php

class Metas{
	private $id;
	private $title;
	private $description;
	private $status;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	public function getMetas(){

		$res = array();
		$string="SELECT * FROM meta
		INNER JOIN categoria ON meta.id_categoriafk=categoria.id_categoria";
		$stmt = $this->db->query($string);
		if ($stmt) {
			while ($exec = $stmt->fetch_assoc()) {
				 $res[] = $exec;
			}
	  }
      return $res;
   }
	
	
}