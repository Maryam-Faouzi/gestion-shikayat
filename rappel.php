<!DOCTYPE html>
<html lang="ar" dir="rtl">
<?php  include_once "fonctions.php" ;
if (isset($_GET['id'])) {
	$numR=$_GET['id'];
	$req="delete from rappel where numRapp='$numR'";
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
            width: auto;
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
		
		
        .btn-action {
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
        .btn-action:hover {
          color: #0d47a1;
          text-decoration: underline;
        }
        .btn-ajout:hover {
    background-color: #204d74;
    color: #fff;
    text-decoration: none;
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
    </style>
</head>
<header class="topbar">
  <h3><img src="./cssTBord/R.png" alt="Logo" style="height:40px; vertical-align: middle; margin-left: 10px;"> منصة إدارة الشكاوي</h3>
  <nav>
    <a href="nouveau.php"><i class="fas fa-home"></i> الرئيسية</a>
    <a href="reclamations.php" ><i class="fas fa-file-alt"></i> الشكايات</a>
    <a href="reponses.php"  ><i class="fas fa-comments"></i> الردود</a>
    <a href="rappel.php"class="active"><i class="fas fa-bell"></i> التذكيرات</a>
	<a href="Statistics.php"><i class="fas fa-chart-bar"></i>  الاحصائيات</a>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
  </nav>
</header>
<body>
       
	   
	   
	     
	      
	   
            <div class="main-menu-title">لائحة التذكيرات</div>

    <form class="filter-bar mb-3" method="GET" style="gap: 18px;">
    <div class="form-group mb-0">
        <div class="custom-select">
            <select id="numR" name="numR" onchange="this.form.submit()" >
                <option value="" selected disabled>الشكاية</option>
                <?php 
                $req="select distinct numR  from reclamation";
				$res=mysqli_query($con,$req);
				if($res){
					 foreach($res as $row){
                    echo "<option value=".$row['numR'].">".$row['numR']."</option>";
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
            style="padding-right: 38px; font-weight: bold; color: #0f4c81; border: 2px solid #0f4c81; border-radius: 6px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); font-size: 16px; height: 44px; width: 100%;"
        >
        <span style="position:absolute; right:12px; top:10px; color:#0f4c81; font-size:18px; pointer-events:none;">
            <i class="fas fa-search"></i>
        </span>
    </div>
    <!-- Bouton ajouter -->
    <div class="form-group mb-0 d-flex align-items-center" style="margin-right:auto; min-width:180px;">
        <a href="ajoutRappel.php" class="btn btn-ajout"
           style="background-color: #286090; color: #fff; font-weight: bold; border-radius: 7px; padding: 10px 26px; font-size: 1.05rem; box-shadow: 0 2px 8px rgba(40,96,144,0.06); border:none; transition: background 0.2s; white-space: nowrap;">
           <i class="fas fa-plus-circle" style="margin-left:6px;"></i> إضافة تذكير
        </a>
    </div>
  
	</form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-striped">
                        <thead>
                          <tr>                   
						<th>رقم الشكاية</th>
						<th>اسم المشتكي</th>
						<th> التذكير عدد</th>
						<th>تاريخ التذكير</th>
                            <th>مسح</th>
                            <th>تعديل</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
						if(isset ($_GET['numR']) && !empty($_GET['numR']) ){
						$numR=$_GET['numR'];
						$req="select  numR , reclamant.reclamant,numRapp ,dateRapp from rappel,reclamation,reclamant where numR=rappel.NumReclamation and id=reclamation.reclamant and numR='$numR'";
						$res=mysqli_query($con,$req);
						}elseif (isset($_GET['reclamant']) && !empty($_GET['reclamant'])){
							$reclamant = $_GET['reclamant'];	
                          	$res=listerRappel($reclamant);
						   }else{
						$reclamant="";
						$res=listerRappel($reclamant);
						   }
							if($res){
                              foreach ($res as $row) {
                              echo "<tr>";
                              echo "<td>".$row['numR']."</td>";
                              echo "<td>".$row['reclamant']."</td>";
                              echo "<td>".$row['numRapp']."</td>";
                              echo "<td>".$row['dateRapp']."</td>";
                              echo "<td><a href='rappel.php?id=".$row['numRapp']."' class='btn-action delete' title='حذف' onclick=\"return confirm('هل أنت متأكد أنك تريد حذف هذه التذكير؟');\">
							<i class='fas fa-trash-alt'></i>
							</a></td>";
                              echo "<td><a href='modifRappel.php?id=".$row['numRapp']."' class='btn-action' title='تعديل'><i class='fas fa-pen'></i></a></td>";
                              echo "</tr>";
								}}
                          ?>
                        </tbody>
                    </table>
                </div>
<script src="./cssTBord/bootstrap.bundle.min.js"></script>
<script src="./cssTBord/all.min.js"></script>
</body>
</html>