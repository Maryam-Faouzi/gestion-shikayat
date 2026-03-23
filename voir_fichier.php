
<?php
// Connexion à la base
$con = mysqli_connect("localhost", "root", "", "reclamation");

$id = $_GET['id'];
$req = "SELECT chemin FROM reclamation WHERE numR = $id";
$res = mysqli_query($con, $req);
$row = mysqli_fetch_assoc($res);

$fichier = $row['chemin'];

if (file_exists($fichier)) {
    $extension = pathinfo($fichier, PATHINFO_EXTENSION);

    // Type MIME selon l’extension
    $mimeTypes = [
        'pdf' => 'application/pdf',
        'jpg' => 'image/jpeg',
        'jpeg'=> 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];

    $type = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';

    header("Content-Type: $type");
    header("Content-Disposition: inline; filename=\"" . basename($fichier) . "\"");
    readfile($fichier);
    exit;
}else {
    echo '<div style="padding:15px; background-color:#f8d7da; color:#721c24; border-radius:4px; margin-bottom:20px;">
             الشكاية غير موجودة !
          </div>';
    echo '<meta http-equiv="refresh" content="2;url=reclamations.php">';
}

?>
