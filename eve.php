<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eve
 *
 * @author Gallica
 */
require_once 'Database.php';
require_once 'Constants.php';

class EveStaticData {
    
    protected $dbh;
//    private $db_type = 'Sqlite'; # Mysql is other option
    private $db_type = 'Mysql'; # Sqlite is other option
    private $mysql_user = 'eveuser';
    private $mysql_pass = 'eveuser';
//    private $mysql_user = 'gallica';
//    private $mysql_pass = 'recorder123';
    private $db_host = '10.0.0.5';
//    private $db_host = 'localhost';
//    private $db_name = 'eve';
    private $db_name = 'eve_crius';
    
    function __autoload($class_name) {
        include $class_name .'.php';
    }
    
    function __construct() {
        if ( $this->db_type == 'Sqlite') {
            $db = new SqliteDB();
            $this->dbh = $db->connect('D:\Eve\kronos10.sqlite');
        } else {
            $db = new MySqlDB();
            $this->dbh = $db->connect($this->db_host, $this->db_name, $this->mysql_user, $this->mysql_pass);
        }        
    }
    
    function __destruct() {
        $this->dbh = null;
    }
    
    public function getMaterials($typeID) {
    
        if ( $this->db_type == 'Sqlite' ) {
            $stmt = $this->dbh->prepare(SQLITE_BUILD_MATERIALS);
            $parms = array($typeID, $typeID);
        } else {
            $stmt = $this->dbh->prepare(SQL_BUILD_MATERIALS);
            $parms = array($typeID);
        }
        
        $stmt->execute($parms);
        $materials = $stmt->fetchAll();
        
        return $materials;
    }
    
    public function getItemName($typeID) {
        
        if ( $this->db_type == 'Sqlite') {
            return $typeID;
        } else {
            $stmt = $this->dbh->prepare(SQL_ITEM_NAME);
            $parms = array($typeID);
    
        }
        
        $stmt->execute($parms);
        
        $name = $stmt->fetch();
        
        return $name['typeName'];
    }
    
    public function findItem($partName) {
        if ( $this->db_host == 'Sqlite') {
            return array(label => $partName, value => 18);
        } else {
            $stmt = $this->dbh->execute(SQL_FIND_ITEM_NAME);
            $parms = array('$partName%');            
        }
        
        $stmt->execute($parms);
        $names = $stmt->fetchAll();
        
        return $names;
    }
}   
