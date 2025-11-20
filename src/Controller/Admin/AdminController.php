<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'app_admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'dashboard')]
    public function dashboard(
        ProductRepository $productRepo,
        CategoryRepository $categoryRepo,
        UserRepository $userRepo,
        OrderRepository $orderRepo
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'totalProducts' => $productRepo->count([]),
            'totalCategories' => $categoryRepo->count([]),
            'totalUsers' => $userRepo->count([]),
            'totalOrders' => $orderRepo->count([]),
            'recentProducts' => $productRepo->findBy([], ['id' => 'DESC'], 5),
            'recentOrders' => $orderRepo->findBy([], ['id' => 'DESC'], 5),
        ]);
    }
}