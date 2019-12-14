<?php

namespace App\Controller;

use App\Entity\Detalleproduct;
use App\Form\DetalleproductType;
use App\Repository\DetalleproductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detalleproduct")
 */
class DetalleproductController extends Controller
{
    /**
     * @Route("/", name="detalleproduct_index", methods={"GET"})
     */
    public function index(DetalleproductRepository $detalleproductRepository): Response
    {
        return $this->render('detalleproduct/index.html.twig', [
            'detalleproducts' => $detalleproductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detalleproduct_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detalleproduct = new Detalleproduct();
        $form = $this->createForm(DetalleproductType::class, $detalleproduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detalleproduct);
            $entityManager->flush();

            return $this->redirectToRoute('detalleproduct_index');
        }

        return $this->render('detalleproduct/new.html.twig', [
            'detalleproduct' => $detalleproduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detalleproduct_show", methods={"GET"})
     */
    public function show(Detalleproduct $detalleproduct): Response
    {
        return $this->render('detalleproduct/show.html.twig', [
            'detalleproduct' => $detalleproduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detalleproduct_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Detalleproduct $detalleproduct): Response
    {
        $form = $this->createForm(DetalleproductType::class, $detalleproduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detalleproduct_index');
        }

        return $this->render('detalleproduct/edit.html.twig', [
            'detalleproduct' => $detalleproduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detalleproduct_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Detalleproduct $detalleproduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detalleproduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detalleproduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detalleproduct_index');
    }
}
