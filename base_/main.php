
<body>

     <!-- navBar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <div class="container-fluid">
            <a class="navbar-brand" href="/rd_proj/">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
              {
               echo '<li class="nav-item">
                  <a class="nav-link"  href="/rd_proj/data/videos.php">Videos</a>
                </li>';
              }

              ?> 
              
               
              </ul>
                <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
              {
              
                  echo '<a href="/rd_proj/Authentication_&_Authorization/logout.php" class="btn btn-danger">Logout</a>';
              }else{
                
                echo '<a class="btn btn-primary m-1" href="/rd_proj/Authentication_&_Authorization/login.php">Login</a>';
                echo '<a href="/rd_proj/Authentication_&_Authorization/sign_up.php" class="btn btn-success m-1">Sign Up</a>';
              }

        ?>
               
               
            </div>
          </div>
        </nav>







