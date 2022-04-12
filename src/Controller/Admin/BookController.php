<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/admin/livres/', name: 'app_admin_book_list', methods: ['GET'])]
    public function list(BookRepository $repository): Response
    {
        $books = $repository->findAll();

        return $this->render('admin/book/list.html.twig', [
            'books' => $books,
        ]);


    }

    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create', methods: ['GET', 'POST'])]
	public function create(Request $request, BookRepository $repository): Response
	{
		$form = $this->createForm(BookType::class, new Book());

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$repository->add($form->getData());

			return $this->redirectToRoute('app_admin_book_list');
		}

		return $this->render('admin/book/create.html.twig', [
			'form' => $form->createView(),
		]);
	}

    #[Route('/admin/livres/{id}/modifier', name: 'app_admin_book_update', methods: ['GET', 'POST'])]
	public function update(Book $book, Request $request, BookRepository $repository): Response
	{
		$form = $this->createForm(BookType::class, $book);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$repository->add($form->getData());

			return $this->redirectToRoute('app_admin_book_list');
		}

		return $this->render('admin/book/update.html.twig', [
			'form' => $form->createView(),
		]);
	}
    
    
}
