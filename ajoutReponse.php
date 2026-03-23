<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
	<?php
	        $con=mysqli_connect("localhost","root","","reclamation");
        if (!$con) {
        die("Échec de la connexion : " . mysqli_connect_error());
                }
	?>
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
		
select#numR {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
    color: #000;
    appearance: none;           /* Supprime la flèche par défaut (Chrome) */
    direction: rtl;             /* Pour texte arabe de droite à gauche */
    background-image: none;     /* Supprime toute flèche potentielle */
}

/* Supprimer la flèche */
select#region::-ms-expand {
    display: none; /* Internet Explorer */
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

        <h1>إضافة رد</h1>
        <p class="form-description"> يُرجى ملء جميع الحقول الإلزامية المميزة بنجمة (*)</p>

 <?php
        // Traitement du formulaire lorsqu'il est soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $numR = $_POST['numR'];
            $nR  = $_POST['numReponse'];
            $dateR = $_POST['dateReponse'];
            $resume = $_POST['resume'];
            $remarque = $_POST['remarque'];
       
            // Ici logique de traitement 
                 $req="insert into reponse(numRep,dateRep,resume,remarque,NumReclamation) values ('$nR','$dateR','$resume','$remarque','$numR')";
                $res=mysqli_query($con,$req);
            // Affichage d'un message de confirmation
            if($res){
             echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;">
                    تم حفظ الإجابة بنجاح !</div>';
					echo '<meta http-equiv="refresh" content="2;url=reponses.php">';
            }else{
                echo '<div style="padding: 15px; background-color:rgb(240, 214, 206); color:rgb(236, 46, 46); border-radius: 4px; margin-bottom: 20px;">
                   il y a une erreur! </div>';
            }
            
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-row">
			<div class="col">
                    <div class="form-group">
					<label for="numR" class="required">رقم الشكاية </label>
                   <?php
if (isset($_GET['id'])) {
    $numR = $_GET['id'];
    // Afficher un champ texte prérempli ou vide selon besoin
    echo "<input type='text' id='numReponse' name='numReponse' value='" . htmlspecialchars($numR) . "' placeholder='9874' required>";
} else {
    $req1 = "SELECT DISTINCT numR FROM reclamation";
    $res1 = mysqli_query($con, $req1);

    if ($res1 && mysqli_num_rows($res1) > 0) {
        echo "<select id='numR' name='numR' required>";
        while ($row = mysqli_fetch_assoc($res1)) {
            echo "<option value='" . htmlspecialchars($row['numR']) . "'>" . htmlspecialchars($row['numR']) . "</option>";
        }
        echo "</select>";
    } else {
        echo "<p>لا توجد شكايات متاحة حالياً.</p>";
    }
}
?>
              
					</div>
                </div>
                <div class="col">
                    <div class="form-group">
                      <label for="numReponse" class="required">رقم الرد</label>
                        <input type="text" id="numReponse" name="numReponse" placeholder="رقم الجواب" required>
                    </div>
                </div>
				<div class="col">
                    <div class="form-group">
                        <label for="dateReponse" class="required">تاريخ الرد</label>
                        <input type="date" id="dateReponse" name="dateReponse" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="resume" >ملخص الرد</label>
                <textarea id="resume" name="resume" placeholder="التفاصيل هنا ....."  ></textarea>
            </div>
			<div class="form-group">
                <label for="remarque">الملاحظات</label>
                <textarea id="remarque" name="remarque" placeholder="التفاصيل هنا ....." ></textarea>
            </div>
			 <div class="buttons">
			    <button type="submit" class="btn-submit">حفظ الرد</button>
                <button type="reset" class="btn-reset">إعادة الضبط</button>

            </div>

    </div>
        </form>
	
</body>
</html>
