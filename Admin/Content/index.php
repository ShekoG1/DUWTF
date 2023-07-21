<?php
// COOKIE CHECK HERE

// Initialize cURL
$curl = curl_init();

// Get All Posts
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
$postsResponse = json_decode(curl_exec($curl));

// Get All Categories

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/categories/getAllcategories.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
));

$categoriesResponse = json_decode(curl_exec($curl));

// Close cURL
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

    <div class="model-container">
        <div class="model">
            <div class="model-header">
                <div id="header-content">

                </div>
                <div class="close">

                </div>
            </div>
            <div class="model-body" id='model-body'>

            </div>
            <div class="model-footer">
                <div id="footer-content">

                </div>
                <div class="close">

                </div>
            </div>
        </div>
    </div>

    <div id="container">
        <?php
            include './../../components/adminNav.php';
        ?>
        <div id="content">
            <div class="col-12 playPink">
                <h1>Content</h1>
                <p>Manage all your categories and posts here</p>
            </div>
            <div id="counters">
                <div class="item-card boxPink neonPink">
                    <button onclick="startModel('post')">Create Post</button>
                </div>
                <div class="item-card boxPink neonPink">
                    <button onclick="startModel('category')">Create Category</button>
                </div>
                <div class="item-card boxPink neonPink">
                    Total Posts: <?php echo $postsResponse->msg == "success" ? count($postsResponse->data) : 0;?>
                </div>
                <div class="item-card boxPink neonPink">
                    Total Categories: <?php echo $categoriesResponse->msg == "success" ? count($categoriesResponse->data) : 0;?>
                </div>
            </div>

            <div class="item-card boxPink table-container col-12">
                <table id="categoriesTable" class="display">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if($categoriesResponse->msg == "success"){
                                foreach($categoriesResponse->data as $category){
                                    echo <<<EOD
                                    <tr class="boxPink playPink">
                                        <td>
                                            $category->category_id
                                        </td>
                                        <td>
                                            $category->category_name
                                        </td>
                                        <td>
                                            $category->created_at
                                        </td>
                                        <td>
                                            <button class="action-btn boxPurple playPurple">Rename</button>
                                        </td>
                                    </tr>
                                    EOD;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="item-card boxPink table-container col-12">
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

                            if($postsResponse->msg == "success"){
                                foreach($postsResponse->data as $post){
                                    echo <<<EOD
                                    <tr class="boxPink playPink">
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
                                            <button class="action-btn boxPurple playPurple">View Post</button>
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
        let categoryTable = new DataTable('#categoriesTable',{
            // options
        });

        function startModel(intent, errorMsg = "NULL", successMsg = "NULL"){
            const POST_FORM = `
                <div class='form-input'>
                    <p class="label">Title</p>
                    <input type="text" placeholder="Super Cool Title">
                    <p class="sub-label">This is the title that will be displayed to all viewers</p>
                </div>
                <div class='form-input'>
                    <p class="label">Categpry</p>
                    <select>
                        <option value="NULL" default>--SELECT--</option>
                        <?php
                            if($categoriesResponse->msg == "success"){
                                foreach($categoriesResponse->data as $category){
                                    echo <<<EOD
                                        <option class="boxBlue playBlue">
                                            $category->category_id
                                        </option>
                                        <option class="boxBlue playBlue">
                                            $category->category_name
                                        </option>
                                        <option class="boxBlue playBlue">
                                            $category->created_at
                                        </option>
                                        <option class="boxBlue playBlue">
                                            <button class="action-btn boxPurple playPurple">Rename</button>
                                        </option>
                                    EOD;
                                }
                            }else{
                                echo <<<EOD
                                    <p>Whoops! We could not find any categories for you to select. You must have at least one category before creating a post.</p>
                                EOD;
                            }
                        ?>
                    </select>
                    <p class="sub-label">This is the category that viewers will need to select to find your post</p>
                </div>
                <div class='form-input'>
                    <p class="label">Content</p>
                    <textarea placeholder="All your content here">
                    </textarea>
                    <p class="sub-label">This is the content of your post</p>
                </div>
            `;
            const CATEGORY_FORM = `
                <div class='form-input'>
                    <p class="label">Title</p>
                    <input type="text" placeholder="Super Cool Title">
                    <p class="sub-label">This is the title that will be displayed to all viewers</p>
                </div>
            `;

            switch (key) {
                case 'post':
                    document.querySelector('#header-content').innerHTML = "<h1 class='neonRed'>Create A Post</h1>"
                    document.querySelector('#model-body').innerHTML = POST_FORM;
                    document.querySelector('#footer-content').innerHTML = "<button onclick='createPost'>Create Post</button>";
                break;
                case 'category':
                    document.querySelector('#header-content').innerHTML = "<h1 class='neonRed'>Create A Category</h1>"
                    document.querySelector('#model-body').innerHTML = CATEGORY_FORM;
                    document.querySelector('#footer-content').innerHTML = "<button onclick='createPost'>Create Category</button>";
                break;
                case 'error':
                    
                break;
                case 'success':
                    
                break;
                default:
                break;
            }
        }
    </script>
</body>
</html>