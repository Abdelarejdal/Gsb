<?php
namespace Pg\GsbFraisBundle\Controller;

require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use PdoGsb;
use Pg\GsbFraisBundle\Form\form;
use Pg\GsbFraisBundle\Form\formAjout;


class ImmatController extends Controller
{
    public function indexAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');
    
        
         
         $Role= $pdo->getRole($id);
         
         $Role = $Role[0];
     /* $idVisiteur = $ListeVehiculesVisiteurs['idVisiteur'];
       $immat = $ListeVehiculesVisiteurs['immat'];
       $marque = $ListeVehiculesVisiteurs['marque'];
       $couleur = $ListeVehiculesVisiteurs['couleur'];*/

       $test = $pdo->gettest();
    // On crée un objet Advert

    $advert = new form();

    // On crée le FormBuilder grâce au service form factory


    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire



    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
          
            
           
        }


            



  
   $Listevehicules= $pdo->getListeVehicules($id);

            return $this->render('PgGsbFraisBundle:Immat:ListeVehicules.html.twig', array(
                    'Listevehicules'=>$Listevehicules, 'test' => $test,
                    ));
            
        
      

    
}


 public function vehiculesAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');
    
        
         
         $Role= $pdo->getRole($id);
         
         $Role = $Role[0];
     /* $refvisiteur = $ListeVehiculesVisiteurs['refvisiteur'];
       $immat = $ListeVehiculesVisiteurs['immat'];
       $marque = $ListeVehiculesVisiteurs['marque'];
       $couleur = $ListeVehiculesVisiteurs['couleur'];*/

       $test = $pdo->gettest();
    // On crée un objet Advert

    $advert = new form();

    // On crée le FormBuilder grâce au service form factory


    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

 


    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
      
            
           
        }


            



  
   $ListeVehiculesVisiteurs= $pdo->getTouslesvehicules();

            return $this->render('PgGsbFraisBundle:Immat:Touslesvehicules.html.twig', array(
                    'Listevehicules'=>$Listevehicules, 'test' => $test, 
                    ));
            
        
      

    
}

 public function affectationvehiculesAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');

        $Listevehicules= $pdo->getTouslesvehicules();
        $immat= $pdo->getImmat();
        $nom= $pdo->getVisiteur();
        $nomeleve= $pdo->getNom();
        $prenomeleve=$pdo->getPrenom();
        $nomprenom=$pdo->getPrenomNom();
       // var_dump($nomprenom);
      
        $Role= $pdo->getRole($id);
         
        $Role = $Role[0];

        $test = $pdo->gettest();
   
    // On crée un objet Advert
        $i="";
        $e="";
        $inc= 0;

        $arrayName = array();

        foreach ($nomprenom as $i) {

          $e= $i[0] ." ".$i[1];
         $inc = $inc + 1;
         $arrayName[]= $e;
        }

         //var_dump($arrayName);

       $eleveetnom="";

foreach (array_combine($nomeleve, $prenomeleve) as $nomeleve =>$prenomeleve )
{
 $eleveetnom=$nomeleve." ".$prenomeleve.",";

 // var_dump($eleveetnom);
  //$arrayName = array('eleveetnom' => $eleveetnom );

}
//var_dump($arrayName);

$personne = explode(',', $eleveetnom, -1);



    $advert = new form();

    // On crée le FormBuilder grâce au service form factory

    $formBuilder = $this->get('form.factory')->createBuilder('form', $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire

    $formBuilder
      ->add('numImmat',      'choice', array('label' => 'Immat :', 'choices'=> $immat))
      ->add('idVisiteur',   'choice', array('label' => 'Visiteur :', 'choices'=> $arrayName))
      ->add('dateDebut',    'date', array('label' => 'Date de début :'))
      ->add('dateFin',      'date', array('label' => 'Date de Fin :'))
      ->add('Save',      'submit')

    ;

    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

    $form = $formBuilder->getForm();

    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            


            $numI = $advert->getnumImmat();
            $idV = $advert->getidVisiteur();
            $dateDebut = $advert->getDateDebut();
            $dateFin = $advert->getDateFin();
            $idnumImmat = $immat[$numI];
            $idVisiteur = $visiteur[$idV];
            $affectation = $pdo->Affectationvehicule($idnumImmat, $idVisiteur, $dateDebut, $dateFin);
        
            
             if ($form->isValid()) 
            {
              return $this->redirect($this->generateUrl('pg_gsb_frais_affectationvehicules'));
            } 


        }


            



  


            return $this->render('PgGsbFraisBundle:Immat:affectationvehicules.html.twig', array(
                    'Listevehicules'=>$Listevehicules, 'test' => $test, 'form' => $form->createView(),
                    ));
            
        
      

    
}



 public function ajoutvehiculesAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');

   $Listevehicules= $pdo->getInfosvehicules();
   //var_dump($ListeVehiculesVisiteurs);


    $advert = new formAjout();

    // On crée le FormBuilder grâce au service form factory

    $formBuilder = $this->get('form.factory')->createBuilder('form', $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire

    $formBuilder
      ->add('numImmat',      'text', array('label' => 'Immat  :'))
      ->add('marque',   'text', array('label' => 'Marque :'))
      ->add('modele',    'text', array('label' => 'Modèle  :'))
      ->add('couleur',      'text', array('label' => 'Couleur :'))
      ->add('valider',   'submit')

    ;

    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

    $form = $formBuilder->getForm();


    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            


            $numImmat = $advert->getnumImmat();
            $marque = $advert->getMarque();
            $modele = $advert->getModele();
            $couleur = $advert->getCouleur();
            $add = $pdo->Addvehicule($numImmat, $marque, $modele, $couleur);
        
            
             if ($form->isValid()) 
            {
              return $this->redirect($this->generateUrl('pg_gsb_frais_ajoutvehicules'));
            } 


        }


    

            return $this->render('PgGsbFraisBundle:Immat:ajoutvehicules.html.twig', array(
                   'Listevehicules'=>$Listevehicules, 'form' => $form->createView(),
                    ));
            
        
      

    
}

 public function affectationtabletteAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');

        $htablette= $pdo->gethtablette($id, $login, $mdp);
        $inter= $pdo->gethintablette($id, $login, $mdp);
        $visiteur= $pdo->getVisiteur($id, $login, $mdp);
        $exter= $pdo->gethextablette($id, $login, $mdp);
        $nomelevee= $pdo->gethnomtablette($id, $login, $mdp);
        $prenomelevee=$pdo->gethprenomtablette($id, $login, $mdp);
        $prenomnom=$pdo->getprenomNom();
        $couleur=$pdo->gethcouleurtablette($id, $login, $mdp);
        $modele=$pdo->gethmodeletablette($id, $login, $mdp);
        
       
       // var_dump($nomprenom);
      
        $Role= $pdo->getRole($id);
         
        $Role = $Role[0];

        $Test = $pdo->gettab();
   
    // On crée un objet Advert
        $o="";
        $t="";
        $ina= 0;

        $arrayName = array();

        foreach ($prenomnom as $o) {

         $t= $o[0] ." ".$o[1];
         $ina = $ina + 1;
         $arrayName[]= $t;
        }

         //var_dump($arrayName);

       $eleveenom="";

