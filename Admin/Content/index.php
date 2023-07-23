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

    <div id="container">
        <?php
            include './../../components/adminNav.php';
        ?>
        <div id="content">

            <div class="modal" id="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Modal title</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal').modal('toggle')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="model-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="boxBlue neonBlue" id="confirm">Save changes</button>
                        <button type="button" class="boxRed neonRed" onclick="$('#modal').modal('toggle')">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 neonPink">
                <h1>Content</h1>
                <p>Manage all your categories and posts here</p>
            </div>
            <div id="counters">
                <div class="item-card boxBlue">
                    <button onclick="startModel('post')" class="neonBlue" id="createPost">Create Post</button>
                </div>
                <div class="item-card boxBlue">
                    <button onclick="startModel('category')" class="neonBlue" id="createCategory">Create Category</button>
                </div>
                <div class="item-card boxPink neonPink">
                    Total Posts: <?php echo $postsResponse->msg == "success" ? count($postsResponse->data) : 0;?>
                </div>
                <div class="item-card boxPink neonPink">
                    Total Categories: <?php echo $categoriesResponse->msg == "success" ? count($categoriesResponse->data) : 0;?>
                </div>
            </div>

            <div class="table-container col-12">
                <div class="item-card boxPink">
                    <h2 class="neonPink">Categories</h2>
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
                                                <button class="action-btn boxPurple playPurple" onclick="startModel('renamecategory', 'NULL', 'NULL', $category->category_id)">Rename</button>
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

            <div class="table-container col-12">
                <div class="item-card boxPink">
                    <h2 class="neonPink">Posts</h2>
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
    </div>
    <script>
        let postsTable = new DataTable('#postsTable', {
            // options
        });
        let categoryTable = new DataTable('#categoriesTable',{
            // options
        });

        function startModel(intent, errorMsg = "NULL", successMsg = "NULL", categoryId = -1){
            const POST_FORM = `
                <div class='form-input'>
                    <p class="label">Title</p>
                    <input type="text" class="boxBlue neonBlue input" id="post-title" placeholder="Super Cool Title">
                    <p class="sub-label">This is the title that will be displayed to all viewers</p>
                </div>
                <div class='form-input'>
                    <p class="label">Categpry</p>
                    <select class="input boxBlue neonBlue" id="post-select-category">
                        <option value="NULL" default>--SELECT--</option>
                        <?php
                            if($categoriesResponse->msg == "success"){
                                foreach($categoriesResponse->data as $category){
                                    echo <<<EOD
                                        <option class="boxBlue playBlue" value="$category->category_id">
                                            <span>$category->category_name</span> | <span>$category->created_at</span>
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
                    <textarea class="boxBlue neonBlue input" id="post-content" placeholder="All your content here"></textarea>
                    <p class="sub-label">This is the content of your post</p>
                </div>
            `;
            const CATEGORY_FORM = `
                <div class='form-input'>
                    <p class="label">Title</p>
                    <input class="input" id="category-title" type="text" placeholder="Super Cool Title">
                    <p class="sub-label">This is the title that will be displayed to all viewers</p>
                </div>
            `;
            const RENAME_CATEGORY_FORM = `
                <div class='form-input'>
                    <input type="hidden" id="categoryId" value="${categoryId}">
                    <p class="label">Title</p>
                    <input class="input" id="category-title" type="text" placeholder="Super Cool Title">
                    <p class="sub-label">This is the title that will be displayed to all viewers</p>
                </div>
            `;

            switch (intent) {
                case 'post':
                    $('#modal').modal('toggle');
                    document.querySelector(".modal-title").innerHTML = "Create A Post";
                    document.querySelector('#model-body').innerHTML = POST_FORM;
                    $("#confirm").on('click',()=>{
                        createPost();
                    })
                break;
                case 'category':
                    $('#modal').modal('toggle');
                    document.querySelector('.modal-title').innerHTML = "Create A Category"
                    document.querySelector('#model-body').innerHTML = CATEGORY_FORM;
                    $("#confirm").on('click',()=>{
                        createCategory();
                    })
                break;
                case 'renamecategory':
                    $('#modal').modal('toggle');
                    document.querySelector('.modal-title').innerHTML = "Rename A Category"
                    document.querySelector('#model-body').innerHTML = RENAME_CATEGORY_FORM;
                    $("#confirm").on('click',()=>{
                        renameCategory();
                    })
                break;
                case 'error':
                    
                break;
                case 'success':
                    
                break;
                default:
                break;
            }
        }

        function createPost(){
            const postTitle = document.querySelector("#post-title").value;
            const postContent = document.querySelector('#post-content').innerHTML;
            const categoryId = document.querySelector('#post-select-category').value;

            // Fetch function to create Post
            var formdata = new FormData();
            formdata.append("postTitle", postTitle);
            formdata.append("postContent", postContent);
            formdata.append("categoryId", categoryId);

            var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/posts/createPost.php", requestOptions)
            .then(response => response.text())
            .then(result => success("Post Created Successfully"))
            .catch(error => console.log('error', error));
            
        }
        function createCategory(){
            const categoryTitle = document.querySelector('#category-title').value;

            var formdata = new FormData();
            formdata.append("categoryTitle", categoryTitle);

            var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/categories/createCategory.php", requestOptions)
            .then(response => response.text())
            .then(result => success("Category Created Success"))
            .catch(error => console.log('error', error));
            
        }
        function renameCategory(){
            const categoryId = document.querySelector('#categoryId').value;
            const categoryName = document.querySelector('#category-title').value;

            var formdata = new FormData();
            formdata.append("categoryId", categoryId);
            formdata.append("categoryNewname", categoryName);

            var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
            };

            fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/categories/renameCategory.php", requestOptions)
            .then(response => response.text())
            .then(result => success(result))
            .catch(error => console.log('error', error));
            
        }

        function success(msg){
            alert(msg);
            window.location.reload();
        }
    </script>
</body>
</html>