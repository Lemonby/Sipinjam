<?php

namespace App\Controllers;

Class Pages extends BaseController
{
    public function about(): string
    {
        return view('about');
    }

    public function contact(): string
    {
        $data = [
            'name' => "Muhamad Agung",
            'email' => "muhamad.agung@example.com"
        ];
        return view('contact', $data);
    }

    public function faqs()
	{
		// membuat data untuk dikirim ke view
		$data['data_faqs'] = [
			[
				'question' => 'Apa itu Codeigniter?',
				'answer' => 'Codeigniter adalah framework untuk membuat web'
			],
			[
				'question' => 'Siapa yang membuat Codeiginter?',
				'answer' => 'CI awalnya dibuat oleh Ellislab'
			],
			[
				'question' => 'Codeigniter versi berapakah yang digunakan pada tutoril ini?',
				'answer' => 'Codeigniter versi 4.0.4'
			]
		];

		// load view dengan data
		return view("faqs", $data);
	}

    public function tos(): string 
    {
        return view('tos');
    }
}