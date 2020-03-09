<?php


class View
{
    private $page;
    

    public function __construct(){
        $this->page .= $this->searchHTML('header');
    }

    //Affichage Tableau des clients
    public function displayHome($list,$societe){

        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats de ' . implode($societe) . '</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th class="text-center">Id client</th>
                                    <th class="text-center">Entreprise</th>
                                    <th class="text-center">Utilisateur</th>
                                    <th class="text-center">Contrat</th>
                                    <th class="text-center">Fréquence</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">Anniversaire </th>
                                    <th class="text-center"> Relance </th>
                                    <th class="text-center">Facturation</th>
                                    <th class="text-center"> Modifier </th>
                                    <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=formuUpdate&id='. $element['IdClient'].'&id='.$element['IdClient'].'&client=' . $element['Client'] .'&util=' . $element['utilisateur'] .'&contrat=' . $element['TypeContrat'] .'&freq=' . $element['frequence'] .'&email=' . $element['email'] .'&anniv=' . $element['Fin'] .'&relance=' . $element['Relance'] .'&facture=' . $element['Facturation'] .'">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>

        <a href="index.php?action=filtreUtil&client='. implode($societe) .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. implode($societe) .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. implode($societe) .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. implode($societe) .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. implode($societe) .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>

        ';        
        $this->display();
    }

    //Affichage tables des Relances
    public function displayResi($liste){

                //Tableau des clients
                $this->page .= '
                <div class="col-12  mt-5 ">
                    <div class="card border-secondary rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-danger text-white text-center py-2">
                                <h3><i class="fas fa-exclamation-triangle"></i></i> RELANCE DU MOIS EN COURS</h3>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <!--Table-->
                                <table class="table table-striped">
        
                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                        <th class="text-center">Id client</th>
                                        <th class="text-center">Entreprise</th>
                                        <th class="text-center">Utilisateur</th>
                                        <th class="text-center">Contrat</th>
                                        <th class="text-center">Fréquence</th>
                                        <th class="text-center">email</th>
                                        <th class="text-center">Anniversaire </th>
                                        <th class="text-center"> Relance </th>
                                        <th class="text-center">Facturation</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->
        
                                    <!--Table body-->
                                    <tbody>';
        
                                    
                foreach($liste as $element) {
                    $this->page .= '<thead><tr>';
                    foreach ($element as $value) {
                        $this->page .='<td class="text-center">'.$value.'</td>';
                    }
        
        
                    $this->page .='

                            </tr>
                        </thead>';
                }
        
        
                $this->page .=' </tbody>
                                    <!--Table body-->
                                </table>
                                <!--Table-->
                            </div>
                        </div>
                    </div>
                </div>
                ';        

          
    }
    
    //Affichage formulaire d'ajout client
    public function displayAdd($list){

        $this->page .= ' <a href="index.php?action=accueil" class="btn btn-success text-light">Retour Accueil</a> <div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=addBdd" method="POST">
            <div class="card border-light rounded-0 ">
    
                <h3 class="text-center mt-3">Ajout client</h3>
    
                <label for="societe" class="text-center mt-5">Entreprise *</label>
                <input type="text" class="form-control col-10 ml-5 " id="societe" name="societe" required>
    
                <label for="util" class="text-center mt-5">Utilisateur *</label>
                <input type="text" class="form-control col-10 ml-5 " id="util" name="util" required>
    
                <label for="contrat" class="text-center mt-5">Type de contrat *</label>
    
                <select class="form-control col-10 ml-5 " id="contrat" name="contrat" required>';

                foreach ($list as $value) {
                    $this->page .='<option value="' . $value['contrat'] . '">'. $value['contrat'] . '</option>';
                }


        //Formulaire d'ajout des clients
        $this->page .= $this->searchHTML('formulaire');

        $this->display();
    }

    //Affichage comfirmation de suppresion client
    public function displayDelete(){

        $this->page .= '<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=addBdd" method="POST">
            <div class="card border-light rounded-0 ">
    
                <h3 class="text-center mt-3">Etes-vous sur de vouloir supprimer ' . $_GET['client'] .' ?</h3>

                <div class="mt-5 mb-5 col-12 d-flex justify-content-center">
                <a href="index.php?action=deletebdd&id='. $_GET['id'] . '" class="btn btn-success col-4 p-3  mr-5">Oui</a>
                <a href="index.php?action=accueil" class="btn btn-danger col-4 p-3">non</a>
                </div>

            </div>
        </form>
     </div>';

        $this->display();
    }

