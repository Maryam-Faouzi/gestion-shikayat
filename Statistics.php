<!DOCTYPE html>
<html lang="ar" dir="rtl">
<?php include_once "fonctions.php"; ?>
<head>
  <meta charset="UTF-8">
  <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
  <link href="./cssTBord/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="./cssTBord/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding-top: 80px; /* espace pour la topbar */
      background-color: #f4f6f9;
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

    .main-menu-title {
      font-size: 32px;
      color: #0d47a1;
      background-color: #e3f2fd;
      padding: 15px;
      margin: 20px auto;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      font-weight: bold;
    }

    .card {
      margin: 15px;
    }

    .card h4 {
      font-size: 24px;
      color: #0d47a1;
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
		
  </style>
</head>
<body>

<header class="topbar">
  <h3><img src="./cssTBord/R.png" alt="Logo" style="height:40px; vertical-align: middle; margin-left: 10px;"> منصة إدارة الشكاوي</h3>
  <nav>
    <a href="nouveau.php" ><i class="fas fa-home"></i> الرئيسية</a>
    <a href="reclamations.php"><i class="fas fa-file-alt"></i> الشكايات</a>
    <a href="reponses.php"><i class="fas fa-comments"></i> الردود</a>
    <a href="rappel.php"><i class="fas fa-bell"></i> التذكيرات</a>
	<a href="Statistics.php" class="active"><i class="fas fa-chart-bar"></i> الاحصائيات</a>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
  </nav>
</header>

<div class="container-fluid">
  <h2 class="text-center main-menu-title">الاحصائيات</h2>
  <div class="row text-center justify-content-center">
  
    <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-striped">
                        <thead>
                          
                            <tr>
                            <th>الجهة المعنية</th>
                            <th>عدد الشكايات</th>
                           
                           </Tr>
                        
                        </thead>
  <tbody>
                          <?php
                        
						
							

$sql = "SELECT region, COUNT(*) AS 'nombre de réclamations'
        FROM reclamation
        WHERE region IN (
            SELECT CONCAT(nomCercle, ' / ', nomCaidat) FROM caidat
        )
        GROUP BY region
        ORDER BY region DESC";
		
$result = $con->query($sql);


// Vérifie s’il y a des résultats

    

    while ($row = $result->fetch_assoc()) {
							
							 
                          ?>
						  <tr>
						     <td  >  <?php echo $row['region']; ?></td>
							 <td > <?php echo $row['nombre de réclamations']; ?> </td>
							 </tr>
	<?php } ?>
                        </tbody>
                    </table>
						
   
      </div>
    </div>
  </div>

<!-- Scripts -->
<script src="./cssTBord/bootstrap.bundle.min.js"></script>
<script src="./cssTBord/all.min.js"></script>
</body>
</html>
