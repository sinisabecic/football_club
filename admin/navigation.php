 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top bg-bordo" role="navigation">
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse"
                 data-target="#bs-example-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <!-- Brand and toggle get grouped for better mobile display -->
             <a class="navbar-brand" href="<?php BASE_URL; ?>/admin/">
                 <p class="zuta"> Administracija</p>
             </a>
         </div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav navbar-right">
                 <li>
                     <a href="index.php"><i class="glyphicon glyphicon-home zuta"></i>
                         Povratak na sajt</a>
                 </li>
                 <li>
                     <a href="functions/user/logout.php"><i class="glyphicon glyphicon-log-in zuta"></i>
                         Odjava</a>
                 </li>
             </ul>
         </div>
     </div>
     <!-- /.container -->
 </nav>