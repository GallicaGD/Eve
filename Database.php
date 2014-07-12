<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gallica
 */
interface Database {
    //put your code here
    public function connect($host, $db, $user=NULL, $pass=NULL);
}

class MySqlDB implements Database {

    function connect($host, $db, $user=NULL, $pass=NULL) {
        $dsn = "mysql:dbname=$db;host=$host";
        if ( $user == NULL ) {
            throw new Exception('No username was passed for MySql connection');
        }
        
        try {
            $dbh = new PDO($dsn,$user,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Connection failed: ' . $ex->getMessage();
        }
        
        return $dbh;
    }
}

class SqliteDB implements Database {
    function connect($host, $db=NULL, $user=NULL, $pass=NULL) {
        $dsn = "sqlite:$host";
        
        try {
            $dbh = new PDO($dsn,$user,$pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Connection failed: ' . $ex->getMessage();
        }
        
        return $dbh;
        
    }
}