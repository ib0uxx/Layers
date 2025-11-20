<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cartService->getDetailedCart(),
            'total' => $cartService->getTotal(),
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(int $id, CartService $cartService): Response
    {
        $cartService->add($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove(int $id, CartService $cartService): Response
    {
        $cartService->remove($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease(int $id, CartService $cartService): Response
    {
        $cartService->decrease($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clear(CartService $cartService): Response
    {
        $cartService->clear();
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/payment', name: 'app_cart_payment')]
    public function payment(CartService $cartService): Response
    {
        return $this->render('cart/payment.html.twig', [
            'cart' => $cartService->getDetailedCart(),
            'total' => $cartService->getTotal(),
        ]);
    }

    #[Route('/cart/payment/confirm', name: 'app_cart_payment_confirm', methods: ['POST'])]
    public function confirm(Request $request, CartService $cartService): Response
    {
        $fullname = $request->request->get('fullname');
        $address = $request->request->get('address');
        $city = $request->request->get('city');
        $zip = $request->request->get('zip');
        $payment = $request->request->get('payment');
        $total = $cartService->getTotal();
        $cartService->clear(); // vider le panier une fois validé

        return $this->render('cart/confirmation.html.twig', [
            'fullname' => $fullname,
            'total' => $total,
            'payment' => $payment,
        ]);
    }


}
