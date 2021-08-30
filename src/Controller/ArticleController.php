<?php

namespace App\Controller;

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
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }


    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, Environment $twigEnvironment)
    {
        
        // dump($slug, $this);
        
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $html = $twigEnvironment->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
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