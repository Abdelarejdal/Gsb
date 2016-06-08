<?php
namespace Pg\GsbFraisBundle\Controller;
require_once("include/fct.inc.php");
//require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use PdoGsb;
use Symfony\Component\HttpFoundation\Request;


class BicycletteController extends Controller
{
    public function BicycletteAction()
    {
        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        $id =  $session->get('id');
        $pdo = $this->get('pg_gsb_frais.pdo');
        $Bicyclette= $pdo->getbicyclette($id, $login, $mdp);
       
            return $this->render('PgGsbFraisBundle:Bicyclette:Bicyclette.html.twig', array(
                    'Bicyclette'=>$Bicyclette));
            
        
        }
    }