    //Affichage formu Update
    public function formuUpdate(){


        $this->page .= '<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=execUpdate&id='.$_GET['id'].'" method="POST">
        <div class="card border-light rounded-0 ">

            <h3 class="text-center mt-3">Modification client</h3>

            
            <label for="societe" class="text-center mt-5">Id client *</label>
            <input type="text" class="form-control col-10 ml-5 " id="id" name="id" value='. $_GET['id'].' required>

            <label for="societe" class="text-center mt-5">Entreprise *</label>
            <input type="text" class="form-control col-10 ml-5 " id="societe" name="societe" value='. $_GET['client'].' required>

            <label for="util" class="text-center mt-5">Utilisateur *</label>
            <input type="text" class="form-control col-10 ml-5 " id="util" name="util" value='. $_GET['util'].' required>

            <label for="contrat" class="text-center mt-5">Type de contrat *</label>

            <select class="form-control col-10 ml-5 " id="contrat" name="contrat" value='. $_GET['contrat'].' required>
                <option value="Autres">Autres</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Maintenance WEB">Maintenance WEB</option>
                <option value="Domaine">Nom de domaine</option>
                <option value="Https">Certificat https</option>
                <option value="Antivirus">Antivirus</option>
                <option value="Office 1">Office 1</option>
                <option value="Office 2">Office 2</option>
                <option value="Mailjet">Mailjet</option>
                <option value="Adobe 1">Adobe 1</option>
                <option value="Adobe 2">Adobe 2</option>
                <option value="Sauvegardes">Sauvegardes</option>
                <option value="Emails">Emails</option>
                <option value="Hébergement">Hebergement</option>

            </select>

            <label for="frequence" class="text-center mt-5">Fréquence *</label>

            <select class="form-control col-10 ml-5 " id="frequence" name="frequence" value='. $_GET['freq'].' required>
                <option value="5 ans">5 ans</option>
                <option value="3 ans">3 ans</option>
                <option value="1 an">1 an </option>
                <option value="1 mois">1 mois</option>
                <option value="autres">Autres</option>


            </select>


            <label for="mail" class="text-center mt-5">Adresse mail *</label>
            <input type="text" class="form-control col-10 ml-5 mb-5" id="mail" name="mail" value='. $_GET['email'].' required>

            <label for="date" class="text-center">Début contrat *</label>
            <input type="text" class="form-control col-10 ml-5 mb-5" id="debut" name="debut" dateformat="d M y"  >

            <label for="date" class="text-center">Date anniversaire *</label>
            <input type="text" class="form-control col-10 ml-5 mb-5" id="anniv" name="anniv" dateformat="d M y"  value='. $_GET['anniv'].' required>

            <label for="date" class="text-center">Date de Relance *</label>
            <input type="text" class="form-control col-10 ml-5 mb-5" id="renou" name="renou" dateformat="d M y" value='. $_GET['relance'].' required>

            <label for="date" class="text-center">Date de Facturation *</label>
            <input type="text" class="form-control col-10 ml-5 mb-5" id="facture" name="facture" dateformat="d M y" value='. $_GET['facture'].' required>

            <p class="text-center"> Veuillez respecter le format des dates </p>

            <input type="submit" class="btn btn-dark col-10 ml-5 mb-5">



        </div>
        </form>
        </div>';
        $this->display();
    }

    //Affichage Index
    public function displayMenu($list){
        $this->page .= '<h1  class="text-center"> Bonjour '. $_SESSION['user'] . '<div class="row justify-content-center mb-5 mt-5">
        <form method="post" action="index.php?action=Tableau" id="framework_form" class="bg-light mb-5 col-6 text-center rounded">

         <h1 class="col-12 mb-5">Veuillez sélectionner une entreprise</h1>
         <select id="framework" name="framework[]"  class="form-control col-12 mb-5" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-12"> ' . $element['Client'] .'</option>';
        }
        $this->page .="</div> </form>";

        $this->page .= $this->searchHTML('furmu');

