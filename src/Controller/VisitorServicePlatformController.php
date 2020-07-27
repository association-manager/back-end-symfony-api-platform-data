<?php

namespace App\Controller;

use App\Entity\VisitorServicePlatform;
use App\Form\VisitorServicePlatformType;
use App\Repository\VisitorServicePlatformRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visitor/service/platform")
 */
class VisitorServicePlatformController extends AbstractController
{
    /**
     * @Route("/", name="visitor_service_platform_index", methods={"GET"})
     */
    public function index(VisitorServicePlatformRepository $visitorServicePlatformRepository): Response
    {
        return $this->render('visitor_service_platform/index.html.twig', [
            'visitor_service_platforms' => $visitorServicePlatformRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="visitor_service_platform_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $visitorServicePlatform = new VisitorServicePlatform();
        $form = $this->createForm(VisitorServicePlatformType::class, $visitorServicePlatform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visitorServicePlatform);
            $entityManager->flush();

            return $this->redirectToRoute('visitor_service_platform_index');
        }

        return $this->render('visitor_service_platform/new.html.twig', [
            'visitor_service_platform' => $visitorServicePlatform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visitor_service_platform_show", methods={"GET"})
     */
    public function show(VisitorServicePlatform $visitorServicePlatform): Response
    {
        return $this->render('visitor_service_platform/show.html.twig', [
            'visitor_service_platform' => $visitorServicePlatform,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visitor_service_platform_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VisitorServicePlatform $visitorServicePlatform): Response
    {
        $form = $this->createForm(VisitorServicePlatformType::class, $visitorServicePlatform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visitor_service_platform_index');
        }

        return $this->render('visitor_service_platform/edit.html.twig', [
            'visitor_service_platform' => $visitorServicePlatform,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="visitor_service_platform_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VisitorServicePlatform $visitorServicePlatform): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visitorServicePlatform->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visitorServicePlatform);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visitor_service_platform_index');
    }
}
