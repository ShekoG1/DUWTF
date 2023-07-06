<div class="msg-container">
    <div class="error"></div>
    <div class="warning"></div>
    <div class="success"></div>
    <script>
        function showSuccess(msg){
            document.querySelector("#success").innerHTML = msg;
        }
        function showWarning(msg){
            document.querySelector("#warning").innerHTML = msg;
        }
        function showError(msg){
            document.querySelector("#error").innerHTML = msg;
        }
    </script>
</div>