<?php
/**
* Plugin Name: IPNET INSCRIPTION
* Plugin URI: https://www.ipnetinstitue.com/plugins
* Description: Ce plugin permet l'inscription des étudiants à IPNET.
* Version: 1.0
* Author: Génie Logiciel, L2
* Author URI: http://www.ipnetinstitue.com/
**/ 

class StudentManager extends WP_Widget
{
    public function __construct(){
        add_action('widgets_init','declarerWidget');
        add_action('admin_menu',array($this,'addMenuToAdmin'));
    }

    public static function install(){
        StudentManager::install_db();
    }

    public static function uninstall(){
        StudentManager::uninstall_db();
    }

    public static function install_db(){
        global $wpdb;
        $requete = "CREATE TABLE IF NOT EXISTS 
        ".$wpdb->prefix."inscription (
            id int not null auto_increment primary key,
            nom varchar(30) not null,
            prenom varchar(30),
            dateNaiss date,
            telephone varchar(15),
            email varchar(30),
            filiere varchar(30)
        );";
        $wpdb->query($requete);
    }

    public function uninstall_db(){
        global $wpdb;
        $requete = "DROP TABLE IF EXISTS ".$wpdb->prefix."inscription;";
        $wpdb->query($requete);
    }

    public static function addMenuToAdmin(){
        $student = new StudentManager();
        add_menu_page("INSCRIPTION A IPNET", "INSCRIPTION", "manage_options", "inscription_ipnet", array($student,"menuInscription"));
        add_submenu_page("inscription_ipnet", "LISTE DES DEMANDES", "Liste", "manage_options", "liste_inscrits", array($student,"sousMenuInscription"));
    }

    public static function menuInscription()
    {
        echo "Formulaire de demande d'inscription.";
    }
	
	
    public static function sousMenuInscription()
    {
        echo '<div class="d-block p-4 bg-dark text-white">Liste des etudiants:</div>';
        global $wpdb;
        $requete="SELECT * FROM ".$wpdb->prefix."inscription;";
        $resultats = $wpdb->get_results($requete);
        echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <title>Liste</title>
            <link rel="stylesheet" href="style.css">
            <style>
                .btn{
                    margin-right: 5px;
                    margin-left: 5px;
                }

                .bold{
                    font-weight:bold;
                }

                .danger{
                    color:red;
                    display:block;
                    font-weight:bold;
                    margin: 5px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <table class="table table-bordered">
                <thead>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Actions</th>
            </thead>
            <tbody>
        ';
        foreach($resultats as $row) {
            echo'<tr><td class="fw-bolder">'.strtoupper($row->nom).'</td><td>'.ucfirst($row->prenom).'</td><td><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$row->id.'">Détails</button><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropM'.$row->id.'">Modifier</button><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropD'.$row->id.'">Supprimer</button></td></tr>';

            // Détails etudiant
            echo'
                <div class="modal fade " id="staticBackdrop'.$row->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel'.$row->id.'">Détails Etudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <span class="bold">Nom:</span> '.strtoupper($row->nom).' </br> 
                    <span class="bold">Prénom:</span>'.ucfirst($row->prenom).' </br> 
                    <span class="bold">Date de naissance:</span> '.$row->dateNaiss.'</br> 
                    <span class="bold">Téléphone:</span>'.$row->telephone.' </br> 
                    <span class="bold">Filière:</span> '.$row->filiere.'</br> 
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
                </div>
            </div>
            
            
            ';

            // Modifier etudiant

            echo'
                <div class="modal fade " id="staticBackdropM'.$row->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabelM'.$row->id.'">Modifier Etudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            <input value="'.strtoupper($row->nom).'" name="nom" placeholder="Votre nom ?" required type="text" />
                            <input value="'.ucfirst($row->prenom).'" name="prenom" placeholder="Votre Prénom ?" required type="text" />
                            <input value="'.$row->dateNaiss.'" name="datenaiss" placeholder="Votre date de naissance ?" required type="date" />
                            <input value="'.$row->telephone.'" name="telephone" placeholder="Votre numéro de téléphone ?" required type="text" />
                            <input value=" '.$row->email.'" name="email" placeholder="Votre adresse mail ?" required type="email" />
                            <input value=" '.$row->filiere.'" name="filiere" placeholder="Votre Filière ?" required type="text" />
                            <input value=" '.$row->id.'" name="id" type="hidden" />
                            <input value="Enrégistrer" name="update" class="btn btn-success" type="submit" />
                        </form>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    
                    </div>
                </div>
                </div>
            </div>
            
            
            ';

            echo'
                <div class="modal fade " id="staticBackdropD'.$row->id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabelD'.$row->id.'">Modifier Etudiant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Etes vous sur de vouloir supprimer cet étudiant? </br>
                        <span class="danger">Cette action est irréversible</span>
                        <form action="#" method="POST">
                            <input value=" '.$row->id.'" name="id" type="hidden" />
                            <input value="Supprimer" name="delete" class="btn btn-danger" type="submit" />
                        </form>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    
                    </div>
                </div>
                </div>
            </div>
            
            
            ';
                   
    }

    $table = $wpdb->prefix."inscription";

    if(isset($_POST['update']) && isset($_POST['nom']) && isset($_POST['prenom']) && 
        isset($_POST['datenaiss'])  && isset($_POST['telephone'])
        && isset($_POST['email']) && isset($_POST['filiere'])){
            $data=array(
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'datenaiss' => $_POST['datenaiss'],
                    'telephone' => $_POST['telephone'],
                    'email' => $_POST['email'],
                    'filiere' => $_POST['filiere'] );
            $where_condition=array('id' => $_POST['id'] );
            $wpdb->update($table, $data, $where_condition);
            echo'<script>window.location.reload()</script>';
        }

    if(isset($_POST['delete'])){
        // echo'<script>alert("OK")</script>';
        $where_condition=array('id' => $_POST['id'] );
        $wpdb->delete($table, $where_condition);
        echo'<script>window.location.reload()</script>';
    }
        

        echo'
        </tbody>
            
        </table>
      
        </div>

        
        </body>
        </html>
        
        ';
    }

}


new StudentManager();

class StudentForm extends WP_Widget {
    public function __construct(){
        parent::__construct('idStudentForm','IPNET INSCRIPTION',array('description'=>'Un formulaire d\'inscription'));
    }

