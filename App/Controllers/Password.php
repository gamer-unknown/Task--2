<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
/**
 * Password controller
 *
 * PHP version 7.0
 */
class Password extends \Core\Controller
{

    /**
     * Show the forgotten password page
     *
     * @return void
     */
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html');
    }

    /**
     * Send the password reset link to the supplied email
     *
     * @return void
     */
    public function requestResetAction()
    {
        User::sendPasswordReset($_POST['email']);

        View::renderTemplate('Password/reset_requested.html');
    }

    /**
     * Show the reset password form
     *
     * @return void
     */
    public function resetAction()
    {
        $token = $this->route_params['token'];

        $user = $this->getUserOrExit($token);

        View::renderTemplate('Password/reset.html', [
            'token' => $token
        ]);
    }

    /**
     * Reset the user's password
     *
     * @return void
     */
    public function resetPasswordAction()
    {
        $token = $_POST['token'];

        $user = $this->getUserOrExit($token);

        if ($user->resetPassword($_POST['password'])) {

            //echo "password valid";
            View::renderTemplate('Password/reset_success.html');
        
        } else {

            View::renderTemplate('Password/reset.html', [
                'token' => $token,
                'user' => $user
            ]);
        }
    } 
	
	public function resetpassAction()
    {
        $assgndby=Auth::getUser();
		 
		 $user = new User($_POST);
		 
		 
	 
	 
	         if ($user->editpass($assgndby->vmname)) {

          View::renderTemplate('Password/reset_success.html');

        } else {

            View::renderTemplate('Password/reset.html', [
                'user' => $user
            ]);

    }}

    /**
     * Find the user model associated with the password reset token, or end the request with a message
     *
     * @param string $token Password reset token sent to user
     *
     * @return mixed User object if found and the token hasn't expired, null otherwise
     */
    protected function getUserOrExit($token)
    {
        $user = User::findByPasswordReset($token);

        if ($user) {

            return $user;

        } else {

            View::renderTemplate('Password/token_expired.html');
            exit;

        }
    }
	
	
		public function changePasswordAction()
    {
	 /* 
		 $assgndby=Auth::getUser();
		 
		 
		 
		$pass = User::getPassword($assgndby->vmname); 
	  */
	 
	 
	 
	 
        View::renderTemplate('Password/reset.html');
		
		   }
}
