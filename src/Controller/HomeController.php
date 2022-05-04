<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entitymanager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entitymanager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $tricks = $this->entitymanager->getRepository(Trick::class)->findBy(array(),null,3);

        $last = $this->entitymanager->getRepository(Trick::class)->findOneBy([], ['id' => 'desc']);

        return $this->render('home/index.html.twig', [
            'tricks' => $tricks,
            'last' => $last
        ]);
    }
}