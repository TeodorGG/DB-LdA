<?php
   
    if(isset($_POST))
{
    $a = '';
    $b = "";

 
  

    if($_POST['start'] != ''){
        $a = "AND `date` > '".$_POST['start']."'";
    }
    if($_POST['end'] != ''){
        $b = "AND `date`  <  '".$_POST['end']."'";
    }

   
      
    $conn = mysqli_connect("localhost","root","root","finante");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        $res->error_code = 1;
        $res = json_encode($res);

        echo $res;
        return;
    }

    // clear la text

    $cheltuieli = mysqli_query($conn, "SELECT * FROM cheltuieli  WHERE 1=1 $a $b");
    $venit = mysqli_query($conn, "SELECT * FROM venit WHERE 1=1 $a $b");

    $list_base = array();
    foreach($venit as $row){
        $list_base[$row['date']] += $row['val_venit'];
    }
    foreach($cheltuieli as $row){
        $list_base[$row['date']] -= $row['val_cheltuili'];
    }

    $das = array();
    foreach ($list_base as $key => $row){
        $das[$key] = $key;
    }
    array_multisort($das, SORT_ASC, $list_base);

    $res->data = $list_base;



    if(!$rs){
        $res->error_code = mysqli_error();
    }
    else
    {
        $res->error_code = 0;
    }
   
}
else
{
    $res->error_code = 7;
    

     
}
echo json_encode($res);

?>