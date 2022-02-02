<?php
session_start();
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class PublicController{

    private $pubfigm;
    private $pubcm;
    private $pubm;

    public function __construct()
    {
        $this->pubfigm = new AdminFigurineModel();
        $this->pubcm = new AdminCategorieModel();
        $this->pubm = new PublicModel();

    }

    public function getPubFigurines(){
        if(isset($_GET['id']) && !empty($_GET['id'])){

            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $figurines = $this->pubfigm->getFigurines($search);
                require_once('./views/public/accueil.php');
            }
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $f = new Figurine();
            $f->getCategorie()->setId_cat($id);
            $tabCat = $this->pubcm->getCategories();
            $figurines = $this->pubm->findFigurinesByCat($f);
            require_once('./views/public/figurinesCat.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $figurines = $this->pubfigm->getFigurines($search);
                require_once('./views/public/accueil.php');
            }
            $tabCat = $this->pubcm->getCategories();
            $figurines = $this->pubfigm->getFigurines();

        require_once('./views/public/accueil.php');
        }
    }

    public function recap(){

        if(isset($_POST['envoi']) && !empty($_POST['nom']) && !empty($_POST['prix'])){
            $id = htmlspecialchars(addslashes($_POST['id']));
            $nom = htmlspecialchars(addslashes($_POST['nom']));
            $taille = htmlspecialchars(addslashes($_POST['taille']));
            $image = htmlspecialchars(addslashes($_POST['image']));
            $prix = htmlspecialchars(addslashes($_POST['prix']));
            $nb = htmlspecialchars(addslashes($_POST['quantite']));

            require_once('./views/public/figurineItem.php');
        }
    }

    public function orderFig(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if(isset($_POST['submit'])){
                $id = addslashes(htmlspecialchars($_GET['id']));
                $email = addslashes(htmlspecialchars($_POST['email']));
                $objet= addslashes(htmlspecialchars($_POST['objet']));
                $message = addslashes(htmlspecialchars($_POST['message']));
                $messageClient = "
                    <h2>Message de client</h2>
                    <div>
                    <p>Message de $email:</p>
                    <p>$message</p>
                    </div>
                ";
                $messageConf = "
                    <h2>Confirmation d'envoie email</h2>
                    <div>
                    <p>Nous vous remercions pour votre message.</p>
                    </div>
                ";
                $this->sendMail($email, 'Confirmation envoie email', $messageConf);
                $this->sendMail('dwwmmike@gmail.com', $objet, $messageClient, $email);
                $this->sended(); 
            }
            
            require_once('./views/public/orderForm.php');
            
        }
    }
    public function sendMail($email, $objet, $message, $emailFrom = 'dwwmmike@gmail.com', $emailFromName = 'Figurama'){
        $mail = new PHPMailer(true); 
        try {                    
            $mail->isSMTP();  
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'dwwmmike@gmail.com';                     
            $mail->Password   = 'dwwm2020';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                               

            $mail->setFrom($emailFrom, $emailFromName);
            $mail->addAddress("$email","$objet","$message", 'Mr/Mme');     

            $mail->isHTML(true);                                  
            $mail->Subject = $objet;
            $mail->Body    = $message;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        } 
    }

    public function payment(){
        if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['quantite'])){
         \Stripe\Stripe::setApiKey('sk_test_51IM8ZTHlq7zZEqVgK2dLM0PztZLbGTAKRkJLqWASDVctfiHv0zL0J5BSmBmUZBbNM39nnmqWmdnHSBcbwWgd4WEu00Z7Y2fcaE');
         header('Content-Type: application/json');
         $checkout_session = \Stripe\Checkout\Session::create([
         'payment_method_types' => ['card'],
         'line_items' => [[
             'price_data' => [
             'currency' => 'eur',
             'unit_amount' => $_POST['prix']*100,
             'product_data' => [
                 'name' => $_POST['nom']."-".$_POST['taille'],
             ],
             ],
             'quantity' => $_POST['quantite'],
         ]],
         'customer_email'=> $_POST['email'],
         'mode' => 'payment',
         'success_url' => 'http://localhost:8888/php/apps/figurines/index.php?action=success',
         'cancel_url' => 'http://localhost:8888/php/apps/figurines/index.php?action=cancel',
         ]);
         $_SESSION['pay'] = $_POST;
         echo json_encode(['id' => $checkout_session->id]);
        }
    }
    public function confirmation() {
        $newStock = ((int)$_SESSION['pay']['nb']) - ((int)$_SESSION['pay']['quantite']);
        $figurine = new Figurine();
        $figurine->setId_fig($_SESSION['pay']['id']);
        $figurine->setQuantite($newStock);

        $nbLine = $this->pubm->updateStock($figurine);

        if($nbLine > 0 ){
            $email = $_SESSION['pay']['email'];
            $nom = $_SESSION['pay']['nom'];
            $taille = $_SESSION['pay']['taille'];
            $prix = $_SESSION['pay']['prix'];
            $mail = new PHPMailer(true);

            try {                      
                $mail->isSMTP();                                      
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'dwwmmike@gmail.com';                     
                $mail->Password   = 'dwwm2020';                               
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    

                $mail->setFrom('dwwmmike@gmail.com', 'Figurama');
                $mail->addAddress("$email");

                $mail->isHTML(true);                                  
                $mail->Subject = 'Confirmation no-reply';
                $mail->Body    = "
                    <h2>Confirmation d'achat</h2>
                    <div>
                     <b>Nom:  </b>".$nom." ,
                     <b>Taille:  </b>".$taille." cm ,
                     <b>Prix:  </b>".$prix." €.
                     <p>Nous vous remercions pour votre achat.</p>
                    </div>
                ";

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        require_once('./views/public/success.php');
    }
    public function annuler() {
       require_once('./views/public/cancel.php');
    }
    public function about() {
        require_once('./views/public/about.php');
    }
    public function contact() {

        if(isset($_POST['submit'])) {
            $emailFrom = addslashes(htmlspecialchars($_POST['email']));
            $message = addslashes(htmlspecialchars($_POST['message']));
            $nom = addslashes(htmlspecialchars($_POST['nom']));
            $prenom = addslashes(htmlspecialchars($_POST['prenom']));
            $telephone = addslashes(htmlspecialchars($_POST['tel']));
            $adresse = addslashes(htmlspecialchars($_POST['adresse']));
            $emailFromName = $nom.' '.$prenom;
            $messageClient = "
                    <h2>Message de client</h2>
                    <div>
                    <p>Message de $nom $prenom $emailFrom:</p>
                    <p>$message</p>
                    <p>$telephone</p>
                    <p>$adresse</p>
                    </div>
                ";
            $this->sendMail('dwwmmike@gmail.com', 'Contact', $messageClient, $emailFrom, $emailFromName);
            $this->sended();   
        }
        require_once('./views/public/contact.php');
    }
    public function faq() {
        require_once('./views/public/faq.php');
    }
     public function politique() {
        require_once('./views/public/politique.php');
    }
    public function conditions() {
        require_once('./views/public/conditions.php');
    }
    public function sended(){
        require_once('./views/public/send.php');

    }
}
?>