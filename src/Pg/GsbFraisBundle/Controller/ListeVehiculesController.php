<?php
namespace Pg\GsbFraisBundle\Controller;
require_once("include/fct.inc.php");
//require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use PdoGsb;
class ListeVehiculesController extends Controller
{
    public function indexAction()
    {
        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        $id =  $session->get('id');
        $pdo = $this->get('pg_gsb_frais.pdo');
         $Listevehicules= $pdo->getListeVehicules($id);
     /* $refvisiteur = $ListeVehiculesVisiteurs['refvisiteur'];
       $immat = $ListeVehiculesVisiteurs['immat'];
       $marque = $ListeVehiculesVisiteurs['marque'];
       $couleur = $ListeVehiculesVisiteurs['couleur'];*/
            return $this->render('PgGsbFraisBundle:ListeVehicules:ListeVehicules.html.twig', array(
                    'Listevehicules'=>$Listevehicules));
            
        
        }
    }