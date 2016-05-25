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
        $var = "mazloum";
        $tab = ['toto', 'tata', 'titi'];
        $product = [
          0 => [
            'name' => 'Popo',
            'codeProduct' => 'pagepopo',
            'price' => 22,
          ],
          1 =>[
            'name' => 'Pepe',
            'codeProduct' => 'pagepepe',
            'price' => 75,
          ],
        ];

        $article = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
        ->findAll();

        if (!$article) {
          throw $this->createNotFoundException(
          'No product found for id '.$id
          );
        }


        // replace this example code with whatever you need
        return $this->render('posts/index.html.twig', [
          'articles' => $article,
          'variable' => $var,
          'tables' => $tab,
          'produit' => $product
        ]);
    }
}
