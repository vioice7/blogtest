<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use bjoernffm\Spintax\Parser;

class UserFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) {
            $user = new User();
            
            $email0 = Parser::parse('{technostructure|technologically|technicalizing|technicalities|technologizing|technological|technologists|technologized|technologizes|technophobias|technobabbles|technocracies|technicalized|technicalizes|technologist|technicality|technophobia|technobabble|technologize|technetronic|technocratic|technicalize|technologies|technophobes|technophiles|technophobic|tectonically|technocracy|technophile|technophobe|technologic|technocrats|technicians|technically|technetiums|technology|technician|technetium|technocrat|techniques|technicals|technopops|tectonisms|technical|technique|tectonics|tectonism|tectorial|tectrices|technopop|tectonic|tectites|techiest|technics|technic|tectrix|tectums|tectite|techier|techies|techily|technos|techno|teched|techie|tectum|tectal|techy|tecta|techs|tech}')->generate();
            $email1 = Parser::parse('{technostructure|technologically|technicalizing|technicalities|technologizing|technological|technologists|technologized|technologizes|technophobias|technobabbles|technocracies|technicalized|technicalizes|technologist|technicality|technophobia|technobabble|technologize|technetronic|technocratic|technicalize|technologies|technophobes|technophiles|technophobic|tectonically|technocracy|technophile|technophobe|technologic|technocrats|technicians|technically|technetiums|technology|technician|technetium|technocrat|techniques|technicals|technopops|tectonisms|technical|technique|tectonics|tectonism|tectorial|tectrices|technopop|tectonic|tectites|techiest|technics|technic|tectrix|tectums|tectite|techier|techies|techily|technos|techno|teched|techie|tectum|tectal|techy|tecta|techs|tech}')->generate();
            
            $name01 = ucfirst($email0) . ' ' . ucfirst($email1);

            $user->setEmail($email0.$i.'@'.$email1.'.com');

            $user->setFirstName($name01);
            
            return $user;
        });
        $manager->flush();
    }
}
