<?php
        $con=mysqli_connect("localhost","root","","reclamation");
        if (!$con) {
        die("Échec de la connexion : " . mysqli_connect_error());
                }
?>
<!DOCTYPE html>
<html lang="ar" dir = "rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">    <style>
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



select#region {
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


        /* Style personnalisé du bouton */
        .custom-file-upload {
            background-color: #286090;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
        }

        /* Optionnel : pour changer le style lorsque l'utilisateur survole */
        .custom-file-upload:hover {
            background-color: #337ab7;
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
        <h1>استمارة تقديم شكوى</h1>
        <p class="form-description"> يُرجى ملء جميع الحقول الإلزامية المميزة بنجمة (*)</p>

        <?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des champs texte comme avant
    $numR = $_POST['numReclamation'];
    $date = $_POST['dateReclamation'];
    $reclamant = $_POST['reclamant'];
    $cin = $_POST['cin'];
    $tel = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $sujet = $_POST['sujet'];
    $src = $_POST['source'];
    $region = $_POST['region'];
    $numE = $_POST['numEnvois'];
    $dateE = $_POST['dateEnvois'];
    $def= $_POST['defendeur'];

    // Upload du fichier
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['document']['tmp_name'];
		$filename = $_FILES['document']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
       
        // Nettoyer le nom du fichier
        $fileName = strtotime(date("Y-m-d H:i:s"));
        $destination = $uploadDir . $fileName.'.'.$extension;

        if (move_uploaded_file($fileTmp, $destination)) {
            // Insertion dans la base
            #$req = "INSERT INTO reclamant(CIN,Adresse,tel,reclamant) VALUES ('$cin','$adresse','$tel','$reclamant')";
            #$res = mysqli_query($con, $req);
            #$req1 = "SELECT id FROM reclamant WHERE reclamant='$reclamant' ORDER BY id DESC LIMIT 1";
            #$res1 = mysqli_query($con, $req1);
            #$reclamantRow = mysqli_fetch_assoc($res1);
            #$reclamant_id = $reclamantRow['id'];	
            
    if(!empty($cin)) {
  $check = "SELECT id FROM reclamant WHERE CIN = '$cin' LIMIT 1";
    $resultCheck = mysqli_query($con, $check);
    if (mysqli_num_rows($resultCheck) > 0) {
        // CNI déjà existant : récupérer l'ID
        $row = mysqli_fetch_assoc($resultCheck);
        $reclamant_id = $row['id'];
    }  else {
        // CNI n'existe pas : insérer nouveau réclamant
        $req = "INSERT INTO reclamant(CIN, Adresse, tel, reclamant) 
                VALUES ('$cin', '$adresse', '$tel', '$reclamant')";
        $res = mysqli_query($con, $req);

        if ($res) {
            $reclamant_id = mysqli_insert_id($con);
        } else {
            echo '<div style="padding:15px; background-color:rgb(240,214,206); color:rgb(236,46,46); border-radius:4px; margin-bottom:20px;">
                    خطأ في حفظ بيانات المُشتكي!
                  </div>';
            exit;
        }
    }
    }else {
    // CIN vide → on insère quand même
    $req = "INSERT INTO reclamant(CIN, Adresse, tel, reclamant) 
            VALUES (NULL, '$adresse', '$tel', '$reclamant')";
    $res = mysqli_query($con, $req);

    if ($res) {
        $reclamant_id = mysqli_insert_id($con);
    } else {
        echo '<div style="padding:15px; background-color:rgb(240,214,206); color:rgb(236,46,46); border-radius:4px; margin-bottom:20px;">
                خطأ في حفظ بيانات المُشتكي!
              </div>';
        exit;
    }
}
 

			

            // Ici on ajoute le chemin du fichier dans la colonne `chemin`
            $chemin =  $destination;

            $req2 = "INSERT INTO reclamation 
                (numR, date, sujet, source, defendeur, region, numEnvois, dateEnvois, reclamant, chemin)
                VALUES 
                ('$numR', '$date', '$sujet', '$src', '$def', '$region', '$numE', '$dateE', '$reclamant_id', '$chemin')";

            $res2 = mysqli_query($con, $req2);

            if ($res && $res2) {
                echo '<div style="padding:15px; background-color:#d4edda; color:#155724; border-radius:4px; margin-bottom:20px;">
                        تم حفظ الشكوى بنجاح !
                      </div>';
                echo '<meta http-equiv="refresh" content="2;url=reclamations.php">';
            } else {
                echo '<div style="padding:15px; background-color:rgb(240,214,206); color:rgb(236,46,46); border-radius:4px; margin-bottom:20px;">
                        هناك خطأ في الحفظ!
                      </div>';
            }
        } else {
            echo '<div style="padding:15px; background-color:rgb(240,214,206); color:rgb(236,46,46); border-radius:4px; margin-bottom:20px;">
                    خطأ في رفع الملف!
                  </div>';
        }
       
    }
}

        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
			<div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="numReclamation" class="required">رقم مكتب الضبط الاقليمي</label>
                        <input type="text" id="numReclamation" name="numReclamation" placeholder="9874" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="dateReclamation" >تاريخ الشكاية</label>
                        <input type="date" id="dateReclamation" name="dateReclamation" >
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="reclamant" >المشتكي</label>
                        <input type="text" id="reclamant" name="reclamant" >
                    </div>
                </div>
				<div class="col">
                    <div class="form-group">
                        <label for="cin" >رقم البطاقة الوطنية</label>
                        <input type="text" id="cin" name="cin">
                    </div>
                </div>
				 <div class="col">
                    <div class="form-group">
                        <label for="telephone" >الهاتف</label>
						
                        <input type="tel" id="telephone" name="telephone" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="adresse">العنوان</label>
                <input type="text" id="adresse" name="adresse" >
            </div>
			<div class="form-group">
                <label for="defendeur">المشتكى به</label>
                <input type="text" id="defendeur" name="defendeur" >
            </div>
			 <div class="form-group">
                <label for="sujet">موضوع الشكاية </label>
				<textarea id="sujet" name="sujet"  ></textarea>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="source" >مصدر الشكاية</label>
                        <input type="text" id="source" name="source" >
                    </div>
                </div>
                <div class="col">
				<div class="form-group">
				<label for="region" class="required">الجهة المحالة إليها الشكاية</label>
					<select id="region" name="region"  required >
					<option value="" disabled selected >الدائرة/القيادة</option>
					
					<?php 
					$req = "SELECT id, CONCAT(nomCercle, ' / ', nomCaidat) AS nom_complet FROM caidat";
					$res = mysqli_query($con, $req);	
					while ($row = mysqli_fetch_assoc($res)) {
						echo "<option value='{$row['nom_complet']}' >{$row['nom_complet']}</option>";
						}
							?>
					</select>
					</div>
					</div>

            </div>
			 <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="numEnvois">رقم الارسال</label>
                        <input type="text" id="numEnvois" name="numEnvois" placeholder="452156" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="nomReclamant" >تاريخ الارسال</label>
                      <input type="date" id="dateEnvois" name="dateEnvois" >
                    </div>
                </div>
            </div>	
			<input type="file" name="document">
			
            <div class="buttons">
			    <button type="submit" class="btn-submit">تأكيد الشكوى</button>
                <button type="reset" class="btn-reset" >إعادة الضبط</button>
               
            </div>
        </form>
    </div>
</body>
</html>
