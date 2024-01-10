<?php
 session start();
 
if (isset($_POST['submit'])) {
    unset($_SESSION['err']);
    $firname = mysqli_real_escape_string($db, $_POST['firstname']);
    if (empty($firname)) {
        $_SESSION['err'] = "*First Name is required *";
        header('location: form.php');
        exit();
    }

    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    if (empty($lastname)) {
        $_SESSION['err'] = "*Last Name is required *";
        header('location: form.php');
        exit();
    }

    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    if (empty($phone)) {
        $_SESSION['err'] = "* Phone is required *";
        header('location: form.php');
        exit();
    }
    if (strlen($phone) < 10) {
        $_SESSION['err'] = "Enter a valid phone number*";
        header('location: form.php');
        exit();
    }

    $email = mysqli_real_escape_string($db, $_POST['email']);
    if (empty($email)) {
        $_SESSION['err'] = "* Email Address is required *";
        header('location: form.php');
        exit();
    }

    $id_passport = mysqli_real_escape_string($db, $_POST['idpassport']);
    if (empty($id_passport)) {
        $_SESSION['err'] = "* National ID/Passport is required *";
        header('location: form.php');
        exit();
    }
    if (strlen($id_passport) < 6) {
        $_SESSION['err'] = "Enter a valid ID/Passport number*";
        header('location: form.php');
        exit();
    }

    $address = mysqli_real_escape_string($db, $_POST['address']);
    if (empty($address)) {
        $_SESSION['err'] = "* Physical Address is required *";
        header('location: form.php');
        exit();
    }

    $projname = mysqli_real_escape_string($db, $_POST['projname']);
    if (empty($projname)) {
        $_SESSION['err'] = "*Project Name is required *";
        header('location: form.php');
        exit();
    }

    $plotno = mysqli_real_escape_string($db, $_POST['plotno']);
    if (empty($plotno)) {
        $_SESSION['err'] = "* Plot Number is required *";
        header('location: form.php');
        exit();
    }
    $paymethod = mysqli_real_escape_string($db, $_POST['payMethod']);
    if (empty($paymethod)) {
        $_SESSION['err'] = "* Method of pay is required *";
        header('location: form.php');
        exit();
    }
    $payday = mysqli_real_escape_string($db, $_POST['payDate']);
    if (empty($payday)) {
        $_SESSION['err'] = "* Reference of pay is required *";
        header('location: form.php');
        exit();
    }
    $pay = mysqli_real_escape_string($db, $_POST['payref']);
    if (empty($pay)) {
        $_SESSION['err'] = "* Reference of pay is required *";
        header('location: form.php');
        exit();
    }
    $file = mysqli_real_escape_string($db, $_POST['file']);
    if(isset($_FILES['file']['name'])){
        $file=$_FILES['file']['name'];
        $newFilePath = "documents/" . $_FILES['file']['name'];
        $tmpFilePath = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmpFilePath, $newFilePath);
       }else{$file='none';}
    
    // Check if the email already exists in the database
    $sql = "SELECT * FROM clients WHERE plot_num = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $plotno);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

}
?>