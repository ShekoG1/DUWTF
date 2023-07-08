<style>

</style>
<div class="col-12" id="nav">
    <div class='nav-item' id='nav-action'>
    </div>
    <?php
        $colors = array('red', 'purple', 'pink', 'blue', 'lime');
        $curl = curl_init();
        
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
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $categoryResults = json_decode($response);
        
        if($categoryResults->msg == "success"){
            $categories =$categoryResults->data;
            foreach ($categories as $category) {
                $color = $colors[array_rand($colors)];
                echo "<div class='nav-item $color' data-color-scheme='$color' id='duwtf-category-".$category->category_id."' onclick='routeTo(".$category->category_id.")'>
                    ".$category->category_name."
                </div>";
            }
        }
    ?>
</div>