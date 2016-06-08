<?php

// src/OC/PlatformBundle/Entity/Application.php


namespace Pg\GsbFraisBundle\Form;



class formAjout

{

  private $numImmat;
  private $marque;
  private $modele;
  private $couleur;
  private $nomt;
  private $inter;
  private $ext;
  



  public function getnumImmat()

  {

    return $this->numImmat;

  }
 public function getnomt()

  {

    return $this->nomt;

  }

   public function setnomt($nomt)

  {

    $this->nomt = $nomt;


    return $this;

  }

    public function getinter()

  {

    return $this->inter;

  }

  public function setinter($inter)

  {

    $this->inter = $inter;


    return $this;

  }

   public function getext()

  {

    return $this->ext;

  }

 public function setext($ext)

  {

    $this->ext = $ext;


    return $this;

  }
   public function getidVisiteur()

  {

    return $this->idVisiteur;

  }

  public function setidVisiteur($idVisiteur)

  {

    $this->idVisiteur = $idVisiteur;


    return $this;

  }


 public function setnumImmat($numImmat)

  {

    $this->numImmat = $numImmat;


    return $this;

  }

  public function getMarque()

  {

    return $this->marque;

  }

  public function setMarque($marque)

  {

    $this->marque = $marque;


    return $this;

  }


  public function getModele()

  {

    return $this->modele;

  }


  public function setModele($modele)

  {

    $this->modele = $modele;


    return $this;

  }


  public function getCouleur()

  {

    return $this->couleur;

  }


  public function setCouleur($couleur)

  {

    $this->couleur = $couleur;


    return $this;

  }




}