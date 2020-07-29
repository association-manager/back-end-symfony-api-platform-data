<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/categories", name="category_index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $categories = $this->categoryRepo->findAll();

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            return $this->render('ad_admin/category/index.html.twig', [
                'categories' => $categories,
            ]);
        }
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/categories/creer", name="category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user =$this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
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
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/categories/{id}/afficher", name="category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        $user = $this->getUser();
        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            return $this->render('ad_admin/category/show.html.twig', [
                'category' => $category,
            ]);
        }
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/categories/{id}/modifier", name="category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $user = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
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
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
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
