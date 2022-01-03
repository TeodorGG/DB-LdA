<?php require_once 'process.php'; ?>
<?php if(isset($_SESSION['message'])): ?>


<?php endif ?> 
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evidența cheltuielilor familiale</title>
    <link rel="stylesheet" href="css/style_base.css">
    <link rel="stylesheet" href="http://localhost:8888/tezadean/css/bootstrap.min.css">

 
</head>
<body>
<nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">Evidența cheltuielilor familiale</span>
    </nav>
  
    <br><br><br>
    <div class="container">
        <div class="row">
                <div class = "w-100  d-flex flex-column justify-content-center">
                     <h2 class="text-center">Suma totală pe cont :  <?php echo $total;?> mdl</h2> 
                    <hr>
                </div>

                <div class = "w-100  d-flex flex-row justify-content-around">

                    <a href = "redactare.php" class = "custom_button_s">
                        <div class = "custom_button_s" >
                            <h3>Redactare date</h3>
                            <p>Adăugare, modificare, ștergere la date ce <br>se referă la membri, venitrui și cheltuieli</p>
                        </div>
                        
                    </a>
                    <a href = "analiza.php" class = "custom_button_s">
                        <div class = "custom_button_s">
                            <h3>Analiză date</h3>
                            <p>Analiza datelor în baza la cheltuieli, venituri și membri</p>
                        </div>
                    </a>
                </div>
        </div>
    </div>


<script src="js/bootstrap.min.js"></script>
</body>

</html>