<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;

/**
 * User model
 *
 * PHP version 7.0
 */
class Pi extends \Core\Model
{

    /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }


    public static function getPi($OrgId)
    {
        $sql = "SELECT * FROM `orgroom` WHERE OrgId = '$OrgId'";

        $db = static::getDB();
        $stmt = $db->query($sql);
        
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    
    public static function insert()
    {
        $string = file_get_contents("export.json");
        $json_a = json_decode($string, true);   
        var_dump($json_a);
        $CSVinsertString = "";

        foreach($json_a as $key => $value){
            foreach($value as $key => $value){
                // echo('This is the ' . $key . ' record');
                // echo '<br>';
                foreach($value as $key => $value){
                    // echo($key . $value); 
                    $CSVinsertString .= $value . ",";                                      
                    }  
                }   
                echo($CSVinsertString);
        }

        
        $sql = "INSERT INTO `tempdata2` (`uuid`, `time`, `temp_fahrenheit`, `temp_celsius`, `date`) VALUES $CSVinsertString ";
        $db = static::getDB();
        $stmt = $db->query($sql);
    }
}