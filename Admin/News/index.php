<?php
// COOKIE CHECK HERE
if(!isset($_COOKIE["DUWTF_ADMIN"])){
    $kick = true;
}else{
    $kick = false;
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/projects/DearUniverseWTF/api/endpoints/admin/getAllusers.php',
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
    <link rel="stylesheet" href="./../../style/Admin/news.css">
    <link rel="stylesheet" href="./../../style/animations.css">
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
                    <h2 class="neonPink">Newsletter</h2>

                    <div class="form">
                        <div class='form-input row'>
                            <div class="col-3 neonBlue form-input-number">Step 1.</div>
                            <div class="col-9">
                                <p class="label">Title</p>
                                <input type="text" class="boxBlue neonBlue input" id="title" placeholder="Super Cool Title">
                                <p class="sub-label">This is the title that will be displayed to on the newsletter</p>
                            </div>
                        </div>
                        <div class='form-input row' id="form-content-container">
                            <hr/>
                            <div class="col-3 neonBlue form-input-number">Step 2.</div>
                            <div class="col-9">
                                <p class="label">Content</p>
                                <textarea class="boxBlue neonBlue input" id="newsletter-content" placeholder="Super Cool Content"></textarea>
                                <p class="sub-label">
                                    This is the content that will be displayed to on the newsletter.<br/>
                                    Hint: You don't need to add a header and a footer...We'll handle that for you!
                                </p>
                            </div>
                        </div>

                        <div class='form-input row' id="form-select-container">
                            <hr/>
                            <div class="col-3 neonBlue form-input-number">Step 3.</div>
                            <div class="col-9">
                                <p class="label">Email List</p>
                                <table id="usersTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
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
                                                    <tr class="boxPink playPink" onclick='toggleCheckbox("check-$user->member_id")'>
                                                        <td>
                                                            <input type="checkbox" class="select-user" id="check-$user->member_id" name="checkbox" value="$user->member_email_address">
                                                        </td>
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
                                <p class="sub-label">
                                    Choose the users that you want to send your newsletter to. Note, you must select at least one user to send the newsletter to!
                                </p>
                            </div>
                        </div>

                        <div class='form-input row' id="form-submit-container">
                            <hr/>
                            <div class="col-3 neonBlue form-input-number">Step 4.</div>
                            <div class="col-9">
                                <p class="sub-label">Send out your newsletter once you are sure that the content and title are correct.</p>
                                <p class="sub-label">Ready to send out the newsletter?</p>
                                <div class="newsletter-action-buttons">
                                    <button class="boxLime neonLime input" id="submit" onclick="sendNewsletter()">Yes! Send Newsletter</button>
                                    <button class="boxRed neonRed input" id="submit" onclick="cancelNewsletter()">No, Cancel!</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
            document.location.href = "http://localhost/projects/DearUniverseWTF/Admin/"
        }

        document.querySelector("#form-content-container").classList.add('fade-out');
        document.querySelector("#form-select-container").classList.add('fade-out');
        document.querySelector("#form-submit-container").classList.add('fade-out');

        // Progressively show next input
        document.getElementById("title").addEventListener("keydown", function(){
            if(document.querySelector("#title").value == null || document.querySelector("#title").value == ""){
                document.querySelector("#form-content-container").classList.add('fade-out');
                document.querySelector("#form-submit-container").classList.add('fade-out');
                document.querySelector("#form-select-container").classList.add('fade-out');
                // form-select-container
                document.querySelector("#form-content-container").classList.remove('fade-in');
                document.querySelector("#form-submit-container").classList.remove('fade-in');
                document.querySelector("#form-select-container").classList.remove('fade-in');
            }else{
                document.querySelector("#form-content-container").classList.add('fade-in');
                document.querySelector("#form-content-container").classList.remove('fade-out');
            }
        });

        document.getElementById("newsletter-content").addEventListener("keydown", function(){
            if(document.querySelector("#newsletter-content").value == null || document.querySelector("#newsletter-content").value == ""){
                document.querySelector("#form-select-container").classList.add('fade-out');
                document.querySelector("#form-select-container").classList.remove('fade-in');
            }else{
                document.querySelector("#form-select-container").classList.add('fade-in');
                document.querySelector("#form-select-container").classList.remove('fade-out');
                
            }
        })

        document.getElementById("form-select-container").addEventListener("click", function(){
            let checkedEmails = getCheckedValues();
            console.log(checkedEmails);
            if(checkedEmails.length <= 0){
                document.querySelector("#form-submit-container").classList.add('fade-out');
                document.querySelector("#form-submit-container").classList.remove('fade-in');
            }else{
                document.querySelector("#form-submit-container").classList.add('fade-in');
                document.querySelector("#form-submit-container").classList.remove('fade-out');
            }
        })

        function getCheckedValues() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const checkedValues = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedValues.push(checkbox.value);
                }
            });

            // Use checkedValues array as needed
            return checkedValues;
        }

        function toggleCheckbox(checkboxId){
            // document.getElementById("Numbers").checked = true;
            let checkboxElem = document.querySelector(`#${checkboxId}`);
            let parent = checkboxElem.parentElement.parentElement;

            if(checkboxElem.checked == true){
                checkboxElem.checked = false;
                parent.classList.remove("select-table-item");
            }else{
                checkboxElem.checked = true;
                parent.classList.add("select-table-item");
            }
        }

        function sendNewsletter(){
            const checkedEmails = getCheckedValues();
            if(
                document.querySelector("#title").value != null && document.querySelector("#title").value != "" &&
                document.querySelector("#newsletter-content").value != null && document.querySelector("#newsletter-content").value != "" &&
                checkedEmails != null && checkedEmails != "" && checkedEmails.length != 0
            ){
                var formdata = new FormData();
                formdata.append("to", checkedEmails);
                formdata.append("subject", document.querySelector("#title").value);
                formdata.append("body", document.querySelector("#newsletter-content").value);

                var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
                };

                fetch("http://localhost/projects/DearUniverseWTF/api/endpoints/email/sendNewsletter.php", requestOptions)
                .then(response => response.text())
                .then(result => alert(result))
                .catch(error => alert('error', error));
            }else{
                alert(`Title: ${document.querySelector("#title").value} \n Content: ${document.querySelector("#newsletter-content").value} \n Emails: ${checkedEmails}`);
            }
        }
    </script>
</body>
</html>