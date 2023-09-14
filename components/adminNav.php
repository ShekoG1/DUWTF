<div id="nav-container" class="nav-container-closed">
    <div id="nav" class="boxPink">
        <div class="nav-heading fadeIn">
            <span onclick="toggleNav()">
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
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Dashboard/">
                    <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    color="white"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        d="M8 15C7.44772 15 7 15.4477 7 16C7 16.5523 7.44772 17 8 17C8.55228 17 9 16.5523 9 16C9 15.4477 8.55228 15 8 15Z"
                        fill="currentColor"
                    />
                    <path
                        d="M11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16Z"
                        fill="currentColor"
                    />
                    <path
                        d="M16 15C15.4477 15 15 15.4477 15 16C15 16.5523 15.4477 17 16 17C16.5523 17 17 16.5523 17 16C17 15.4477 16.5523 15 16 15Z"
                        fill="currentColor"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M4 3C2.34315 3 1 4.34315 1 6V18C1 19.6569 2.34315 21 4 21H20C21.6569 21 23 19.6569 23 18V6C23 4.34315 21.6569 3 20 3H4ZM20 5H4C3.44772 5 3 5.44772 3 6V7H21V6C21 5.44772 20.5523 5 20 5ZM3 18V9H21V18C21 18.5523 20.5523 19 20 19H4C3.44772 19 3 18.5523 3 18Z"
                        fill="currentColor"
                    />
                    </svg>
                </a>
            </div>
            <div class="nav-route">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Dashboard/">Dashboard</a>
            </div>
        </div>
        <div class="nav-item boxRed playRed">
            <div class="nav-icon">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Content/">
                    <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    color="white"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M14 7C13.4477 7 13 7.44772 13 8V16C13 16.5523 13.4477 17 14 17H18C18.5523 17 19 16.5523 19 16V8C19 7.44772 18.5523 7 18 7H14ZM17 9H15V15H17V9Z"
                        fill="currentColor"
                    />
                    <path
                        d="M6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H10C10.5523 9 11 8.55228 11 8C11 7.44772 10.5523 7 10 7H6Z"
                        fill="currentColor"
                    />
                    <path
                        d="M6 11C5.44772 11 5 11.4477 5 12C5 12.5523 5.44772 13 6 13H10C10.5523 13 11 12.5523 11 12C11 11.4477 10.5523 11 10 11H6Z"
                        fill="currentColor"
                    />
                    <path
                        d="M5 16C5 15.4477 5.44772 15 6 15H10C10.5523 15 11 15.4477 11 16C11 16.5523 10.5523 17 10 17H6C5.44772 17 5 16.5523 5 16Z"
                        fill="currentColor"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M4 3C2.34315 3 1 4.34315 1 6V18C1 19.6569 2.34315 21 4 21H20C21.6569 21 23 19.6569 23 18V6C23 4.34315 21.6569 3 20 3H4ZM20 5H4C3.44772 5 3 5.44772 3 6V18C3 18.5523 3.44772 19 4 19H20C20.5523 19 21 18.5523 21 18V6C21 5.44772 20.5523 5 20 5Z"
                        fill="currentColor"
                    />
                    </svg>
                </a>
            </div>
            <div class="nav-route">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Content/">Content</a>
            </div>
        </div>
        <div class="nav-item boxBlue playBlue">
            <div class="nav-icon">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Users">
                    <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    color="white"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7ZM14 7C14 8.10457 13.1046 9 12 9C10.8954 9 10 8.10457 10 7C10 5.89543 10.8954 5 12 5C13.1046 5 14 5.89543 14 7Z"
                        fill="currentColor"
                    />
                    <path
                        d="M16 15C16 14.4477 15.5523 14 15 14H9C8.44772 14 8 14.4477 8 15V21H6V15C6 13.3431 7.34315 12 9 12H15C16.6569 12 18 13.3431 18 15V21H16V15Z"
                        fill="currentColor"
                    />
                    </svg>
                </a>
            </div>
            <div class="nav-route">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Users">Users</a>
            </div>
        </div>
        <div class="nav-item boxLime playLime">
            <div class="nav-icon">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Subscriptions">
                    <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    color="white"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M19 9C19 11.3787 17.8135 13.4804 16 14.7453V22H13.4142L12 20.5858L10.5858 22H8V14.7453C6.18652 13.4804 5 11.3787 5 9C5 5.13401 8.13401 2 12 2C15.866 2 19 5.13401 19 9ZM17 9C17 11.7614 14.7614 14 12 14C9.23858 14 7 11.7614 7 9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9ZM10 19.7573L12 17.7573L14 19.7574V15.7101C13.3663 15.8987 12.695 16 12 16C11.305 16 10.6337 15.8987 10 15.7101V19.7573Z"
                        fill="currentColor"
                    />
                    </svg>
                </a>
            </div>
            <div class="nav-route">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/Subscriptions">Subscriptions</a>
            </div>
        </div>
        <div class="nav-item boxPurple playPurple">
            <div class="nav-icon">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/News">
                    <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    color="white"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M14 3V3.28988C16.8915 4.15043 19 6.82898 19 10V17H20V19H4V17H5V10C5 6.82898 7.10851 4.15043 10 3.28988V3C10 1.89543 10.8954 1 12 1C13.1046 1 14 1.89543 14 3ZM7 17H17V10C17 7.23858 14.7614 5 12 5C9.23858 5 7 7.23858 7 10V17ZM14 21V20H10V21C10 22.1046 10.8954 23 12 23C13.1046 23 14 22.1046 14 21Z"
                        fill="currentColor"
                    />
                    </svg>
                </a>
            </div>
            <div class="nav-route">
                <a href="http://localhost/projects/DearUniverseWTF/Admin/News">News</a>
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