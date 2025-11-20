<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ProductRepository;

class CartService
{
    private $session;
    private $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack->getSession();
        $this->productRepository = $productRepository;
    }

    public function add(int $productId): void
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$productId])) {
            $cart[$productId] = 0;
        }

        $cart[$productId]++;

        $this->session->set('cart', $cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->session->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->session->set('cart', $cart);
    }

    public function decrease(int $productId): void
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$productId])) {
            return;
        }

        if ($cart[$productId] > 1) {
            $cart[$productId]--;
        } else {
            unset($cart[$productId]);
        }

        $this->session->set('cart', $cart);
    }

    public function clear(): void
    {
        $this->session->set('cart', []);
    }

    public function getDetailedCart(): array
    {
        $cart = $this->session->get('cart', []);
        $detailed = [];

        foreach ($cart as $productId => $quantity) {
            $product = $this->productRepository->find($productId);

            if ($product) {
                $detailed[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product->getPrice() * $quantity,
                ];
            }
        }

        return $detailed;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getDetailedCart() as $item) {
            $total += $item['total'];
        }

        return $total;
    }
}
