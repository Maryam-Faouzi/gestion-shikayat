 <!DOCTYPE html>
<html lang="ar" dir="rtl">
<?php include_once "fonctions.php"; ?>
<head>
  <meta charset="UTF-8">
  <title>منصة إدارة الشكايات</title>
    <link rel="icon" type="image/png" href="cssTBord/R.png">
  <link href="./cssTBord/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="./cssTBord/all.min.css" rel="stylesheet">
  <script src="./cssTBord/js/chart.umd.min.js"></script>
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
      padding: 20px;
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

    .card p {
      font-size: 30px;
      font-weight: bold;
    }
	.paragraphe{
		 color:red;
	}
  </style>
  </head>
<body>
<header class="topbar">
  <h3><img src="./cssTBord/R.png" alt="Logo" style="height:40px; vertical-align: middle; margin-left: 10px;"> منصة إدارة الشكاوي</h3>
  <nav>
    <a href="nouveau.php" class="active"><i class="fas fa-home"></i> الرئيسية</a>
    <a href="reclamations.php"><i class="fas fa-file-alt"></i> الشكايات</a>
    <a href="reponses.php"><i class="fas fa-comments"></i> الردود</a>
    <a href="rappel.php"><i class="fas fa-bell"></i> التذكيرات</a>
	<a href="Statistics.php"><i class="fas fa-chart-bar"></i>  الاحصائيات</a>
	
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
  </nav>
</header>

<div class="container-fluid">
  <h2 class="text-center main-menu-title">القائمة الرئيسية</h2>
  <div class="row text-center justify-content-center">
    <div class="col-md-4">
      <div class="card p-3">
        <h4><i class="fas fa-file-alt"></i> الشكاوي</h4>
        <p><?php echo statiReclamation();?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h4><i class="fas fa-comments"></i> الردود</h4>
        <p> <?php echo statiReponse();?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h4><i class="fas fa-bell"></i> التذكيرات</h4>
        <p><?php echo statiRappel(); ?></p>
      </div>
    </div>
  </div>
</div>
<!-- ===== DASHBOARD GRAPHES ===== -->
<!-- ===== DASHBOARD GRAPHES ===== -->
<div class="container-fluid mt-4">
  <h4 class="text-center mb-4" style="color:#0d47a1; font-weight:bold;">لوحة الإحصائيات</h4>
  <div class="row justify-content-center">

    <!-- Graphe en barres -->
    <div class="col-md-5">
      <div class="card p-3 shadow-sm">
        <h6 class="text-center" style="color:#0d47a1;">مقارنة الشكاوي / الردود / التذكيرات</h6>
        <div style="height:300px;">
          <canvas id="barChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Graphe en donut -->
    <div class="col-md-5">
      <div class="card p-3 shadow-sm">
        <h6 class="text-center" style="color:#0d47a1;">التوزيع النسبي</h6>
        <div style="height:300px;">
          <canvas id="donutChart"></canvas>
        </div>
      </div>
    </div>

  </div>
</div>
<script>
  // Récupérer les valeurs depuis PHP
  const reclamations = <?php echo (int)statiReclamation(); ?>;
  const reponses     = <?php echo (int)statiReponse(); ?>;
  const rappels      = <?php echo (int)statiRappel(); ?>;

  // ---- Graphe en barres ----
  new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: ['الشكاوي', 'الردود', 'التذكيرات'],
      datasets: [{
        label: 'العدد',
        data: [reclamations, reponses, rappels],
        backgroundColor: ['#1565c0', '#42a5f5', '#bbdefb'],
        borderRadius: 8,
      }]
    },
    options: {
      responsive: true,
        maintainAspectRatio: false,  // ← ajoute cette ligne
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
  });

  // ---- Graphe Donut ----
  new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
      labels: ['الشكاوي', 'الردود', 'التذكيرات'],
      datasets: [{
        data: [reclamations, reponses, rappels],
        backgroundColor: ['#1565c0', '#42a5f5', '#bbdefb'],
        borderWidth: 2
      }]
    },
   options: {
  responsive: true,
  maintainAspectRatio: false,  // ← ajoute cette ligne
  plugins: {
    legend: { position: 'bottom', labels: { font: { size: 14 } } }
  }
}
  });

</script>
<!-- ===== FIN DASHBOARD ===== -->



<!-- Scripts -->
<script src="./cssTBord/bootstrap.bundle.min.js"></script>
<script src="./cssTBord/all.min.js"></script>
</body>
</html>
