<?php
include ("php/connexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuditX</title>
    <link rel="shortcut icon" type="x-icon" href="img/icon.png">
    <link rel="stylesheet" href="style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
      .weirdfocus:focus {
              outline:0 !important;
              outline-style: none;
              box-shadow: none;
              border-color: #ffc107;
              }
      input:focus { 
        border: 1px solid #ffc107
            }
      .signin{
        border: 1px solid rgba(154, 154, 154, 0.498)
            }
      .signin:hover{
        background-color: #ffc107;
      }

    </style>
  </head>
<body style="background-color: grey;">
    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="img/AuditX.png"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <div class="card">
                <div class="card-body mt-4">
                  <div class="w-100">
                    <h3 class="mb-4 text-center fw-light">Connexion</h3>
                  </div>
              <form action="index.php" method="post">
                <!-- Login input -->
                <div class="form-outline mb-4">
                  <input type="text" class="form-control form-control-lg weirdfocus"
                    placeholder="Enter a valid login"  name="login"/>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-3">
                  <input type="password"class="form-control form-control-lg weirdfocus"
                    placeholder="Enter password" name="pwd"/>
                </div>
      
                <div class="text-center mt-4 pt-2">
                  <button type="submit" class="form-control btn btn-lightrounded submit px-3 signin weirdfocus fw-light" name="signin">Sign In</button>
                </div>
              </form>
              <?php
              if (isset($_POST['signin'])){
                  $login=$_POST['login'];
                  $pwd=$_POST['pwd'];
                  $sql="SELECT * FROM users WHERE username='".$login."' AND pwd='".$pwd."'";
                  $resultat=mysqli_query($link,$sql);
                  $row=mysqli_fetch_array($resultat);
                  if($row!=false) {
                      session_start();
                      $_SESSION["id_user"] = $row['id_user'];
                      $_SESSION["type_user"] = $row['type_user'];
                      $type_user=$_SESSION["type_user"];
                      $_SESSION["username"] = $row['username'];
                      if($type_user==0){
                          header("Location:src/admin/dashboard.php");
                      }elseif ($type_user==1){
                          header("Location:src/audit/dashboard.php");
                      }else{
                          header("Location:src/employe/dashboard.php");
                      };

                  }else{
                    echo '
                      <p class="small fw-bold mt-2 pt-1 mb-0 text-center">Wrong informations ! <a href="javascript:history.back()"
                      class="link-danger text-decoration-none">Try again</a></p>
                    ';
                  };
              };
              ?>
            </div>
          </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
