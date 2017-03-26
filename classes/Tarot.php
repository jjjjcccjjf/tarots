<?php

class Tarot 
{ 
	public $db;

	function __construct(PDO $db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare('SELECT * FROM tarots WHERE 1');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function get($id)
	{
		$stmt = $this->db->prepare('SELECT * FROM tarots WHERE id = ?');
		$stmt->execute([$id]);
		return $stmt->fetch();
	}

	public function add($data)
	{
		try {
	        $keys = array_keys($data);
		    $sql = "INSERT INTO tarots (".implode(", ",$keys).") \n";
		    $sql .= "VALUES ( :".implode(", :",$keys).")";        
		    $stmt = $this->db->prepare($sql);
		    return $stmt->execute($data);
		} catch (PDOException $e) { 
		    throw $e;
		}
	}

	public function update($id, $data)
	{
		try { 
			$sql = "UPDATE tarots SET \n";
			foreach($data as $key => $value){
				$sql .= "$key = '$value',";
			}
			$sql = rtrim($sql, ",") . "\n";
			$sql .= "WHERE id = $id";
		    $stmt = $this->db->prepare($sql);

		    return $stmt->execute($data);
		} catch (PDOException $e) { 
		    throw $e;
		}
	}

	public function deleteById($id)
	{
		try{
			$stmt = $this->db->prepare("DELETE FROM tarots WHERE id = ?");
			return $stmt->execute([$id]);
	    	return $stmt->execute($data);
		} catch (PDOException $e) { 
		    throw $e;
		}
	}

}