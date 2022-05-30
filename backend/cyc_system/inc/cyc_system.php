<?php
@session_start();
include_once('database.php');
include_once("class.upload.php");
class cyc_system
{
    public $chk_logged_in;
    private $db;

    /* public functions */
    public function __construct() {
		$this->chk_logged_in = 0; 
        $this->db = new cyc_db();
    }

    public function check_login(){
        return $this->chk_logged_in;
    }

    public function count_users(){
        return $this->db->count_users();
    }

    public function get_recall_recent($limit, $offset){
        $data = array("data"=>array());
        $limit = (int)$limit;
        $offset = (int)$offset;
        $rs = $this->db->get_recall_recent($limit, $offset);
        array_push($data["data"],array("Status"=>"success", "Response"=>$rs));
        return $data;
    }

    public function add_car($make, $model, $year, $manufactr, $image){
        $data = array("data"=>array());
        if($this->db->chk_car_by_mmy($make, $model, $year)){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"car already exists"));
            return $data;
        }
        if(!$this->is_admin()){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"only admin can add new car"));
            return $data;
        }
        if(is_array($image)){
            $image_name = $this->uploadimage($image);
        }else{
            $image_name = '';
        }
        
        if(trim(strlen($make)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"make can not be empty"));
            return $data;
        }
        if(trim(strlen($model)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"model can not be empty"));
            return $data;
        }
        if(trim(strlen($year)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"year can not be empty"));
            return $data;
        }
        if(!is_int((int)$year)){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"year must be an integer value"));
            return $data;
        }
        if(trim(strlen($manufactr)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"manufacturer can not be empty"));
            return $data;
        }
        if(strlen($image_name)>4){
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $valid_ext = array('jpg', 'jpeg', 'png', 'webp');
            if(!in_array($ext,$valid_ext)){
                array_push($data["data"],array("Status"=>"failed", "Response"=>"invalid file type. only jpg, jpeg, png and webp are allowed"));
                return $data;
            }
        }
        

        $rs = $this->db->add_car($make, $model, $year, $manufactr, $image_name);
        if($rs){
            array_push($data["data"],array("Status"=>"success", "Response"=>$rs));
        }else{
            array_push($data["data"],array("Status"=>"failed", "Response"=> "Unable to add car."));
        }
        
        return $data;
    }
    public function user_login($email, $pass){
        $data = array("data"=>array());
        if($this->check_login()){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"you are already log in"));
            return $data;
        }
        if(trim(strlen($email)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"email can not be empty"));
            return $data;
        }
        if(!$this->validate_email($email)){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"Invalid email"));
            return $data;
        }
        if(trim(strlen($pass)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"password can not be empty"));
            return $data;
        }
        $rs = $this->db->login($email,  $pass);
        if($rs){
            array_push($data["data"],array("Status"=>"success", "Response"=>$rs));
        }else{
            array_push($data["data"],array("Status"=>"failed", "Response"=> "Email or password incorrect"));
        }
        
        return $data;
    }

    public function add_user($fname, $lname, $email, $pass, $country, $city, $contact, $type){
        $data = array("data"=>array());
        if($type == 'ADMINISTRATOR'){
            if( !$this->is_admin()){
                return $this->admin_account_required();
            }
        }else{
            if($this->check_login()){
                array_push($data["data"],array("Status"=>"failed", "Response"=>"you are already log in"));
                return $data;
            }
        }
        
        if(trim(strlen($fname)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"first name can not be empty"));
            return $data;
        }
        if(trim(strlen($lname)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"last name can not be empty"));
            return $data;
        }
        if(trim(strlen($email)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"email can not be empty"));
            return $data;
        }
        if(!$this->validate_email($email)){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"Invalid email"));
            return $data;
        }
        if($this->db->chk_email($email)){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"email exist"));
            return $data;
        }
        if(trim(strlen($pass)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"password can not be empty"));
            return $data;
        }
        if($this->verify_pass_strength($pass) !== 1){
            $pstrength = $this->verify_pass_strength($pass);
            array_push($data["data"],array("Status"=>"failed", "Response"=>$pstrength));
            return $data;
        }
        if(trim(strlen($country)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"country can not be empty"));
            return $data;
        }
        if(trim(strlen($city)) < 1){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"city can not be empty"));
            return $data;
        }
        if(!$this->validate_phone($contact) || trim(strlen($contact)) < 7){
            array_push($data["data"],array("Status"=>"failed", "Response"=>"phone number invalid"));
            return $data;
        }

        

        $rs = $this->db->add_user($fname, $lname, $email, $pass, $country, $city, $contact, $type);
        array_push($data["data"],array("Status"=>"success", "Response"=>$rs));
        return $data;
    }

    



    /* private functions */
    private function uploadimage($imgField)
    {
        $handle = new Upload($imgField);
        if ($handle->uploaded) {
            $dir_dest = '../media';
            $dir_pics = $dir_dest;
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 800;
            $handle->Process($dir_dest);
            $fname = $handle->file_dst_name;
            $path_to_file = '../media/' . $fname;
            $dir_dest = '../media/thumbs';

            $dir_pics = $dir_dest;
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 500;
            $handle->Process($dir_dest);
            $path_to_file = '../media/thumbs/' . $fname;
            $handle-> Clean();
            return $fname;

        }
    }
    private function is_admin(){
        if(!isset($_SESSION["user_type"])){
            return False;
        }
        if($_SESSION["user_type"] !== 'ADMINISTRATOR'){
            return False;
        }
        return True;
    }
    private function admin_account_required(){
        $data = array("data"=>array());
        if(!isset($_SESSION["user_type"])){
            array_push($data["data"],array("Status"=>"unauthorized action", "Response"=>"only admin user can create administrative account."));
            return $data;
        }else{
            if($_SESSION["user_type"] !== 'ADMINISTRATOR'){
                array_push($data["data"],array("Status"=>"unauthorized action"));
                array_push($data["data"],array("Response"=>"only admin user can create administrative account."));
                return $data;
            }
        }
    }

    private function validate_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validate_phone($contact){
        return preg_match('/^\+?\d+$/', $contact);
    }

    private function verify_pass_strength($pass){
        if(trim(strlen($pass)) < 6){
            return 'password must be at least 6 characters long.';
        }
        if (!preg_match('~[0-9]+~', $pass)) {
            return 'password must contain at least 1 numeric character';
        }
        if (!preg_match('/[\'^£$%&*()}{@!#~?><>,|=_+¬-]/', $pass))
        {
            return 'password must contain at least 1 special character';
        }
        
        return 1;
    }
}
?>