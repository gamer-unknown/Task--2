<?php

namespace App\Controllers;

use \App\Models\User;
use \Core\View;
use \App\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $vposts = User::viewPosts();


        View::renderTemplate('Home/index.html', [
            //'user' => Auth::getUser()
            'posts' => $vposts
        ]);
    }

    public function createAction()
    {
        $user = new User($_POST);

        $user->createPost();

        $vposts = User::viewPosts();
        View::renderTemplate('Home/index.html', [
            'user' => $user, 'posts' => $vposts
        ]);
    }
}
