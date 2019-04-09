<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use App\Models\Temperature;
use App\Models\Pi;
use App\Models\Organization;

/**
 * Items controller (example)
 *
 * PHP version 7.0
 */
//class Items extends \Core\Controller
class Admin extends Authenticated
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

                // call model to get orgs
                $orgs = Organization::getOrganizations();


        View::renderTemplate('Admin/AdminSearch.html', ['user' => $this->user, 'orgs' =>$orgs]);
    }
        /**
     * Items index
     *
     * @return void
     */
    public function currentUsersAction()
    {

                // Take the selected Organization ID and store it in a session. 
                // This saves the selected Organization ID for multiple pages to use because the Post variable gets reset.
                if( isset($_POST['selectedOrg'])){
                  $_SESSION["selectedOrg"] = $_POST['selectedOrg'];                   
                }
                // $users = Organization::getOrganizationUsers($_POST['selectedOrg']);
                // $selectedOrg = Organization::getOrganizationInfo($_POST['selectedOrg']);
                if( isset($_SESSION['selectedOrg'])){
                $users = Organization::getOrganizationUsers($_SESSION["selectedOrg"]);
                $selectedOrg = Organization::getOrganizationInfo($_SESSION["selectedOrg"]);




                View::renderTemplate('Admin/AdminCurrentUsers.html', ['user' => $this->user, 'users'=>$users, 'selectedOrg' => $selectedOrg]);
                // View::renderTemplate('Admin/AdminSearch.html', ['user' => $this->user, 'orgs' =>$orgs]);                    
                }
                else{

                    $this->redirect('/Admin/index');
                }

    }

    public function currentPisAction()
    {

                // Take the selected Organization ID and store it in a session. 
                // This saves the selected Organization ID for multiple pages to use because the Post varibale gets reset.
                if( isset($_POST['selectedOrg'])){
                  $_SESSION["selectedOrg"] = $_POST['selectedOrg'];  
                }

                if( isset($_SESSION['selectedOrg'])){
                $pis = Pi::getPi($_SESSION["selectedOrg"]);
                $selectedOrg = Organization::getOrganizationInfo($_SESSION["selectedOrg"]);

                View::renderTemplate('Admin/AdminCurrentPis.html', ['user' => $this->user, 'pis'=>$pis, 'selectedOrg' => $selectedOrg]);
              
            }else{
                $this->redirect('/Admin/index');
            }
    }

    public function currentOrganizationInfoAction(){

                 // Take the selected Organization ID and store it in a session. 
                // This saves the selected Organization ID for multiple pages to use because the Post varibale gets reset.
                if( isset($_POST['selectedOrg'])){
                    $_SESSION["selectedOrg"] = $_POST['selectedOrg'];  
                  }
  
                  if( isset($_SESSION['selectedOrg'])){

                  $selectedOrg = Organization::getOrganizationInfo($_SESSION["selectedOrg"]);

                  View::renderTemplate('Admin/AdminOrganizationInfo.html', ['user' => $this->user, 'selectedOrg' => $selectedOrg]);
                
              }else{
                  $this->redirect('/Admin/index');
              }



    }
}
