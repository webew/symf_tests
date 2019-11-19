<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function index(EventRepository $eventRepository)
    {
        $events = $eventRepository->findAll();
        return $this->render('app/index.html.twig', compact('events'));
    }
}
