<?php

require_once('PHPMailer-master/class.phpmailer.php');
class Model
{

    // // déclaration à distance

     //const SERVER = "localhost";
     //const USER = "root";
     //const PASSWORD = "root";
     //const BASE ="gestionClient";

      const SERVER = "sqlprive-pc2372-001.privatesql.ha.ovh.net:3306";
      const USER = "cefiidev908";
      const PASSWORD = "hzc5JV62S";
      const BASE ="cefiidev908";



    private $connexion;

    public function __construct()
    {
        try
        {
            $this->connexion = new PDO("mysql:host=".self::SERVER.";dbname=".self::BASE, self::USER, self::PASSWORD);
        } 
        catch (Exception $e) 
        {
            die('Erreur : ' . $e->getMessage());
        }          
    }
    
    // Selection du tableau client
    public function getSociete($societe){

        $client=(implode($societe));


        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient  WHERE Client = '$client'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;

    }
    
    //Selection des dates avec comparaison
    public function getDate(){
        $dateJour = date('m/Y');

        
        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Relance='$dateJour' ";
        $resultat = $this->connexion->query($requete);
        $liste = array();
        if($resultat) 
        {
            $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

        }
        return $liste;

    }

    //Ajout client bdd et conversion des dates
    public function addBdd($societe,$util,$contrat,$frequence,$mail, $anniv, $facturation){


        $date = $anniv;

        //Conversion de la date
        $datte=(date('d/m/Y', strtotime($date)));

        // Ajout de 5 ans à la date
        $cinq= (date("d/m/Y",strtotime( $date .'+60 months')));
        $relanceCinq= (date("m/Y",strtotime( $date .'+57 months')));

        // Ajout de 3 ans à la date
        $trois= (date("d/m/Y",strtotime( $date .'+36 months')));
        $relanceTrois= (date("m/Y",strtotime( $date .'+33 months')));

        // Ajout de 1an à la date
        $fin= (date("d/m/Y",strtotime( $date .'+12 months')));

        // Ajout de 1 mois à la date
        $mois= (date("d/m/Y",strtotime( $date .'+1 months')));
        $relanceMois= (date("d/m/Y",strtotime( $date .'+15 days')));



        // Ajout de 9 mois à la date
        $relance= (date("m/Y",strtotime( $date .'+9 months')));

        //Conversion date Facturation
        $facture = (date("d/m/Y",strtotime($facturation)));


        // Ajout à la Bdd

        // POUR 1 ANS
        if ($frequence == '1 an' ){

        $requete =$this->connexion->prepare(" INSERT INTO listeClient (Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation) VALUES (:societe,:util, :contrat, :frequence,:email, :anniv, :fin, :relance, :Facture)");
        $requete->execute(array('societe'=>$societe,'util'=>$util,'contrat'=>$contrat,'frequence'=>$frequence,'email'=>$mail, 'anniv'=>$datte,'fin'=>$fin, 'relance'=>$relance, 'Facture'=>$facture));

        header('Location:index.php?action=accueil');
        }

        // POUR 1 MOIS
        if ($frequence == '1 mois' ){

            $requete =$this->connexion->prepare(" INSERT INTO listeClient (Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation) VALUES (:societe,:util, :contrat, :frequence,:email, :anniv, :fin, :relance, :Facture)");
            $requete->execute(array('societe'=>$societe,'util'=>$util,'contrat'=>$contrat,'frequence'=>$frequence,'email'=>$mail, 'anniv'=>$datte,'fin'=>$mois, 'relance'=>$relanceMois, 'Facture'=>$facture));
            
            header('Location:index.php?action=accueil');
            }

        // POUR 5 ANS
        if ($frequence == '5 ans' ){

            $requete =$this->connexion->prepare(" INSERT INTO listeClient (Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation) VALUES (:societe,:util, :contrat, :frequence,:email, :anniv, :fin, :relance, :Facture)");
            $requete->execute(array('societe'=>$societe,'util'=>$util,'contrat'=>$contrat,'frequence'=>$frequence,'email'=>$mail, 'anniv'=>$datte,'fin'=>$cinq, 'relance'=>$relanceCinq, 'Facture'=>$facture));
            header('Location:index.php?action=accueil');
            }

        // POUR 3 ANS
        if ($frequence == '3 ans' ){

            $requete =$this->connexion->prepare(" INSERT INTO listeClient (Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation) VALUES (:societe,:util, :contrat, :frequence,:email, :anniv, :fin, :relance, :Facture)");
            $requete->execute(array('societe'=>$societe,'util'=>$util,'contrat'=>$contrat,'frequence'=>$frequence,'email'=>$mail, 'anniv'=>$datte,'fin'=>$trois, 'relance'=>$relanceTrois, 'Facture'=>$facture));
    
            header('Location:index.php?action=accueil');
            }





        //Conversion date du jour pour comparaison
        $dateJour = date('m/Y');

        //Selection des dates avec comparaison
        $requete = "SELECT * FROM listeClient WHERE Relance='$dateJour' ";
        $resultat = $this->connexion->query($requete);
        $liste = array();
        if($resultat)
        {
            $liste = $resultat->fetch(PDO::FETCH_ASSOC);
        }
        echo "<pre>";

    }

