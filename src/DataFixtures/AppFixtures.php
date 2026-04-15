<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipPart;
use App\Entity\StarshipStatusEnum;
use App\Factory\DroidFactory;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ship1 = new Starship();
        $ship1->setName('USS LeafyCruiser (NCC-0001)');
        $ship1->setClass('Garden');
        $ship1->setCaptain('Jean-Luc Pickles');
        $ship1->setStatus(StarshipStatusEnum::IN_PROGRESS);
        $ship1->setArrivedAt(new \DateTimeImmutable('-1 day'));

        $ship2 = new Starship();
        $ship2->setName('USS Espresso (NCC-1234-C)');
        $ship2->setClass('Latte');
        $ship2->setCaptain('James T. Quick!');
        $ship2->setStatus(StarshipStatusEnum::COMPLETED);
        $ship2->setArrivedAt(new \DateTimeImmutable('-1 week'));

        $ship3 = new Starship();
        $ship3->setName('USS Wanderlust (NCC-2024-W)');
        $ship3->setClass('Delta Tourist');
        $ship3->setCaptain('Kathryn Journeyway');
        $ship3->setStatus(StarshipStatusEnum::WAITING);
        $ship3->setArrivedAt(new \DateTimeImmutable('-1 month'));

        $manager->persist($ship1);
        $manager->persist($ship2);
        $manager->persist($ship3);

        $manager->flush();

        $starship = StarshipFactory::createOne()->_real();
        $part1 = new StarshipPart();
        $part1->setName('Warp Core');
        $part1->setPrice(1000);
        $part2 = new StarshipPart();
        $part2->setName('Phaser Array');
        $part2->setPrice(500);
        $manager->persist($part1);
        $manager->persist($part2);
        $manager->flush();
        StarshipFactory::createOne([
            'name' => 'USS LeafyCruiser (NCC-0001)',
            'class' => 'Garden',
            'captain' => 'Jean-Luc Pickles',
            'status' => StarshipStatusEnum::IN_PROGRESS,
            'arrivedAt' => new \DateTimeImmutable('-1 day'),
        ]);
        StarshipFactory::createOne([
            'name' => 'USS Espresso (NCC-1234-C)',
            'class' => 'Latte',
            'captain' => 'James T. Quick!',
            'status' => StarshipStatusEnum::COMPLETED,
            'arrivedAt' => new \DateTimeImmutable('-1 week'),
        ]);
        $ship = StarshipFactory::createOne([
            'name' => 'USS Wanderlust (NCC-2024-W)',
            'class' => 'Delta Tourist',
            'captain' => 'Kathryn Journeyway',
            'status' => StarshipStatusEnum::WAITING,
            'arrivedAt' => new \DateTimeImmutable('-1 month'),
        ]);
        StarshipFactory::createMany(20);
        StarshipPartFactory::createMany(100);
    }
}
