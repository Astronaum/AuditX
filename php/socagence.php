<?php
    if(isset($_GET['societe']) && !empty($_GET['societe'])){
        include('connexion.php');

        $id= $_GET['societe'];

        $query = "SELECT * FROM agences WHERE id_societe='$id'";
        $do = mysqli_query($link,$query);
        $count = mysqli_num_rows($do);

        if($count > 0){
            while ($row= mysqli_fetch_array($do)){
                echo'<option value="'.$row['id_agence'].'">'.$row['nom_agence'].'</option>';
            }
        }else{
            echo'<option>Pas d\'agence disponible</option>';

        }
    }else{
        echo 'Error';
    }
?>