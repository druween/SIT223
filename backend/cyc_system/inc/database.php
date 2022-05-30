<?php
@session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class cyc_db
{
	public static $con;
    
    public function __construct() {
		self::$con = mysqli_connect("localhost","root","","checkyourcar");
		if (mysqli_connect_errno())
		  {
		    return mysqli_connect_error();
		  }
    }

	public function count_users(){
		$sql = "SELECT 	USER_ID FROM users ";
		$qResut = self::$con->query($sql);
		return $qResut->num_rows;
	}

	public function str_escape($data){
		return mysqli_real_escape_string(self::$con,$data);
	}

	public function verify($user_id, $code){
		$rs = mysqli_query(self::$con,"UPDATE users SET 
					USER_EMAIL_VERIFIED='1'
				WHERE USER_ID='$user_id'");
	}

	public function get_recall_recent($limit,$offset){
		$do_search=mysqli_query(self::$con, "
		SELECT vehicles.*, recalls.*
		FROM recalls
		INNER JOIN vehicles ON recalls.VHCL_ID=recalls.VHCL_ID 
		ORDER BY recalls.RC_ID DESC LIMIT $limit OFFSET $offset
		");
		 return mysqli_fetch_all($do_search, MYSQLI_ASSOC);
	}

	public function add_car($make, $model, $year, $manufactr, $image = NULL){
		$rs = mysqli_query(self::$con,"INSERT INTO vehicles (
			VHCL_MAKE,
			VHCL_MODEL,
			VHCL_YEAR,
			VHCL_MANUFACTURER,
			VHCL_IMAGE
			) 
			VALUES (
			'$make',
			'$model',
			'$year',
			'$manufactr',
			'$image'
					)");
		
		return $rs;
	}

	public function add_user($fname, $lname, $email, $pass, $country, $city, $contact, $type = 'CUSTOMER'){
		$pass = sha1($pass);
		$code = rand(111111,999999);
		$rs = mysqli_query(self::$con,"INSERT INTO users (
				USER_FIRST_NAME,
				USER_CODE,
				USER_LAST_NAME,
				USER_EMAIL,
				USER_PASS,
				USER_COUNTRY,
				USER_CITY,
				USER_CONTACT,
				USER_TYPE,
				USER_DATE
				) 
			VALUES (
			'$fname',
			'$code',
			'$lname',
			'$email',
			'$pass',
			'$country',
			'$city',
			'$contact',
			'$type',
			 NOW()
					)");
		

		return $rs;
	}

	public function chk_email($email){
		$sql = "SELECT 	USER_ID FROM users WHERE USER_EMAIL = '$email' ";
		$qResut = self::$con->query($sql);
		if($qResut->num_rows){
			return true;
		}else{
			return false;
		}
	}
	public function chk_car_by_mmy($make, $model, $year){
		$sql = "SELECT 	VHCL_ID FROM vehicles WHERE VHCL_MAKE = '$make' AND VHCL_MODEL = '$model' AND VHCL_YEAR = '$year' ";
		$qResut = self::$con->query($sql);
		if($qResut->num_rows){
			return true;
		}else{
			return false;
		}
	}
	public function chk_car_by_id($car_id){
		$sql = "SELECT 	VHCL_ID FROM vehicles WHERE VHCL_ID = '$car_id' ";
		$qResut = self::$con->query($sql);
		if($qResut->num_rows){
			return true;
		}else{
			return false;
		}
	}
	public function login($email, $pass){
		$email = mysqli_real_escape_string(self::$con,$email);
		$pass = mysqli_real_escape_string(self::$con,$pass);
		$sql = "SELECT * FROM users WHERE USER_EMAIL = '" . $email . "' AND USER_PASS = '" . sha1($pass) . "' AND USER_STATUS <> 3 ";
		$qResut = self::$con->query($sql);
		$elem = $qResut->fetch_assoc();
		$row_cnt = $qResut->num_rows;
		if($row_cnt > 0){
			$_SESSION["loggedin"] = 1;
			$_SESSION["user_id"] =  $elem["USER_ID"];
			$_SESSION["user_full_name"] =  $elem["USER_FIRST_NAME"] . ' ' . $elem["USER_FIRST_NAME"];
			$_SESSION["user_type"] =  $elem["USER_TYPE"];
			$_SESSION["userid"] =  $elem["USER_ID"];
            $this->chk_logged_in  = 1;
			return True;
		}else{
			return False;
		}
	}

}

?>