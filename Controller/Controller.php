<?php

session_start();
include 'Model/Model.php';
include 'View/View.php';

class Controller{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new View();
        $this->model = new Model();
    }

    public function dispatch(){
        $action = isset($_GET['action']) ? $_GET['action'] : 'login';

        switch ($action){

            //Page Login
            case "login" :

             $this->view->Login();
            break;
            
            //Test connexion
            case "connect" : 
            
                $this->model->Login($_POST['user'],$_POST['password']);
            break;

            //Wrong password
            case "Wrong" :

             $this->view->Wrong();
            break;

            //Affichage des tableaux
            case 'Tableau' :
                //Tableau des relances
                if(isset($_SESSION['user'])){

                $liste = $this->model->getDate();
                $this->view->displayResi($liste);

                //Tableau des sociétés
                $list = $this->model->getSociete($_POST['framework']);
                $this->view->displayHome($list,$_POST['framework']);
 

                }

                else {
                header('Location:index.php');
                }
            break;
            
            //Page formulaire ajout client
            case 'add' :
                if(isset($_SESSION['user'])){

                $list=$this->model->displayAdd();
                $this->view->displayAdd($list);

                }

                else {
                header('Location:index.php');
                }
        
            break;

            //Ajout client à la bdd
            case 'addBdd' : 
                if(isset($_SESSION['user'])){

                $this->model->addBdd($_POST['societe'],$_POST['util'],$_POST['contrat'],$_POST['frequence'],$_POST['mail'], $_POST['anniv'], $_POST['facture']);

                }

                else {
                header('Location:index.php');
                }
            break;

            //Pop-up suppression client
            case 'Supression' :

                if(isset($_SESSION['user'])){

                $this->view->displayDelete();

                }

                else {
                header('Location:index.php');
                }
            break;
            
            //Supression de la bdd client
            case 'deletebdd' :
                if(isset($_SESSION['user'])){

                $this->model->deleteBdd($_GET['id']);

                }

                else {
                header('Location:index.php');
                }

            break;

            
            // Formulaire Update BDD
            case 'formuUpdate' :

                if(isset($_SESSION['user'])){

                $this->view->formuUpdate();

                }

                else {
                    header('Location:index.php');
                }
            break;
            
            //Execution add BDD
            case 'execUpdate' :
                if(isset($_SESSION['user'])){

                $this->model->execbdd($_POST['id'],$_POST['societe'],$_POST['util'],$_POST['contrat'],$_POST['frequence'],$_POST['mail'],$_POST['debut'], $_POST['anniv'], $_POST['renou'], $_POST['facture']);
                }

                else {
                header('Location:index.php');
                }
                
            break;
            

            
            //Accueil
            case 'accueil' : 
                if(isset($_SESSION['user'])){

                $list=$this->model->displayMenu();
                $this->view->displayMenu($list);
                }

                else {
                header('Location:index.php');
                }
            
                
            break;
            //Tableau de tous les clients 
            case 'complet' : 

                if(isset($_SESSION['user'])){


                $liste = $this->model->getDate();
                $this->view->displayResi($liste);

                $list=$this->model->displayComplet();
                $this->view->displayComplet($list);
                }

                else {
                header('Location:index.php');
                }
             
            break;
            
            //Tri et tableau par utilisateur
            case 'filtreUtil' : 
                if(isset($_SESSION['user'])){

                $list = $this->model->triUtil($_GET['client']);
                $this->view->triUtil($list,$_GET['client']);
                }

                else {
                header('Location:index.php');
                }

            break;
            case 'TableauUtil' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabUtil($_GET['client'],$_POST['util']);
                $this->view->tabUtil($list, $_POST['util']);
                }

                else {
                header('Location:index.php');
                }

            break;
       

            //Tri et tableau par contrat
            case 'filtreContrat' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triContrat($_GET['client']);
                $this->view->triContrat($list,$_GET['client']);
                }

                else {
                header('Location:index.php');
                }

            break; 
            case 'TableauContrat' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabContrat($_GET['client'],$_POST['contrat']);
                $this->view->tabContrat($list, $_POST['contrat']);
                }

                else {
                header('Location:index.php');
                }

            break;


            //Tri et tableau par Anniversaire
            case 'filtreAnniv' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triAnniv($_GET['client']);
                $this->view->triAnniv($list,$_GET['client']);
                }

                else {
                header('Location:index.php');
                }

            break; 
            case 'TableauAnniv' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabAnniv($_GET['client'],$_POST['anniv']);
                $this->view->tabAnniv($list,$_POST['anniv']);
                }

                else {
                header('Location:index.php');
                }

            break;

            case 'filtreAnniv2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triAnnivComplet();
                $this->view->triAnnivComplet($list);
                }

                else {
                header('Location:index.php');
                }

                break; 
            case 'TableauAnniv2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabAnniv2($_POST['anniv']);
                $this->view->tabAnniv2($list);
                }

                else {
                header('Location:index.php');
                }

            break;

            //Tri et tableau par Relance
            case 'filtreRelance' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triRelance($_GET['client']);
                $this->view->triRelance($list,$_GET['client']);
                }

                else {
                header('Location:index.php');
                }
            break; 
            case 'TableauRelance' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabRelance($_GET['client'],$_POST['relance']);
                $this->view->tabRelance($list,$_POST['relance']);
                }

                else {
                header('Location:index.php');
                }

            break;

            case 'filtreRelance2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triRelance2();
                $this->view->triRelance2($list);
             }

                else {
                header('Location:index.php');
                }

            break; 
            case 'TableauRelance2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabRelance2($_POST['relance']);
                $this->view->tabRelance2($list);
                }

                else {
                header('Location:index.php');
                }

            break;


            //Tri et tableau par Facturation
            case 'filtreFacturation' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triFacture($_GET['client']);
                $this->view->triFacture($list,$_GET['client']);
                }

                else {
                header('Location:index.php');
                }

            break; 
            case 'TableauFacture' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabFacture($_GET['client'],$_POST['Facture']);
                $this->view->tabFacture($list,$_POST['Facture']);
                }

                else {
                header('Location:index.php');
                }

            break;
            case 'filtreFacturation2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->triFacture2();
                $this->view->triFacture2($list);
             }

                else {
                header('Location:index.php');
                }

            break; 
            case 'TableauFacture2' :
                if(isset($_SESSION['user'])){

                $list = $this->model->tabFacture2($_POST['Facture']);
                $this->view->tabFacture2($list);
                }

                else {
                header('Location:index.php');
                }

            break;



            //Add Login
            case "addLogin" : 
                if(isset($_SESSION['user'])){

                $this->view->addLog();
                }

                else {
                header('Location:index.php');
                }
            break;
            case "addLoginBDD":
                if(isset($_SESSION['user'])){

                $this->model->addBDDUser($_POST['user'],$_POST['password']);
                }   

                else {
                header('Location:index.php');
                }
            break;

            //Add Contrat
            case "addContrat" :
                if(isset($_SESSION['user'])){

                $list=$this->model->Contrat();
                $this->view->addContrat($list);
                }

                else {
                header('Location:index.php');
                }
            break;
            case "addContratBDD" :
                if(isset($_SESSION['user'])){

                $this->model->addContrat($_POST['contrat']);
                }

                else {
                header('Location:index.php');
                }
            break;

            //Delete Contrat
            case "delContrat" :
                $this->model->delContrat($_GET['id']);
            break;

            //Update Contrat
            case "upContrat" :
                $this->view->upContrat($_GET['contrat'],$_GET['id']);
            break;
            case "upContratBDD" :
                $this->model->upContrat($_POST['contrat'],$_GET['id']);
            break;

            //Import csv
            case "import" :
                $this->view->import();
            break;
            case "importBDD":
                $this->model->import();
            break;

            //Export csv
            case "export":
                $this->model->export();
            break;

            case "email":
                $this->model->email();

            break;


        



    }

}
}