foreach (array_combine($nomelevee, $prenomelevee) as $nomelevee => $prenomelevee)
{
 $eleveenom=$nomelevee." ".$prenomelevee.",";

 // var_dump($tabnom);
  //$arrayName = array('nom' => $tabnom );

}
//var_dump($arrayName);

$personne = explode(',', $eleveenom, -1);



    $advert = new form();

    // On crée le FormBuilder grâce au service form factory

    $formBuilder = $this->get('form.factory')->createBuilder('form', $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire

    $formBuilder
      ->add('nomt',      'choice', array('label' => 'marque :', 'choices'=> $htablette))
      ->add('nom',   'choice', array('label' => 'Visiteur :', 'choices'=> $arrayName))
      ->add('inter',    'choice', array('label' => 'Mémoire interne :', 'choices'=> $inter))
      ->add('ext',      'choice', array('label' => 'Mémoire externe :', 'choices'=> $exter))
      ->add('couleur',      'choice', array('label' => 'Couleur :', 'choices'=> $couleur))
      ->add('modele',      'choice', array('label' => 'Modele :', 'choices'=> $modele))
      ->add('Save',      'submit')

    ;

    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

    $form = $formBuilder->getForm();

    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            


            $tnom = $advert->getnomt();
            $idV = $advert->getidVisiteur();
            $intE = $advert->getInter();
            $ext = $advert->getext();
            $nomtab= $htablette[$tnom];
            $idVisiteur= $visiteur[$idV];
            $affectation = $pdo->Affectationtablette($nomtab, $externe, $interne, $idVisiteur);
        
            
             if ($form->isValid()) 
            {
              return $this->redirect($this->generateUrl('pg_gsb_frais_affectationtablette'));
            } 


        }

        return $this->render('PgGsbFraisBundle:Immat:affectationtablette.html.twig', array(
                    'htablette'=>$htablette, 'Test' => $Test, 'form' => $form->createView(),
                    ));

}

 public function ajouttabletteAction(Request $request)
    {

        $session= $this->container->get('request')->getSession();
        $login =  $session->get('login');
        $mdp =  $session->get('mdp');
        
        $pdo = $this->get('pg_gsb_frais.pdo');
        $id= $session->get('id');

   $Listetablette= $pdo->getInfostablette();
   //var_dump($ListeVehiculesVisiteurs);


    $advert = new formAjout();

    // On crée le FormBuilder grâce au service form factory

    $formBuilder = $this->get('form.factory')->createBuilder('form', $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire

    $formBuilder
      ->add('nomt',      'text', array('label' => 'nom  :'))
      ->add('ext',   'text', array('label' => 'Mémoire externe :'))
      ->add('inter',    'text', array('label' => 'Mémoire interne  :'))
      ->add('couleur',      'text', array('label' => 'Couleur :'))
      ->add('modele',      'text', array('label' => 'Modele :'))
      ->add('valider',   'submit')

    ;

    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard


    // À partir du formBuilder, on génère le formulaire

    $form = $formBuilder->getForm();


    //    $form = $this->createForm(new testType());
        
        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            


            $nomt = $advert->getnomt();
            $ext = $advert->getext();
            $inter = $advert->getinter();
            $couleur = $advert->getCouleur();
            $modele = $advert->getmodele();
            $add = $pdo->Addtablette($nomt, $ext, $inter, $couleur, $modele);
        
            
             if ($form->isValid()) 
            {
              return $this->redirect($this->generateUrl('pg_gsb_frais_ajouttablette'));
            } 


        }


    

            return $this->render('PgGsbFraisBundle:Immat:ajouttablette.html.twig', array(
                   'Listetablette'=>$Listetablette, 'form' => $form->createView(),
                    ));
            
        
      

    
}
}











