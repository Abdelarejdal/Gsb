<?php

// src/OC/PlatformBundle/Entity/Application.php


namespace Pg\GsbFraisBundle\Form;



class Advert

{

  private $id;
  private $author;
  private $content;
  private $date;

  

  public function __construct()

  {

    $this->date = new \Datetime();

  }

  public function getId()

  {

    return $this->id;

  }


  public function setAuthor($author)

  {

    $this->author = $author;


    return $this;

  }


  public function getAuthor()

  {

    return $this->author;

  }


  public function setContent($content)

  {

    $this->content = $content;


    return $this;

  }


  public function getContent()

  {

    return $this->content;

  }


  public function setDate($date)

  {

    $this->date = $date;


    return $this;

  }


  public function getDate()

  {

    return $this->date;

  }

}