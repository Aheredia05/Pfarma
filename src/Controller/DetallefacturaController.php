<?php

namespace App\Controller;

use App\Entity\Detallefactura;
use App\Form\DetallefacturaType;
use App\Repository\DetallefacturaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detallefactura")
 */
class DetallefacturaController extends Controller
{
    /**
     * @Route("/", name="detallefactura_index", methods={"GET"})
     */
    public function index(DetallefacturaRepository $detallefacturaRepository): Response
    {
        return $this->render('detallefactura/index.html.twig', [
            'detallefacturas' => $detallefacturaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detallefactura_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detallefactura = new Detallefactura();
        $form = $this->createForm(DetallefacturaType::class, $detallefactura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detallefactura);
            $entityManager->flush();

            return $this->redirectToRoute('detallefactura_index');
        }

        return $this->render('detallefactura/new.html.twig', [
            'detallefactura' => $detallefactura,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detallefactura_show", methods={"GET"})
     */
    public function show(Detallefactura $detallefactura): Response
    {
        return $this->render('detallefactura/show.html.twig', [
            'detallefactura' => $detallefactura,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detallefactura_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Detallefactura $detallefactura): Response
    {
        $form = $this->createForm(DetallefacturaType::class, $detallefactura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detallefactura_index');
        }

        return $this->render('detallefactura/edit.html.twig', [
            'detallefactura' => $detallefactura,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detallefactura_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Detallefactura $detallefactura): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detallefactura->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detallefactura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detallefactura_index');
    }
}
