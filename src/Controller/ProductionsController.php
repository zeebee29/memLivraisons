<?php

namespace App\Controller;

use App\Entity\Productions;
use App\Entity\Produits;
use App\Form\ProductionsType;
use App\Repository\ProductionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/productions')]
class ProductionsController extends AbstractController
{
    #[Route('/', name: 'app_productions_index', methods: ['GET'])]
    public function index(ProductionsRepository $productionsRepository): Response
    {
        return $this->render('productions/index.html.twig', [
            'productions' => $productionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_productions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionsRepository $productionsRepository): Response
    {
        $production = new Productions();
        $form = $this->createForm(ProductionsType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionsRepository->save($production, true);

            return $this->redirectToRoute('app_productions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('productions/new.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_productions_show', methods: ['GET'])]
    public function show(Productions $production): Response
    {
        return $this->render('productions/show.html.twig', [
            'production' => $production,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_productions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Productions $production, ProductionsRepository $productionsRepository): Response
    {
        $form = $this->createForm(ProductionsType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionsRepository->save($production, true);

            return $this->redirectToRoute('app_productions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('productions/edit.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_productions_delete', methods: ['POST'])]
    public function delete(Request $request, Productions $production, ProductionsRepository $productionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $production->getId(), $request->request->get('_token'))) {
            $productionsRepository->remove($production, true);
        }

        return $this->redirectToRoute('app_productions_index', [], Response::HTTP_SEE_OTHER);
    }
}
