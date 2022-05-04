<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{

    private $entitymanager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entitymanager = $entityManager;
    }

    /**
     * @Route("/tricks", name="tricks")
     */
    public function index(): Response
    {
        $tricks = $this->entitymanager->getRepository(Trick::class)->findAll();

        return $this->render('trick/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    /**
     * @Route("/trick/{slug}", name="trick")
     */
    public function show($slug): Response
    {
        $trick = $this->entitymanager->getRepository(Trick::class)->findOneBy(['slug' => $slug]);

        //dd($trick);

        if(!$trick) {
            return $this->redirectToRoute('tricks');
        }

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
        ]);
    }

}
