<?php
session_start();
// Create connection
$con = new mysqli("localhost","root","root","finante");

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
$total = 0;
$update = false;
$id=0;
$name = '';
$amount = '';
$user_name = '';
$id_edit_cheltuiala = '';
$id_edit_venit = '';
$cheltuieli_data = (object)[];
 $venit_data = (object)[];

    if(isset($_GET['edit_cheltuiala'])){
        $id_edit_cheltuiala = $_GET['edit_cheltuiala'];
        $ssd = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_chelituiala = '$id_edit_cheltuiala'");
        $cheltuieli_data = $ssd->fetch_assoc();

    }

    if(isset($_GET['edit_venit'])){
        $id_edit_venit = $_GET['edit_venit'];
        $ssd = mysqli_query($con, "SELECT * FROM venit WHERE id_venit = '$id_edit_venit'");
        $venit_data = $ssd->fetch_assoc();
    }



    $cheltuieli = mysqli_query($con, "SELECT * FROM cheltuieli");
    $venit = mysqli_query($con, "SELECT * FROM venit");
    $membri = mysqli_query($con, "SELECT * FROM membru");

    // while($row = $result->fetch_assoc()){
    $total = 233;
    // }

    //delete data

    // if(isset($_GET['start_date_sort']) || isset($_GET['end_date_sort'])  ){
        
    //     $id = $_SESSION['alert'];
       
    //     $_SESSION['massage'] = "SELECT * FROM venit WHERE id_membru = '$id' AND `date`  <  '".$_GET['end_date_sort']."'";
    //     $_SESSION['msg_type'] = "amount";

    //     header("location: index.php");
    //     return;
    // }

    if(isset($_GET['get_user_data']) || isset($_GET['start_date_sort']) || isset($_GET['end_date_sort']) ){
        

        if(isset($_GET['get_user_data'])){
            $id = $_GET['get_user_data'];
        } else {
            $id = $_SESSION['alert'];
        }

        if(isset($_GET['start_date_sort']) ){
            if(isset($_GET['end_date_sort'])){
                $cheltuieli_user = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_membru = '$id' AND `date` > '".$_GET['start_date_sort']."' AND `date`  <  '".$_GET['end_date_sort']."'  ");
                $venit_user = mysqli_query($con, "SELECT * FROM venit WHERE  id_membru = '$id' AND `date` > '".$_GET['start_date_sort']."' AND `date`  <  '".$_GET['end_date_sort']." ' ");
            } else {
                $cheltuieli_user = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_membru = '$id' AND `date` > '".$_GET['start_date_sort']."' ");
                $venit_user = mysqli_query($con, "SELECT * FROM venit WHERE  id_membru = '$id' AND `date` > '".$_GET['start_date_sort']."' ");
            }
        } else {
            if(isset($_GET['end_date_sort'])){
                $cheltuieli_user = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_membru = '$id' AND  `date`  <  '".$_GET['end_date_sort']."' ");
                $venit_user = mysqli_query($con, "SELECT * FROM venit WHERE  id_membru = '$id' AND `date`  <  '".$_GET['end_date_sort']."' ");
            } else {
                $cheltuieli_user = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_membru = '$id' ");
                $venit_user = mysqli_query($con, "SELECT * FROM venit WHERE  id_membru = '$id'");

            }
        }

        $_SESSION['alert'] = $id; 
        $_SESSION['alert_name'] = $_GET['name']; 

        //header("location: index.php");
    } 
   


    if(isset($_GET['clear'])){
        
        $_SESSION['alert'] = ""; 
        $_SESSION['alert_name'] = ""; 


        if(!isset($_GET['edit_cheltuiala']) && !isset($_GET['edit_venit']) ) {
         header("location: index.php");
        }

    }


    if(isset($_GET['nume_membru'])){
        $nume = $_GET['nume_membru'];

        $query = mysqli_query($con, "INSERT INTO `membru` (`nume_membry`) VALUES ( '$nume')");
        $_SESSION['massage'] = "Membrul a fost adăugat";
        $_SESSION['msg_type'] = "amount";

        header("location: index.php");

    }

    if(isset($_GET['titlu_venit'])){
        $titlu = $_GET['titlu_venit'];
        $valoare = $_GET['valoare'];
        $id_membru = $_GET['id_membru'];
        $date = $_GET['date'];
        $id_tip = $_GET['id_tip'];
        $id_sursa = $_GET['id_sursa'];

        if(isset($_GET['id_update_venit'])){
            $query = mysqli_query($con, "UPDATE venit SET titlu = '$titlu', id_sursa = '$id_sursa', id_cont = '2', id_membru = '$id_membru', val_venit = '$valoare', `date` =  '$date', id_tip = '$id_tip' WHERE id_venit = '".$_GET['id_update_venit']."' ");
            $_SESSION['massage'] = "Cheltuiala a fost updatat";
            $_SESSION['msg_type'] = "amount";
        } else {
            $query = mysqli_query($con, "INSERT INTO `venit` (`titlu`, `id_sursa`, `id_cont`, `id_membru`, `val_venit`, `date`, `id_tip`) VALUES ('$titlu', '$id_sursa', '2', '$id_membru', '$valoare', '$date', '$id_tip')");
            $_SESSION['massage'] = "Venit a fost adăugat";
            $_SESSION['msg_type'] = "amount";
        }
    
        header("location: index.php");

    }


    
    if(isset($_GET['titlu_cheltuiala'])){

            
        $titlu = $_GET['titlu_cheltuiala'];
        $id_membru = $_GET['id_membru'];
        $date = $_GET['date'];
        $id_tip = $_GET['id_tip'];
        $id_categorie = $_GET['id_categorie'];
        $id_update_chel = $_GET['id_update_chel'];

        if(isset($_GET['valoare_update'])){
            $valoare = $_GET['valoare_update'];

            $query = mysqli_query($con, "UPDATE  cheltuieli SET titlu = '$titlu', id_categorie = '$id_categorie', id_cont = '2', id_membru = '$id_membru', val_cheltuili = '$valoare', `date` =  '$date', id_tip = '$id_tip' WHERE id_chelituiala = '$id_update_chel' ");
            $_SESSION['massage'] = "Cheltuiala a fost updatat";
            $_SESSION['msg_type'] = "amount";
        } else {
            $valoare = $_GET['valoare'];
            $query = mysqli_query($con, "INSERT INTO `cheltuieli` (`titlu`, `id_categorie`, `id_cont`, `id_membru`, `val_cheltuili`, `date`, `id_tip`) VALUES ( '$titlu', '$id_categorie', '2', '$id_membru', '$valoare', '$date', '$id_tip')");
            $_SESSION['massage'] = "Cheltuiala a fost adăugată";
            $_SESSION['msg_type'] = "amount";
        }

    

        header("location: index.php");

    }

    

    if(isset($_GET['delete_membru'])){ 
        $id_membru_delete = $_GET['delete_membru'];
    

        $query = mysqli_query($con, "DELETE FROM `membru` WHERE `membru`.`id_membry` = ".$id_membru_delete."");
        $_SESSION['massage'] = "Membru a fost șters";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");

    }

    if(isset($_GET['delete_venit'])){
        $id_venit_delete = $_GET['delete_venit'];
    

        $query = mysqli_query($con, "DELETE FROM `venit` WHERE `id_venit` = ".$id_venit_delete."");
        $_SESSION['massage'] = "Venit a fost ștersă";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");

    }

    

    if(isset($_GET['delete_cheltuiala'])){
        $id_delete_cheltuiala = $_GET['delete_cheltuiala'];
    

        $query = mysqli_query($con, "DELETE FROM `cheltuieli` WHERE `id_chelituiala` = ".$id_delete_cheltuiala."");
        $_SESSION['massage'] = "Cheltuială a fost ștersă";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");

    }
    // if(isset($_GET['delete'])){
    //     $id = $_GET['delete'];

    //     $query = mysqli_query($con, "DELETE FROM budget WHERE id=$id");
    //     $_SESSION['massage'] = "Recode has been Delete !";
    //     $_SESSION['msg_type'] = "danger";

    //     header("location: index.php");

    // }

    // if(isset($_GET['edit'])){
    //     $id = $_GET['edit'];
    //     $update = true;
    //     $result = mysqli_query($con, "SELECT * FROM budget WHERE id=$id");

      
    //     if( mysqli_num_rows($result) == 1){
    //         $row = $result->fetch_assoc();
    //         $name = $row['name'];
    //         $amount = $row['amount'];
    //     }
    
    // }

    // if(isset($_POST['update'])){
    //     $id = $_POST['id'];
    //     $budget = $_POST['budget'];
    //     $amount = $_POST['amount'];

    //     $query = mysqli_query($con, "UPDATE budget SET name='$budget', amount='$amount' WHERE id='$id'");
    //     $_SESSION['massage'] = "Recode has been Update !";
    //     $_SESSION['msg_type'] = "success";
    //     header("location: index.php");
    // }


?>

