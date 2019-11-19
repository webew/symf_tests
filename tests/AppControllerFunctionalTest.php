<?php

namespace App\Tests;

use App\Entity\Event;
use App\Tests\Framework\MyTestCase;

class AppControllerFunctionalTest extends MyTestCase
{
    public function testSomething() :void
    {
        $ev1 = (new Event)
            ->setName("Poppa")
            ->setLocation("Lons")
            ->setPrice(22.00);
        $ev2 = (new Event)
            ->setName("Poppa")
            ->setLocation("Lons")
            ->setPrice(22.00);
        $ev3 = (new Event)
            ->setName("Poppa")
            ->setLocation("Lons")
            ->setPrice(22.00);

        $events = [$ev1, $ev2, $ev3];

        $this->em->persist($ev1);
        $this->em->persist($ev2);
        $this->em->persist($ev3);
        $this->em->flush();

        $this->crawler = $this->client->request('GET', '/app');

        $this->assertResponseIsSuccessful();
        $responseContent = $this->client->getResponse()->getContent();
        $this->assertStringContainsString("3 Events", $responseContent);
        foreach ($events as $event){
            $this->assertStringContainsString($event->getName(), $responseContent);
            $this->assertStringContainsString($event->getLocation(), $responseContent);
            $this->assertStringContainsString($event->getPrice(), $responseContent);
        }
    }

    public function testBeb() :void
    {
        $this->client->request('GET', '/test/');
        $this->assertResponseIsSuccessful();
    }

}
