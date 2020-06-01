<?php
        
    // including the database connection file
    include('config.php');

    session_start();

    //Get login details from login page
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //Getting matched username & password from db
    $retrieve_query = "SELECT * FROM users WHERE username = '$username'";

    $sql = mysqli_query($con,$retrieve_query);

    while($data = mysqli_fetch_assoc($sql)){

        $db_userid = $data['id'];
        $db_username = $data['username'];
        $db_password = $data['password'];
        $db_role = $data['role'];

    }

    if(!$db_username){

        $_SESSION['unregistered_credentials'] = 'The credentials do not exist. Please contact the system admin to register an account';
        header('location:login.php');

    }elseif($username == $db_username && $password == $db_password && $db_role == 'admin'){

        $_SESSION['userid'] = $db_userid;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $db_role;
        header('location:admin/user.php');

    }elseif($username == $db_username && $password == $db_password && $db_role == 'user'){

        $_SESSION['userid'] = $db_userid;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $db_role;
        header('location:user/storage_info.php');

    }else{

        $_SESSION['wrong_credentials'] = 'Wrong username or password';
        header('location:login.php');

    }
    
?>