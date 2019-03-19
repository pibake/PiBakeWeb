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

                // call model to get temps
                $orgs = Organization::getOrganizations();


        View::renderTemplate('Admin/AdminSearch.html', ['user' => $this->user, 'orgs' =>$orgs]);
    }

}
