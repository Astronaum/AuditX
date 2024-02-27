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
    <title>AuditX - Dépôt des rapports</title>
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
<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 fw-bold text-danger">AuditX</div>
            </a>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les créations
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="creerformulaire.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Création d'un formulaire</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="modif.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Création des questions et modification</span>
                </a>
            </li>
            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Audits
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="auditer.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Auditer une agence</span>
                </a>
            </li>

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Les dépôts
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed text-dark" href="rapports.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Les rapports</span>
                </a>
            </li>
       

            <hr class="sidebar-divider bg-dark">

            <div class="sidebar-heading text-dark">
                Historique
            </div>

                <li class="nav-item">
                    <a class="nav-link collapsed text-dark" href="histo.php">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Les audits</span>
                    </a>
                </li>
                
        </ul>
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

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow opacity-25">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-end me-5">
                        <?php  
                            $research=$_SESSION['username'];
                            $research=explode('.',$research);

                            $sql="SELECT * FROM audits WHERE nom_audit='$research[0]' AND prenom_audit='$research[1]'";
                            $result=mysqli_query($link,$sql);
                            $row=mysqli_fetch_assoc($result);
                            $nom_audit_cour=$row['nom_audit'];
                            $prenom_audit_cour=$row['prenom_audit'];
                            $id_audit_cour=$row['id_audit'];
                            $_SESSION['id_a_c']=$id_audit_cour;
                            echo '<h6 style="color:grey;"> Bonjour, '.$nom_audit_cour.' '.$prenom_audit_cour.' !</h6>'
                        ?>
                        </div>
                      </div>
                </nav>
                <form class="row g-3 m-5 p-5 pt-0" method="post" enctype="multipart/form-data">
                    <div class=" ms-2  ">
                            <p class=" text-danger fw-bold text-center">Statut de l'agence</p>
                    </div>
                    <div class="col-md-12">
                        <select class="form-select weirdfocus" name="agence" id="agence">
                        <?php
										$sql="SELECT * from affectations where id_audit='$id_audit_cour'";
										$result=mysqli_query($link,$sql);
										while ($affec=mysqli_fetch_assoc($result))
										{
                                            $affec_no_name=$affec["id_agence"];
										    echo '<option value='.$affec_no_name.'>';
                                            $sql2="SELECT nom_agence from agences where  id_agence='$affec_no_name' ";
                                            $result2=mysqli_query($link,$sql2);
                                            $affect=mysqli_fetch_assoc($result2);
										    echo $affect["nom_agence"];
										    echo'</option>';
										}
										?>
                        </select>                  
                    </div>
                    <?php
                    if(isset($_POST['verifier'])){
                                                
                        $id=$_POST['agence'];
                        $sql2="SELECT nom_agence from agences where  id_agence='$id' ";
                                            $result2=mysqli_query($link,$sql2);
                                            $affect=mysqli_fetch_assoc($result2);
										    $nom=$affect["nom_agence"];
                        $sql5="SELECT * from collaborateurs where id_agence='$id'";
                        $result5=mysqli_query($link,$sql5);
                        if($result5==FALSE){
                            echo '<div class="col-md-12">
                            <input type="text" class="form-control weirdfocus" value="Pas de collaborateurs dans cet agence." disabled>
                            </div>';
                        }else{
                        while ($check=mysqli_fetch_assoc($result5)){
                             
                        $id_co=$check['id_collaborateur'];
                        $sql6="SELECT * from reponses where id_collaborateur='$id_co'";
                        $result6=mysqli_query($link,$sql6);
                        $check2=mysqli_fetch_assoc($result6);
                        if($check2==NULL){
                            echo '<div class="col-md-12">
                            <input type="text" class="form-control text-danger weirdfocus" value="Le collaborateur '.$check['nom_collaborateur'].' '.$check['prenom_collaborateur'].' de l\'agence '.$nom.'  n\'est toujours pas audité" disabled>
                            </div>';
                        }else{
                            echo '<div class="col-md-12">
                                <input type="text" class="form-control weirdfocus text-success" value="Le collaborateur '.$check['nom_collaborateur'].' '.$check['prenom_collaborateur'].' de l\'agence '.$nom.'  est audité" disabled>
                                </div>';    };
                            };
                        };
                        };
                    ?>
                    <div class="col-12 mt-5 text-center">
                        <button type="submit" class="btn btn-success" name="verifier">Vérifier</button>
                    </div>
                </form>
                
            </div>
        </div>        
</body>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</html>

