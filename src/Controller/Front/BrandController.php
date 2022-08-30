<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BrandRepository;
use Knp\Component\Pager\PaginatorInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    public function __construct(
        private BrandRepository $brandRepository
    )
    {
        
    }
    #[Route('/brand', name: 'app_brand')]
    public function index(
        PaginatorInterface $paginator,
        FilterBuilderUpdaterInterface $builderUpdater,
        Request $request        
    ): Response
    {
        $qb = $this->gameRepository->getQbAll();
        $filterForm = $this->createForm(
            BrandSearchFilterType::class,
            null,
            ['method' => 'GET']
        );

        if ($request->query->has($filterForm->getName())) {
            $filterForm->submit($request->query->get($filterForm->getName()));
            $builderUpdater->addFilterConditions($filterForm, $qb);
        }

        $brands = $paginator->paginate(
            $qb,
            $request->query->getInt('page', 1),
            10
        );

        #[Route('/{slug}', name: 'app_brand_show')]
    public function show(
        string $slug,
        Request $request,
        PaginatorInterface $paginator,
        ModelRepository $modelRepository
    ): Response
    {
        $announcements = $paginator->paginate(
            $modelRepository->getQueryBuilderBybrand($slug),
            $request->query->getInt('page', 1),
            6
        );
        #[Route('/{slug}', name: 'app_brand_show')]
        public function show(
            string $slug,
            Request $request,
            PaginatorInterface $paginator,
            ModelRepository $modelRepository
        ): Response
        {
            $announcements = $paginator->paginate(
                $modelRepository->getQueryBuilderByBrand($slug),
                $request->query->getInt('page', 1),
                5
            );

        return $this->render('brand/index.html.twig', [
            'brandsArray' => $brands,
            'filterForm' => $filterForm->createView(),
        ]);
    }
}