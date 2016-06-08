<?php

// src/OC/PlatformBundle/Entity/Application.php


namespace Pg\GsbFraisBundle\Form;



class form

{

  private $numImmat;
  private $idVisiteur;
  private $dateDebut;
  private $dateFin;
  private $nomt;
  private $nom;
  private $inter;
  private $ext;
  private $couleur;
  private $modele;



  public function getnumImmat()

  {

    return $this->numImmat;

  }

  public function getcouleur()

  {

    return $this->couleur;

  }

  public function getmodele()

  {

    return $this->modele;

  }
  public function getnom()

  {

    return $this->nom;

  }


  public function getnomt()

  {

    return $this->nomt;

  }

   public function setnom($nom)

  {

    $this->nom = $nom;


    return $this;

  }

 public function setnumImmat($numImmat)

  {

    $this->numImmat = $numImmat;


    return $this;

  }

   public function setcouleur($couleur)

  {

    $this->couleur = $couleur;


    return $this;

  }

   public function setmodele($modele)

  {

    $this->modele = $modele;


    return $this;

  }

 public function setnomt($nomt)

  {

    $this->nomt = $nomt;


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


  public function getdateDebut()

  {

    return $this->dateDebut;

  }

   public function getinter()

  {

    return $this->inter;

  }


  public function setdateDebut($dateDebut)

  {

    $this->dateDebut = $dateDebut->format('Y-m-d');


    return $this;

  }
public function setinter($inter)

  {

    $this->inter = $inter;


    return $this;

  }

  public function getdateFin()

  {

    return $this->dateFin;

  }
 public function getext()

  {

    return $this->ext;

  }

  public function setdateFin($dateFin)

  {

    $this->dateFin = $dateFin->format('Y-m-d');


    return $this;

  }
    public function setext($ext)

  {

    $this->ext = $ext;


    return $this;

  }





}