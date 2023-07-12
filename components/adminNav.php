<div id="nav-container" class="nav-container-closed">
    <div id="nav" class="boxPink">
        <div class="nav-heading fadeIn" onclick="toggleNav()">
            <span>
                <svg class="hb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke="#eee" stroke-width=".6" fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
                    <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
                        <animate dur="0.2s" attributeName="d" values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze" begin="start.begin" />
                        <animate dur="0.2s" attributeName="d" values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze" begin="reverse.begin" />
                    </path>
                    <rect width="10" height="10" stroke="none">
                        <animate dur="2s" id="reverse" attributeName="width" begin="click" />
                    </rect>
                    <rect width="10" height="10" stroke="none">
                        <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click" />
                        <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin" />
                    </rect>
                </svg>
            </span>
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