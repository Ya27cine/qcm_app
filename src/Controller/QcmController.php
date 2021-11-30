<?php

namespace App\Controller;

use App\Entity\Qcm;
use App\Form\QcmType;
use App\Repository\QcmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/qcm")
 */
class QcmController extends AbstractController
{
    /**
     * @Route("/", name="qcm_index", methods={"GET"})
     */
    public function index(QcmRepository $qcmRepository): Response
    {
        return $this->render('qcm/index.html.twig', [
            'qcms' => $qcmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="qcm_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $qcm = new Qcm();
        $form = $this->createForm(QcmType::class, $qcm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($qcm);
            $entityManager->flush();

            return $this->redirectToRoute('qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('qcm/new.html.twig', [
            'qcm' => $qcm,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="qcm_show", methods={"GET"})
     */
    public function show(Qcm $qcm): Response
    {
        return $this->render('qcm/show.html.twig', [
            'qcm' => $qcm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="qcm_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Qcm $qcm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QcmType::class, $qcm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('qcm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('qcm/edit.html.twig', [
            'qcm' => $qcm,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="qcm_delete", methods={"POST"})
     */
    public function delete(Request $request, Qcm $qcm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qcm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($qcm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('qcm_index', [], Response::HTTP_SEE_OTHER);
    }
}
