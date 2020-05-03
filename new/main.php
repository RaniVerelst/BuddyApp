<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
    <link href="style/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,900&display=swap" rel="stylesheet">

    <title>BUDS</title>
</head>

<body>
    <div></div>
    <div class="row">
        <div class="col-lg-12  ">
            <div class="well headermain">
                <h1> <img src="images/logo.png" width="200px" alt=""></h1>
            </div>
        </div>
    </div>

    <div class="row mainbox">
        <div class="col-lg-6 main">
            <div>
                <h3><span class="glyphicon glyphicon-search"></span>&nbsp Vind snel je weg in IMD</h3>
                <h3><span class="glyphicon glyphicon-search"></span>&nbsp Krijg antwoorden op al je vragen</h3>
                <h3><span class="glyphicon glyphicon-search"></span>&nbsp Zoek beginnende IMD studenten en ga als buddy door het leven</h3>

            </div>


        </div>

        <div class="col-lg-6 main2">
            <div>
                <h2>Ontdek de wonderen van BUDS!</h2>
                <form action="" method="POST">
                    <button id="register" class="btn btn-info btn-lg" name="register">REGISTREER</button></br></br>
                    <?php if (isset($_POST['register'])) {
                        header('location:register.php');
                    } ?>
                    <button id="login" class="btn btn-info btn-lg" name="login">LOGIN</button>
                    <?php if (isset($_POST['login'])) {
                        header('location:login.php');
                    } ?>
                </form>

            </div>
        </div>
    </div>

</body>

</html>