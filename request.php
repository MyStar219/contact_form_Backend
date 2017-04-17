<?php
header("Access-Control-Allow-Origin: *");

// Database class folder path
define( 'DBPATH', dirname(__FILE__) . '/database/' );

// erro reporting
error_reporting( E_ALL );

// get db environment variables
require_once( 'config.php' );

// include all databse classes
require_once( DBPATH . 'index.php' );
require_once( DBPATH . 'function.php' );

//check up to exsist of DB class
if ( !class_exists('DB') ) {
error_code('can not find db class.', __FILE__, __LINE__);
}

//global db variable
$db = require_db();


//create database and tables
$sql = "CREATE DATABASE " . DB_NAME;
$db->query($sql);

$sql ="USE " . DB_NAME;
$db->query($sql);

$tbl_fields = array(
    'id' => array(
                    'type' => 'int',
                    'constraint' => 11, 
                    'null' => false,
                    'auto_increment' => true
              ),
    'firstname' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'lastname' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'age' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'gender' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'address1' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'address2' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'zipcode' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              ),
    'state' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false
              )            
    );
                        
$db->add_field($tbl_fields);
$db->add_key('id', true);
$db->create_table(TBL_USERS, true);


//request processor
extract($_REQUEST, EXTR_OVERWRITE, "");
//signin and signup request processor
if (@$action == "registor"){    
        $db->set("firstname", $firstname);
        $db->set("lastname", $lastname);
        $db->set("age", $age);
        $db->set("gender", $gender);
        $db->set("address1", $address1);
        $db->set("address2", $address2);
        $db->set("zipcode", $zipcode);
        $db->set("state", $state);      
        if ($db->insert(TBL_USERS)){
            echo 'yes';
        } else {
            echo 'no';
        }           
} else {
    echo "nothing received!";
    die(0);
}

?>