<?php

namespace App\Controllers;

use \Core\View;

/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Items extends Authenticated
{

    /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    /*
    protected function before()
    {
        $this->requireLogin();
    }
    */

    /**
     * Items index
     *
     * @return void
     */
    public function indexAction()
    {


        print_r($_POST);
        View::renderTemplate('Items/index.html');
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {

        $string = file_get_contents("export.json");
        $json_a = json_decode($string, true);   
        // var_dump($json_a);

        $CSVinsertString = "(";

        $index = 0;
        foreach($json_a as $key => $value){
        
            if($index < 4)
            {
                $CSVinsertString .=  "'$value'" . ",";   
            }
            else
            {
                $CSVinsertString .=  "'$value'" ;     
            }
        $index++;

        }
        $CSVinsertString .= ")";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pidata";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "INSERT INTO `tempdata2` (`uuid`, `date`, `time`, `temp_fahrenheit`, `temp_celsius` ) VALUES $CSVinsertString";
        echo $sql;
        mysqli_query($conn, $sql);

        
    }

    /**
     * Show an item
     *
     * @return void
     */
    public function showAction()
    {
        echo "show action";
    }
}
