<?php

namespace App\Controller;

use App\Entity\Entradas;
use App\Form\EntradasType;
use App\Repository\EntradasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entradas")
 */
class EntradasController extends Controller
{
    /**
     * @Route("/", name="entradas_index", methods={"GET"})
     */
    public function index(EntradasRepository $entradasRepository): Response
    {
        return $this->render('entradas/index.html.twig', [
            'entradas' => $entradasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entradas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entrada = new Entradas();
        $form = $this->createForm(EntradasType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('entradas_index');
        }

        return $this->render('entradas/new.html.twig', [
            'entrada' => $entrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entradas_show", methods={"GET"})
     */
    public function show(Entradas $entrada): Response
    {
        return $this->render('entradas/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entradas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entradas $entrada): Response
    {
        $form = $this->createForm(EntradasType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entradas_index');
        }

        return $this->render('entradas/edit.html.twig', [
            'entrada' => $entrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entradas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entradas $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entradas_index');
    }
}