        $this->page.= ' <div class="mt-5">';
        $this->page .= $this->searchHTML('index');
        $this->page.= '</div>';

        
        $this->display();
    }


    //Affichage tous les clients
    public function displayComplet($list){

        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th class="text-center">Id client</th>
                                    <th class="text-center">Entreprise</th>
                                    <th class="text-center">Utilisateur</th>
                                    <th class="text-center">Contrat</th>
                                    <th class="text-center">Fréquence</th>
                                    <th class="text-center">email</th>
                                    <th class="text-center">Date anniversaire</th>
                                    <th class="text-center">Date de Relance prévue</th>
                                    <th class="text-center">Date de Facturation</th>
                                    <th class="text-center"> Modifier </th>
                                    <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                        <a href="index.php?action=formuUpdate&id='. $element['IdClient'].'&id='.$element['IdClient'].'&client=' . $element['Client'] .'&util=' . $element['utilisateur'] .'&contrat=' . $element['TypeContrat'] .'&freq=' . $element['frequence'] .'&email=' . $element['email'] .'&anniv=' . $element['Fin'] .'&relance=' . $element['Relance'] .'&facture=' . $element['Facturation'] .'">
                        <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?action=filtreAnniv2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>
        <a href="index.php?action=filtreRelance2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>
        <a href="index.php?action=filtreFacturation2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>
        <a href="index.php" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>

        ';       




        $this->display();
    }

    
    //Tri et tableau par utilisateur
    public function triUtil($list,$client){
                        //Affichage Utilisateur
                        $this->page .= '
                        <form method="post" action="index.php?action=TableauUtil&client='.$client.'" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
                        <h4 class="text-light">Utilisateur</h4>
                         <select id="framework"  name="util"  class=" col-9 framework" >';
                
                        foreach($list as $element) {
                            $this->page .= '<option class="col-4"> ' . $element['utilisateur'] .'</option>';
                        }
                        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }   
    public function tabUtil($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats de ' . $_POST['util'] . ' de la société ' . $_GET['client'] . '</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?action=filtreUtil&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }


    //Tri et tableau par Contrat
    public function triContrat($list,$client){
        //Affichage Utilisateur
        $this->page .= '
        <form method="post" action="index.php?action=TableauContrat&client='.$client.'" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
        <h4 class="text-light">Utilisateur</h4>
         <select id="framework"  name="contrat"  class=" col-12 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-12"> ' . $element['TypeContrat'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }
    public function tabContrat($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats de ' . $_POST['contrat'] . ' de la société ' . $_GET['client'] . '</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client']  .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>        
        
        <a href="index.php?action=filtreUtil&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }

    //Tri et tableau par Anniversaire
    public function triAnniv($list,$client){
        $this->page .= '
        <form method="post" action="index.php?action=TableauAnniv&client='.$client.'" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
        <h4 class="text-light">Date Anniversaire</h4>
         <select id="framework"  name="anniv"  class=" col-9 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-4"> ' . $element['Fin'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }
    public function tabAnniv($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats de ' . $_GET['client'].' Ayant pour anniversaire ' . $_POST['anniv'].' </h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?action=filtreUtil&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }

    public function triAnnivComplet($list){

        $this->page .= '
        <form method="post" action="index.php?action=TableauAnniv2" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
        <h4 class="text-light">Date Anniversaire</h4>
        <select id="framework"  name="anniv"  class=" col-9 framework" >';

        foreach($list as $element) {
        $this->page .= '<option class="col-4"> ' . $element['Fin'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }   

    public function tabAnniv2($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
        <div class="card border-secondary rounded-0">
            <div class="card-header p-0">
                <div class="bg-primary text-white text-center py-2">
                    <h3><i class="fas fa-list-ol"></i> Liste des contrats ayant pour date anniversaire ' . $_POST['anniv'] .' </h3>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <!--Table-->
                    <table class="table table-striped">

                        <!--Table head-->
                        <thead>
                            <tr>
                            <th class="text-center">Id client</th>
                            <th class="text-center">Entreprise</th>
                            <th class="text-center">Utilisateur</th>
                            <th class="text-center">Contrat</th>
                            <th class="text-center">Fréquence</th>
                            <th class="text-center">email</th>
                            <th class="text-center">Anniversaire </th>
                            <th class="text-center"> Relance </th>
                            <th class="text-center">Facturation</th>
                            <th class="text-center"> Modifier </th>
                            <th class="text-center"> Supprimer <th>
                            </tr>
                        </thead>
                        <!--Table head-->

                        <!--Table body-->
                        <tbody>';

                        
        foreach($list as $element) {
        $this->page .= '<thead><tr>';
        foreach ($element as $value) {
            $this->page .='<td class="text-center">'.$value.'</td>';
        }


        $this->page .='
                    <td class="text-center">
                        <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </thead>';
        }


        $this->page .=' </tbody>
                        <!--Table body-->
                    </table>
                    <a href="index.php?action=add"
                        class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                    <!--Table-->
                </div>
            </div>
        </div>
        </div>
        <a href="index.php?action=filtreAnniv2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>
        <a href="index.php?action=filtreRelance2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>
        <a href="index.php?action=filtreFacturation2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>
        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';

    
        $this->display();
}

    //Tri et tableau par Relance
    public function triRelance($list,$client){
        $this->page .= '
        <form method="post" action="index.php?action=TableauRelance&client='.$client.'" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
        <h4 class="text-light">Date Relance</h4>
         <select id="framework"  name="relance"  class=" col-9 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-4"> ' . $element['Relance'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }
    public function tabRelance($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats  de ' . $_GET['client'].' Ayant pour relance ' . $_POST['relance'].'</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div> 
        <a href="index.php?action=filtreUtil&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }

    //Tri et tableau par Relance
    public function triRelance2($list){
        $this->page .= '
        <form method="post" action="index.php?action=TableauRelance2" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12">
        <h4 class="text-light">Date Relance</h4>
         <select id="framework"  name="relance"  class=" col-9 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-4"> ' . $element['Relance'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
    }
    public function tabRelance2($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats ayant pour date de relance ' . $_POST['relance'] . '</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?action=filtreAnniv2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>
        <a href="index.php?action=filtreRelance2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>
        <a href="index.php?action=filtreFacturation2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>
        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }

    //Tri et tableau par Facture
    public function triFacture($list,$client){
        $this->page .= '
        <form method="post" action="index.php?action=TableauFacture&client='.$client.'" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12 ">
        <h4 class="text-light">Date Facturation</h4>
         <select id="framework"  name="Facture"  class=" col-12 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-8"> ' . $element['Facturation'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
        }
    public function tabFacture($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats  de ' . $_GET['client'].' Ayant pour Facturation ' . $_POST['Facture'].'</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>        
        
        <a href="index.php?action=filtreUtil&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-3">Filtrer un utilisateur</a>

        <a href="index.php?action=filtreContrat&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer les Contrats</a>

        <a href="index.php?action=filtreAnniv&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>

        <a href="index.php?action=filtreRelance&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>

        <a href="index.php?action=filtreFacturation&client='. $_GET['client'] .'" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>

        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
        }

    public function triFacture2($list){
        $this->page .= '
        <form method="post" action="index.php?action=TableauFacture2" id="framework_form" class="mb-5 mt-5 col-2 text-center rounded col-12 ">
        <h4 class="text-light">Date Facturation</h4>
        <select id="framework"  name="Facture"  class=" col-12 framework" >';

        foreach($list as $element) {
            $this->page .= '<option class="col-8"> ' . $element['Facturation'] .'</option>';
        }
        $this->page .= $this->searchHTML('furmu');

        $this->display();
        }
    public function tabFacture2($list){
        //Tableau des clients
        $this->page .= '
        <div class="col-12  mt-5 ">
            <div class="card border-secondary rounded-0">
                <div class="card-header p-0">
                    <div class="bg-primary text-white text-center py-2">
                        <h3><i class="fas fa-list-ol"></i> Liste des contrats ayant pour date de facturation ' . $_POST['Facture'] .'</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table table-striped">

                            <!--Table head-->
                            <thead>
                                <tr>
                                <th class="text-center">Id client</th>
                                <th class="text-center">Entreprise</th>
                                <th class="text-center">Utilisateur</th>
                                <th class="text-center">Contrat</th>
                                <th class="text-center">Fréquence</th>
                                <th class="text-center">email</th>
                                <th class="text-center">Anniversaire </th>
                                <th class="text-center"> Relance </th>
                                <th class="text-center">Facturation</th>
                                <th class="text-center"> Modifier </th>
                                <th class="text-center"> Supprimer <th>
                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody>';

                            
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


            $this->page .='
                        <td class="text-center">
                            <a href="index.php?action=updateBdd&id='. $element['IdClient'].'&client='.$element['Client'] .'&fin='. $element['Fin'].'&relance=' . $element['Relance'] .'&mail=' . $element['email'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=Supression&id='. $element['IdClient'].'&client='.$element['Client'] .'">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>
                        <a href="index.php?action=add"
                            class="btn btn-primary btn-block rounded-0 py-2">Ajouter</a>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php?action=filtreAnniv2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Anniversaire</a>
        <a href="index.php?action=filtreRelance2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Relance</a>
        <a href="index.php?action=filtreFacturation2" class="btn-primary p-5 mt-5 ml-5">Filtrer par Facturation</a>
        <a href="index.php?action=accueil" class="btn-primary p-5 mt-5 ml-5">Retour Accueil</a>';
        
        $this->display();
    }

    // Page de connexion
    public function Login(){

            $this->page .='<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
            <form action="index.php?action=connect" method="POST" center-block>
                <div class="card border-light rounded-0 d-flex align-items-center">

                    <h1>Connexion </h1>

                    <label for="user"class="text-center mt-5">User</label>
                    <input type="text" name="user" class="form-control col-10  mb-3">
        
                    <label for="password"class="text-center mt-5">Password</label>
                    <input type="password" name="password" class="form-control col-10 mb-5">
        
                    <input type="submit" class="btn btn-dark col-10 mb-5">
                </div>
            </form>
        </div>';

            $this->display();
    }

    //Page de connexion en cas d'erreur
    public function Wrong(){

        $this->page .=$_SESSION['user']  .'<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=connect" method="POST" center-block>
            <div class="card border-light rounded-0 d-flex align-items-center">

                <h1>Connexion </h1>

                <label for="user"class="text-center mt-5">User</label>
                <input type="text" name="user" class="form-control col-10  mb-3">
    
                <label for="password"class="text-center mt-5">Password</label>
                <input type="password" name="password" class="form-control col-10 mb-5">

                <p style="color:red"> Mot de passe ou identifiant incorrect ! </p>
    
                <input type="submit" class="btn btn-dark col-10 mb-5">
            </div>
        </form>
        </div>';

            $this->display();
    }

    //PAGE ajout user
    public function addLog(){

        $this->page .='<a href="index.php?action=accueil" class="btn btn-success text-light">Retour Accueil</a> <div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=addLoginBDD" method="POST" center-block>
            <div class="card border-light rounded-0 d-flex align-items-center">

                <h1>Ajouter un user </h1>
    
                <label for="user"class="text-center mt-5">User</label>
                <input type="text" name="user" class="form-control col-10  mb-3">
    
                <label for="password"class="text-center mt-5">Password</label>
                <input type="text" name="password" class="form-control col-10 mb-5">
    
                <input type="submit" class="btn btn-dark col-10 mb-5">
            </div>
        </form>
        </div>';

        $this->display();
        }
    //

    //PAGE ajout contrat
    public function addContrat($list){


        $this->page .='<a href="index.php?action=accueil" class="btn btn-success text-light">Retour Accueil</a> <div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
            <form action="index.php?action=addContratBDD" method="POST" center-block>
                <div class="card border-light rounded-0 d-flex align-items-center">

                    <h1>Ajouter un contrat </h1>
        
                    <label for="contrat"class="text-center mt-5">Nom du contrat</label>
                    <input type="text" name="contrat" class="form-control col-10  mb-3">
        
                    <input type="submit" class="btn btn-dark col-10 mb-5">
                </div>
            </form>
            </div>';

        $this->page .= '
            <div class="col-12  mt-5 ">
                <div class="card border-secondary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-primary text-white text-center py-2">
                            <h3><i class="fas fa-list-ol"></i> Liste des contrats</h3>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <!--Table-->
                            <table class="table table-striped">

                                <!--Table head-->
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Contrat</th>
                                        <th class="text-center">Modifier</th>
                                        <th class="text-center">Supprimer</th>

                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>';

                        
        foreach($list as $element) {
            $this->page .= '<thead><tr>';
            foreach ($element as $value) {
                $this->page .='<td class="text-center">'.$value.'</td>';
            }


        $this->page .='
                        <td class="text-center">
                        <a href="index.php?action=upContrat&id=' .$element['id'] .'&contrat='. $element['contrat'] .' ">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="index.php?action=delContrat&id='.$element['id'] .'">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </thead>';
        }


        $this->page .=' </tbody>
                            <!--Table body-->
                        </table>

                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>';

            $this->display();
    }

    //Page update contrat
    public function upContrat($contrat,$id){
        $this->page .='<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=upContratBDD&id='.$id.'" method="POST" center-block>
            <div class="card border-light rounded-0 d-flex align-items-center">

                <h1>Modifier un contrat </h1>
    
                <label for="contrat"class="text-center mt-5">Nom du contrat</label>
                <input type="text" name="contrat" value='.$contrat.' class="form-control col-10  mb-3">
    
                <input type="submit" class="btn btn-dark col-10 mb-5">
            </div>
        </form>
        </div>';

     $this->display();
    }

    //Formulaire import
    public function import(){
        $this->page .='<div class="col-12 col-md-12 col-lg-6 mx-auto mt-5 ">
        <form action="index.php?action=importBDD" enctype="multipart/form-data"  method="POST" center-block>
            <div class="card border-light rounded-0 d-flex align-items-center">

                <h1>Importer un fichier csv </h1>
    
                <input type="file" name="userfile" value="table" class="form-control col-10  mb-3">
    
                <input type="submit" name="submit" value="Importez" class="btn btn-dark col-10 mb-5">
            </div>
        </form>
        </div>';

     $this->display();
    }




    private function display(){
        $this->page .= $this->searchHTML('footer');
        echo $this->page;
    }

    private function searchHTML($html){
        return file_get_contents('html/'.$html.'.html');
    }


}
