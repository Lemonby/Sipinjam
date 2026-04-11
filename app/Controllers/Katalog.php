<?php

namespace App\Controllers;

class Katalog extends BaseController
{	
	public function index()
	{
		$booksModel = new \App\Models\BooksModel();
		$books = $booksModel->getAvailableBooks();

		return view('KatalogBuku', ['books' => $books]);
	}
}