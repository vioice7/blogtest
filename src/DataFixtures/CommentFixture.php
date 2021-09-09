<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use bjoernffm\Spintax\Parser;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixture extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(100, 'main_comments', function(){

            $comment = new Comment();

            $comment->setAuthorName(Parser::parse('{Tech|Timo|Time} {Aim|Aimo|Aime}')->generate());
            
            $comment->setContent(Parser::parse('Laboris beef {ribs|test|aim|thing} fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
            laboris sunt venison, et {laborum|liborume|tastio|aimeo|eteco} dolore minim non meatball.')->generate());
            
            $comment->setCreatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));

            $comment->setIsDeleted((bool)random_int(0, 1));
            
            // $comment->setArticle($this->getReference(Article::class.'_'.rand(0, 9)));   
            
            $comment->setArticle($this->getRandomReference('main_articles'));

            return $comment;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class
        ];
    }
}
