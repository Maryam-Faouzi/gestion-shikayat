<?php
$con=mysqli_connect("localhost","root","","reclamation");
if (!$con) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

function statiReclamation(){
	 global $con;
	$req="select count(numR) as total from reclamation";
	$res = mysqli_query($con, $req);
	$row=mysqli_fetch_assoc($res);
	return $row['total']; 
	
}
function SansReponse() {
	 global $con;
	$req="SELECT count(*) as total FROM reclamation WHERE numR not in (select NumReclamation from reponse)";
	$res = mysqli_query($con, $req);
	$row=mysqli_fetch_assoc($res);
	return $row['total']; 
}

function statiRappel(){
	global $con;
	$req="select count(numRapp) as total from rappel,reclamation where numR = NumReclamation ";
	$res = mysqli_query($con, $req);
	$row=mysqli_fetch_assoc($res);
	return $row['total']; 
	
}

function statiReponse(){
	global $con;
	$req="select count(numRep) as total from reponse,reclamation where numR = NumReclamation ";
	$res = mysqli_query($con, $req);
	$row=mysqli_fetch_assoc($res);
	return $row['total']; 
	
	
}

function listerReclamation(){
	global $con;
	$req = "select numR ,reclamant.reclamant AS nom_reclamant,CIN,tel,adresse,sujet,source,defendeur,region,date,numEnvois,dateEnvois,etatRec
	from reclamant , reclamation where id=reclamation.reclamant ";
	return mysqli_query($con,$req);
	
}
function chercher($nom_complet){
	global $con;
	$req = "select numR , reclamant.reclamant AS nom_reclamant,CIN,tel,adresse,sujet,source,defendeur,region,date,numEnvois,dateEnvois,etatRec
	from reclamant , reclamation where id=reclamant and  reclamant.reclamant='$nom_complet'";
	return mysqli_query($con,$req);
	
}


function listerReponse($nom) {
    global $con;
    
    // Vérification si le nom est vide
    if (empty($nom)) {
        // Si le nom est vide, retourner toutes les réponses
        $req = "SELECT numR,reclamant.reclamant , numRep, dateRep, resume, remarque 
                FROM reclamant, reclamation, reponse 
                WHERE id = reclamation.reclamant AND numR = reponse.NumReclamation";
    } else {
        // Si le nom est spécifié, chercher l'id du réclamant
        $req1 = "SELECT id FROM reclamant 
                WHERE reclamant.reclamant LIKE '%$nom%'";
	
        // Exécution de la requête pour récupérer l'id
        $res = mysqli_query($con, $req1);
        if ($res && mysqli_num_rows($res) > 0) {
            // Si un réclamant est trouvé, on récupère son id
            $row = mysqli_fetch_assoc($res);
            $rec = $row['id'];
        } else {
            // Si aucun réclamant n'est trouvé, retourner false
            return false;
        }

        // Récupérer les réponses associées à cet id de réclamant
        $req = "SELECT numR, reclamant.reclamant, numRep, dateRep, resume, remarque 
                FROM reclamant, reclamation, reponse 
                WHERE reclamant.id = '$rec' 
                AND id = reclamation.reclamant 
                AND numR = reponse.NumReclamation";
    }

    // Retourner le résultat de la requête
    return mysqli_query($con, $req);
}

// function listerReponse($nom){
	// global $con;
	// if($reclamant ==""){
	// $req = "select numR , concat(nom,' ',prenom) as nom_complet,numRep,dateRep,resume,remarque from reclamant , reclamation ,reponse 
	// where id=reclamant and numR=reponse.NumReclamation ";
	// }else{
		// $req = "select id from reclamant where (concat(nom,' ',prenom))='$nom' or (concat(prenom,' ',nom))='$nom' or nom='$nom' or prenom='$nom'";
		// $res=mysqli_query($con,$req);
				// if ($res && mysqli_num_rows($res) > 0) {
				// $row = mysqli_fetch_assoc($res);
				// $rec = $row['id'];
				// }
				// else {
				// return false;
				// }
				// $req = "select numR , concat(nom,' ',prenom) as nom_complet,numRep,dateRep,resume,remarque from reclamant , reclamation ,reponse 
				// where id ='$nom' and id=reclamant and numR=reponse.NumReclamation and ";}
				// return mysqli_query($con,$req);
	
       // }


function cercle(){
	global $con;
	$req = "SELECT * FROM cercle";
    return mysqli_query($con,$req);	
	
}

function caidat($id){
	global $con;
	$req = "SELECT id , nomCaidat FROM caidat where idCercle = '$id'";
    return mysqli_query($con,$req);	
	
}

function listerRecherche($cercle){
	global $con;
	$req = "select numR , reclamant.reclamant ,CIN,tel,adresse,sujet,source,defendeur,region,date,numEnvois,dateEnvois,etatRec
	from reclamant , reclamation where id=reclamation.reclamant and region='$cercle' ";
	return mysqli_query($con,$req);
	
	
	
}
function reclamant ($nom){
		global $con;
	$req = "select id from reclamant where reclamant.reclamant LIKE '%$nom%'";
	$res=mysqli_query($con,$req);
	 if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $rec = $row['id'];
    }
	else {
 return false;
 }
	$req = "select numR , reclamant.reclamant ,CIN,tel,adresse,sujet,source,defendeur,region,date,numEnvois,dateEnvois,etatRec
	from reclamant , reclamation where id=reclamation.reclamant and id='$rec' ";
	return mysqli_query($con,$req);
	
}

 function listerRappel($nom){
	global $con;	
	 if (empty($nom)) {
        // Si le nom est vide, retourner toutes les réponses
     $req = "select  numR ,reclamant.reclamant,numRapp ,dateRapp from rappel,reclamation,reclamant where numR=rappel.NumReclamation and id=reclamation.reclamant ";
    } else {
        // Si le nom est spécifié, chercher l'id du réclamant
        $req1 = "SELECT id FROM reclamant 
                WHERE reclamant.reclamant LIKE '%$nom%'";
	        $res1 = mysqli_query($con, $req1);
        if ($res1 && mysqli_num_rows($res1) > 0) {
            // Si un réclamant est trouvé, on récupère son id
            $row = mysqli_fetch_assoc($res1);
            $rec = $row['id'];
        } else {
            // Si aucun réclamant n'est trouvé, retourner false
            return false;
        }

        // Récupérer les réponses associées à cet id de réclamant
      $req = "select  numR , reclamant.reclamant,numRapp ,dateRapp from rappel,reclamation,reclamant where numR=rappel.NumReclamation and id=reclamation.reclamant and id='$rec'";
	
 }
	return mysqli_query($con,$req);
 }

// select region, count(*) as 'nombre de réclamations' from reclamation where region in (SELECT concat(nomCercle,' / ',nomCaidat) from caidat) group by region order by region,count(*) desc

function listerReclamations($limit, $offset) {
    global $con;
    $sql = "SELECT * FROM reclamation,reclamant where id=reclamation.reclamant ORDER BY numR DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}





?>