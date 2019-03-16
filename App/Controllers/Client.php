<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

use App\Models\Temperature;


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

        // call model to get temps
        $temps = Temperature::getTemps();

        //instantiate empty string
        $formattedResults = "";

        //format a CSV string 
        for ($x = 0; $x < sizeof($temps); $x++)
        {
          $formattedResults .=  $temps[$x]['Temp'] . ',';
        }
        
        View::renderTemplate('Client/ClientDashboard.html', ['user' => $this->user, 'temps' => $temps, 'resultString'=> $formattedResults]);
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
