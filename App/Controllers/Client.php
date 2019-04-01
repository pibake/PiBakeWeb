<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

use App\Models\Temperature;
use App\Models\Pi;


/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Client extends Authenticated
{

    /**
     * Before filter - called before each action method
     *
     * @return void
     */
    protected function before()
    {
        parent::before();

        $this->user = Auth::getUser();
    }

    /**
     * Items index
     *
     * @return void
     */
    public function indexAction()
    {
        //get the user object
        $user = Auth::getUser();

        // call model to get Pis using user OrgId property
        $pis = Pi::getPi($user->OrgId);

        $temps = array();
        // loop through array to get individual pis
        foreach($pis as $key => $value){

            // loop through each pi 
            foreach($value as $key => $value){

                //if the property equals PiId...
                if($key == 'PiId'){

                    // call model to get temps by sending it the PiId                   
                    array_push($temps, Temperature::getTemps($value));     
                              
                }
            }
        
        }
        
        //instantiate empty string
        
        $formattedResultsArray = array();

        foreach($temps as $key => $value){
            $formattedResults = "";
            foreach($value as $key => $value){

                foreach($value as $key => $value){
                    
                    if($key == 'Temp'){
                                           
                    $formattedResults .= $value . ',';                                  
                    }
                }

            }
                 array_push($formattedResultsArray, $formattedResults);       
        }

        //format a CSV string 
        // for ($x = 0; $x < sizeof($temps); $x++)
        // {
        //   $formattedResults .=  $temps[$x]['Temp'] . ',';
        // }
        var_dump($temps);
        View::renderTemplate('Client/ClientDashboard.html', ['user' => $this->user, 'temps' => $temps, 'resultString'=> $formattedResults, 'Pis' => $pis, 'RESULTARRAY' => $formattedResultsArray]);
    }


        View::renderTemplate('Client/ClientDashboard.html', [
            'user' => $this->user
        ]);
    }

    /**
     * Add a new item
     *
     * @return void
     */
    public function newAction()
    {
        echo "new action";
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
