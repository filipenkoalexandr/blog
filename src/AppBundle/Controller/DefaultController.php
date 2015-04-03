<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/article/create/", name="article_create")
     */
    public function createAction()
    {
        $article = new Article();
        $article->setAuthor("admin");
        $article->setCategory("Default");
        $article->setTitle("Article" . $article->getId());
        $article->setCreated(new \DateTime());
        $article->setDescription("BlaBlaBla");

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($article);
        $em->flush();

        return new Response('Created product id ' . $article->getId());
    }


    /**
     * @Route("/article/", name="articles_show")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository('AppBundle:Article')
            ->getAdminArticles();
        return $this->render('welcome.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article_show")
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository('AppBundle:Article')
            ->getFullArticle($id);
        return $this->render('article.html.twig', [
            'articles' => $articles
        ]);
    }

}
