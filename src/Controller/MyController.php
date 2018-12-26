<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{
    /**
     * @Route("/my", name="my")
     */
     public $prop1 = "I'm a class property!";

     public function __construct()
  {
      echo 'The class "', __CLASS__, '" was initiated!<br />';
  }

  public function __destruct()
  {
      echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }
  /**
   * @Route("/my/string", name="tostring")
   */
  public function __toString()
  {
      echo "Using the toString method: ";
      return $this->getProperty();
  }
    public function index()
    {

        return $this->render('my/index.html.twig', [
            'controller_name' => 'MyController',
        ]);
    }

    public function getProperty()
  {
      return $this->render('my/index.html.twig', [
          'TheBug' => $this->prop1,
          'controller_name' => 'MyController',
      ]);
  }
}
