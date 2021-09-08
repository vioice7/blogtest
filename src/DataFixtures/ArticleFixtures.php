<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use bjoernffm\Spintax\Parser;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Article::class, 
            10, 
            function(Article $article, $count) use ($manager)
            {

                $rand = rand(0, 10000);
                $article->setTitle(Parser::parse('Why Asteroids Taste Like {Bacon|Cheese|Cream|Caviar|IceCream}')->generate())
                    //->setSlug('why-asteroids-taste-like-something-'.$count)
                    ->setContent(<<<EOF
            Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
            lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
            labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
            **turkey** shank eu pork belly meatball non cupim.

            Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
            laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
            capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
            picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
            occaecat lorem meatball prosciutto quis strip steak.

            Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
            mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
            strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
            cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
            fugiat.
            EOF);

                $article->setAuthor(Parser::parse('{Teco Aim|Test Tec|Element Testing|Echelon Aim}')->generate())
                    ->setHeartCount(rand(5, 100))
                    ->setImageFilename(Parser::parse('{asteroid.jpeg|mercury.jpeg|earth.jpg|lightspeed.png}')->generate())
                ;

                // publish most articles
                if (rand(1, 10) > 2) {
                    $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
                }

                $tags = $this->getRandomReferences(Tag::class, rand(0, 5));

                foreach ($tags as $tag) {
                    $article->addTag($tag);
                }

            });
        
        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            TagFixture::class,
        ];
    }

}
