<?php
namespace Pg\GsbFraisBundle\Controller;
require_once("include/fct.inc.php");
//require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use PdoGsb;
class HistoriqueController extends Controller
{
    public function indexAction()
    {
        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $Historique= $pdo->getHistorique($login, $mdp);

            return $this->render('PgGsbFraisBundle:Historique:Historique.html.twig', array(
                    'Historique'=>$Historique));
            
        
        }
    }