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
    public static function updatePi()
    {
         $sql = "UPDATE `orgroom` SET `roomId`='$_POST[roomId]', `bldg`='$_POST[building]' WHERE `uuid` = '$_POST[uuid]'";

        $db = static::getDB();
        $stmt = $db->query($sql);       
    }
    public static function deactivatePi()
    {
        
        $sql = "UPDATE `orgroom` SET `orgId`= null WHERE `uuid` = '$_POST[piuuid]'";


        $db = static::getDB();
        $stmt = $db->query($sql);     
         $sql = "DELETE FROM `orgroom` WHERE `orgId` IS NULL";       
        $db = static::getDB();
        $stmt = $db->query($sql);   
    }
    public static function addPi()
    {
        

        $sql = "SELECT  `piId` FROM `pi` WHERE uuid = '$_POST[uuid]'";

        $db = static::getDB();
        $stmt = $db->query($sql); 
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $piId = $results[0]['piId'];

        $sql = "INSERT INTO `orgroom`(`bldg`, `orgId`, `piId`, `uuid`, `roomId`) VALUES ('$_POST[bldg]','$_POST[orgId]',$piId,'$_POST[uuid]','$_POST[roomId]')";
        $db = static::getDB();
        $stmt = $db->query($sql); 

          
    }
    public static function getOpenPis()
    {
             
        $sql = "SELECT pi.uuid, pi.piId FROM pi LEFT JOIN orgroom ON pi.uuid = orgroom.uuid WHERE orgroom.orgId IS NULL";  
        $db = static::getDB();
        $stmt = $db->query($sql); 
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

}