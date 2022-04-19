<?php

namespace App\Controller;

use App\Entity\Operations;
use App\Form\OperationsType;
use App\Repository\OperationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @isGranted("ROLE_USER")
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * @Route("/", name="app_operations_index", methods={"GET"})
     */
    public function index(OperationsRepository $operationsRepository): Response
    {
        return $this->render('operations/index.html.twig', [
            'operations' => $operationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_operations_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OperationsRepository $operationsRepository): Response
    {
        $operation = new Operations();
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operationsRepository->add($operation);
            return $this->redirectToRoute('app_operations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('operations/new.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_operations_show", methods={"GET"})
     */
    public function show(Operations $operation): Response
    {
        return $this->render('operations/show.html.twig', [
            'operation' => $operation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_operations_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Operations $operation, OperationsRepository $operationsRepository): Response
    {
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operationsRepository->add($operation);
            return $this->redirectToRoute('app_operations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('operations/edit.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_operations_delete", methods={"POST"})
     */
    public function delete(Request $request, Operations $operation, OperationsRepository $operationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operation->getId(), $request->request->get('_token'))) {
            $operationsRepository->remove($operation);
        }

        return $this->redirectToRoute('app_operations_index', [], Response::HTTP_SEE_OTHER);
    }
}