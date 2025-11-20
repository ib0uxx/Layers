<?php

namespace App\Controller\Admin;

use App\Repository\OrderRepository;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/orders', name: 'app_admin_orders')]
class AdminOrderController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('admin/orders/index.html.twig', [
            'orders' => $orderRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Order $order): Response
    {
        return $this->render('admin/orders/show.html.twig', [
            'order' => $order,
        ]);
    }
}