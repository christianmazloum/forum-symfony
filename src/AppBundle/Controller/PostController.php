<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class PostController extends Controller
{
    /**
     * @Route("/posts", name="app_post_list")
     */
    public function indexAction(Request $request)
    {
        $article = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
        ->findAll();

        if (!$article) {
          throw $this->createNotFoundException(
          'No product found for id '.$id
          );
        }

        return $this->render('posts/index.html.twig', [
          'articles' => $article,
        ]);
    }
}
