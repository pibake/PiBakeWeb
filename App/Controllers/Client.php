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
        $pis = Pi::getPi($user->orgId);
        $temps = array();
        
        // loop through array to get individual pis
        foreach($pis as $key => $value){
            
            // loop through each pi 
            foreach($value as $key => $value){
                //if the property equals PiId...
                if($key == 'uuid'){                   
                    // call model to get temps by sending it the PiId                   
                    array_push($temps, Temperature::getTemps($value));
                }
            }
        
        }
  
        //instantiate empty string
        
        $formattedResultsArray = array();
        $timeLabels = array();
        foreach($temps as $key => $value){
            $formattedResults = "";
            $formattedTimeLabels = "";
            foreach($value as $key => $value){
                foreach($value as $key => $value){
                    
                    if($key == 'temp_fahrenheit'){
                                           
                    $formattedResults .= $value . ',';                                  
                    }
                    if($key == 'time'){
                                           
                        $formattedTimeLabels .= $value . ',';                                  
                        }
                }
            }
                 array_push($formattedResultsArray, $formattedResults);     
                 array_push($timeLabels, $formattedTimeLabels);    
        }
        //format a CSV string 
        // for ($x = 0; $x < sizeof($temps); $x++)
        // {
        //   $formattedResults .=  $temps[$x]['Temp'] . ',';
        // }
        View::renderTemplate('Client/ClientDashboard.html', ['user' => $this->user, 'temps' => $temps, 'resultString'=> $formattedResults, 'Pis' => $pis, 'RESULTARRAY' => $formattedResultsArray, 'timeLabels'=>$timeLabels, 'index'=>0]);
   
    }
}