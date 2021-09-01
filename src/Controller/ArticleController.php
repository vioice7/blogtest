<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Twig\Environment;
use Psr\Log\LoggerInterface;

class ArticleController extends AbstractController
{
    
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(ArticleRepository $repository)
    {
        //homepage(EntityManagerInterface $em)
        //$repository = $em->getRepository(Article::class);

        // $articles = $repository->findAll();

        //$articles = $repository->findBy([], ['publishedAt' => 'DESC']);
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show(
        $slug, Environment $twigEnvironment,
        EntityManagerInterface $em,
        bool $isDebug
        )
    {
        
        // dump($slug, $this);
        // dump($isDebug);die;
        
        $repository = $em->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }
 
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $html = $twigEnvironment->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments,
        ]);

        return new Response($html);

    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart")
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted!');
        // TODO - actually heart/unheart the article!
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

}