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
class Organization extends \Core\Model
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


    public static function getOrganizations()
    {
        $sql  = 'SELECT * FROM `organization`';
        $db = static::getDB();
        $stmt = $db->query($sql);
        
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public static function getOrganizationInfo($orgId)
    {
        $sql  = "SELECT * FROM `organization` WHERE orgId = '$orgId'";
        $db = static::getDB();
        $stmt = $db->query($sql);
        
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public static function getOrganizationUsers($orgId)
    {
        $sql  = "SELECT * FROM `users` WHERE OrgId = '$orgId'";
        $db = static::getDB();
        $stmt = $db->query($sql);
        
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
    public static function UpdateUser()
    {
        
        $sql = "UPDATE `users` SET `lastName`= '$_POST[lastname]',`firstName`= '$_POST[firstname]' ,`email`= '$_POST[email]' ,`role`='$_POST[role]' WHERE `userId` = '$_POST[userId]'";
        
      
        $db = static::getDB();
        $stmt = $db->query($sql);  
                     
    }

    public static function DeleteUser()
    {
        
        
        $sql = "DELETE FROM `users` WHERE userId = '$_POST[userdeleteid]'";
        $db = static::getDB();
        $stmt = $db->query($sql);  
                     
    }
    public static function updateOrganization(){


        $sql = "UPDATE `organization` SET `orgId`='$_POST[orgId]' ,`orgName`='$_POST[OrgName]',`street`='$_POST[Street]',`city`='$_POST[City]',`state`='$_POST[State]',`zip`='$_POST[Zip]',`phone`='$_POST[Phone]',`email`= '$_POST[email]' WHERE orgId = '$_POST[orgId]'";
        $db = static::getDB();
        $stmt = $db->query($sql);  
    }
    
}