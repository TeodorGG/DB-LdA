<?php require_once 'process1.php'; ?>
<?php if(isset($_SESSION['message'])): ?>


<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidența cheltuielilor familiale</title>
    <link rel="stylesheet" href="http://localhost:8888/tezadean/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost:8888/tezadean/css/style_base.css">

    <script type="text/javascript" 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" 
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script type="text/javascript" 
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>


</head>
<body>

<div class = "dialog_box_as" id = "add_membru" >
    <div class = "dialog_container">
        <div class="d-flex justify-content-between">
                <div class = "w-100  d-flex flex-column justify-content-center">
                    <h3>Adaugă membru</h3>
                    <form action="process1.php" method = "GET" style = "d-flex flex-row justify-content-center">
                        <label>Nume membru</label>
                        <input name="nume_membru" class="form-control" placeholder = "Nume membru nou" style = "width : 100%; "  minlength = "4" type required/>
                        <div class = "d-flex flex-row">
                            <a href="" class="btn btn-danger w-100" style="margin: 5px;">Anulează</a>
                            <input type="submit"  class="btn btn-success w-100" style="margin: 5px;" value = "Adaugă membru"/>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div> 

<div class = "dialog_box_as" id = "add_venit" style = '<?php if($id_edit_venit != ""){ echo "display: flex;"; }?>' >
    <div class = "dialog_container">
        <div class="d-flex justify-content-between">
                <div class = "w-100  d-flex flex-column justify-content-center">
                    <h3><?php if($id_edit_venit != ""){ echo "Update la venit"; } else { echo 'Adaugă venit';}?></h3>
                    <form action="http://localhost:8888/tezadean/process1.php" method = "GET" style = "d-flex flex-row justify-content-center">
                        <input name="titlu_venit"  class="form-control" value = "<?php if($id_edit_venit != ""){echo $venit_data['titlu'];} else { echo ""; }?>"  placeholder = "Titlu" style = "width : 100%; margin-top:20px"  minlength = "4" type required/>
                        <input name="valoare"  class="form-control"  value = "<?php if($id_edit_venit != ""){echo $venit_data['val_venit'];} else { echo ""; }?>"  placeholder = "Valoare" style = "width : 100%;  margin-top:20px"   required/>
                        <?php if($id_edit_venit != ""){ echo '
                            <input name="id_update_venit" value = "'.$id_edit_venit.'"  style = "display: none; " />
                            '; }?>
                        <select  class="form-control" id="id_membru" name="id_membru" style = "width : 100%;  margin-top:20px" required>
                          
                            <?php 

                                foreach($membri as $row):
                                    $val_help = "";
                                    if($id_edit_venit != "" && $venit_data['id_membru'] == $row['id_membry']){
                                        $val_help = "selected='selected'";
                                    } 
                                    echo "
                                        <option ".$val_help." value='".$row['id_membry']."'>".$row['nume_membry']."</option>
                                    "
                                ?>
                            <?php endforeach ?>
                        </select>
                        <input class="form-control" name="date"  value = "<?php if($id_edit_venit != ""){echo $venit_data['date'];} else { echo ""; }?>"   placeholder = "Data" style = "width : 100%;  margin-top:20px" type="date"   required/>
                        <select  class="form-control" id="id_tip" name="id_tip" style = "width : 100%;  margin-top:20px" required>
                          
                            <?php 

                                $tips = mysqli_query($con, "SELECT * FROM tip");
                               
                                while($row = $tips->fetch_assoc()): 
                                    $val_help = "";
                                    if($id_edit_venit != "" && $venit_data['id_tip'] == $row['id_tip']){
                                        $val_help = "selected='selected'";
                                    } 
                                    echo "
                                        <option ".$val_help." value='".$row['id_tip']."'>".$row['tip']."</option>
                                "
                            ?>
                            <?php endwhile ?>

                        </select>

                        <select class="form-control" id="id_sursa" name="id_sursa" style = "width : 100%;  margin-top:20px" required>
                          
                            <?php 

                                $surse = mysqli_query($con, "SELECT * FROM surse");

                                while($row = $surse->fetch_assoc()): 
                                    $val_help = "";
                                    if($id_edit_venit != "" && $venit_data['id_sursa'] == $row['id_surse']){
                                        $val_help = "selected='selected'";
                                    } 
                                    echo "
                                        <option ".$val_help." value='".$row['id_surse']."'>".$row['sursa']."</option>
                                    "
                            ?>
                            <?php endwhile ?>

                        </select>

                        <div class = "d-flex flex-row">
                            <a href="http://localhost:8888/tezadean/analiza.php" class="btn btn-danger w-100" style="margin: 5px;">Anulează</a>
                            <input type="submit"  class="btn btn-success w-100" style="margin: 5px;" value = "<?php if($id_edit_venit != ""){ echo "Update la venit"; } else { echo 'Adaugă venit';}?>"/>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div> 



<div class = "dialog_box_as" id = "add_cheltuiala" style = '<?php if($id_edit_cheltuiala != ""){ echo "display: flex;"; }?>' >
    <div class = "dialog_container">
        <div class="d-flex justify-content-between">
                <div class = "w-100  d-flex flex-column justify-content-center">
                    <h3><?php if($id_edit_cheltuiala != ""){ echo "Update la cheltuială"; } else { echo 'Adaugă cheltuială';}?></h3>
                    <form action="http://localhost:8888/tezadean/process1.php" method = "GET" style = "d-flex flex-row justify-content-center">
                        <input class="form-control"  name="titlu_cheltuiala" value = "<?php if($id_edit_cheltuiala != ""){echo $cheltuieli_data['titlu'];} else { echo ""; }?>"      placeholder = "Titlu" style = "width : 100%; margin-top:20px"  minlength = "4" type required/>
                        <input class="form-control"  name="valoare<?php if($id_edit_cheltuiala != ''){echo "_update";}?>"          value = "<?php if($id_edit_cheltuiala != ""){echo $cheltuieli_data['val_cheltuili'];} else { echo ""; }?>"       placeholder = "Valoare" style = "width : 100%;  margin-top:20px"   required/>
                        <?php if($id_edit_cheltuiala != ""){ echo '
                            <input name="id_update_chel" value = "'.$id_edit_cheltuiala.'"  style = "display: none; " />
                            '; }?>
                        <select class="form-control"  id="id_membru" name="id_membru" style = "width : 100%;  margin-top:20px" required>
                      

                            <?php 

                                foreach($membri as $row):
                                    $val_help = "";
                                    if($id_edit_cheltuiala != "" && $cheltuieli_data['id_membru'] == $row['id_membry']){
                                        $val_help = "selected='selected'";
                                    } 
                                    echo "
                                        <option ".$val_help." value='".$row['id_membry']."'>".$row['nume_membry']."</option>
                                    "
                                ?>
                            <?php endforeach ?>
                        </select>
                        <input name="date"  class="form-control" value = "<?php if($id_edit_cheltuiala != ""){echo $cheltuieli_data['date'];} else { echo ""; }?>"   placeholder = "Data" style = "width : 100%;  margin-top:20px" type="date"   required/>
                        <select class="form-control"  id="id_tip" name="id_tip" style = "width : 100%;  margin-top:20px" required>
                          
                            <?php 

                                $tips = mysqli_query($con, "SELECT * FROM tip");

                                while($row = $tips->fetch_assoc()): 
                                    $val_help = "";
                                    if($id_edit_cheltuiala != "" && $cheltuieli_data['id_tip'] == $row['id_tip']){
                                        $val_help = "selected='selected'";
                                    } 
                                    echo "
                                        <option  ".$val_help." value='".$row['id_tip']."'>".$row['tip']."</option>
                                "
                            ?>
                            <?php endwhile ?>

                        </select>

                        <select class="form-control"  id="id_categorie" name="id_categorie" style = "width : 100%;  margin-top:20px" required>
                          
                            <?php 

                                $surse = mysqli_query($con, "SELECT * FROM categorii");

                                while($row = $surse->fetch_assoc()): 
                                    $val_help = "";
                                    if($id_edit_cheltuiala != "" && $cheltuieli_data['id_categorie'] == $row['id_categorie']){
                                        $val_help = "selected='selected'";
                                    } 
                                echo "
                                    <option  ".$val_help." value='".$row['id_categorie']."'>".$row['categorie']."</option>
                                "
                            ?>
                            <?php endwhile ?>

                        </select>

                        <div class = "d-flex flex-row">
                            <a href="http://localhost:8888/tezadean/analiza.php" class="btn btn-danger w-100" style="margin: 5px;">Anulează</a>
                            <input type="submit"  class="btn btn-success w-100" style="margin: 5px;" value = "<?php if($id_edit_cheltuiala != ""){ echo "Update la cheltuială"; } else { echo 'Adaugă cheltuială';}?>"/>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div> 

<div class = "dialog_box_as" id = "filtre_suma" style = '<?php if($show_filtre != ""){ echo "display: flex;"; }?>' >
    <div class = "dialog_container">
    <div class = "d-flex flex-row justify-space-between">
                <h3 class = "w-100" style = "width : 100%">Filtre</h3>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick="this.style.display = 'none'; window.location.replace('process1.php?clear=true');">
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <form  method= "GET" class = "d-flex flex-row">
                <input type = "date" name = "start_date_sort_f" />
                <input name="show_filtre" value = "true"  style = "display: none; " />
                            
                            
                <input type = "date" name = "end_date_sort_f" />
                <input type = "submit" value = "Sortează" />
            </form>
            <div class="d-flex flex-column justify-content-between">
                <div class = "flex-row">
                    <h3>Cel mai mult a cheltuit utilizatorul "<?php echo $cel_mai_mult_chel['f3']?>", o suma de "<?php echo $cel_mai_mult_chel['f1']?> mdl"</h3>
                    <h3>Cel mai mare venit îl are utilizatorul "<?php echo $cel_mai_mult_venit['f3']?>", o suma de "<?php echo $cel_mai_mult_venit['f1']?> mdl"</h3>
                </div>

                <div class="d-flex justify-content-between" style = "margin-top: 30px;">
                    <div class = "w-100 " >
                        <h3>Top cheltuieli</h3>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th>Membru</th>
                                    <th>Suma</th>
                                </tr>
                            </thead>
                            <?php 
                       
                            foreach($sums_cheltus as $row): 
                            ?>
                                <tr onclick = "<?php echo "window.location.replace('http://localhost:8888/tezadean/analiza.php?get_user_data=".$row['f2']."&name=".$row['f3']."')"?>" >
                                    <td><?php echo $row['f3']; ?></td>
                                    <td><?php echo $row['f1']; ?> mdl</td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class = "w-100 " > 
                        <h3>Top venit</h3>
                        <table class = "table">
                            <thead>
                                <tr >
                                    <th>Membru</th>
                                    <th>Valoare</th>
                                </tr>
                            </thead>
                            <?php 
                            foreach($sum_venitus as $row): 
                             

                                ?>
                                
                                <tr onclick = "<?php echo "window.location.replace('http://localhost:8888/tezadean/analiza.php?get_user_data=".$row['f2']."&name=".$row['f3']."')"?>" >
                                    <td><?php echo $row['f3']; ?></td>
                                    <td><?php echo $row['f1']; ?> mdl</td>
                                </tr>
                              

                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
                   
            </div>
    </div>
</div> 

<?php 

if($_SESSION['alert'] != ""): 
    
?>
    
    <div class = "dialog_box" id = "user_info" >
        <div class = "dialog_container" style = "z-index : 999">
            <div class = "d-flex flex-row justify-space-between">
                <h3 class = "w-100" style = "width : 100%">Datele utilizatorului: <?php echo $_SESSION['alert_name'] ?> - <?php echo $sum_venit - $sum_chelt?> mdl </h3>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close' onclick="this.style.display = 'none'; window.location.replace('process1.php?clear=true');">
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
            </div>
            <form  method= "GET" class = "d-flex flex-row">
                <input type = "date" name = "start_date_sort" />
                <input type = "date" name = "end_date_sort" />
                <input type = "submit" value = "Sortează" />
            </form>
            <div class="d-flex justify-content-between">
                    <div class = "w-100 " >
                        <h3>Cheltuieli - <?php echo $sum_chelt ?> mdl</h3>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th>Titlu</th>
                                    <th>Valoare</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <?php 
                            // $cheltuieli_user = mysqli_query($con, "SELECT * FROM cheltuieli WHERE id_membru = '".$_SESSION['alert']."'");
                            // $venit_user = mysqli_query($con, "SELECT * FROM venit  WHERE id_membru = '".$_SESSION['alert']."'");
                            
                            foreach($cheltuieli_user as $row): 
                            ?>
                                <tr>
                                    <td><?php echo $row['titlu']; ?></td>
                                    <td class ="text-danger"><?php echo $row['val_cheltuili']; ?> mdl</td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style = "border-top: none; ">
                                        <div class = "d-flex flex-row">
                                            <a href="analiza.php?edit_cheltuiala=<?php echo $row['id_chelituiala']; ?>&clear=true" class="btn btn-success w-100" style="margin: 5px;">Update</a>
                                            <a href="process1.php?delete_cheltuiala=<?php echo $row['id_chelituiala']; ?>&clear=true"  class="btn btn-danger w-100" style="margin: 5px;">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                

                            <?php endforeach ?>
                        </table>
                    </div>
                    <div class = "w-100 " > 
                        <h3>Venit - <?php echo $sum_venit ?> mdl</h3>
                        <table class = "table">
                            <thead>
                                <tr>
                                    <th>Titlu</th>
                                    <th>Valoare</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <?php 
                            foreach($venit_user as $row): 
                             

                                ?>
                                
                                <tr>
                                    <td><?php echo $row['titlu']; ?></td>
                                    <td class ="text-success"><?php echo $row['val_venit']; ?> mdl</td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style = "border-top: none; ">
                                        <div class = "d-flex flex-row">
                                            <a href="analiza.php?edit_venit=<?php echo $row['id_venit']; ?>&clear=true" class="btn btn-success w-100" style="margin: 5px;">Update</a>
                                            <a href="process1.php?delete_venit=<?php echo $row['id_venit']; ?>&clear=true"  class="btn btn-danger w-100" style="margin: 5px;">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                

                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
        </div>
    </div>  
    <?php endif ?> 


    <nav class="navbar navbar-dark bg-primary text-center">
    <a href="index.php" class="navbar-brand mb-0 h1 text-center">Evidența cheltuielilor familiale</a>
    </nav>
  
    <br><br><br>
    <div class="container">
        <div class="row">
             
            <div class="col-md-8 ">
                <div class = "d-flex f-row">
                    <h2 class="text-center">Suma totală pe cont :  <?php echo $total;?> mdl</h2>
                    <a class = "btn btn-dark btn-square-md m-auto" href = "?show_filtre=true">Mai multe setari</a>
                </div>
                <hr>
                <br>
                <h2>Grafic valoare cont</h2>

                <div class = "d-flex f-row">
                    <canvas id="myChart" style="width:100%;max-width:600px;margin-botton:100px"></canvas>


                    <script>

                        var xValues = [];
                        var yValues = [];

                        <?php 
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

                            $sum_cont=0;

                            foreach($list_base as $key => $row): 
                                $sum_cont += $row;
                            ?>
                            xValues.push("<?php echo $key; ?>");
                            yValues.push("<?php echo $sum_cont; ?>");
                        <?php endforeach ?>
                                
                       

                      

                        new Chart("myChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: false},
                            scales: {
                            yAxes: [{ticks: {min: -5000, max:10000}}],
                            }
                        }
                        });
                    </script>
                    
                </div>
                <script>
                    function update_chart(){

                        var start = document.getElementById("start_fileter").value.trim();
                        var end = document.getElementById("end_filter").value.trim();
   
                        var body_data = {
                            start: start,
                            end: end
                        }

                        let formData = new FormData();
                        formData.append('start', start);
                        formData.append('end', end);

                        var request = new XMLHttpRequest();

                        request.onreadystatechange = async (e) => {
                            if (request.readyState !== 4) {
                                return;
                            } 
                        

                            if (request.status === 200) {
                                //alert('tes ' + request.responseText)
                                try {

                                    const jsonValue = request.responseText;
                                    console.log(jsonValue);
                                    var json = JSON.parse(jsonValue);

                                    var xValues = [];
                                    var yValues = [];

                                    var keys = Object.keys(json.data);
                                    var sum = 0 ;

                                    for(var i = 0; i < keys.length;i++){
                                        xValues.push(keys[i]);
                                        sum += json.data[keys[i]];
                                        yValues.push(sum)
                                    }

                                    new Chart("myChart", {
                                    type: "line",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                        fill: false,
                                        lineTension: 0,
                                        backgroundColor: "rgba(0,0,255,1.0)",
                                        borderColor: "rgba(0,0,255,0.1)",
                                        data: yValues
                                        }]
                                    },
                                    options: {
                                        legend: {display: false},
                                        scales: {
                                        yAxes: [{ticks: {min: -5000, max:10000}}],
                                        }
                                    }
                                    });

                                } catch (e) {
                                // saving error

                                }

                            } else {
                            }
                        };

                        request.open('POST', 'http://localhost:8888/tezadean/get_sol_Data.php');
                        request.send(formData);
                        
                       
                    }
                </script>
                <div  class = "d-flex flex-row">
                    <input type = "date" id ="start_fileter"/>   
                    <input type = "date" id = "end_filter"/>
                    <button class = "btn btn-dark btn-square-md m-auto" onClick = "update_chart()">Filtrează</button>

                </div>

                <hr>
                <br>
                <br>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

