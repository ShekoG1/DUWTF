<div id="nav-container" class="nav-container-closed">
    <div id="nav" class="boxPink">
        <div class="nav-heading" onclick="toggleNav()">
            <!-- <span>ICON<span> -->
            <span>Menu</span>
        </div>
        <div class="nav-item boxPink playPink">
            <div class="nav-icon">
                <a href="#">ICON</a>
            </div>
            <div class="nav-route">
                <a href="#">ROUTE</a>
            </div>
        </div>
        <div class="nav-item boxRed playRed">
            <div class="nav-icon">
                <a href="#">ICON</a>
            </div>
            <div class="nav-route">
                <a href="#">ROUTE</a>
            </div>
        </div>
        <div class="nav-item boxBlue playBlue">
            <div class="nav-icon">
                <a href="#">ICON</a>
            </div>
            <div class="nav-route">
                <a href="#">ROUTE</a>
            </div>
        </div>
        <div class="nav-item boxLime playLime">
            <div class="nav-icon">
                <a href="#">ICON</a>
            </div>
            <div class="nav-route">
                <a href="#">ROUTE</a>
            </div>
        </div>
        <div class="nav-item boxPurple playPurple">
            <div class="nav-icon">
                <a href="#">ICON</a>
            </div>
            <div class="nav-route">
                <a href="#">ROUTE</a>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleNav(){
        let nav = document.querySelector("#nav-container");
        nav.classList.toggle("nav-container-open")
        nav.classList.toggle("nav-container-closed")
    }
    toggleNav()
</script>