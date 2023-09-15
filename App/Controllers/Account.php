<?php

namespace App\Controllers;

use \App\Models\User;

/**
 * Account controller
 *
 * PHP version 7.0
 */
class Account extends \Core\Controller
{

    /**
     * Validate if email is available (AJAX) for a new signup.
     *
     * @return void
     */
    public function validateVMnameAction()
    {
        $is_valid = ! User::vmnameExists($_GET['vmname']);
        
        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
}
