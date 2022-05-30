<?php

if(isset($_GET['req'])){
    $action = $_GET['req'];
}else{
    header('Content-Type: application/json');
    $data = array("Response"=>"Invalid Request");
    
    die(json_encode($data));
}
include_once('inc/cyc_system.php');

$system = new cyc_system();

if($action == 'register'){

    $data = $system->add_user(
        isset($_POST['fname'])?$_POST['fname']:'',
        isset($_POST['lname'])?$_POST['lname']:'',
        isset($_POST['email'])?$_POST['email']:'',
        isset($_POST['pass'])?$_POST['pass']:'',
        isset($_POST['country'])?$_POST['country']:'',
        isset($_POST['city'])?$_POST['city']:'',
        isset($_POST['contact'])?$_POST['contact']:'',
        'CUSTOMER'
    );
    header('Content-Type: application/json');
    die(json_encode($data));

}
if($action == 'add_admin'){

    $data = $system->add_user(
        isset($_POST['fname'])?$_POST['fname']:'',
        isset($_POST['lname'])?$_POST['lname']:'',
        isset($_POST['email'])?$_POST['email']:'',
        isset($_POST['pass'])?$_POST['pass']:'',
        isset($_POST['country'])?$_POST['country']:'',
        isset($_POST['city'])?$_POST['city']:'',
        isset($_POST['contact'])?$_POST['contact']:'',
        'ADMINISTRATOR'
    );
    header('Content-Type: application/json');
    die(json_encode($data));
}
if($action == 'login'){

    $data = $system->user_login(
        isset($_POST['email'])?$_POST['email']:'',
        isset($_POST['pass'])?$_POST['pass']:''
    );
    header('Content-Type: application/json');
    die(json_encode($data));
}
if($action == 'add_car'){
    $data = $system->add_car(
        isset($_POST['make'])?$_POST['make']:'',
        isset($_POST['model'])?$_POST['model']:'',
        isset($_POST['year'])?$_POST['year']:'',
        isset($_POST['manufacture'])?$_POST['manufacture']:'',
        isset($_FILES['image'])?$_FILES['image']:''
    );
    header('Content-Type: application/json');
    die(json_encode($data));
}
if($action == 'get_recall_recent'){
    $data = $system->get_recall_recent(
        isset($_POST['limit'])?$_POST['limit']:'',
        isset($_POST['offset'])?$_POST['offset']:''
    );
    header('Content-Type: application/json');
    die(json_encode($data));
}

header('Content-Type: application/json');
$data = array("Response"=>"Request Not Found");

?>