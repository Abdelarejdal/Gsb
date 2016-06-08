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