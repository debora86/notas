<?php

namespace miniOrm;
use PDO;
use Exception;

class Db {// el nombre de la clase Db

	private $link;
	private static $mysql;
	
	public $lastQuery;
//funcion el constructor que usa la conexion 
	private function __construct($name= _MO_DB_NAME_, $login= _MO_DB_LOGIN_, $mdp= _MO_DB_MDP_, $serveur= _MO_DB_SERVER_) {
		if(!$name)
			self::displayError('Please define your database name in miniOrm.config.php');
		try {
			$this->link = new PDO('pgsql:host=' . $serveur . ';dbname=' . $name, $login, $mdp);
		} catch(Exception $e) {
			self::displayError($e->getMessage());
		}
	}
	//funcion para el manejo de errores 
	public static function displayError($error) {
		$trace = debug_backtrace();
		if(_MO_DEBUG_)
			die('<fieldset>
				<legend>miniOrm Error</legend>'.
				$error.'<br/><small>'.$trace[0]['file'].' ('.$trace[0]['line'].')</small>
			</fieldset>');
	}

	private function quote($value) {
		$isNotString= array('NOW()');
		if (in_array($value, $isNotString)) {
			return $value;
		} else {
			return $this->link->quote($value);
		}
	}
//arma el where de los query
	private static function getQueryWhere($where) {
		$sql= '';
		if (is_array($where)) {
			foreach ($where as $key => $param) {
				if ($key == 0) {
					$sql.= ' WHERE ' . $param;
				} else {
					$sql.= ' AND ' . $param;
				}
			}
		} else {
			return ' WHERE ' . $where;
		}
		return $sql;
	}
//arma el select
	private function getQuerySelect($select, $from, $where= NULL, $groupby= NULL, $orderby= NULL, $limit= NULL) {
		$sql= 'SELECT ' . $select . ' FROM ' . $from.'';
		if ($where)
			$sql.= self::getQueryWhere($where);
		if ($groupby)
			$sql.= ' GROUP BY ' . $groupby;
		if ($orderby)
			$sql.= ' ORDER BY ' . $orderby;
		if ($limit)
			$sql.= ' LIMIT ' . $limit;
		return $sql;
	}
//arma el elimoinar
	private function getQueryDelete($table, $where= NULL) {
		$sql= 'DELETE FROM ' . $table.'';
		if ($where)
			$sql.= self::getQueryWhere($where);
		return $sql;
	}
//arma el insertar
	private function getQueryInsert($table, $values) {
		foreach ($values as $key => $value) {
			if($value) {
				$array_key[]= '' . $key . '';
				$array_value[]= $this->quote($value);
			}
		}
		return 'INSERT INTO ' . $table . ' (' . implode(',', $array_key) . ') VALUES (' . implode(',', $array_value) . ')';
	}
//arma el actualizar
	private function getQueryUpdate($table, $values, $where) {
		$array_value= array();
		foreach ((array)$values as $key => $value) {
			$array_value[]= $key . '=' . $this->link->quote($value);
		}
		return 'UPDATE ' . $table . ' SET ' . implode(', ', $array_value) . ' ' . self::getQueryWhere($where);
	}

//los ejecuta o confirma exec es igual pg_query
	public function exec($q) {
		$this->lastQuery = $q;
		$res= $this->link->query($q);
		return $this->queryResult($res);
	}
	
	//maneja los resultados de los query	
	private function queryResult($res) {
		try {
			if(!$res) {
				$errorInfo = $this->link->errorInfo();
				throw new Exception('<strong>'.$errorInfo[2].'</strong> : '.$this->lastQuery);
			} 
			return $res;
		} catch(Exception $e) {
			self::displayError($e->getMessage());
		}
	}
//una ves armado el select alla ariba este los usa osea esta es la que llamaremos para hacer nuestras consultas 
	public function consultar($select, $from=NULL , $where= NULL, $groupby= NULL, $orderby= NULL, $limit= NULL) {
		$i= 0;
		$r= array();
		# If only one parameter : first parameter is the full query
		$q = is_null($from) ? $select : self::getQuerySelect($select, $from, $where, $groupby, $orderby, $limit);
		$res = self::exec($q);
		if(is_object($res)) {
			while ($l= $res->fetch(PDO::FETCH_ASSOC)) {
				foreach ($l as $clef => $valeur)
					$r[$i][$clef]= $valeur;
				$i++;
			}
			return $r;
		} else {
			return false;
		}
	}
//la que cuenta obtiene un 0 o 1
	public function getRow($select, $from, $where= NULL, $groupby= NULL, $orderby= NULL) {
		$r= self::consultar($select, $from, $where, $groupby, $orderby, '0,1');
		return $r ? $r[0] : false;
	}
//obtiene los valores
	public function getValue($select, $from, $where= NULL, $groupby= NULL, $orderby= NULL) {
		$r= self::consultar($select, $from, $where, $groupby, $orderby, '0,1');
		return $r[0][$select];
	}
//obtiene los valores de los arreglos
	public function getValueArray($select, $from, $where= NULL, $groupby= NULL, $orderby= NULL, $limit= NULL) {
		$valueArray= array();
		$r= self::consultar($select, $from, $where, $groupby, $orderby, $limit);
		foreach ($r as $v) {
			$valueArray[]= $v[$select];
		}
		return $valueArray;
	}

	public function count($from, $where= NULL, $groupby= NULL) {
		$r= self::consultar('COUNT(*) as count', $from, $where, $groupby);
		return $r[0]['count'];
	}
//igual que la de consulta alla ariba se armo el query de isertar y aqui se usa
	public function insert($table, $values) {
		self::exec(self::getQueryInsert($table, $values));
		return $this->link->lastInsertId();
	}
//igual que la de consulta alla ariba se armo el query de eliminar y aqui se usa
	public function delete($table, $where) {
		self::exec(self::getQueryDelete($table, $where));
	}
//igual que la de consulta alla ariba se armo el query de actualizar y aqui se usa
	public function update($table, $values, $where) {
		self::exec(self::getQueryUpdate($table, $values, $where));
	}
//funcio ya crea el objeto de una ves solo lo llamamos crea los objetos
	public static function inst() {
		if (is_null(self::$mysql))
			self::$mysql= new Db();//aqui crea los objetos
		return self::$mysql;
	}

}
