<style>

    /* MAIN NAV STYLING BELOW */
    #nav{
        gap:3%;
        background-color:#5195FF;
        padding: 10px;
        justify-content: center;
    }
    .nav-item{
        width:150px;
        min-height:100px;
        padding:20px;
        font-size:30px;
        cursor:pointer;
    }
    .nav-item:hover{
        color:white;
    }

    .red{
        border: 5px solid #5195FF;
        background-color: #FA535D;
        color:#FF000F;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight:bolder;
    }
    .red:hover{
        border-color: #FF000F;
    }

    .baby_blue{
        border: 5px solid #5195FF;
        background-color: #A6B6F7;
        color:#DFE5FF;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight:bolder;
    }
    .baby_blue:hover{
        border-color: #DFE5FF;
    }

    .pink{
        border: 5px solid #5195FF;
        background-color: #E680E8;
        color:#FFFCF9;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight:bolder;
    }
    .pink:hover{
        border-color: #FFFCF9;
    }

    .orange{
        border: 5px solid #5195FF;
        background-color: #FB9B00;
        color:#FFE1B1;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight:bolder;
    }
    .orange:hover{
        border-color: #FFE1B1;
    }

    .faded_green{
        border: 5px solid #5195FF;
        background-color: #42C67B;
        color:#C8FFE0;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight:bolder;
    }
    .faded_green:hover{
        border-color: #C8FFE0;
    }
</style>
<div class="col-12" id="nav">
    <?php
        $colors = array('red', 'baby_blue', 'pink', 'orange', 'faded_green');
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
                echo "<div class='nav-item $color' id='duwtf-category-".$category->category_id."'>
                    ".$category->category_name."
                </div>";
            }
        }
    ?>
</div>