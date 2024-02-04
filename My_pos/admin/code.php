<?php

include('../config/function.php');

if(isset($_POST['saveAdmin']))
{
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = validate($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password != ''){

        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('admins-create.php', 'Email Already Used by another user.');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban,	  
        ];
        $result = insert('admins',$data);
        if($result){
            redirect('admins.php', 'Admin Created Successfully!');
        }else{
            redirect('admins-create.php', 'Something Went Wrong!');
        }

    }else{
        redirect('admins-create.php', 'please fill required fields.');
    }

}


if(isset($_POST['UpdateAdmin']))
{
    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);
    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId, 'please fill required fields.');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = validate($_POST['is_ban']) == true ? 0:1;

    $EmailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $EmailCheckQuery);
    if($checkResult){
        if(mysqli_query($conn, $EmailCheckQuery) > 0){
            redirect('admins-edit.php?id=' .$adminId, 'Email Already used by another User');
        }
    }
    if($password != ''){
        $hashedPassword = paswword_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData['data']['password'];
    }

    if($name != '' && $email != '' )
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedpassword,
            'phone' => $phone,
            'is_ban' => $is_ban,	  
        ];
        $result = update('admins', $adminId,$data);
        if($result){
            redirect('admins-edit.php?id='.$adminId, 'Admin Updated Successfully!');
        }else{
            redirect('admins-edit.php?id='.$adminId, 'Something Went Wrong!');
        }
    }
    else
    {
        redirect('admins-create.php', 'please fill required fields.');
    }
}



if(isset($_POST['saveCategory']))
{
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $data = [
        'name' => $name,
        'description' => $description,
        //'password' => $bcrypt_password,
        //'phone' => $phone,
        // /'is_ban' => $is_ban,	  
    ];
    $result = insert('categories',$data);
    if($result){
        redirect('categories.php', 'Categories Created Successfully!');
    }else{
        redirect('categories-create.php', 'Something Went Wrong!');
    }
}


if(isset($_POST['updateCategory']))
{
    $categoryId = validate($_POST['categoryId']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $data = [
        'name' => $name,
        'description' => $description,
        //'password' => $bcrypt_password,
        //'phone' => $phone,
        // /'is_ban' => $is_ban,	  
    ];
    $result = update('categories', $categoryId, $data);
    if($result){
        redirect('categories-edit.php?id='.$categoryId, 'Categories Updated Successfully!');
    }else{
        redirect('categories-edit.php?id='.$categoryId, 'Something Went Wrong!');
    }
}


?>