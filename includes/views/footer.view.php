<style type="text/css">.cookie-alert {
   position: fixed;
   bottom: 20px;
   right:20px;
   border-radius: 10px;
   background:#2f2f2f;
   color:#fff;
   padding:10px 15px;
   width:280px;
   z-index:100;
}
.cookie-alert a { 
   display:block;
   text-align: center;
   padding:5px 10px;
   margin:8px auto 0 auto;
   border-radius: 10px;
   background:transparent;
   border: 2px solid #46A2D9;
   color:#46A2D9;
   transition: all .3s ease;
}
   .cookie-alert a:hover {
      background: #46A2D9;
      color:#2f2f2f;
   }
@media only screen and (max-width:480px) {
   .cookie-alert {
      text-align: center;
      left: 0; right: 0;;
        margin: 0 auto;
      max-width:700px;
      padding:10px 30px;
   }
}</style>
<?php if($showcookie) { ?>
<div class="cookie-alert">
   En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour vous proposer des contenus et services adaptés à vos centres d’intérêts.<br /><a href="accept_cookie.php">OK</a>
</div>
<?php } ?>