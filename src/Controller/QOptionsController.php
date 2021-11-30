<?php

namespace App\Controller;

use App\Entity\QOptions;
use App\Form\QOptionsType;
use App\Repository\QOptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/q/options")
 */
class QOptionsController extends AbstractController
{
    /**
     * @Route("/", name="q_options_index", methods={"GET"})
     */
    public function index(QOptionsRepository $qOptionsRepository): Response
    {
        return $this->render('q_options/index.html.twig', [
            'q_options' => $qOptionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="q_options_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $qOption = new QOptions();
        $form = $this->createForm(QOptionsType::class, $qOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($qOption);
            $entityManager->flush();

            return $this->redirectToRoute('q_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('q_options/new.html.twig', [
            'q_option' => $qOption,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="q_options_show", methods={"GET"})
     */
    public function show(QOptions $qOption): Response
    {
        return $this->render('q_options/show.html.twig', [
            'q_option' => $qOption,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="q_options_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, QOptions $qOption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QOptionsType::class, $qOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('q_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('q_options/edit.html.twig', [
            'q_option' => $qOption,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="q_options_delete", methods={"POST"})
     */
    public function delete(Request $request, QOptions $qOption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qOption->getId(), $request->request->get('_token'))) {
            $entityManager->remove($qOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('q_options_index', [], Response::HTTP_SEE_OTHER);
    }
}