    public function widget($args,$instance){
        echo '
        <form action="#" method="POST">
            <input value="" name="nom" placeholder="Votre nom ?" required type="text" />
            <input value="" name="prenom" placeholder="Votre Prénom ?" required type="text" />
            <input value="" name="datenaiss" placeholder="Votre date de naissance ?" required type="date" />
            <input value="" name="telephone" placeholder="Votre numéro de téléphone ?" required type="text" />
            <input value="" name="email" placeholder="Votre adresse mail ?" required type="email" />
            <input value="" name="filiere" placeholder="Votre Filière ?" required type="text" />
            <input value="Envoyer" name="submit" type="submit" />
        </form>
        ';

        global $wpdb;
        $table = $wpdb->prefix."inscription";

        if(isset($_POST['nom']) && isset($_POST['prenom']) && 
        isset($_POST['datenaiss'])  && isset($_POST['telephone'])
        && isset($_POST['email']) && isset($_POST['filiere'])){
            $wpdb->insert($table, array(
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'datenaiss' => $_POST['datenaiss'],
                'telephone' => $_POST['telephone'],
                'email' => $_POST['email'],
                'filiere' => $_POST['filiere'] )
            );
            echo '<div style="background-color:#ccc;color:#fff"> Votre demande a été bien enregistrée.! </div>';
        }
    }
   
    public function form($instance){
        echo "Formulaire de demande d'inscription.";
    }

}

new StudentForm();

function declarerWidget(){
    register_widget('StudentForm');
}

register_activation_hook(__FILE__,array('StudentManager','install'));
register_uninstall_hook(__FILE__,array('StudentManager','uninstall'));
add_action('widgets_init','declarerWidget');