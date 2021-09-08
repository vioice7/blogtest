<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use bjoernffm\Spintax\Parser;

class TagFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Tag::class, 10, function(Tag $tag){
            $tag->setName(Parser::parse('{technostructure|technologically|technicalizing|technicalities|technologizing|technological|technologists|technologized|technologizes|technophobias|technobabbles|technocracies|technicalized|technicalizes|technologist|technicality|technophobia|technobabble|technologize|technetronic|technocratic|technicalize|technologies|technophobes|technophiles|technophobic|tectonically|technocracy|technophile|technophobe|technologic|technocrats|technicians|technically|technetiums|technology|technician|technetium|technocrat|techniques|technicals|technopops|tectonisms|technical|technique|tectonics|tectonism|tectorial|tectrices|technopop|tectonic|tectites|techiest|technics|technic|tectrix|tectums|tectite|techier|techies|techily|technos|techno|teched|techie|tectum|tectal|techy|tecta|techs|tech}')->generate());
        });

        $manager->flush();
    }
}
