<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
/**
 * @Route("/brand")
 */
class BrandController extends AbstractController
{
    private BrandRepository $repo;
    public function __construct(BrandRepository $repo)
   {
      $this->repo = $repo;
   }

       /**
     * @Route("/", name="brand_show")
     */
    public function readAllAction(): Response
    {
        $brands = $this->repo->findAll();
        return $this->render('brand/index.html.twig', [
            'brands'=>$brands
        ]);
    }
    
     /**
     * @Route("/{id}", name="brand_read",requirements={"id"="\d+"})
     */
    public function showAction(Brand $b): Response
    {
        return $this->render('detail.html.twig', [
            'b'=>$b
        ]);
    }
     /**
     * @Route("/add", name="brand_create")
     */
    public function createAction(Request $req): Response
    {
        $br = new Brand();
        $form = $this->createForm(BrandType::class, $br);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->save($br,true);

            return $this->redirectToRoute('brand_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('brand/form.html.twig', [
            'brand' => $br,
            'form' => $form,
        ]);

    }   
    /**
     * @Route("/edit/{id}", name="brand_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, Brand $br): Response
    {
        $form = $this->createForm(BrandType::class, $br);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->save($br,true);

            return $this->redirectToRoute('brand_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('brand/form.html.twig', [
            'brand' => $br,
            'form' => $form,
        ]);
    }

     /**
     * @Route("/delete/{id}",name="brand_delete",requirements={"id"="\d+"})
     */

     public function deleteAction(Brand $br): Response
     {
         $this->repo->remove($br,true);
         return $this->redirectToRoute('brand_show', [], Response::HTTP_SEE_OTHER);
     }

}
