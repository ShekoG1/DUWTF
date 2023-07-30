<style>
    footer{
        width: 100%;
        max-width:100%;
        background-color: black;
        padding: 15px;
        /* position: fixed; */
        bottom: 0;
        left: 0;
        right: 0;
    }
#creator-credit{
  display: flex;
  align-items: center;
  justify-content:center;
}
.footer-builtby{
    color: white;
    font-weight: bold;
    font-size:15px;
}
.footer-builtby a{
    color: white;
    text-decoration: none;
}
.footer-builtby a:hover{
    color:white;
}
#heart-svg {
    cursor: pointer;
    overflow: visible;
    width: 40px;
    margin: 0 auto;
    padding-bottom: 4rem;
  }
  
  svg #heart {
    transform-origin: center;
    animation: animateHeartOut .3s linear forwards;
  }
  
  svg #main-circ {
    transform-origin: 29.5px 29.5px;
  }
  
  .checkbox {
    display: none;
  }
  
  .checkbox:checked+label svg #heart {
    transform: scale(0.2);
    fill: #E2264D;
    animation: animateHeart .3s linear forwards .25s;
  }
  
  .checkbox:checked+label svg #main-circ {
    transition: all 2s;
    animation: animateCircle .3s linear forwards;
    opacity: 1;
  }
  
  .checkbox:checked+label svg #grp1 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp1 #oval1 {
    transform: scale(0) translate(0, -30px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp1 #oval2 {
    transform: scale(0) translate(10px, -50px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp2 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp2 #oval1 {
    transform: scale(0) translate(30px, -15px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp2 #oval2 {
    transform: scale(0) translate(60px, -15px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp3 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp3 #oval1 {
    transform: scale(0) translate(30px, 0px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp3 #oval2 {
    transform: scale(0) translate(60px, 10px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp4 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp4 #oval1 {
    transform: scale(0) translate(30px, 15px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp4 #oval2 {
    transform: scale(0) translate(40px, 50px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp5 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp5 #oval1 {
    transform: scale(0) translate(-10px, 20px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp5 #oval2 {
    transform: scale(0) translate(-60px, 30px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp6 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp6 #oval1 {
    transform: scale(0) translate(-30px, 0px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp6 #oval2 {
    transform: scale(0) translate(-60px, -5px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp7 {
    opacity: 1;
    transition: .1s all .3s;
  }
  
  .checkbox:checked+label svg #grp7 #oval1 {
    transform: scale(0) translate(-30px, -15px);
    transform-origin: 0 0 0;
    transition: .5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp7 #oval2 {
    transform: scale(0) translate(-55px, -30px);
    transform-origin: 0 0 0;
    transition: 1.5s transform .3s;
  }
  
  .checkbox:checked+label svg #grp2 {
    opacity: 1;
    transition: .1s opacity .3s;
  }
  
  .checkbox:checked+label svg #grp3 {
    opacity: 1;
    transition: .1s opacity .3s;
  }
  
  .checkbox:checked+label svg #grp4 {
    opacity: 1;
    transition: .1s opacity .3s;
  }
  
  .checkbox:checked+label svg #grp5 {
    opacity: 1;
    transition: .1s opacity .3s;
  }
  
  .checkbox:checked+label svg #grp6 {
    opacity: 1;
    transition: .1s opacity .3s;
  }
  
  .checkbox:checked+label svg #grp7 {
    opacity: 1;
    transition: .1s opacity .3s;
  }

  .contact-link{
    color: white;
    font-size: 20px;
    text-decoration:none;
  }
  #contact-heading{
    font-size: 50px;
  }
  .social-list{
    list-style:none;
  }
  .social-list li{
    padding: 20px;
  }

  .D_U{
    font-size: 50px;
  }
  .WTF{
      font-size: 100px;
  }
  
  @keyframes animateCircle {
    40% {
      transform: scale(10);
      opacity: 1;
      fill: #DD4688;
    }
    55% {
      transform: scale(11);
      opacity: 1;
      fill: #D46ABF;
    }
    65% {
      transform: scale(12);
      opacity: 1;
      fill: #CC8EF5;
    }
    75% {
      transform: scale(13);
      opacity: 1;
      fill: transparent;
      stroke: #CC8EF5;
      stroke-width: .5;
    }
    85% {
      transform: scale(17);
      opacity: 1;
      fill: transparent;
      stroke: #CC8EF5;
      stroke-width: .2;
    }
    95% {
      transform: scale(18);
      opacity: 1;
      fill: transparent;
      stroke: #CC8EF5;
      stroke-width: .1;
    }
    100% {
      transform: scale(19);
      opacity: 1;
      fill: transparent;
      stroke: #CC8EF5;
      stroke-width: 0;
    }
  }
  
  @keyframes animateHeart {
    0% {
      transform: scale(0.2);
    }
    40% {
      transform: scale(1.2);
    }
    100% {
      transform: scale(1);
    }
  }
  
  @keyframes animateHeartOut {
    0% {
      transform: scale(1.4);
    }
    100% {
      transform: scale(1);
    }
  }
    </style>
<footer class="container-fluid row">
    <div class="col-lg-6 col-md-12 col-sm-12" id="creator-credit">
      <div class="col-12 row" id="logo-container">
        <div class="col-12 row" id="logo">
          <div class="D_U neonPink col-12" style="display:flex;align-items:center;justify-content:center;padding: 30px 30px 0 30px;">Dear Universe...</div>
          <div class="WTF neonPink col-12" style="display:flex;align-items:center;justify-content:center;padding: 0 30px 30px 30px;">WTF???</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <h3 id="contact-heading">Contact Me</h3>
      <div class="contact-info row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <ul class="social-list">
            <li><a class="contact-link playPink" href="">(000)-000-0000</a></li>
            <li><a class="contact-link playPink" href="">hennars1@gmail.com</a></li>
            <li><a class="contact-link playPink" href="">support@duwtf.co.za</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <ul class="social-list">
            <li><a class="contact-link playPink" href="#">Instagram</a></li>
            <li><a class="contact-link playPink" href="#">Facebook</a></li>
            <li><a class="contact-link playPink" href="#">Twitter</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <ul class="social-list">
            <li><a class="contact-link playPink" href="#">Threads</a></li>
            <li><a class="contact-link playPink" href="#">Reddit</a></li>
            <li><a class="contact-link playPink" href="#">Discord</a></li>
          </ul>
        </div> 
      </div>
    </div>

    <!-- Creator Credit -->
    <div class="col-12" id="creator-credit">
        <p>Dear Universe..WTF? &#169; 2023 | </p>
        <p class='footer-builtby'>Made with <input type="checkbox" class="checkbox" id="checkbox" />
        <label for="checkbox">
            <svg id="heart-svg" viewBox="467 350 58 57" xmlns="http://www.w3.org/2000/svg">
                <g id="Group" fill="none" fillRule="evenodd" transform="translate(467 392)">
                <path id="heart" d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" fill="#AAB8C2"/>
                <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>
        
                <g id="grp7" opacity="0" transform="translate(7 6)">
                    <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                    <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                </g>
        
                <g id="grp6" opacity="0" transform="translate(0 28)">
                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                    <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                </g>
        
                <g id="grp3" opacity="0" transform="translate(52 28)">
                    <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                    <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                </g>
        
                <g id="grp2" opacity="0" transform="translate(44 6)">
                    <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                </g>
        
                <g id="grp5" opacity="0" transform="translate(14 50)">
                    <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                    <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                </g>
        
                <g id="grp4" opacity="0" transform="translate(35 50)">
                    <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                    <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                </g>
        
                <g id="grp1" opacity="0" transform="translate(24)">
                    <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                    <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                </g>
                </g>
            </svg>
            </label>
        by <a class="playRed" href="https://www.theshekharmaharaj.com">Shekhar Maharaj</a></p>
    </div>

</footer>