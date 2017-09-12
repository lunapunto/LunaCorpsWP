<?php
/*
* Clase de base de datos
* Pasa la parámetros del archivo config.php
*/

class db{
    public $db = array();
    public $db_error = false;
    public $db_qstr;
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $database = DATABASE;

    /*
    * MySQL connect
    *
    * (obj) mysqli link
    */
    public function __construct(){
      $db = new mysqli($this->host, $this->username, $this->password, $this->database);
      if($db->connect_errno){
        throw new Exception('MYSQL DATABASE CONNECTION FAILED.');
      }
      return $this->db = $db;
    }
    /*
    * MySQL Query
    * @params (string) $query
    * @exception Si el query es inválido
    *
    * (obj) Resultado del query
    */
    public function query($query){
        if(!$this->db_error){
            $q = $this->db->query($query);
            if(!$q){
              $this->db_error = true;
              throw new Exception('Problema en la consulta de la BD: '.$this->db->error);
            }
            $this->db_error = false;
            return $q;
        }else{
          return $this->db_error;
        }
        $this->db_qstr = $query;
    }
    /*
    *Fetch a query (used for single result queries)
    *@params MySQL query
    *@returns array containing row
    *@returns error
    */
    public function fetch($query){
     $q = $this->query($query);
     return mysqli_fetch_array($q);
    }
    /*
    *Fetch_assoc (used for multiple result queries)
    *@params MySQL query
    *@returns array containing rows (2-dim array)
    *@returns error
    */
    public function assoc($query){
    $q = $this->query($query);
    $output = array();
        if(!$this->db_error){
        while($row = $q->fetch_assoc()){
        $output[] = $row;
        }
        return $output;
        }else{
        return $q;
        }
    }
    /*
    *Insert function
    *@params table_name, array($col=>$value)
    *@returns last insert_id
    *@returns error
    */
    public function i($table, $colsvals){
    $c = array();
    $v = array();
    foreach($colsvals as $col=>$val){
    $c[] = $col;
    $v[] = '"'.$val.'"';
    }
    $c = implode(',',$c);
    $v = implode(',',$v);
    $pq = 'INSERT INTO '.$table.' ('.$c.') VALUES ('.$v.')';
    $q = $this->query($pq);
        if(!$this->db_error){
        return $this->db->insert_id;
        }else{
        return $q;
        }
    }
    /*
    *Update function
    *@params table_name, array($col=>$value), array($col=>$value) [WHERE $col=$value], (special requirements (string) [AND ID != * p.e])
    *@returns true
    *@returns error
    */
    public function u($table,$colsvals,$col_val, $special = NULL){
    $cv = array();
        foreach($colsvals as $col=>$val){
           $cv[] = $col.'="'.$val.'"';
        }
        foreach($col_val as $col=>$val){
        $w = $col.'="'.$val.'"';
        }
        $w .= ($special ? ' '.$special : '');
        $cv = implode(',',$cv);
        $pq = 'UPDATE '.$table.' SET '.$cv.' WHERE '.$w;
        $q = $this->query($pq);
        if(!$this->db_error){
        return;
        }else{
        return $q;
        }
    }
    /*
    *Insert, on duplicate key update
    *@params table_name, array($col=>$value)
    *@returns insert_id
    *@returns error
    */
    public function ioru($table, $colsvals){
    $c = array();
    $v = array();
    foreach($colsvals as $col=>$val){
    $c[] = $col;
    $v[] = '"'.$val.'"';
    }
    $c = implode(',',$c);
    $v = implode(',',$v);
    $cv = array();
    foreach($colsvals as $col=>$val){
    $cv[] = $col.'="'.$val.'"';
    }
    $cv = implode(',',$cv);
    $pq = 'INSERT INTO '.$table.' ('.$c.') VALUES ('.$v.') ON DUPLICATE KEY UPDATE '.$cv;
    $q = $this->query($pq);
    if(!$this->db_error){
    return $this->db->insert_id;
    }else{
    return $q;
    }
    }
    /*
    *Delete a row
    *@params table_name, array($col=>$value) [WHERE $col=$value]
    */
    public function d($table,$colval){
        foreach($colval as $col=>$val){
            $d = $col.'="'.$val.'"';
        }
        $this->query('DELETE FROM '.$table.' WHERE '.$d);
    }

}
