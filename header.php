<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <title>The Gram</title>
</head>
<body>
    <header>
        <div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <div class = "header_right">
                <?php
                    if(!isset($_SESSION)) 
                    { 
                        session_start(); 
                    } 
                    if(isset($_SESSION['login']))
                    {
                    ?>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                        <a class="nav-link" href="home.php">HOME</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="camera.php">Camera</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="changedetails.php">Update Information</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="includes/signout_inc.php">LOGOUT</a>
                        </li>
                    </ul>
                    <?php
                    }
                    else
                    {
                    ?>

                    <ul class="navbar-nav">
                        <li class="nav-item active">
                        <a class="nav-link" href="home.php">HOME</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="login.php">SIGNIN</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link"  href="signup.php">SIGNUP</a>
                        </li>
                    </ul>
                    <?php 
                    }
                ?>            
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>