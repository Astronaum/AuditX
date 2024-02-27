<?php 
session_start();
include ("../../php/connexion.php");
if(!isset($_SESSION["id_user"]))
	{
	header("location:../../index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AuditX - Collaborateur</title>
    <link rel="shortcut icon" type="x-icon" href="../../img/icon.png">
    <link rel="stylesheet" href="../../style/sb-admin-2.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">    <script src="../../js/sidebar.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">
    <link href="../../style/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/bootstrapmodif.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3 fw-bold text-danger">AuditX</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider bg-dark">
                <div class="sidebar-heading text-dark">
                Les audits
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="dashboard.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Mon historique</span>
                    </a>
                </li>
    
                <!-- Heading -->
                
                <div class="dropdown position-absolute bottom-0 start-3">
                    <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="../../img/avatar.png" alt="mdo" width="24" height="24" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow ms-3">
                      <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                      <li><hr class="sidebar-divider bg-dark mt-2 mb-2"></li>
                      <li>
                        <form action="../../php/logout.php" method = "post">
                        <button type="submit" class="dropdown-item signoutcolor" name="signout" >Sign out</button>
                        </form>
                       </li>
                    </ul>
                  </div>
                </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow opacity-25">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-end me-5">
                        <?php  

                            $research=$_SESSION['username'];
                            $sql="SELECT * FROM collaborateurs WHERE matricule='$research'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_fetch_assoc($result);
                            $nom=$row['nom_collaborateur'];
                            $prenom=$row['prenom_collaborateur'];
                            $id=$row['id_collaborateur'];
                            $id_role=$row['id_role'];
                            $_SESSION['id']=$id;
                            $_SESSION['id_role']=$id_role;
                            echo '<h6 style="color:grey;"> Bonjour, '.$nom.' '.$prenom.' !</h6>'
                        ?>
                        </div>
                      </div>
                </nav>
                <form class="row g-3 m-5 p-5 pt-0" method="post">
                    <div class="col-md-12">
                        <label class="form-label">les auditeurs :</label>
                        <select class="form-select weirdfocus" name="auditeur" required>
							<?php
								$sql2="SELECT * from audits";
								$result2=mysqli_query($link,$sql2);
								while ($nom_auditeur=mysqli_fetch_assoc($result2))
								{
								echo '<option value='.$nom_auditeur["id_audit"].'>';
								echo $nom_auditeur["nom_audit"].' '.$nom_auditeur["prenom_audit"].' ('.$nom_auditeur["bureau_audit"].')';
								echo'</option>';
								}
							?>
                        </select>
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <button type="submit" class="btn btn-warning" name="reponse">Mes réponses</button>
                    </div>
                    <?php
if(isset($_POST['reponse']) && !empty($_POST['auditeur'])){

    $id_a=$_POST['auditeur'];
    $id_r=$_SESSION['id_role'];

    $sql2="SELECT * FROM formulaires WHERE id_audit='$id_a' AND role='$id_r'";
    $result2=mysqli_query($link,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    if(is_null($row2)){
        
        echo '<div class="d-flex justify-content-center mt-5">
        <p class="card-text text-danger fw-bold">Vous n\'êtes pas audité par cet audit. <a href="dashboard.php" class="text-success">Réessayer.</a></p>
        </div>
        </div>';

    }else{
        $id_f=$row2['id_formulaire'];
        echo "<meta http-equiv='refresh' content='0'>";
        echo "<script>window.location.replace(\"details.php?id_a=".$id_a."&id_r=".$id_r."&id_f=".$id_f."\");</script>";

    };

};
?>
                </form>
            </div>
            </div>
</body>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</html>