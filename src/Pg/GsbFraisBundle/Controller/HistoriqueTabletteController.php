<?php
namespace Pg\GsbFraisBundle\Controller;
require_once("include/fct.inc.php");
//require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
//use PdoGsb;
use Symfony\Component\HttpFoundation\Request;


class HtabletteController extends Controller
{
    public function HtabletteAction()
    {
        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        $id =  $session->get('id');
        $pdo = $this->get('pg_gsb_frais.pdo');
        $htablette= $pdo->gethtablette($id, $login, $mdp);
        $hintablette= $pdo->gethintablette($id, $login, $mdp);
        $hextablette= $pdo->gethextablette($id, $login, $mdp);
        $hnom= $pdo->gethnomtablette($id, $login, $mdp);
        $hprenom= $pdo->gethprenomtablette($id, $login, $mdp);
            return $this->render('PgGsbFraisBundle:Htablette:Htablette.html.twig', array(
                    'htablette'=>$htablette, 'hintablette'=>$hintablette, 'hextablette'=>$hextablette, 'hnom'=>$hnom, 'hprenom'=>$hprenom));
            
        
        }
    }