<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController
{
    
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('TEST');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response(
            sprintf(
                'Test: %s',
                $slug
            )
        );
    }
}