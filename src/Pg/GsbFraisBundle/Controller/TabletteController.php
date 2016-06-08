<?php
namespace Pg\GsbFraisBundle\Controller;
require_once("include/fct.inc.php");
//require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use PdoGsb;
use Symfony\Component\HttpFoundation\Request;


class TabletteController extends Controller
{
    public function TabletteAction()
    {
        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        $id =  $session->get('id');
        $pdo = $this->get('pg_gsb_frais.pdo');
        $tablette= $pdo->gettablette($id, $login, $mdp);
        $intablette= $pdo->getintablette($id, $login, $mdp);
        $extablette= $pdo->getextablette($id, $login, $mdp);
        $nom= $pdo->getnomtablette($id, $login, $mdp);
        $prenom= $pdo->getprenomtablette($id, $login, $mdp);
        $couleur= $pdo->getcouleurtablette($id, $login, $mdp);
        $modele= $pdo->getmodeletablette($id, $login, $mdp);
            return $this->render('PgGsbFraisBundle:Tablette:Tablette.html.twig', array(
                    'tablette'=>$tablette, 'intablette'=>$intablette, 'extablette'=>$extablette, 'nom'=>$nom, 'prenom'=>$prenom, 'couleur'=>$couleur, 'modele'=>$modele));
            
        
        }
    }