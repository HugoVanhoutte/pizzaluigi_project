<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Review;
use App\Form\BookingType;
use App\Form\ReviewType;
use App\Repository\BookingRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Route for, displaying landing page
     * @return Response
     */
    #[Route('/', name: 'app_landing', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('landing.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Route for waiting screen
     * @return Response
     */
    #[Route('/waiting', name: 'app_waiting', methods: ['GET'])]
public function waiting(): Response
    {
        return $this->render('waiting.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Route for displaying the menu
     * @return Response
     */
    #[Route('/menu', name: 'app_menu', methods: ['GET'])]
public function menu(): Response
    {
        return $this->render('menu.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Route for displaying the booking creation form
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/booking', name: 'app_booking', methods: ['GET', 'POST'])]
public function booking(
    Request $request,
    EntityManagerInterface $manager,
    ): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success', 'Resérvation enregistrée avec success !'
            );

            return $this->redirectToRoute('app_landing');
        }

        return $this->render('booking.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Route for displaying the reviews, pagination included
     * @param ReviewRepository $reviewRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/reviews', name: 'app_reviews_read', methods: ['GET'])]
public function notes(ReviewRepository $reviewRepository,
                      PaginatorInterface $paginator,
                      Request $request
    ): Response
    {
        $reviews = $paginator->paginate(
            $reviewRepository->findAll(),
            $request->query->getInt('page', 1),
            50
        );
        return $this->render('reviews.html.twig', [
            'controller_name' => 'HomeController',
            'reviews' => $reviews,
        ]);
    }

    #[Route('/reviews/create', name: 'app_reviews_create', methods: ['GET', 'POST'])]
public function reviewCreate(
    Request $request,
    EntityManagerInterface $manager
    ): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success', 'Avis enregistré avec success !'
            );

            return $this->redirectToRoute('app_reviews_read');
        }

        return $this->render('reviews_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
