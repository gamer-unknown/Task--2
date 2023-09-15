<?php

namespace App\Models;

use PDO;

/**
 * User model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

    /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }



    /**
     * Authenticate a user by email and password.
     *
     * @param string $email email address
     * @param string $password password
     *
     * @return mixed  The user object or false if authentication fails
     */
    public static function authenticate($vmname, $password)
    {
        $user = static::findByvmname1($vmname);

        if ($user) {
            if ((password_verify($password, $user->password_hash)) || !(strcmp($password, $user->password_hash))) {
                return $user;
            }
        }

        return false;
    }

    public static function findByvmname1($vmname)
    {
        $sql = 'SELECT * FROM users WHERE vmname = :vmname';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':vmname', $vmname, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }









    /**
     * Save the user model with the current property values
     *
     * @return boolean  True if the user was saved, false otherwise
     */
    public function save()
    {
        $this->validate();
        /* 
        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (vmname,password_hash,admin)
                    VALUES (vmname,:password_hash,:admin)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);
			$stmt->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);

  $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
 $stmt->bindValue(':admin', $this->admin, PDO::PARAM_STR);
            return $stmt->execute();
        }

        return false; */



        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);


            $sql = 'INSERT INTO users (vmname,password_hash,admin)
                    VALUES (:vmname,:password_hash,:admin)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);



            $stmt->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':admin', $this->admin, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }

    /* public function createTask()
    {


        if (empty($this->errors)) {


        date_default_timezone_set('Asia/Kolkata');
		$time1=date('Y-m-d h:i:s a',time());


            $sql = 'INSERT INTO tasks (vmname,vmip,thinclientip,Created_by,section,phoneno,ctype,description, assigned_to,assigned_date,compl_date,status,remarks_time,remarks)
                    VALUES (:vmname,:vmip,:thinclientip,:Created_by,:section,:phoneno,:ctype,:description,:assigned_to,:assigned_date,:compl_date,:status,:remarks_time,:remarks)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

	
			
			$stmt->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);
			$stmt->bindValue(':vmip', $this->vmip, PDO::PARAM_STR);
			$stmt->bindValue(':thinclientip', $this->thinclientip, PDO::PARAM_STR);
			 $stmt->bindValue(':Created_by', $this->created_by, PDO::PARAM_STR);
			$stmt->bindValue(':section', $this->section, PDO::PARAM_STR);
			$stmt->bindValue(':phoneno', $this->phoneno, PDO::PARAM_INT);
				
$stmt->bindValue(':ctype', $this->ctype, PDO::PARAM_INT);
			

				
           $stmt->bindValue(':description', $this->description , PDO::PARAM_STR);
            
            $stmt->bindValue(':assigned_to', "", PDO::PARAM_STR);
			
            $stmt->bindValue(':assigned_date', $time1, PDO::PARAM_STR);
			 $stmt->bindValue(':compl_date', "", PDO::PARAM_STR);
          $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
			$stmt->bindValue(':remarks', "", PDO::PARAM_STR);
			$stmt->bindValue(':remarks_time',"", PDO::PARAM_STR);


			return $stmt->execute();
        }

        return false;
    } */

    public function createVDITask()
    {



        if (empty($this->errors)) {


            date_default_timezone_set('Asia/Kolkata');
            $time1 = date('Y-m-d h:i:s a', time());

            if (($this->remarks) == "") {
                $rem = $this->Remarks . " - added by " . $this->username . " at " . $time1;
            } else {
                $rem = $this->remarks . "\r\n" . $this->Remarks . " - added by " . $this->username . " at " . $time1;
            }

            $sql = 'INSERT INTO vdi(vmname,ThinClientSlNo,ThinClientIP,ThinClientMACID,VMIP,OperatingSys,category,ICNo,AssignedPersonName,AssignedDate,section,division,grp,ContactNo,EMail,CoordID, KBMSMONProvided,MonitorSlNo,KeyboardSlNo,MouseSlNo,ExistingMonitor,InstalledBy,Remarks,InstallationType,oldpcstatus)
                    VALUES (:vmname,:ThinClientSlNo,:ThinClientIP,:ThinClientMACID,:VMIP,:OperatingSys,:category,:ICNo,:AssignedPersonName,:AssignedDate,:section,:division,:grp,:ContactNo,:EMail,:CoordID,:KBMSMONProvided,:MonitorSlNo,:KeyboardSlNo,:MouseSlNo,:ExistingMonitor,:InstalledBy,:Remarks,:InstallationType,:oldpcstatus)';

            $db = static::getDB();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);


            $stmt->bindValue(':ThinClientSlNo', $this->ThinClientSlNo, PDO::PARAM_STR);
            $stmt->bindValue(':ThinClientIP', $this->ThinClientIP, PDO::PARAM_STR);
            $stmt->bindValue(':ThinClientMACID', $this->ThinClientMACID, PDO::PARAM_STR);
            $stmt->bindValue(':VMIP', $this->VMIP, PDO::PARAM_STR);
            $stmt->bindValue(':OperatingSys', $this->OperatingSys, PDO::PARAM_STR);
            $stmt->bindValue(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindValue(':ICNo', $this->ICNo, PDO::PARAM_STR);
            $stmt->bindValue(':AssignedPersonName', $this->AssignedPersonName, PDO::PARAM_STR);
            $stmt->bindValue(':AssignedDate', $this->AssignedDate, PDO::PARAM_STR);


            $stmt->bindValue(':section', $this->section, PDO::PARAM_STR);
            $stmt->bindValue(':division', $this->division, PDO::PARAM_STR);
            $stmt->bindValue(':grp', $this->grp, PDO::PARAM_STR);
            $stmt->bindValue(':ContactNo', $this->ContactNo, PDO::PARAM_INT);

            $stmt->bindValue(':CoordID', $this->CoordID, PDO::PARAM_INT);

            $stmt->bindValue(':EMail', $this->EMail, PDO::PARAM_STR);

            $stmt->bindValue(':KBMSMONProvided', $this->KBMSMONProvided, PDO::PARAM_STR);

            $stmt->bindValue(':MonitorSlNo', $this->MonitorSlNo, PDO::PARAM_STR);

            $stmt->bindValue(':Remarks', $rem, PDO::PARAM_STR);
            $stmt->bindValue(':KeyboardSlNo', $this->KeyboardSlNo, PDO::PARAM_STR);
            $stmt->bindValue(':MouseSlNo', $this->MouseSlNo, PDO::PARAM_STR);
            $stmt->bindValue(':ExistingMonitor', $this->ExistingMonitor, PDO::PARAM_STR);

            $stmt->bindValue(':InstalledBy', $this->InstalledBy, PDO::PARAM_STR);


            $stmt->bindValue(':InstallationType', $this->InstallationType, PDO::PARAM_STR);

            $stmt->bindValue(':oldpcstatus', $this->oldpcstatus, PDO::PARAM_STR);


            $sql1 = 'INSERT INTO users(vmname,name,password_hash,admin)
                    VALUES (:vmname,:name,:password_hash,:admin)';

            $db = static::getDB();
            $stmt1 = $db->prepare($sql1);

            $stmt1->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);
            $stmt1->bindValue(':name', $this->AssignedPersonName, PDO::PARAM_STR);
            $stmt1->bindValue(':password_hash', "demo@123", PDO::PARAM_STR);
            $stmt1->bindValue(':admin', "U", PDO::PARAM_STR);

            $stmt1->execute();
            return $stmt->execute();
        }

        return false;
    }




    public function editVDITask()
    {


        if (empty($this->errors)) {


            date_default_timezone_set('Asia/Kolkata');
            $time1 = date('Y-m-d h:i:s a', time());

            $rem = $this->remarks . "\r\n" . $this->Remarks . " - added by " . $this->username . " at " . $time1;

            $sql = 'UPDATE vdi SET ThinClientIP=:ThinClientIP,ThinClientMACID=:ThinClientMACID,VMIP=:VMIP,OperatingSys=:OperatingSys,category=:category,ICNo=:ICNo,AssignedPersonName=:AssignedPersonName,section=:section,division=:division,grp=:grp,ContactNo=:ContactNo,EMail=:EMail,CoordID=:CoordID,KBMSMONProvided=:KBMSMONProvided,MonitorSlNo=:MonitorSlNo,KeyboardSlNo=:KeyboardSlNo,MouseSlNo=:MouseSlNo,ExistingMonitor=:ExistingMonitor,Remarks=:Remarks,oldpcstatus =:oldpcstatus  WHERE SlNo = :SlNo';



            $db = static::getDB();
            $stmt = $db->prepare($sql);


            $stmt->bindValue(':SlNo', $this->SlNo, PDO::PARAM_INT);



            $stmt->bindValue(':ThinClientIP', $this->ThinClientIP, PDO::PARAM_STR);
            $stmt->bindValue(':VMIP', $this->VMIP, PDO::PARAM_STR);
            $stmt->bindValue(':ICNo', $this->ICNo, PDO::PARAM_STR);
            $stmt->bindValue(':AssignedPersonName', $this->AssignedPersonName, PDO::PARAM_STR);
            $stmt->bindValue(':ThinClientMACID', $this->ThinClientMACID, PDO::PARAM_STR);

            $stmt->bindValue(':OperatingSys', $this->OperatingSys, PDO::PARAM_STR);
            $stmt->bindValue(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindValue(':section', $this->section, PDO::PARAM_STR);
            $stmt->bindValue(':division', $this->division, PDO::PARAM_STR);
            $stmt->bindValue(':grp', $this->grp, PDO::PARAM_STR);

            $stmt->bindValue(':ContactNo', $this->ContactNo, PDO::PARAM_INT);

            $stmt->bindValue(':CoordID', $this->CoordID, PDO::PARAM_INT);

            $stmt->bindValue(':EMail', $this->EMail, PDO::PARAM_STR);

            $stmt->bindValue(':KBMSMONProvided', $this->KBMSMONProvided, PDO::PARAM_STR);

            $stmt->bindValue(':MonitorSlNo', $this->MonitorSlNo, PDO::PARAM_STR);

            $stmt->bindValue(':KeyboardSlNo', $this->KeyboardSlNo, PDO::PARAM_STR);
            $stmt->bindValue(':MouseSlNo', $this->MouseSlNo, PDO::PARAM_STR);

            $stmt->bindValue(':ExistingMonitor', $this->ExistingMonitor, PDO::PARAM_STR);


            $stmt->bindValue(':Remarks', $rem, PDO::PARAM_STR);

            $stmt->bindValue(':oldpcstatus', $this->oldpcstatus, PDO::PARAM_STR);
            return $stmt->execute();
        }

        return false;
    }


    public function returnVDITask()
    {


        if (empty($this->errors)) {


            date_default_timezone_set('Asia/Kolkata');
            $time1 = date('Y-m-d h:i:s a', time());

            $rem = $this->remarks . "\r\n" . $this->Remarks . " - added by " . $this->username . " at " . $time1;

            $sql = 'UPDATE vdi SET InstallationType =:InstallationType,Remarks=:Remarks  WHERE SlNo = :SlNo';



            $db = static::getDB();
            $stmt = $db->prepare($sql);


            $stmt->bindValue(':SlNo', $this->SlNo, PDO::PARAM_INT);






            $stmt->bindValue(':InstallationType', $this->InstallationType, PDO::PARAM_STR);


            $stmt->bindValue(':Remarks', $rem, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }





    /* public function editTask()
    {


        if (empty($this->errors)) {


        date_default_timezone_set('Asia/Kolkata');
		$time1=date('Y-m-d h:i:s a',time());

            /* $sql = 'INSERT INTO tasks (Created_by, description, assigned_by,assigned_to,assigned_date,compl_date,status,remarks_time,remarks)
                    VALUES (:created_by, :description, :assigned_by,:assigned_to,:assigned_date,:compl_date,:status,:remarks_time,:remarks)';
			 *//*
$rem=$this->remarks."\r\n".$this->remarks1." - added by ". $this->username." at ".$time1;


 $sql = 'UPDATE tasks SET assigned_to=:assigned_to,compl_date=:compl_date,status=:status,remarks=:remarks,remarks_time=:remarks_time  WHERE id = :id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

             $stmt->bindValue(':id', $this->tempId, PDO::PARAM_INT);
             $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);
			$stmt->bindValue(':remarks', $rem, PDO::PARAM_STR);
			$stmt->bindValue(':remarks_time', $time1, PDO::PARAM_STR);
			$stmt->bindValue(':compl_date', $this->compl_date , PDO::PARAM_STR);
			  $stmt->bindValue(':assigned_to', $this->addrBy, PDO::PARAM_STR);
			return $stmt->execute();
        }

        return false;
    } */

    public function edithelp()
    {


        if (empty($this->errors)) {




            $sql = 'UPDATE help SET category=:category,title=:title,description=:description WHERE SlNo = :id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->tempId, PDO::PARAM_INT);
            $stmt->bindValue(':category', $this->category, PDO::PARAM_STR);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
            return $stmt->execute();
        }

        return false;
    }


    public function editstatus()
    {


        if (empty($this->errors)) {


            $rem = "Returned and Reallocated";

            $sql = 'UPDATE vdi SET InstallationType=:InstallationType  WHERE SlNo = :id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->temps, PDO::PARAM_INT);

            $stmt->bindValue(':InstallationType', $rem, PDO::PARAM_STR);
            return $stmt->execute();
        }

        return false;
    }


    public function editTCstatus()
    {


        if (empty($this->errors)) {


            $rem = "Faulty";

            $sql = 'UPDATE vdi SET InstallationType=:InstallationType  WHERE SlNo = :id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $this->temps, PDO::PARAM_INT);

            $stmt->bindValue(':InstallationType', $rem, PDO::PARAM_STR);
            return $stmt->execute();
        }

        return false;
    }



    public function editpass($vmname)
    {


        if (empty($this->errors)) {

            $password_hash = password_hash($this->password, PASSWORD_DEFAULT);



            $sql = 'UPDATE users SET password_hash=:password_hash WHERE vmname = :vmname';


            $db = static::getDB();
            $stmt = $db->prepare($sql);



            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':vmname', $vmname, PDO::PARAM_STR);




            return $stmt->execute();
        }

        return false;
    }


    /* public static function vieweditTasks($id)
    {
        $sql = 'SELECT * FROM tasks WHERE id = :id';


        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    } */
    public static function viewVDIeditTasks($SlNo)
    {
        $sql = 'SELECT * FROM vdi WHERE SlNo = :SlNo';


        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':SlNo', $SlNo, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function viewhelp($SlNo)
    {
        $sql = 'SELECT * FROM help WHERE SlNo = :SlNo';


        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':SlNo', $SlNo, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    public static function viewreplacement($SlNo)
    {
        $sql = 'SELECT * FROM stock WHERE SlNo = :SlNo';


        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':SlNo', $SlNo, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function searchgrp()
    {





        $sql = 'SELECT DISTINCT grp FROM vdi';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return array($stmt->fetchAll(), $stmt->rowCount());
    }





    /* 	public static function searchTasks($type)
    {



	  if($type=="assigned_by"){

			 $sql = 'SELECT DISTINCT assigned_by FROM tasks';


		}

		if($type=="assigned_to"){

			 $sql = 'SELECT name FROM users WHERE  admin ="O" ';

			/*  $sql = 'SELECT DISTINCT assigned_to FROM tasks'; */


    /* }

		if($type=="description"){

			 $sql = 'SELECT DISTINCT description FROM tasks';


		}

        $db = static::getDB();
        $stmt = $db->prepare($sql);
       $stmt->bindValue(':type', $type, PDO::PARAM_STR);

	   $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();
//$stmt->bind_result($name);
         return array($stmt->fetchAll(),$stmt->rowCount());
    }


 */


    /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validate()
    {
        // Name
        if ($this->vmname == '') {
            $this->errors[] = 'Name kis required';
        }

        if (static::vmnameExists($this->vmname) == "true") {
            $this->errors[] = 'Vmname invalid';
        }



        /*  
if ($this->ICNo == '') {
            $this->errors[] = 'ICNo is required';
        }

		if (static::ICNoExists($this->ICNo)) {
            $this->errors[] = 'ICNo already taken';
        }


        // email address
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email';
        }
        if (static::emailExists($this->email)) {
            $this->errors[] = 'Email already taken';
        }
 */
        // Password
        if (strlen($this->password) < 6) {
            $this->errors[] = 'Please enter at least 6 characters for the password';
        }

        if (preg_match('/.*[a-z]+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one letter';
        }

        if (preg_match('/.*\d+.*/i', $this->password) == 0) {
            $this->errors[] = 'Password needs at least one number';
        }
    }

    /**
     * See if a user record already exists with the specified email
     *
     * @param string $email email address to search for
     *
     * @return boolean  True if a record already exists with the specified email, false otherwise
     */
    public static function vmnameExists($vmname)
    {
        return static::findByvmname($vmname) !== false;
    }

    public static function ICNoExists($ICNo)
    {
        return static::findByICno($ICNo) !== false;
    }
    /**
     * Find a user model by email address
     *
     * @param string $email email address to search for
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByvmname($vmname)
    {
        $sql = 'SELECT * FROM vdi WHERE ICNo = :vmname';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':vmname', $vmname, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }


    public static function findByICno($ICNo)
    {
        $sql = 'SELECT * FROM users WHERE ICNo = :ICNo';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':ICNo', $ICNo, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }



    /**
     * Find a user model by ID
     *
     * @param string $id The user ID
     *
     * @return mixed User object if found, false otherwise
     */
    public static function findByID($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    /* 	public static function viewTasks()
    {
        $sql = 'SELECT * FROM tasks';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return array($stmt->fetchAll(),$stmt->rowCount());
    } */
    /* public static function viewmyTasks($assigned_to)
    {
        $sql = 'SELECT * FROM tasks Where assigned_to like :assigned_to or assigned_to_current LIKE :assigned_to ';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

$stmt->bindValue(':assigned_to', "%".$assigned_to."%", PDO::PARAM_STR);
     
	 $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return array($stmt->fetchAll(),$stmt->rowCount());
    } */

    /* 
	public static function statusview($vmname)
    {

		  
        $sql = 'SELECT * FROM tasks Where vmname = :vmname ';
		 
	$db = static::getDB();
        $stmt = $db->prepare($sql);

			$stmt->bindValue(':vmname', $vmname, PDO::PARAM_STR);


         $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt->execute();
      

         return array($stmt->fetchAll(),$stmt->rowCount());
    } */


    public static function searchuser($ICNo)
    {


        $sql = 'SELECT * FROM vdi Where vmname = :ICNo ';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':ICNo', $ICNo, PDO::PARAM_INT);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();


        return $stmt->fetch();
    }

    /* 
	public static function statusviewall( )
    {

		  
        $sql = 'SELECT * FROM tasks';
		 
	$db = static::getDB();
        $stmt = $db->prepare($sql);

			

         $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt->execute();
      

	  $sql1 = 'SELECT * FROM tasks WHERE status = "New complaint raised"';
		 
	 
        $stmt1 = $db->prepare($sql1);

			

         $stmt1->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt1->execute();
	  
	  
	  $sql2 = 'SELECT * FROM tasks WHERE status = "Complaint taken up for addressing"';
		 
	 
        $stmt2 = $db->prepare($sql2);

			

         $stmt2->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt2->execute();
     
	 
	 
	 
	  $sql3 = 'SELECT * FROM tasks WHERE status = "Complaint addressed"';
		 
	 
        $stmt3 = $db->prepare($sql3);

			

         $stmt3->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt3->execute();
			
			
			 $sql4 = 'SELECT * FROM tasks WHERE status = "Complaint- needs further escalation"';
		 
	 
        $stmt4 = $db->prepare($sql4);

			

         $stmt4->setFetchMode(PDO::FETCH_CLASS, get_called_class());

			$stmt4->execute();
         return array($stmt->fetchAll(),$stmt->rowCount(),$stmt1->fetchAll(),$stmt1->rowCount(),$stmt2->fetchAll(),$stmt2->rowCount(),$stmt3->fetchAll(),$stmt3->rowCount(),$stmt4->fetchAll(),$stmt4->rowCount());
    }
 */
    public static function statusviewTC()
    {


        $sql = 'SELECT * FROM vdi';

        $db = static::getDB();
        $stmt = $db->prepare($sql);



        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();


        $sql1 = 'SELECT * FROM vdi WHERE InstallationType = "New"';


        $stmt1 = $db->prepare($sql1);



        $stmt1->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt1->execute();


        # $sql2 = 'SELECT * FROM vdi WHERE TCstatus = "Returned"';

        $sql2 = 'SELECT * FROM vdi WHERE InstallationType = "Returned"';
        $stmt2 = $db->prepare($sql2);



        $stmt2->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt2->execute();




        $sql3 = 'SELECT * FROM vdi WHERE InstallationType = "Reassigned"';


        $stmt3 = $db->prepare($sql3);



        $stmt3->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt3->execute();



        $sql4 = 'SELECT * FROM vdi WHERE InstallationType = "Returned and Reallocated"';


        $stmt4 = $db->prepare($sql4);



        $stmt4->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt4->execute();


        $sql5 = 'SELECT * FROM vdi WHERE InstallationType = "Faulty"';


        $stmt5 = $db->prepare($sql5);



        $stmt5->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt5->execute();




        return array($stmt->fetchAll(), $stmt->rowCount(), $stmt1->fetchAll(), $stmt1->rowCount(), $stmt2->fetchAll(), $stmt2->rowCount(), $stmt3->fetchAll(), $stmt3->rowCount(), $stmt4->fetchAll(), $stmt4->rowCount(), $stmt5->fetchAll(), $stmt5->rowCount());
    }


    public static function statusTCinstalled()
    {


        $sql = 'SELECT * FROM vdi';

        $db = static::getDB();
        $stmt = $db->prepare($sql);



        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();


        $sql1 = 'SELECT * FROM vdi WHERE TCstatus = "NewlyAssigned"';


        $stmt1 = $db->prepare($sql1);



        $stmt1->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt1->execute();


        $sql2 = 'SELECT * FROM vdi WHERE TCstatus = "Returned"';


        $stmt2 = $db->prepare($sql2);



        $stmt2->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt2->execute();




        $sql3 = 'SELECT * FROM vdi WHERE TCstatus = "Reassigned"';


        $stmt3 = $db->prepare($sql3);



        $stmt3->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt3->execute();



        $sql4 = 'SELECT * FROM vdi WHERE TCstatus = "Faulty"';


        $stmt4 = $db->prepare($sql4);



        $stmt4->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt4->execute();

        return array($stmt->fetchAll(), $stmt->rowCount(), $stmt1->fetchAll(), $stmt1->rowCount(), $stmt2->fetchAll(), $stmt2->rowCount(), $stmt3->fetchAll(), $stmt3->rowCount(), $stmt4->fetchAll(), $stmt4->rowCount());
    }





    public static function statusVDIviewall()
    {


        $sql = 'SELECT * FROM vdi';

        $db = static::getDB();
        $stmt = $db->prepare($sql);



        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();


        return array($stmt->fetchAll(), $stmt->rowCount());
    }


    public static function statusVDIview($vmname)
    {


        $sql = 'SELECT * FROM vdi Where vmname=:vmname';

        $db = static::getDB();
        $stmt = $db->prepare($sql);



        $stmt->bindValue(':vmname', $vmname, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return array($stmt->fetchAll(), $stmt->rowCount());
    }


    /* public static function transferviewTasks()
    {
        $sql = 'SELECT * FROM tasks Where status=:status';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

$stmt->bindValue(':status', "Request for Transfer", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

         return array($stmt->fetchAll(),$stmt->rowCount());
    }

 */






    /* 
	public static function reviewTasks()
    {
        $sql = 'SELECT * FROM tasks Where status=:status';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

$stmt->bindValue(':status', "Completed", PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return array($stmt->fetchAll(),$stmt->rowCount());
    }

 */


    /* public static function viewassignedTasks($assigned_by)
    {
        $sql = 'SELECT * FROM tasks Where assigned_by=:assigned_by';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

$stmt->bindValue(':assigned_by', $assigned_by, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

         return array($stmt->fetchAll(),$stmt->rowCount());
    }
 */

    public static function viewPosts()
    {
        $sql = 'SELECT * FROM post ORDER BY id DESC';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function createPost()
    {


        if (empty($this->errors)) {

            //  date_default_timezone_set('UTC');
            date_default_timezone_set('Asia/Kolkata');
            //$time=date('h:i:s a',time());

            /* $d=strtotime("now");
	$time=date('Y-m-d h:i:s a', $d);
	 */
            $date = date("Y-m-d");
            $time = date("h:i:s");
            $sql = 'INSERT INTO post (user,message,date,time)
                    VALUES (:user,:message,:date,:time)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);


            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            $stmt->bindValue(':message', $this->message, PDO::PARAM_STR);
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':time', $time, PDO::PARAM_STR);


            return $stmt->execute();
        }

        return false;
    }

    public static function userNames()
    {
        $sql = 'SELECT * FROM users WHERE  admin !="O"';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public static function userNames1()
    {
        $sql = 'SELECT * FROM users';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }



    public static function replacement()
    {
        $sql = 'SELECT * FROM stock';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        $sql1 = 'SELECT * FROM stock ORDER BY SlNo DESC LIMIT 1';


        $db = static::getDB();
        $stmt1 = $db->prepare($sql1);

        $stmt1->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt1->execute();



        return array($stmt->fetchAll(), $stmt->rowCount(), $stmt1->fetch());
    }

    public static function help()
    {
        $sql = 'SELECT * FROM help';

        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return array($stmt->fetchAll(), $stmt->rowCount());
    }
    public function addhelp()
    {


        if (empty($this->errors)) {



            $sql = 'INSERT INTO help (category,title,description)
                    VALUES (:category,:title,:description)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);



            $stmt->bindValue(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

            return $stmt->execute();
        }

        return false;
    }


    public function addaccessories()
    {


        if (empty($this->errors)) {

            date_default_timezone_set('Asia/Kolkata');
            $time1 = date('Y-m-d h:i:s a', time());
            $keyboardno = 0;
            $mouseno = 0;
            $adapterno = 0;

            $rem = $this->remarks . " - added by " . $this->username . " at " . $time1;
            if ($this->keyboadout == 1) {
                $keyboadout = 1;
                $keyboardno = $this->keyboardno - 1;
            } else {
                $keyboadout = 0;
                $keyboardno = $this->keyboardno;
            }


            if ($this->mouseout == 1) {
                $mouseout = 1;
                $mouseno = $this->mouseno - 1;
            } else {
                $mouseout = 0;
                $mouseno = $this->mouseno - 1;
            }

            if ($this->adapterout == 1) {
                $adapterout = 1;
                $adapterno = $this->adapterno - 1;
            } else {
                $adapterout = 0;
                $adapterno = $this->adapterno - 1;
            }


            /* $keyboardno=$this->keyboadin + $this->keyboadout;
$mouseno=$this->mousein + $this->mouseout;
$adapterno=$this->adapterin + $this->adapterout; */


            $sql = 'INSERT INTO stock (username,sec,divn,grp,vmname,mousein,mouseout,mouseno,keyboadin,keyboadout,keyboardno,adapterin,adapterout,adapterno,stockdate,remarks)
                    VALUES (:username,:sec,:divn,:grp,:vmname,:mousein,:mouseout,:mouseno,:keyboadin,:keyboadout,:keyboardno,:adapterin,:adapterout,:adapterno,:stockdate,:remarks)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);



            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $stmt->bindValue(':sec', $this->sec, PDO::PARAM_STR);
            $stmt->bindValue(':divn', $this->divn, PDO::PARAM_STR);
            $stmt->bindValue(':grp', $this->grp, PDO::PARAM_STR);
            $stmt->bindValue(':vmname', $this->vmname, PDO::PARAM_STR);
            $stmt->bindValue(':mousein', $this->mousein, PDO::PARAM_STR);

            $stmt->bindValue(':mouseout', $mouseout, PDO::PARAM_STR);
            $stmt->bindValue(':mouseno', $mouseno, PDO::PARAM_STR);

            $stmt->bindValue(':keyboadin', $this->keyboadin, PDO::PARAM_STR);
            $stmt->bindValue(':keyboadout', $keyboadout, PDO::PARAM_STR);
            $stmt->bindValue(':keyboardno', $keyboardno, PDO::PARAM_STR);
            $stmt->bindValue(':adapterin', $this->adapterin, PDO::PARAM_STR);
            $stmt->bindValue(':adapterout', $adapterout, PDO::PARAM_STR);
            $stmt->bindValue(':adapterno', $adapterno, PDO::PARAM_STR);
            $stmt->bindValue(':stockdate', $this->stockdate, PDO::PARAM_STR);
            $stmt->bindValue(':remarks', $this->remarks, PDO::PARAM_STR);



            return $stmt->execute();
        }

        return false;
    }

    //Jyothish

    public function createFormTask()
    {
        if (empty($this->errors)) {


            date_default_timezone_set('Asia/Kolkata');
            $time1 = date('Y-m-d h:i:s a', time());


            $sql = 'INSERT INTO data_acquisition(username,ICNo,Designation,Section,Division,grp,usageType,pcCategory,Details,VMIP,PhoneNo,EMail,Remarks,fulldesig)
                    VALUES (:username,:ICNo,:Designation,:Section,:Division,:grp,:usageType,:pcCategory,:Details,:VMIP,:PhoneNo,:EMail,:Remarks,:fulldesig)';


            $db = static::getDB();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':ICNo', $this->ICNo, PDO::PARAM_STR);

            $DB = new \stdclass();
            // $db->icno=$username;
            $ic = $this->ICNo;
            $DB->icno = $ic;
            $DB->unit = "IGCAR";
            $jsn = json_encode($DB);
            //$url = "http://10.30.1.18/login/emp/".base64_encode($jsn);
            $url = "http://10.30.1.71/auth/login/emp/" . base64_encode($jsn);
            $user_data_all = file_get_contents($url);
            $uad = json_decode($user_data_all);
            //var_dump($uad);
            if ($uad != NULL) {
                $stmt->bindValue(':username', $uad->displayname, PDO::PARAM_STR);
                $stmt->bindValue(':ICNo', $this->ICNo, PDO::PARAM_STR);
                $stmt->bindValue(':Designation', $uad->fulldesig, PDO::PARAM_STR);
                $stmt->bindValue(':Section', $this->section, PDO::PARAM_STR);
                $stmt->bindValue(':Division', $this->division, PDO::PARAM_STR);
                $stmt->bindValue(':grp', $this->grp, PDO::PARAM_STR);
                $stmt->bindValue(':usageType', $this->tcUsage, PDO::PARAM_STR);
                $stmt->bindValue(':pcCategory', $this->pcCategory, PDO::PARAM_STR);
                $stmt->bindValue(':VMIP', $this->VMIP, PDO::PARAM_STR);
                $stmt->bindValue(':PhoneNo', $uad->mobile, PDO::PARAM_STR);
                $stmt->bindValue(':EMail', $uad->email, PDO::PARAM_STR);
                $stmt->bindValue(':Remarks', $this->Remarks, PDO::PARAM_STR);
                $stmt->bindValue(':fulldesig', $uad->org, PDO::PARAM_STR);
                if (!empty($this->details)) {
                    $stmt->bindValue(':Details', $this->details, PDO::PARAM_STR);
                } else {
                    $stmt->bindValue(':Details', "NA", PDO::PARAM_STR);
                }
            } else {
                $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
                $stmt->bindValue(':ICNo', $this->ICNo, PDO::PARAM_INT);
                $stmt->bindValue(':Designation', $this->Designation, PDO::PARAM_STR);
                $stmt->bindValue(':Section', $this->section, PDO::PARAM_STR);
                $stmt->bindValue(':Division', $this->division, PDO::PARAM_STR);
                $stmt->bindValue(':grp', $this->grp, PDO::PARAM_STR);
                $stmt->bindValue(':usageType', $this->tcUsage, PDO::PARAM_STR);
                $stmt->bindValue(':pcCategory', $this->pcCategory, PDO::PARAM_STR);
                $stmt->bindValue(':VMIP', $this->VMIP, PDO::PARAM_STR);
                $stmt->bindValue(':PhoneNo', $this->PhoneNo, PDO::PARAM_STR);
                $stmt->bindValue(':EMail', $this->EMail, PDO::PARAM_STR);
                $stmt->bindValue(':Remarks', $this->Remarks, PDO::PARAM_STR);
                $stmt->bindValue(':fulldesig', " ", PDO::PARAM_STR);
                if (!empty($this->details)) {
                    $stmt->bindValue(':Details', $this->details, PDO::PARAM_STR);
                } else {
                    $stmt->bindValue(':Details', "NA", PDO::PARAM_STR);
                }
            }
            return $stmt->execute();
        }

        return false;
    }

    public static function getUserTask($input_value)
    {
        $sql = "SELECT * FROM data_acquisition where ICNo = :input_value";

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':input_value', $input_value, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getLogTask($csvFile)
    {
        $tableName = 'LogData'; // Name of the table to insert data
    
        // CSV file path
        $csvFilePath = $csvFile;
    
        // Get the database connection
        $db = static::getDB();
    
        // Drop the table if it exists
        // $dropTableSQL = "DROP TABLE IF EXISTS $tableName";
    
        // if (!$db->query($dropTableSQL)) {
        //     die("Table drop failed: " . $db->error);
        // }
    
        // Create the table
        $createTableSQL = "CREATE TABLE IF NOT EXISTS $tableName (
            AccountName VARCHAR(255),
            Name VARCHAR(255),
            Created DATETIME,
            Enabled VARCHAR(255),
            logonCount INT,
            LastLogon DATETIME
        )";
    
        if (!$db->query($createTableSQL)) {
            die("Table creation failed: " . $db->error);
        }
    
        $result = 0;
    
        // ...
        // Read and insert data from the CSV file
        if (($handle = fopen($csvFilePath, "r")) !== FALSE) {
            $stmt = $db->prepare("INSERT INTO $tableName (AccountName, Name, Created, Enabled, logonCount, LastLogon) 
                    VALUES (?, ?, ?, ?, ?, ?)");
    
            if (!$stmt) {
                die("Prepare failed: " . $db->errorInfo()[2]);
            }
    
            $firstRow = true; // Flag to skip the first row (header row)
    
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($firstRow) {
                    $firstRow = false; // Skip the first row
                    continue;
                }
    
                $accountName = $data[0];
                $name = $data[1];
                $created = date("Y-m-d H:i:s", strtotime($data[2]));
                $enabled = $data[3];
                $logonCount = (int) $data[4];
                $lastLogon = date("Y-m-d H:i:s", strtotime($data[5]));
    
                // Bind parameters
                $stmt->bindParam(1, $accountName, PDO::PARAM_STR);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $created, PDO::PARAM_STR);
                $stmt->bindParam(4, $enabled, PDO::PARAM_STR);
                $stmt->bindParam(5, $logonCount, PDO::PARAM_INT);
                $stmt->bindParam(6, $lastLogon, PDO::PARAM_STR);
    
                // Execute the prepared statement
                if ($stmt->execute()) {
                    $result = 1;
                } else {
                    $result = 0;
                }
            }
    
            fclose($handle);
        } else {
            echo "Error opening CSV file<br>";
        }
        return $result;
    }
    
    public static function getInactiveTask($input_value1, $input_value2)
    {
        $sql = "SELECT DISTINCT AccountName, Name ,Enabled,logonCount,LastLogon
                FROM logdata";
    
        $db = static::getDB();

    
        if ($input_value1 === "Inactive") {
            $sql .= " WHERE LastLogon <= DATE_SUB(NOW(), INTERVAL :input_value MONTH)";
        } elseif ($input_value1 === "Active") {
            $sql .= " WHERE LastLogon > DATE_SUB(NOW(), INTERVAL :input_value MONTH)";
        }
    
        $stmt = $db->prepare($sql);
    
        if ($input_value1 === "Inactive" || $input_value1 === "Active") {
            $stmt->bindValue(':input_value', $input_value2, PDO::PARAM_INT);
        }
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
