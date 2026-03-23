<!DOCTYPE html>
<html lang="ar" dir="rtl">
<?php  include_once "fonctions.php" ;

if (isset($_GET['id'])) {
	$idReclamation=$_GET['id'];
	$req="delete from reclamation where numR='$idReclamation'";
	mysqli_query($con,$req);

}



?>
<head>
    <meta charset="UTF-8">
    <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
    <link href="./cssTBord/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="./cssTBord/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #eef3fa;
            margin: 0;
            padding-top: 40px;
        }
        
      .main-menu-title {
      font-size: 32px;
      color: #0d47a1;
      background-color: #e3f2fd;
      padding: 15px;
      margin: 70px auto;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      font-weight: bold;
    }


        .filter-bar {
            background: #f1f5fa;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 25px;
            display: flex;
            gap: 18px;
            align-items: center;
            justify-content: flex-start;
        }
        @media(max-width:600px){
          .filter-bar{flex-direction:column;align-items:stretch}
        }
        /* Nouveau style pour les listes déroulantes */
        .custom-select {
            position: relative;
            width: auto;
        }
        .custom-select select {
            font-weight: bold;
            width: 250px;
            padding: 12px 20px;
            font-size: 16px;
            color: #0f4c81;
            background-color: #fff;
            border: 2px solid #0f4c81;
            border-radius: 6px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease-in-out;
        }
        .custom-select select:focus {
            outline: none;
            border-color: #1c6dd0;
            box-shadow: 0 0 8px rgba(28, 109, 208, 0.21);
        }

        .table thead th {
            background: #e3f2fd;
            color: #153566;
            font-weight: bold;
            vertical-align: middle;
            border-bottom: 2.5px solid #dee2e6;
			 text-align: center;
        }
		
		 .table tbody td {
         text-align: center;
        }
		
		
        .btn-action , .btn-outline-secondary {
            border: none;
            background: none;
            color: #1976d2;
            font-size: 1.25rem;
            padding: 6px 10px;
            transition: color 0.2s;
        }
        .btn-action.delete {
          color: #e74c3c;
        }
		.btn-outline-secondary{
			color : #497095;
		}
        .btn-action:hover , .btn-outline-secondary:hover {
          color: #0d47a1;
          text-decoration: underline;
        }
        .btn-ajout:hover {
    background-color: #204d74;
    color: #fff;
    text-decoration: none;
}
.topbar {
      position: fixed;
      top: 0;
      right: 0;
      left: 0;
      height: 70px;
      background-color: #0d47a1;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      z-index: 1000;
    }

    .topbar h3 {
      margin: 0;
      font-size: 1.5rem;
    }

    .topbar nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }

    .topbar nav a:hover,
    .topbar nav a.active {
      color: #bbdefb;
    }

    .logout {
      color: white;
      font-size: 1.2rem;
      text-decoration: none;
      font-weight: bold;
    }

    .logout:hover {
      color: #ffcccb;
    }
   .form-group{
	 width: 100%;
	
  }
    </style>
</head>
<body>
<header class="topbar">
  <h3><img src="./cssTBord/R.png" alt="Logo" style="height:40px; vertical-align: middle; margin-left: 10px;"> منصة إدارة الشكاوي</h3>
  <nav>
    <a href="nouveau.php"><i class="fas fa-home"></i> الرئيسية</a>
    <a href="reclamations.php"  class="active"><i class="fas fa-file-alt"></i> الشكايات</a>
    <a href="reponses.php"><i class="fas fa-comments"></i> الردود</a>
    <a href="rappel.php"><i class="fas fa-bell"></i> التذكيرات</a>
	<a href="Statistics.php"><i class="fas fa-chart-bar"></i> الاحصائيات</a>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
  </nav>
</header>
            <div class="main-menu-title">لائحة الشكايات</div>
                <!-- FILTRE BAR AVEC 2 LISTBOX -->
                <form class="filter-bar mb-3" method="GET" style="gap: 18px;">
    <!-- Select cercle -->

    <div class="form-group mb-0">
        <div class="custom-select">
            <select id="cercle" name="cercle" onchange="this.form.submit()">
                <option value="" disabled <?= !isset($_GET['cercle']) ? 'selected' : '' ?>>الدوائر</option>
                <?php 
                $res = cercle(); // Cette fonction doit retourner les cercles (numCercle, nomCercle)
                foreach ($res as $row) {
                    $selected = (isset($_GET['cercle']) && $_GET['cercle'] == $row['numCercle']) ? 'selected' : '';
                    echo "<option value='{$row['numCercle']}' $selected>{$row['nomCercle']}</option>";
                }
                ?>
            </select>

            <!-- Select Caïdat -->
            <select id="caidat" name="caidat" onchange="this.form.submit()">
                <option value="" disabled <?= !isset($_GET['caidat']) ? 'selected' : '' ?>>القيادات</option>
                <?php 
                if (isset($_GET['cercle'])) {
                    $cercle = $_GET['cercle'];
                    $caidats = caidat($cercle); // Cette fonction prend un cercle et retourne les caïدات
                    foreach ($caidats as $row) {
                        $selected = (isset($_GET['caidat']) && $_GET['caidat'] == $row['id']) ? 'selected' : '';
                        echo "<option value='{$row['id']}' $selected>{$row['nomCaidat']}</option>";
                    }
                }
				
					

				
                ?>
            </select>
        </div>
    </div>
    <!-- Input recherche المشتكي -->
    <div class="form-group mb-0" style="position:relative; min-width:220px;">
        <input 
            type="text" name="reclamant" id="reclamant" class="search-input"
            placeholder="بحث عن المشتكي..." 
            style="padding-right: 38px; font-weight: bold; color: #0f4c81; border: 2px solid #0f4c81; border-radius: 6px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); font-size: 16px; height: 44px; width: auto;"
        >
        <span style="position:absolute; right:12px; top:10px; color:#0f4c81; font-size:18px; pointer-events:none;">
            <i class="fas fa-search"></i>
        </span>

    </div>
    <!-- Bouton ajouter -->
        <a href="ajoutReclamation.php" class="btn btn-ajout"
           style="background-color: #286090; color: #fff; font-weight: bold; border-radius: 7px; padding: 10px 26px; font-size: 1.05rem; box-shadow: 0 2px 8px rgba(40,96,144,0.06); border:none; transition: background 0.2s; white-space: nowrap;">
           <i class="fas fa-plus-circle" style="margin-left:6px;"></i> إضافة شكاية
        </a>

