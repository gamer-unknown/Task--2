<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;

/**
 * Signup controller
 *
 * PHP version 7.0
 */
class Create extends \Core\Controller
{

    /**
     * Show the signup page
     *
     * @return void
     */
    public function newAction()
    {
        $usrs = User::userNames();
        $usrs1 = User::userNames1();
        View::renderTemplate('Create/new.html', [
            'name' => $usrs, 'name1' => $usrs1
        ]);
    }

    /*  public function newcompldaintAction()
    {
		 $usrs = User::userNames();
		 $usrs1 = User::userNames1();
        View::renderTemplate('Create/new2.html', [
                'name' => $usrs,'name1' => $usrs1]);
		
    } */
    public function newcomplaintAction()
    {
        $assgndby = Auth::getUser();
        $searchuser = User::searchuser($assgndby->vmname);



        View::renderTemplate('Create/new1.html', [
            'tasks' => $searchuser
        ]);
    }
    public function vmassignedAction()
    {
        $assgndby = Auth::getUser();



        $searchview = User::statusVDIview($assgndby->vmname);





        View::renderTemplate('Create/VDIview.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1]
        ]);
    }




    /* 
		 public function vmassignedAction()
    { 
	
	 $searchview = User::statusview($_POST["vmname"]); 
	 
	 
	 
        View::renderTemplate('Create/view1.html', [
               'flag'=>'5', 'tasks' => $searchview[0],'count'=>$searchview[1]
            ]);
} */
    public function VDIcreateAction()
    {
        $usrs = User::userNames();
        $usrs1 = User::userNames1();
        View::renderTemplate('Create/VDInew.html', [
            'name' => $usrs, 'name1' => $usrs1
        ]);
    }
    public function createVDIAction()
    {
        $user = new User($_POST);

        if ($user->createVDITask()) {

            $this->redirect('/create/successVDI');
        } else {

            View::renderTemplate('Create/VDInew.html', [
                'user' => $user
            ]);
        }
    }

    public function reassignVDIAction()
    {
        $user = new User($_POST);
        $user->editstatus($_POST["temps"]);
        if ($user->createVDITask()) {

            $this->redirect('/create/successVDI');
        } else {

            View::renderTemplate('Create/VDIreassign.html', [
                'user' => $user
            ]);
        }
    }

    public function replaceTCAction()
    {
        $user = new User($_POST);
        $user->editTCstatus($_POST["temps"]);
        if ($user->createVDITask()) {

            $this->redirect('/create/successVDI');
        } else {

            View::renderTemplate('Create/VDIreassign.html', [
                'user' => $user
            ]);
        }
    }


    /**
     * Sign up a new user
     *
     * @return void
     */
    public function createAction()
    {
        $user = new User($_POST);

        if ($user->createTask()) {

            $this->redirect('/create/success');
        } else {

            View::renderTemplate('Create/new2.html', [
                'user' => $user
            ]);
        }
    }
    /*  public function searchuserAction()
    { 
	
	 $searchuser = User::searchuser($_POST["desc"]); 
	 
	 
	 
        View::renderTemplate('Create/new1.html', [
                'tasks' => $searchuser
            ]);
} */

    public function complaintstatusAction()
    {


        View::renderTemplate(
            'Create/search2.html'
        );
    }


    public function statusviewAction()
    {
        $assgndby = Auth::getUser();


        $searchview = User::statusview($assgndby->vmname);



        View::renderTemplate('Create/view1.html', [
            'flag' => '5', 'tasks' => $searchview[0], 'count' => $searchview[1]
        ]);
    }
    public function statusviewallAction()
    {

        $searchview = User::statusviewall();



        View::renderTemplate('Create/view1.html', [
            'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }


    public function statusTCinstalled()
    {

        $searchview = User::statusTCinstalled();



        View::renderTemplate('Create/viewinstalledTC.html', [
            'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }

    public function statusviewTCAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }

    public function statusReportsAction()
    {

        $searchview = User::statusviewTC();

        $searchgrp = User::searchgrp();

        View::renderTemplate('Create/viewReports.html', [
            'searchgrp1' => $searchgrp[0], 'searchgrp2' => $searchgrp[1],  'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }







    public function statusviewreturnedAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 3, 'tasks' => $searchview[4], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }


    public function statusviewreassignedAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 4, 'tasks' => $searchview[6], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }
    public function statusviewRetReassAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 5, 'tasks' => $searchview[8], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }

    public function statusviewfaultyAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 6, 'tasks' => $searchview[10], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }



    public function statusviewnewAction()
    {

        $searchview = User::statusviewall();



        View::renderTemplate('Create/view1.html', [
            'flag' => 2, 'tasks' => $searchview[2], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9]
        ]);
    }

    public function statusviewnewTCAction()
    {

        $searchview = User::statusviewTC();



        View::renderTemplate('Create/viewTC.html', [
            'flag' => 2, 'tasks' => $searchview[2], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9]
        ]);
    }
    public function statusviewescalatedAction()
    {

        $searchview = User::statusviewall();



        View::renderTemplate('Create/view1.html', [
            'flag' => 6, 'tasks' => $searchview[8], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9]
        ]);
    }
    public function statusviewtakenAction()
    {

        $searchview = User::statusviewall();



        View::renderTemplate('Create/view1.html', [
            'flag' => 3, 'tasks' => $searchview[4], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9]
        ]);
    }

    public function statusviewaddressedAction()
    {

        $searchview = User::statusviewall();



        View::renderTemplate('Create/view1.html', [
            'flag' => 4, 'tasks' => $searchview[6], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9]
        ]);
    }

    public function statusVDIviewallAction()
    {

        $searchview = User::statusVDIviewall();



        View::renderTemplate('Create/VDIview.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1]
        ]);
    }


    public function helpAction()
    {

        $searchview = User::help();



        View::renderTemplate('Create/help.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1]
        ]);
    }


    public function replacementAction()
    {

        $searchview = User::replacement();



        View::renderTemplate('Create/replacement.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1], 'totalstock' => $searchview[2],
        ]);
    }
    public function replacementviewAction()
    {

        $searchview = User::replacement();



        View::renderTemplate('Create/replacementview.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1], 'totalstock' => $searchview[2],
        ]);
    }




    public function addhelpAction()
    {





        View::renderTemplate(
            'Create/addhelp.html'
        );
    }
    public function addreplacementAction()
    {





        $searchview = User::replacement();



        View::renderTemplate('Create/addreplacement.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1], 'totalstock' => $searchview[2],
        ]);
    }


    public function addhelptopicAction()
    {


        $user = new User($_POST);
        if ($user->addhelp()) {

            $this->redirect('/create/successaddhelp');
        } else {

            View::renderTemplate('Create/addhelp.html', [
                'user' => $user
            ]);
        }
    }


    public function addaccessoriesAction()
    {


        $user = new User($_POST);
        if ($user->addaccessories()) {

            $this->redirect('/create/successaddhelp');
        } else {

            View::renderTemplate('Create/addreplacement.html', [
                'user' => $user
            ]);
        }
    }
    public function edithelpAction()
    {


        $user = new User($_POST);
        if ($user->edithelp()) {

            $this->redirect('/create/successedithelp');
        } else {

            View::renderTemplate('Create/edithelp.html', [
                'user' => $user
            ]);
        }
    }

    public function VDIreturnviewAction()
    {

        //$user = new User($_POST);

        //$temps=$_POST["tempId"];
        $vmedit = User::viewVDIeditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();

        if ($_POST["submit-btn"] == "Return TC") {
            View::renderTemplate('Create/VDIreturn.html', [
                'vmedit' => $vmedit, 'name' => $usrs1
            ]);
        } elseif ($_POST["submit-btn"] == "Replace Faulty TC") {
            View::renderTemplate('Create/VDIreplace.html', [
                'vmedit' => $vmedit, 'name' => $usrs1
            ]);
        } else {
            View::renderTemplate('Create/VDIreassign.html', [
                'vmedit' => $vmedit, 'name' => $usrs1
            ]);
        }
    }

    public function VDIeditviewAction()
    {

        //$user = new User($_POST);


        $vmedit = User::viewVDIeditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();


        View::renderTemplate('Create/VDIedit.html', [
            'vmedit' => $vmedit, 'name' => $usrs1
        ]);
    }

    public function editVDIAction()
    {


        $user = new User($_POST);
        if ($user->editVDITask()) {

            $this->redirect('/create/successeditVDI');
        } else {

            View::renderTemplate('Create/VDIedit.html', [
                'user' => $user
            ]);
        }
    }
    public function returnVDIAction()
    {


        $user = new User($_POST);
        if ($user->returnVDITask()) {

            $this->redirect('/create/successeditVDI');
        } else {

            View::renderTemplate('Create/VDIreturn.html', [
                'user' => $user
            ]);
        }
    }

    public function editviewAction()
    {

        //$user = new User($_POST);

        $editt = User::vieweditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();

        View::renderTemplate('Create/edit1.html', [
            'editt' => $editt, 'name' => $usrs1
        ]);
    }




    public function editAction()
    {


        $user = new User($_POST);
        if ($user->editTask()) {

            $this->redirect('/create/successs');
        } else {

            View::renderTemplate('Create/edit1.html', [
                'user' => $user
            ]);
        }
    }


    public function transferAction()
    {

        $editt = User::vieweditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();

        View::renderTemplate('Create/edit.html', [
            'editt' => $editt, 'name' => $usrs1, 'transfer' => '1'
        ]);
    }


    public function transferviewAction()
    {

        $taskreview = User::transferviewTasks();



        View::renderTemplate('Create/view.html', [
            'tasks' => $taskreview[0], 'count' => $taskreview[1], 'flag' => '3'
        ]);
    }



    public function reviewsuccessAction()
    {


        $user = new User($_POST);
        if ($user->editTask()) {

            $this->redirect('/create/successs');
        } else {

            View::renderTemplate('Create/review.html', [
                'user' => $user
            ]);
        }
    }
    public function reviewAction()
    {

        $taskreview = User::reviewTasks();



        View::renderTemplate('Create/view.html', [
            'tasks' => $taskreview[0], 'count' => $taskreview[1], 'flag' => '2'
        ]);
    }



    public function reviewonlyAction()
    {

        //$user = new User($_POST);

        $review = User::vieweditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();

        View::renderTemplate('Create/review.html', [
            'editt' => $review, 'name' => $usrs1
        ]);
    }


    public function transferonlyAction()
    {

        $editt = User::vieweditTasks($_POST["tempId"]);

        $usrs1 = User::userNames1();

        View::renderTemplate('Create/edit.html', [
            'editt' => $editt, 'name' => $usrs1, 'transfer' => '2'
        ]);
    }


    public function  viewonlyAction()
    {

        //$user = new User($_POST);

        $viewonly = User::vieweditTasks($_POST["tempId"]);



        View::renderTemplate('Create/viewonly.html', [
            'viewonly' => $viewonly
        ]);
    }


    public function  vmviewonlyAction()
    {

        //$user = new User($_POST);

        $viewonly = User::vieweditTasks($_POST["tempId"]);



        View::renderTemplate('Create/vmview.html', [
            'viewonly' => $viewonly
        ]);
    }


    public function  VDIviewonlyAction()
    {

        //$user = new User($_POST);

        $viewonly = User::viewVDIeditTasks($_POST["tempId"]);



        View::renderTemplate('Create/viewVDI.html', [
            'viewonly' => $viewonly
        ]);
    }


    public function  helpviewonlyAction()
    {

        //$user = new User($_POST);

        $viewonly = User::viewhelp($_POST["tempId"]);



        View::renderTemplate('Create/viewhelp.html', [
            'viewonly' => $viewonly
        ]);
    }


    public function  viewreplacementAction()
    {

        //$user = new User($_POST);

        $viewonly = User::viewreplacement($_POST["tempId"]);



        View::renderTemplate('Create/viewreplacement.html', [
            'viewonly' => $viewonly
        ]);
    }


    public function  helpeditAction()
    {

        //$user = new User($_POST);

        $viewonly = User::viewhelp($_POST["tempId"]);



        View::renderTemplate('Create/edithelp.html', [
            'viewonly' => $viewonly
        ]);
    }



    public function viewmyAction()
    {
        $assgndto = Auth::getUser();
        $taskk = User::viewmyTasks($assgndto->name);



        View::renderTemplate('Create/view.html', [
            'tasks' => $taskk[0], 'count' => $taskk[1], 'flag' => '1'
        ]);
    }

    public function viewassignedAction()
    {
        $assgndby = Auth::getUser();
        $assgndby = Auth::getUser();
        $taskasgn = User::viewassignedTasks($assgndby->name);



        View::renderTemplate('Create/view.html', [
            'tasks' => $taskasgn[0], 'count' => $taskasgn[1], 'flag' => '1', 'admin' => '1'
        ]);
    }



    public function viewAction()
    {

        $taskk  = User::viewTasks();



        View::renderTemplate('Create/view.html', [
            'tasks' => $taskk[0], 'count' => $taskk[1], 'flag' => '0'
        ]);
    }





    /**
     * Show the signup success page
     *
     * @return void
     */
    public function successAction()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '2'
        ]);
    }

    public function successsAction()
    {
        View::renderTemplate('Create/success1.html');
    }


    public function
    Action()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '1'
        ]);
    }
    public function successeditVDIAction()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '3'
        ]);
    }

    public function successedithelpAction()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '5'
        ]);
    }
    public function successaddhelpAction()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '4'
        ]);
    }
    public function searchspecificAction()
    {

        $searchonly = User::searchTasks($_POST["searchtype"]);

        View::renderTemplate(
            'Create/search1.html',
            ['typedistinct' => $searchonly, 'types' => $_POST["searchtype"]]
        );
    }

    public function searchviewAction()
    {
        if ($_POST["typevalue"] == "assigned_to") {

            $type = "assigned_to";
            $searchview = User::searchviewTasks($type, $_POST["assigned_to"]);
        }
        if ($_POST["typevalue"] == "assigned_by") {

            $type = "assigned_by";
            $searchview = User::searchviewTasks($type, $_POST["assigned_by"]);
        }

        if ($_POST["typevalue"] == "description") {

            $type = "description";
            $searchview = User::searchviewTasks($type, $_POST["desc"]);
        }


        View::renderTemplate('Create/view.html', [
            'tasks' => $searchview[0], 'count' => $searchview[1]
        ]);
    }

    // Jyothish 

    public function fillFormAction()
    {

        $searchview = User::statusviewTC();

        $searchgrp = User::searchgrp();

        View::renderTemplate('Create/formsnew.html', [
            'searchgrp1' => $searchgrp[0], 'searchgrp2' => $searchgrp[1],  'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }

    public function formFillAction()
    {
        $user = new User($_POST);

        if ($user->createFormTask()) {

            $this->redirect('/create/successForms');
        } else {

            View::renderTemplate('Create/formsnew.html', [
                'user' => $user
            ]);
        }
    }

    public function successFormsAction()
    {
        View::renderTemplate('Create/success.html', [
            'flag' => '6'
        ]);
    }

    public function getFormAction()
    {

        View::renderTemplate('Create/getform.html');
    }
    public function getUserAction()
    {
        $users = new User;
        $input_value = $_POST['input_value'];

        $searchgrp = User::getUserTask($input_value);

        if ($users->getUserTask($input_value)) {

            $user = $searchgrp[0];

            View::renderTemplate('Create/successGetUser.html', [
                'searchgrp0' => $user->SINo,
                'searchgrp1' => $user->username,
                'searchgrp2' => $user->ICNo,
                'searchgrp3' => $user->Designation,
                'searchgrp7' => $user->Section,
                'searchgrp8' => $user->fulldesig,
                'searchgrp9' => $user->grp,
                'searchgrp10' => $user->usageType,
                'searchgrp11' => $user->pcCategory,
                'searchgrp12' => $user->VMIP,
                'searchgrp13' => $user->PhoneNo,
                'searchgrp14' => $user->EMail,
                'searchgrp15' => $user->Remarks,
                'searchgrp16' => $user->Details
            ]);
        } else {

            $this->redirect('/create/getForm');
        }
    }
    public function logInputAction()
    {

        $searchview = User::statusviewTC();

        $searchgrp = User::searchgrp();

        View::renderTemplate('Create/getLog.html', [
            'searchgrp1' => $searchgrp[0], 'searchgrp2' => $searchgrp[1],  'flag' => 1, 'tasks' => $searchview[0], 'count' => $searchview[1], 'count1' => $searchview[3], 'count2' => $searchview[5], 'count3' => $searchview[7], 'count4' => $searchview[9], 'count5' => $searchview[11]
        ]);
    }
    public function getLogAction()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["logFile"])) {
                $csvFile = $_FILES["logFile"]["tmp_name"];
                if (($handle = fopen($csvFile, "r")) !== FALSE) {
                    $users = new User;
                    if ($users->getLogTask($csvFile) == 1) {
                        View::renderTemplate('Create/success.html', [
                            'flag' => '7'
                        ]);
                    }
                    fclose($handle);
                } else {
                    echo "Error opening CSV file";
                }
            }
        }
    }

    public function dateInputAction()
    {

        $searchview = User::statusviewTC();

        $searchgrp = User::searchgrp();

        View::renderTemplate('Create/getLogData.html');
    }

    public function getInactiveAction()
    {
        $users = new User;
        $input_value1 = $_POST['UserType'];
        $input_value2 = $_POST['months'];

        $searchgrp = User::getInactiveTask($input_value1,$input_value2);

        if ($users->getInactiveTask($input_value1,$input_value2)) {

            View::renderTemplate('Create/viewInactive.html', ['users' => $searchgrp]);
        } else {

            $this->redirect('/create/getForm');
        }
    }
}
