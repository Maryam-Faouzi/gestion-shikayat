<!DOCTYPE html>
<html lang="ar" dir="rtl">
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
            padding: 0;
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
        .table thead th {
            background: #e3f2fd;
            color: #153566;
            font-weight: bold;
            vertical-align: middle;
            text-align: center;
        }
        .table tbody td {
            text-align: center;
        }
        .container {
            padding: 100px 20px 20px; /* espace pour la barre fixe */
        }
		
       
    </style>
</head>
<body>

<header class="topbar">
  <h3>
    <img src="./cssTBord/R.png" alt="Logo" style="height:40px; vertical-align: middle; margin-left: 10px;">
    منصة إدارة الشكاوي
  </h3>
  <nav>
    <a href="nouveau.php"><i class="fas fa-home"></i> الرئيسية</a>
    <a href="reclamations.php"><i class="fas fa-file-alt"></i> الشكايات</a>
    <a href="reponses.php"><i class="fas fa-comments"></i> الردود</a>
    <a href="rappel.php" class="active"><i class="fas fa-bell"></i> التذكيرات</a>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> خروج</a>
  </nav>
</header>

<div class="container">
<?php
$con = mysqli_connect("localhost", "root", "", "reclamation");
if (!$con) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $numR = $_GET['id'];
    $req = "SELECT numR, reclamant.reclamant, numRapp, dateRapp 
            FROM rappel
            JOIN reclamation ON numR = rappel.numReclamation
            JOIN reclamant ON reclamation.reclamant = reclamant.id
            WHERE numR = '$numR'";
    $res = mysqli_query($con, $req);

    if ($res && mysqli_num_rows($res) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead><tr>
                <th>رقم الشكاية</th>
                <th>المشتكي</th>
                <th>رقم التذكير</th>
                <th>تاريخ التذكير</th>
              </tr></thead><tbody>';
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>" . $row['numR'] . "</td>";
            echo "<td>" . $row['reclamant'] . "</td>";
            echo "<td>" . $row['numRapp'] . "</td>";
            echo "<td>" . $row['dateRapp'] . "</td>";
            echo "</tr>";
        }
        echo '</tbody></table>';
    } else {
        echo "<div class='alert alert-info text-center'>لا توجد تذكيرات لهذه الشكاية.</div>";
    }
}
?>
</div>
<script src="./cssTBord/bootstrap.bundle.min.js"></script>
<script src="./cssTBord/all.min.js"></script>
</body>
</html>