    //Delete client bdd
    public function deleteBdd($id){

        $requete = $this->connexion->prepare( "DELETE FROM `listeClient` WHERE IdClient= :id"); 
        $requete->execute(array('id'=>$id)); 
        header('Location:index.php?action=accueil');


    }

    //Update client
    public function execbdd($id,$client,$utilisateur,$contrat,$frequence,$email,$debut,$fin,$renou,$facture){
       
        $id=$_GET['id'];
        
        $requete= $this->connexion->prepare("UPDATE listeClient SET Client = :societe,utilisateur =:util, TypeContrat = :contrat,frequence =:frequence, email= :mail, Anniversaire = :debut, Fin = :fin, Relance = :relance , Facturation =:facture WHERE IdClient= :id");
        $requete->execute(array('societe'=>$client,'util'=> $utilisateur, 'contrat'=>$contrat, 'frequence' => $frequence, 'mail'=>$email, 'debut'=>$debut, 'fin'=>$fin, 'relance'=>$renou, 'facture' => $facture, 'id'=>$id));
        header('Location:index.php?action=accueil');

    }



    //Requête Index
    public function displayMenu(){
        $requete = "SELECT DISTINCT Client FROM listeClient";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    //Affichage Tableau Complet
    public function displayComplet(){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient ORDER BY Client ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;




    }

    //Tri et tableau par utilisateur
    public function triUtil($societe){

        $requete = "SELECT DISTINCT utilisateur FROM listeClient WHERE Client='$societe'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabUtil($client,$util){
        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Client='$client' AND utilisateur='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }


    //Tri et tableau par contrat
    public function triContrat($societe){

        $requete = "SELECT DISTINCT TypeContrat FROM listeClient WHERE Client='$societe'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabContrat($client,$util){
        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Client='$client' AND TypeContrat='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    //Tri et tableau par Anniversaire
    public function triAnniv($societe){

        $requete = "SELECT DISTINCT Fin FROM listeClient WHERE Client='$societe'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }
    public function tabAnniv($client,$util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE  Fin='$util' AND Client='$client' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function triAnnivComplet(){

        $requete = "SELECT DISTINCT Fin FROM listeClient";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
        
    }

    public function tabAnniv2($util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE  Fin='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }


    //Tri et tableau par Relance
    public function triRelance($societe){

        $requete = "SELECT DISTINCT Relance FROM listeClient WHERE Client='$societe'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabRelance($client,$util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Client='$client' AND Relance='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }
    public function triRelance2(){

        $requete = "SELECT DISTINCT Relance FROM listeClient ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabRelance2($util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Relance='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    //Tri et tableau par Facturation
    public function triFacture($societe){

        $requete = "SELECT DISTINCT Facturation FROM listeClient WHERE Client='$societe'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabFacture($client,$util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE Client='$client' AND Facturation='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function triFacture2(){

        $requete = "SELECT DISTINCT Facturation FROM listeClient";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    public function tabFacture2($util){

        $requete = "SELECT IdClient,Client,utilisateur,TypeContrat,frequence,email,Fin,Relance,Facturation FROM listeClient WHERE  Facturation='$util' ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }


    //Vérification connexion
    public function Login($user,$password){

        $requete = "SELECT * FROM gestionUser  WHERE user = '$user'";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        if (password_verify($password, $list[0]["password"])){

            session_start();
            $_SESSION['user'] = $user;
            header('Location:index.php?action=accueil');
        }
        else{
            header('Location:index.php?action=Wrong');
        }

    }

    //Add BDD user
    public function addBDDUser($user,$password){

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        echo $pass_hash;

        $requete =$this->connexion->prepare("INSERT INTO gestionUser (user,password) VALUES ( :user, :password)");
        $requete->execute(array('user'=>$user, 'password'=>$pass_hash));

        header('Location:index.php?action=accueil');
        
    }

    public function displayAdd(){
        $requete = "SELECT * FROM listeContrat ";
        $result = $this->connexion->query($requete);
        $list = array();
        if($result) 
        {
            $list = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $list;
    }

    //Add BDD contrat
    public function addContrat($contrat){
    
            $requete =$this->connexion->prepare("INSERT INTO listeContrat (contrat) VALUES ( :contrat)");
            $requete->execute(array('contrat'=>$contrat));
    
            header('Location:index.php?action=addContrat');
            
    }

    //Affichage des contrats
    public function Contrat(){
            $requete = "SELECT * FROM listeContrat ";
            $result = $this->connexion->query($requete);
            $list = array();
            if($result) 
            {
                $list = $result->fetchAll(PDO::FETCH_ASSOC);
            }
            return $list;
    }

    //Delete contrats
    public function delContrat($id){
        $requete = $this->connexion->prepare( "DELETE FROM `listeContrat` WHERE id= :id"); 
        $requete->execute(array('id'=>$id)); 
        header('Location:index.php?action=addContrat');
    }

    //Update contrat
    public function upContrat($contrat,$id){
        $requete= $this->connexion->prepare("UPDATE listeContrat SET contrat = :contrat WHERE id= :id");
        $requete->execute(array('contrat'=>$contrat, 'id'=>$id));
        header('Location:index.php?action=addContrat');

    }

    //Import BDD
    public function import(){

        extract(filter_input_array(INPUT_POST));
                $fichier=$_FILES["userfile"]["name"];
                    if ($fichier){
                        $fp = fopen($_FILES['userfile']['tmp_name'], "r");}
        
        
                $cpt=0;
                while (!feof($fp)){
                    $ligne = fgets($fp,4096);
        
                    $liste = explode(",",$ligne);
                    $table = filter_input(INPUT_POST, 'userfile');
        
        
        
                    $liste[0] = ( isset($liste[0])) ? $liste[0] : Null;
                    $liste[1] = ( isset($liste[1])) ? $liste[1] : Null;
                    $liste[2] = ( isset($liste[2])) ? $liste[2] : Null;
                    $liste[3] = ( isset($liste[3])) ? $liste[3] : Null;
                    $liste[4] = ( isset($liste[4])) ? $liste[4] : Null;
                    $liste[5] = ( isset($liste[5])) ? $liste[5] : Null;
                    $liste[6] = ( isset($liste[6])) ? $liste[6] : Null;
                    $liste[7] = ( isset($liste[7])) ? $liste[7] : Null;
                    $liste[8] = ( isset($liste[8])) ? $liste[8] : Null;
        
                    
                    $champs1= $liste[0];
                    $champs2= $liste[1];
                    $champs3= $liste[2];
                    $champs4= $liste[3];
                    $champs5= $liste[4];
                    $champs6= $liste[5];
                    $champs7= $liste[6];
                    $champs8= $liste[7];
                    $champs9= $liste[8];
        
        
                
                    if ($champs1!= ''){
                        $cpt++;
                        $requete =$this->connexion->prepare(" INSERT INTO listeClient (Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation) VALUES (:societe,:util, :contrat, :frequence,:email, :anniv, :fin, :relance, :Facture)");
                        $requete->execute(array('societe'=>$champs1,'util'=>$champs2,'contrat'=>$champs3,'frequence'=>$champs4,'email'=>$champs5, 'anniv'=>$champs6,'fin'=>$champs7, 'relance'=>$champs8, 'Facture'=>$champs9));
                    
                }}
                fclose($fp);

                header('Location:index.php?action=complet');


                
    }

    //Export BDD
    public function export(){
        
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=listeClient' . date("d/m/y") . '.csv');  
        $connect = mysqli_connect("sqlprive-pc2372-001.privatesql.ha.ovh.net:3306", "cefiidev908", "hzc5JV62S", "cefiidev908");  

        $output = fopen("php://output", "w");  
        $query = "SELECT Client,utilisateur,TypeContrat,frequence,email,Anniversaire,Fin,Relance,Facturation from listeClient ";  
        $result = mysqli_query($connect, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
             fputcsv($output, $row);  
        }  
        fclose($output);  
             
        }
        
    //mail
    public function email(){
        $dateJour = date('m/Y');

        echo $dateJour;
        
        $requete = "SELECT societe FROM listeClient WHERE Relance='$dateJour' ";
        $resultat = $this->connexion->query($requete);
        $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);
        echo $liste;
        var_dump($liste);


        require'PHPMailer-master/PHPMailerAutoload.php';


        //$mail = new PHPmailer();

        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
    $mail->Host = 'smtp-fr.securemail.pro'; // Spécifier le serveur SMTP
    $mail->SMTPAuth = true; // Activer authentication SMTP
    $mail->Username = 'noreplay@ibooservices.com'; // Votre adresse email d'envoi
    $mail->Password = 'No99repl@yIS'; // Le mot de passe de cette adresse email
    $mail->SMTPSecure = 'ssl'; // Accepter SSL
    $mail->Port = 465;

    $mail->setFrom('noreplay@ibooservices.com', 'iBoo TECHNOLOGIES'); // Personnaliser l'envoyeur
    $mail->addAddress('ma.farhat@ibooservices.com','MOMO'); // Ajouter le destinataire
    $mail->addAddress('gentilhommealan@icloud.com', 'Alan'); 

    $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

    $mail->Subject = 'Demande de relance';
    $mail->Body = 'Tu dois payer mec';
    
    if(!$mail->send()) {
        echo 'Erreur, message non envoyé.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Le message a bien été envoyé !';
     }
     $mail->SMTPDebug = 1;
    }
}

