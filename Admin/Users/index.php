<?php
// COOKIE CHECK HERE
if(!isset($_COOKIE["DUWTF_ADMIN"])){
    $kick = true;
}else{
    $kick = false;
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://duwtf-de7cb1deecd8.herokuapp.com/api/endpoints/admin/getAllusers.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('adminToken' => $_COOKIE["DUWTF_ADMIN"]),
));

$usersResponse = json_decode(curl_exec($curl));

curl_close($curl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Content</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/admin.css">
    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
</head>
<body id="content-body">

    <div id="container">
        <?php
            include './../../components/adminNav.php';
        ?>
        <div id="content">
            <div class="table-container col-12">
                <div class="item-card boxPink">
                    <h2 class="neonPink">Users</h2>
                    <table id="usersTable" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($usersResponse->msg == "success"){
                                    foreach($usersResponse->data as $user){
                                        $tempDate = new DateTime($user->created_at);
                                        $tempDate = $tempDate->format('F j, Y \a\t H:i:s');
                                        echo <<<EOD
                                        <tr class="boxPink playPink">
                                            <td>
                                                $user->member_id
                                            </td>
                                            <td>
                                                $user->member_first_name
                                            </td>
                                            <td>
                                                $user->member_last_name
                                            </td>
                                            <td>
                                                $user->member_email_address
                                            </td>
                                            <td>
                                                $tempDate
                                            </td>
                                        </tr>
                                        EOD;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let usersTable = new DataTable('#usersTable', {
            // options
        });

        const kick = <?php echo json_encode($kick); ?>;
        if(kick){
            document.location.href = "https://duwtf-de7cb1deecd8.herokuapp.com/Admin/"
        }
    </script>
</body>
</html>