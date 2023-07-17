<?php
// GET ALL POSTS

// Declarations

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Posts</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="./../../res/bootstrap/css/bootstrap.css">
    <script src="./../../res/bootstrap/js/bootstrap.js"></script>
    <!-- STYLE -->
    <link rel="stylesheet" href="./../../style/globals.css">
    <link rel="stylesheet" href="./../../style/nav.css">
    <link rel="stylesheet" href="./../../style/explore.css">
    <!-- JAVASCRIPT -->
    <script src="./../../js/globals.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
</head>
<body>
    <?php
        require('../../components/nav.php');
    ?>
    <div class="container-fluid">
        <div class="row">

        <?php
        
            foreach ($categoryResults->data as $category) {

                echo <<<EOD
                <div class="col-lg-6 col-md-12 col-sm-12 category-table">
                    <div class="table-container">
                        <table id="table-$category->category_id" class="display">
                            <thead>
                                <tr>
                                    <th>$category->category_name</th>
                                </tr>
                            </thead>
                            <tbody>
                EOD;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/posts/getPostsbyCategory.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('categoryId' => $category->category_id),
                ));
                
                $response = json_decode(curl_exec($curl));
                
                curl_close($curl);

                if($response->msg == "success"){
                    $data = $response->data;

                    foreach ($response->data as $post) {
                        echo <<<EOD
                                <tr id="$post->post_id">
                                    <td>
                                        <form action="./../ViewBlog/" method="post">
                                            <input type="hidden" name="id" value="DUWTF-$post->post_id">
                                            <input type="hidden" name="categoryId" value="$category->category_id">
                                            <input type="submit" class="boxPink playPink" value="$post->post_title">
                                        </form>
                                    </td>
                                </tr>
                        EOD;
                    }
                }
                echo <<<EOD
                            </tbody>
                        </table>
                    </div>
                </div>
                EOD;
            }

        ?>
        </div>
    </div>
    <script>

        <?php
        
        foreach ($categoryResults->data as $category) {
            // let color$category->category_id = titleCase(document.querySelector('duwtf-category-$category->category_id')).getAttribute('data-color-scheme')
            //document.querySelector('#table-$category->category_id').classList.add(`box`+titleCase(color$category->category_id))
            echo "
                let table_$category->category_id = new DataTable('#table-$category->category_id', {
                    // options

                });
            ";
        }

        ?>
    </script>
</body>
</html>