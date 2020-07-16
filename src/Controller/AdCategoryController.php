<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/regie-publicitaire")
 */
class AdCategoryController extends AbstractController
{
    private $manager;

    private $categoryRepo;

    public function __construct(EntityManagerInterface $manager, CategoryRepository $categoryRepo)
    {
        $this->manager = $manager;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * @Route("/categories", name="category_index", methods={"GET"})
     */
    public function index(): Response
    {
        $categories = $this->categoryRepo->findAll();

        return $this->render('ad_admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/creer", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($category);
            $this->manager->flush();

            $this->addFlash('success', "La catégorie {$category->getName()} a été créée avec succès");

            return $this->redirectToRoute('category_index');
        }

        return $this->render('ad_admin/category/save.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categories/{id}/modifier", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash('success', "La catégorie {$category->getName()} a été modifiée avec succès");

            return $this->redirectToRoute('category_index');
        }

        return $this->render('ad_admin/category/save.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/categories/{id}/supprimer", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->manager->remove($category);
            $this->manager->flush();

            $this->addFlash('success', "La catégorie {$category->getName()} a été supprimée avec succès");
        }

        return $this->redirectToRoute('category_index');
    }
}
