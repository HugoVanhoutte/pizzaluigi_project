<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\BookingRepository;
use App\Repository\ReviewRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// TODO: create controllers to atomize admin
#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{

    /**
     * Route displaying all bookings for admin uses
     * @param BookingRepository $bookingRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/bookings', name: 'bookings', methods: ['GET'])]
public function adminBookings(BookingRepository $bookingRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $bookings = $paginator->paginate(
            $bookingRepository->findAll(),
            $request->query->getInt('page', 1),
            100
        );

        return $this->render('admin/bookings.html.twig', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Route displaying all reviews for admin uses
     * @param ReviewRepository $reviewRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/reviews', name: 'reviews', methods: ['GET'])]
public function adminReviews(ReviewRepository $reviewRepository, PaginatorInterface $paginator, Request $request): Response
{
    $reviews = $paginator->paginate(
        $reviewRepository->findAll(),
        $request->query->getInt('page', 1),
        100
    );

    return $this->render('admin/reviews.html.twig', [
        'reviews' => $reviews,
    ]);
}

    /**
     * Route displaying all posts for admin uses
     * @param PostRepository $postRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/posts/read', name: 'posts_read', methods: ['GET'])]
public function adminPostsRead(PostRepository $postRepository, PaginatorInterface $paginator, Request $request): Response
{
    $posts = $paginator->paginate(
        $postRepository->findAll(),
        $request->query->getInt('page', 1),
        100
    );

    return $this->render('admin/posts_read.html.twig', [
        'posts' => $posts,
    ]);
}

    /**
     * Route to post creation form
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/posts/create', name: 'posts_create', methods: ['GET', 'POST'])]
public function adminPostsCreate(
        Request $request,
        EntityManagerInterface $manager,
    ): Response
{
    $posts = new Post();
    $form = $this->createForm(PostType::class, $posts);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $booking = $form->getData();
        $manager->persist($booking);
        $manager->flush();

        $this->addFlash(
            'success', 'Post créé !'
        );

        return $this->redirectToRoute('admin_posts_read');

    }

    return $this->render('admin/posts_create.html.twig', [
        'form' => $form->createView(),
    ]);
}

    /**
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/posts/edit/{id}', name: 'posts_edit', methods: ['GET', 'POST'])]
    #[ParamConverter("post", class: "App\Entity\Post")]
public function adminPostsEdit(Post $post, Request $request, EntityManagerInterface $manager) : Response {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success', 'Post modifié !'
            );

            return $this->redirectToRoute('admin_posts_read');
        }

    return $this->render('admin/posts_edit.html.twig', [
        'form' => $form->createView(),
    ]);
}
#[Route('/posts/delete/{id}', name: 'posts_delete', methods: ['GET'])]
public function adminPostsDelete(Post $post, EntityManagerInterface $manager) : Response {

        $manager->remove($post);
        $manager->flush();

        $this->addFlash(
            'success', 'Post supprimé !'
        );

        return $this->redirectToRoute('admin_posts_read');
}
}
