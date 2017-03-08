<?php 

namespace Chongieball\Models;

abstract class BaseModel
{
	protected $table;
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$this->db
			 ->select('*')
			 ->from($this->table);

		$result = $this->db->execute();

		return $result->fetchAll();
	}

	//conditional find
	public function find($column, $value)
	{
		$param = ':'.$column;
		$this->db
			 ->select('*')
			 ->from($this->table)
			 ->where($column . ' = '. $param)
			 ->setParameter($param, $value);

		$result = $this->db->execute();

		return $result->fetch();
	}
}