<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Tweet;
use App\Form\TweetSend;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class WritePostController extends AbstractController
{
    /**
     * @Route("/write/post", name="write_post")
     */
    public function index()
    {
        return $this->render('write_post/index.html.twig', [
            'controller_name' => 'WritePostController',
        ]);
    }
    /**
     * @Route("/write/postnew", name="write_postnew")
     */
    public function newpost(Request $request)
    {
      $tweet = new Tweet();
      //I put some dummy content into the entity
        $tweet->setMessage('Your post comes here...');

        $form=$this->createForm(TweetSend::class,$tweet);
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$tweet` variable has also been updated
        $tweet = $form->getData();
        $tweet->setOwner('1'); // temporarly all of the posts will be owned by 'user 1'
        $now=new DateTime(time());
        $tweet->setDate($now); // temporarly all of the posts will be owned by 'user 1'


        // saving the tweet to the database
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($tweet);
         $entityManager->flush();

        return $this->redirectToRoute('task_success');
    }
        return $this->render('write_post/index.html.twig', array(
            'form' => $form->createView(),));
    }
}
