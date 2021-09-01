<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em)
    {
        $article = new Article();


        $rand = rand(0, 10000);
        $article->setTitle('Why Asteroids Taste Like Bacon')
            ->setSlug('why-asteroids-taste-like-bacon'.$rand)
            ->setContent('test '.$rand);

        // publish most articles
        if (rand(1, 10) > 2) {
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        }

        $em->persist($article);
        $em->flush();

        return new Response(
            'article created ' . $article->getId() . ' url ' . $article->getSlug()
        );
    }
}