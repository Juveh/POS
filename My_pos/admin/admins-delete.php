<?php

require '../config/function.php';

$paraRestultId = checkParamId('id');
if(is_numeric($paraRestultId)){

    $adminId = validate($paraRestultId);

    $admin = getById('admins', $adminId);
    if($admin['status'] == 200)
    {
        $response = delete('admins',$adminId);
        if($response)
        {
            redirect('admins.php', 'Admin Deleted Successfuly!.');
        }
        else
        {
            redirect('admins.php', 'Something Went Wrong!');
        }
    }
    else
    {
        redirect('admins.php', $admin['message']);
    }
    //echo $adminId;
}else{
    redirect('admins.php', 'Something Went Wrong.');
}

?>
