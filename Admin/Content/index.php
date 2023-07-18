<?php
// COOKIE CHECK HERE
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
<body>
    <div id="container">
        <?php
            include './../../components/adminNav.php';
        ?>
        <div id="content">
        <div class="table-container">
                        <table id="postsTable" class="display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getAllposts.php',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    ));
                                    $response = json_decode(curl_exec($curl));
                                    curl_close($curl);
                                    if($response->msg == "success"){
                                        foreach($response->data as $post){
                                            echo <<<EOD
                                            <tr>
                                                <td>
                                                    $post->post_id
                                                </td>
                                                <td>
                                                    $post->category_id
                                                </td>
                                                <td>
                                                    $post->post_title
                                                </td>
                                                <td>
                                                    $post->created_at
                                                </td>
                                                <td>
                                                    <button class="action-btn">View Post</button>
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
    <script>
        let postsTable = new DataTable('#postsTable', {
        // options
        });
    </script>
</body>
</html>