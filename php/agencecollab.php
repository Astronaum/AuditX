<?php
    if(isset($_GET['agence']) && !empty($_GET['agence'])){
        include('connexion.php');

        $id= $_GET['agence'];

        $query = "SELECT * FROM collaborateurs WHERE id_agence='$id'";
        $do = mysqli_query($link,$query);
        $count = mysqli_num_rows($do);
        if($count > 0){
            while ($row= mysqli_fetch_array($do)){
                $role=$row['id_role'];
                $sql2="SELECT * from roles where id_role='$role' ";
                $result2=mysqli_query($link,$sql2);
                $affect=mysqli_fetch_assoc($result2);
		        $nom=$affect["libelle_role"];
                echo'<option value="'.$row['id_collaborateur'].'">'.$row['nom_collaborateur'].' '.$row['prenom_collaborateur'].' ('.$nom.')</option>';
            }
        }else{
            echo'<option>Pas de collaborateur disponible</option>';

        }
    }else{
        echo 'Error';
    }
?>