</form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>رقم مكتب الضبط</th>
                            <th>المشتكي</th>
                            <th>الجهة المحالة اليها الشكاية</th>
                            <th>تاريخ الشكاية</th>
                            <th>رقم الارسال</th>
                            <th>تاريخ الارسال</th>
                            <th>حالة الشكاية</th>
                            <th>تفاصيل</th>
                            <th>مسح</th>
                            <th>تعديل</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
						  
						  // code ajouterer 
						  $limit = 5; // nombre de lignes par page
                         $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
                         $offset = ($page - 1) * $limit;
						 // Fin code
						 
              $res = listerReclamations($limit, $offset); // Définis le traitement du paramètre dans la fonction
						$total_result = mysqli_query($con, "SELECT COUNT(*) AS total FROM reclamation");
                        $total_row = mysqli_fetch_assoc($total_result);
                       $total_records = $total_row['total'];
                      $total_pages = ceil($total_records / $limit);

						if(isset ($_GET['cercle']) && isset($_GET['caidat'] ) && !empty($_GET['cercle']) && !empty($_GET['caidat']) ){
						$idC=$_GET['cercle'];
						$id=$_GET['caidat'];
						$req="select concat(nomCercle,' / ',nomCaidat) as region  from caidat where idCercle='$idC' and id='$id'";
						$resReg=mysqli_query($con,$req);				
						 if ($resReg && mysqli_num_rows($resReg) > 0) {
						$reg = mysqli_fetch_assoc($resReg);
						$region = $reg['region']; 
						$res=listerRecherche($region);
						} else {
						return false;
							}

						
						
					}elseif(isset($_GET['reclamant'] ) && !empty($_GET['reclamant'])){
						$reclamant=$_GET['reclamant'];
						$res=reclamant($reclamant);						
					}else{
						$res = listerReclamations($limit, $offset);
					}
							if($res){
							foreach ($res as $row) {
                            echo "<tr>";
							$numR = $row['numR'];
							$checkRappel = mysqli_query($con, "SELECT 1 FROM rappel WHERE numReclamation = '$numR' LIMIT 1");
							if($checkRappel && mysqli_num_rows($checkRappel) > 0){
                              echo "<td><a href='detailRappel.php?id=".$row['numR']."'><i class='fas fa-bell' style='color:#a51305'></i> </td>";
							}else{
								echo "<td></td>";
							}
                              echo "<td>".$row['numR']."</td>";
                              echo "<td>".$row['reclamant']."</td>";
                              echo "<td>".$row['region']."</td>";
                              echo "<td>".$row['date']."</td>";
                              echo "<td>".$row['numEnvois']."</td>";
                              echo "<td>".$row['dateEnvois']."</td>";
							  if($row['etatRec'] == 'قيد المعالجة'){
								  echo "<td style='color: #1976d2; font-weight: bold' ><a href='ajoutReponse.php?id=".$row['numR']."' style='text-decoration: none; color: inherit;'>".$row['etatRec']."</a></td>";
							  }elseif($row['etatRec'] =='معالجة'){
							echo "<td style='color: green; font-weight: bold'>
							<a href='detailsReponse.php?id=".$row['numR']."' style='text-decoration: none; color: inherit;'>".$row['etatRec']."</a></td>";
							  }
							  else{
								 echo   "<td style='color: red; font-weight: bold' >".$row['etatRec']."</td>";
							  }
							echo "<td><a href='details.php?id=". $row['numR'] . "' class='btn-outline-secondary' title='تفاصيل'><i class='fas fa-info-circle'></i></a></td>";
                             echo "<td>
							<a href='reclamations.php?id=".$row['numR']."' class='btn-action delete' title='حذف' onclick=\"return confirm('هل أنت متأكد أنك تريد حذف هذه الشكوى؟');\">
							<i class='fas fa-trash-alt'></i>
							</a>
								</td>";
                              echo "<td><a href='modifReclamation.php?id=".$row['numR']."' class='btn-action' title='تعديل'><i class='fas fa-pen'></i></a></td>";
                              echo "</tr>";
							}}
                          ?>
                        </tbody>
                    </table>
		 </div>
		 
		 
		 
		 <!-- code Ajouter -->
		 <?php
		 
		 $total_result = mysqli_query($con, "SELECT COUNT(*) AS total FROM reclamation");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

?>



<!-- Pagination -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center mt-4">
    <!-- Bouton Précédent -->
    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1">السابق</a>
    </li>

    <!-- Numéros de page -->
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>

    <!-- Bouton Suivant -->
    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page + 1 ?>">التالي</a>
    </li>
  </ul>
</nav>
<!-- Fin code -->


<script src="./cssTBord/bootstrap.bundle.min.js"></script>
<script src="./cssTBord/all.min.js"></script>

</body>
</html>