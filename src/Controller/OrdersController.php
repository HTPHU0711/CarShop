<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Form\OrdersType;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 */
class OrdersController extends AbstractController
{
    private OrdersRepository $repo;
    private UserRepository $urepo;
    private ProductRepository $prepo;

    public function __construct(OrdersRepository $repo, UserRepository $urepo, ProductRepository $prepo)
   {
      $this->repo = $repo;
      $this->urepo = $urepo;
      $this->prepo = $prepo;
   }

       /**
     * @Route("/", name="order_show")
     */
    public function readAllAction(): Response
    {
        $orders = $this->repo->findAll();
        $user = $this->urepo->findAll();
        $product = $this->prepo->findAll();
        return $this->render('orders/index.html.twig', [
            'orders'=>$orders,
            'user'=>$user,
            'product'=>$product
        ]);
    }

    //  /**
    //  * @Route("/add", name="order_create")
    //  */
    // public function createAction(Request $req): Response
    // {
    //     $br = new Orders();
    //     $form = $this->createForm(OrdersType::class, $br);
    //     $form->handleRequest($req);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->repo->save($br,true);

    //         return $this->redirectToRoute('order_show', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('order/form.html.twig', [
    //         'order' => $br,
    //         'form' => $form,
    //     ]);

    // }   
    // /**
    //  * @Route("/edit/{id}", name="order_edit",requirements={"id"="\d+"})
    //  */
    // public function editAction(Request $req, Orders $br): Response
    // {
    //     $form = $this->createForm(OrdersType::class, $br);
    //     $form->handleRequest($req);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->repo->save($br,true);

    //         return $this->redirectToRoute('order_show', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('order/form.html.twig', [
    //         'order' => $br,
    //         'form' => $form,
    //     ]);
    // }

    //  /**
    //  * @Route("/delete/{id}",name="order_delete",requirements={"id"="\d+"})
    //  */

    //  public function deleteAction(Orders $br): Response
    //  {
    //      $this->repo->remove($br,true);
    //      return $this->redirectToRoute('order_show', [], Response::HTTP_SEE_OTHER);
    //  }

}
