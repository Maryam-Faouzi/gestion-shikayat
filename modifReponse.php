<?php
$con = mysqli_connect("localhost", "root", "", "reclamation");
if (!$con) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$data = [];

if (isset($_GET['id'])) {
    $numR = $_GET['id'];
    $query = "SELECT * FROM reponse, reclamation WHERE numR = numReclamation AND numRep = '$numR'";
    $res1 = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res1);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numR = $_POST['numReclamation'];
    $nR = $_POST['numReponse'];
    $dateR = $_POST['dateReponse'];
    $resume = $_POST['resume'];
    $remarque = $_POST['remarque'];
    $req2 = "UPDATE reponse SET  numRep='$nR', dateRep='$dateR', resume='$resume', remarque='$remarque' , numReclamation='$numR' WHERE numRep='$nR'";
    $res = mysqli_query($con, $req2);
    if ($res) {
       header("Location:reponses.php");
        exit();
    } else {
    echo '<div style="padding: 15px; background-color:rgb(240, 214, 206); color:rgb(236, 46, 46); border-radius: 4px; margin-bottom: 20px;">
                   il y a une erreur! </div>';
            }
    }

?>

<!DOCTYPE html>
<html lang="ar" dir = "rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
    background-color: rgba(0, 0, 0, 0.5); /* Transparence */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-description {
            text-align: center;
            color:#a10202;
            margin-bottom: 30px;
			font-size :20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .required:after {
            content: ' *';
            color: #e32;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        textarea {
            min-height: 150px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col {
            flex: 1;
            padding: 0 10px;
            min-width: 200px;
        }
        .buttons {
            text-align: right;
            margin-top: 20px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-submit:hover, .btn-reset:hover ,.btn-scanner:hover{
           color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
        }
        .btn-submit ,.btn-reset,.btn-scanner {
                color: #fff;
    background-color: #286090;
    border-color: #204d74;
        }
        @media (max-width: 600px) {
            .col {
                flex: 0 0 100%;
                margin-bottom: 15px;
            }
        }
 .exit-button {
            position: fixed;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: #666;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .exit-button:hover {
            background: #ff4757;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
        }

        .exit-button:active {
            transform: scale(0.95);
        }

    </style>
</head>
<body>
       <button class="exit-button" id="exitBtn1" onclick="exitApplication()" title="Fermer">×</button>
<script>
  function exitApplication() {
            window.history.back();
        }
        </script>
    <div class="container">
        <h1>تعديل اجابة</h1>

      
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-row">
			<div class="col">
                    <div class="form-group">
                      <label for="numReclamation" class="required">رقم الشكاية </label>
                        <input type="text" id="numReclamation" name="numReclamation" placeholder="9874" value="<?= $data['numR'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                      <label for="numReponse" class="required">رقم الجواب </label>
                        <input type="text" id="numReponse" name="numReponse" placeholder="9874" value="<?= $data['numRep'] ?>">
                    </div>
                </div>
				<div class="col">
                    <div class="form-group">
                        <label for="dateReponse" class="required">تاريخ الجواب</label>
                        <input type="date" id="dateReponse" name="dateReponse" value="<?= $data['dateRep'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="resume" >ملخص الجواب</label>
                <textarea id="resume" name="resume" placeholder="التفاصيل هنا ....."  ><?= $data['resume'] ?></textarea>
            </div>
			<div class="form-group">
                <label for="remarque">الملاحظات</label>
                <textarea id="remarque" name="remarque" placeholder="التفاصيل هنا ....." ><?= $data['remarque'] ?></textarea>
            </div>
			 <div class="buttons">
			    <button type="submit" class="btn-submit">حفظ الإجابة</button>
                <button type="reset" class="btn-reset">إعادة الضبط</button>

            </div>

    </div>
        </form>
    </div>
</body>
</html>
