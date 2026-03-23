
    <?php
		$con=mysqli_connect("localhost","root","","reclamation");
        if (!$con) {
        die("Échec de la connexion : " . mysqli_connect_error());
                }
				
		if (isset($_GET['id'])) {
		$numR = $_GET['id'];
		// Récupération des données depuis la base
		$query = "select * from reclamation,reclamant where  id=reclamation.reclamant and numR='$numR'";
		$res = mysqli_query($con, $query);
		$data = mysqli_fetch_assoc($res);
		}


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $numR = $_POST['numReclamation'];
            $date = $_POST['dateReclamation'];
            $nom = $_POST['nomReclamant'];
            $cin = $_POST['cin'];
            $tel = $_POST['telephone'];
            $adresse = $_POST['adresse'];
            $sujet = $_POST['sujet'];
            $src = $_POST['source'];
            $region = $_POST['region'];
            $numE = $_POST['numEnvois'];
            $dateE = $_POST['dateEnvois'];
			$etat=$_POST['etat'];
            $def= $_POST['defendeur'];
			    
				
				$req2 = "UPDATE reclamation SET numR='$numR',date='$date',sujet='$sujet', source='$src',defendeur='$def', region='$region',numEnvois='$numE',dateEnvois='$dateE',etatRec='$etat'
				WHERE numR='$numR'";
				$res=mysqli_query($con, $req2);
                $req1 = "UPDATE reclamant SET  CIN='$cin',Adresse='$adresse', tel='$tel',reclamant='$nom' WHERE id = (SELECT reclamant FROM reclamation WHERE numR='$numR')";
				$res2=mysqli_query($con, $req1);

            // Affichage d'un message de confirmation
            if($res && $res2){
				 header("Location: reclamations.php");
				 exit();
            }else{
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
   <!-- <link href="./cssTBord/static" rel="stylesheet">-->
	
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
		.select-etat-simple {
			 width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
			}
			
select#region ,#etat {
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
        <h1>تعديل شكاية</h1>
     

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          
			<div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="numReclamation" class="required">رقم مكتب الضبط الاقليمي</label>
                        <input type="text" id="numReclamation" name="numReclamation" value="<?= $data['numR'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="dateReclamation" class="required">تاريخ الشكاية</label>
                        <input type="date" id="dateReclamation" name="dateReclamation" value="<?= $data['date'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="nomReclamant" class="required">اسم المشتكي</label>
                        <input type="text" id="nomReclamant" name="nomReclamant" value="<?=  $data['reclamant'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="cin" >رقم البطاقة الوطنية</label>
                        <input type="text" id="cin" name="cin" value="<?= $data['CIN'] ?>" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="telephone" >الهاتف</label>
						
                        <input type="tel" id="telephone" name="telephone" value="<?= $data['tel'] ?>" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="adresse">العنوان</label>
                <input type="text" id="adresse" name="adresse" value="<?= $data['Adresse'] ?>">
            </div>
			<div class="form-group">
                <label for="defendeur">المشتكى به</label>
                <input type="text" id="defendeur" name="defendeur" value="<?= $data['defendeur'] ?>" >
            </div>
			 <div class="form-group">
                <label for="sujet">موضوع الشكاية </label>
                <input type="text" id="sujet" name="sujet"value="<?= $data['sujet'] ?>">
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="source" class="required">مصدر الشكاية</label>
                        <input type="text" id="source" name="source" value="<?= $data['source'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="region" class="required" >الجهة المحالة اليها الشكاية</label>
                    <select id="region" name="region" >
					<option disabled selected><?= $data['region'] ?></option>
					<?php 
					$req = "SELECT id, CONCAT(nomCercle, ' / ', nomCaidat) AS nom_complet FROM caidat";
					$res = mysqli_query($con, $req);	
					while ($row = mysqli_fetch_assoc($res)) {
						echo "<option value='{$row['nom_complet']}' >{$row['nom_complet']}</option>";
						}
							?>
					</select>                    </div>
                </div>
            </div>
			 <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="numEnvois" class="required">رقم الارسال</label>
                        <input type="text" id="numEnvois" name="numEnvois" value="<?= $data['numEnvois'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="dateEnvois" class="required">تاريخ الارسال</label>
                      <input type="date" id="dateEnvois" name="dateEnvois" value="<?= $data['dateEnvois'] ?>">
                    </div>
                </div>



				  <div class="col">
                  <div class="form-group">
			<label for="etat">حالة الشكاية</label>
			<select id="etat" name="etat"  class="select-etat-simple"  class="required" >
            <option disabled selected><?= $data['etatRec'] ?></option>
			<option value="قيد المعالجة" <?= ($data['etatRec'] == 'قيد المعالجة') ? 'selected' : '' ?>>قيد المعالجة</option>
			<option value="معالجة" <?= ($data['etatRec'] == 'معالجة') ? 'selected' : '' ?>>معالجة</option>
			<option value="مؤرشفة" <?= ($data['etatRec'] == 'مؤرشفة') ? 'selected' : '' ?>>مؤرشفة</option>
			<option value="مرفوضة" <?= ($data['etatRec'] == 'مرفوضة') ? 'selected' : '' ?>>مرفوضة</option>
			</select>
				</div>

                </div>
            </div>

          
            <div class="buttons">
			    <button type="submit" class="btn-submit">تأكيد </button>
                <button type="reset" class="btn-reset">إعادة الضبط</button>

            </div>
        </form>
    </div>
</body>
</html>
