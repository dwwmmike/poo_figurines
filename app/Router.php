<?php
require_once("./app/autoload.php");
class Router{
    private $ctrfig;
    private $ctrca;
    private $ctru;
    private $ctrpub;
    public function __construct(){
        $this->ctrfig = new AdminFigurineController();
        $this->ctrca = new AdminCategorieController();
        $this->ctru = new AdminUtilisateurController();
        $this->ctrpub = new PublicController();
    }
    public function getPath(){
        try{
            if(isset($_GET["action"])){
                switch($_GET["action"]){
                    case "list_fig" :
                        $this->ctrfig->listFigurines();
                        break;
                    case "add_fig" :
                        $this->ctrfig->addFigurine();
                        break;
                    case "delete_fig" :
                        $this->ctrfig->removeFig();
                        break;
                    case "edit_fig" :
                        $this->ctrfig->editFig();
                        break;
                    case "list_cat" :
                        $this->ctrca->listCategories();
                        break;
                    case "add_cat" :
                        $this->ctrca->addCat();
                        break;
                    case "delete_cat" :
                        $this -> ctrca -> removeCat();
                        break;
                    case "edit_cat" :
                        $this->ctrca->editCat();
                        break;
                    case "list_u" :
                        $this->ctru->listUsers(); 
                        break;
                    case "register" :
                        $this->ctru->addUser();
                        break;
                    case "login" :
                        $this->ctru->login();
                        break;
                    case "logout" :
                        AuthController::logout(); // Méthode appelée via la class car méthode statique
                        break;
                    case 'pay': 
                        $this->ctrpub->payment();
                        break;
                    case 'checkout':
                        $this->ctrpub ->recap();
                        break; 
                    case 'order' :
                        $this->ctrpub ->orderFig();
                        break;
                    case 'success': 
                        $this->ctrpub->confirmation();
                        break;
                    case 'cancel': 
                        $this->ctrpub->annuler();
                        break;
                    case 'about': 
                        $this->ctrpub->about();
                        break;
                    case 'contact': 
                        $this->ctrpub->contact();
                        break;
                    case 'conditions': 
                        $this->ctrpub->conditions();
                        break;
                    case 'politique': 
                        $this->ctrpub->politique();
                        break;
                    case 'faq': 
                        $this->ctrpub->faq();
                        break;
                    case 'sended': 
                        $this->ctrpub->sended();
                        break;
                    default:
                        throw new Exception('Action non définie');
                }
            }
            else{
                $this->ctrpub->getPubFigurines();
            }
            
        }
        catch (Exception $e) {
            $this->page404($e->getMessage());
        }
    }
    private function page404($errorMsg){
        require_once('./views/public/404.php');
    }
}
?>