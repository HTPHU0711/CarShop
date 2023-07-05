<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_show_cart")
     */
    public function showcartAction(CartRepository $repo): Response
    {
        $user = $this->getUser();

        if(!$user){
            return $this->redirectToRoute('app_login');
        }else{
            $showcart = $repo->cartshow($user->getId());
            return $this->render('cart/index.html.twig', [
            'cart'=> $showcart,
            ]);
            // return $this->json($showcart);
        }
    }

    /**
     * @Route("/cart/{id}", name="app_cart")
     */
    public function index(CartRepository $repo, Product $p, Request $req): Response
    {
        $cart= new Cart();
        $quantity = $req ->query->get('quantity_input');
        $cart ->setQuantity($quantity);
        $cart ->setProcart($p);
        $cart ->setUscart($this->getUser());
        $repo -> save($cart,true);
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/cart/delete/{id}", name="app_cart_delete")
     */
    public function delete(Cart $id, Request $req, CartRepository $repo): Response
    {
        $repo ->remove($id,true);
        return $this->redirectToRoute('app_show_cart');
    }

}
