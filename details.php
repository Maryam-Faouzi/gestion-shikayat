<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
  <style>
    * {
      box-sizing: border-box;
      font-family:  Arial, sans-serif;
    }
    body {
      background-color: #f6f8fa;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #286090;
      margin-bottom: 30px;
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
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }
    textarea {
      min-height: 100px;
      resize: vertical;
    }
    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .col {
      flex: 1;
      min-width: 280px;
    }
    .buttons {
      text-align: center;
      margin-top: 30px;
    }
    button {
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-left: 10px;
    }
    .btn-submit, .btn-reset , .btn-link{
      background-color: #286090;
      color: white;
    }
    .btn-submit:hover, .btn-reset:hover ,.btn-link:hover {
      background-color: #337ab7;
    }
    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
      }
    }
	.btn-link {
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-family: 'Arial', sans-serif;
    transition: background-color 0.3s ease;
    direction: rtl;
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

<div class="container">
  <h1>تفاصيل الشكاية</h1>
   <button class="exit-button" id="exitBtn1" onclick="exitApplication()" title="Fermer">×</button>
<script>
  function exitApplication() {
            window.history.back();
        }
        </script>
  <form method="POST" action="reclamations.php">
    <?php
		$con=mysqli_connect("localhost","root","","reclamation");
		if (!$con) {
		die("Échec de la connexion : " . mysqli_connect_error());
					}
		if(isset($_GET['id']) && !empty($_GET['id']) ){
		$numR=$_GET['id'];
		$req="select * from reclamation , reclamant where id=reclamation.reclamant and numR='$numR' ";	
		$res=mysqli_query($con,$req);
		if($res){
		$data = mysqli_fetch_assoc($res);
					}
		
		}
		
	?>
    <div class="form-row">
      <div class="col">
        <div class="form-group">
          <label for="numReclamation" class="required">رقم مكتب الضبط الإقليمي</label>
          <input type="text" id="numReclamation" name="numReclamation" value="<?= $data['numR'] ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="dateReclamation" class="required">تاريخ الشكاية</label>
          <input type="text" id="dateReclamation" name="dateReclamation" value="<?= $data['date'] ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="reclamant" class="required">اسم المشتكي</label>
          <input type="text" id="reclamant" name="reclamant" value="<?= $data['reclamant'] ?>">
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col">
        <div class="form-group">
          <label for="cin">رقم البطاقة الوطنية</label>
          <input type="text" id="cin" name="cin" value="<?= $data['CIN'] ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="telephone">رقم الهاتف</label>
          <input type="tel" id="telephone" name="telephone" value="<?= $data['tel'] ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="adresse">العنوان</label>
          <input type="text" id="adresse" name="adresse" value="<?= $data['Adresse'] ?>">
        </div>
      </div>
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
          <label for="region" class="required">الجهة المحالة إليها الشكاية</label>
          <input type="text" id="region" name="region" value="<?= $data['region'] ?>">
        </div>
      </div>
    </div>
<div class="form-group">
          <label for="sujet">موضوع الشكاية</label>
          <textarea id="sujet" name="sujet"><?= $data['sujet'] ?></textarea>
        </div>
    <div class="form-row">
      <div class="col">
        <div class="form-group">
          <label for="numEnvois" class="required">رقم الإرسال</label>
          <input type="text" id="numEnvois" name="numEnvois" value="<?= $data['numEnvois'] ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="dateEnvois" class="required">تاريخ الإرسال</label>
          <input type="text" id="dateEnvois" name="dateEnvois" value="<?= $data['dateEnvois'] ?>">
        </div>
      </div>
    </div>
	
<a href='voir_fichier.php?id=<?= $data['numR'] ?>' target='_blank'  class="btn-link">عرض الشكاية</a>


    <div class="buttons">
      <button type="submit" class="btn-reset">الرجوع</button>
    </div>

  </form>
</div>

</body>
</html>
