<?php

class Save{

	private $con;

		function __construct($con){
			$this->con = $con;		
	}

	public function saveEvent($str){
		$id_event = null;

		$con = $this->con->db_connect();
		$sqlQuery = $con->query($str);
		$id_event = $con->insert_id;
		return $id_event;
	}
	
}