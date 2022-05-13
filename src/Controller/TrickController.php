<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/tricks", name="tricks")
     */
    public function index(): Response
    {
        $tricks = $this->entityManager->getRepository(Trick::class)->findAll();

        return $this->render('trick/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    /**
     * @Route("/trick/{slug}", name="trick")
     */
    public function show($slug, Request $request): Response
    {
        $trick = $this->entityManager->getRepository(Trick::class)->findOneBy(['slug' => $slug]);
        $author = $this->entityManager->getRepository(User::class)->findOneBy(['id' => 1]);
        $notification = null;

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$comment->getId()) {
                $comment->setCreatedAt(new \DateTimeImmutable());
                $comment->setTricks($trick);
                $comment->setAuthor($author);
                //dd($form);
            }

            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            $notification = 'Votre commentaire a bien été enregistré';
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);

            return $this->render('trick/show.html.twig', [
                'trick' => $trick,
                'formComment' => $form->createView()
            ]);
        }

        if (!$trick) {
            return $this->redirectToRoute('tricks');
        }

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'formComment' => $form->createView()
        ]);
    }

}
