<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

class PostController extends Controller
{
    /**
     * @Route("/posts", name="app_post_index")
     */
    public function indexAction(Request $request)
    {
        $article = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
        ->findAll();

        if (!$article) {
          throw $this->createNotFoundException(
          'No product found for id '
          );
        }

        return $this->render('posts/index.html.twig', [
          'articles' => $article,
        ]);
    }

    /**
     * @Route("/post/create", name="app_post_create")
     */
    public function CreateAction(Request $request)
    {
      $article = new article();
      $form = $this->createForm(ArticleType::class, $article);

      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneByTitle($form->getData()->getTitle());
        if ($article) {
          exit;
        }

        $em->persist($form->getData());
        $em->flush();
      }

      return $this->render('posts/create.html.twig', [
        'form' => $form -> createView()
      ]);

    }

    /**
     * @Route("/post/view/{id}", name="app_post_view")
     */
    public function ViewAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $article = $em->getRepository('AppBundle:Article')->findOneById($id);

      return $this->render('posts/view.html.twig', [
        'article' => $article
      ]);
    }

    /**
     * @Route("/post/edit/{id}", name="app_post_edit")
     */
    public function EditAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $article = $em->getRepository('AppBundle:Article')->findOneById($id);

      var_dump($article);
      exit;
      $em->remove($product);
$em->flush();
    }

    /**
     * @Route("/post/delete/{id}", name="app_post_delete")
     */
    public function DeleteAction(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $article = $em->getRepository('AppBundle:Article')->findOneById($id);

      $em->remove($article);
      $em->flush();

      return $this->redirectToRoute('app_post_index');
    }
}
