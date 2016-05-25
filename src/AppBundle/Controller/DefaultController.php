<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $var = "DATA";
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

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
          'variable' => $var,
          'tables' => $tab,
          'produit' => $product
        ]);
    }

}
