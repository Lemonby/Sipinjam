<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // $this->db->table('users')->truncate();
        // $this->db->table('categories')->truncate();
        // $this->db->table('books')->truncate();
        // $this->db->table('bookCopies')->truncate();

        // 1. Seed Users (Password: 123456)
        $users = [
            [
                'nama'     => 'Agung Pratama',
                'email'    => 'admin@sipinjam.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role'     => 'admin',
                'nim'      => '20260001',
                'jurusan'  => 'Teknik Informatika',
                'telp'     => '081234567890',
                'createdAt' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'     => 'User Testing',
                'email'    => 'user@gmail.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role'     => 'user',
                'nim'      => '20260002',
                'jurusan'  => 'Sistem Informasi',
                'telp'     => '081234567891',
                'createdAt' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);

        // 2. Seed Categories
        $categories = [
            ['namaKategori' => 'Teknologi'],
            ['namaKategori' => 'Sains'],
            ['namaKategori' => 'Fiksi'],
            ['namaKategori' => 'Non-Fiksi'],
            ['namaKategori' => 'Sejarah'],
        ];
        $this->db->table('categories')->insertBatch($categories);

        // 3. Seed Books
        $books = [
            [
                'judul'      => 'Clean Code',
                'penulis'    => 'Robert C. Martin',
                'penerbit'   => 'Prentice Hall',
                'idKategori' => 1,
                'deskripsi'  => 'Buku wajib untuk software engineer.',
                'tahunTerbit' => 2008,
                'cover'      => 'clean_code.jpg'
            ],
            [
                'judul'      => 'The Pragmatic Programmer',
                'penulis'    => 'Andrew Hunt & David Thomas',
                'penerbit'   => 'Addison-Wesley',
                'idKategori' => 1,
                'deskripsi'  => 'Panduan praktis untuk pengembangan perangkat lunak.',
                'tahunTerbit' => 1999,
                'cover'      => 'pragmatic_programmer.jpg'
            ],
            [
                'judul'      => 'Sapiens: A Brief History of Humankind',
                'penulis'    => 'Yuval Noah Harari',
                'penerbit'   => 'Harper',
                'idKategori' => 4,
                'deskripsi'  => 'Sejarah umat manusia dari zaman purba hingga modern.',
                'tahunTerbit' => 2011,
                'cover'      => 'sapiens.jpg'
            ],
            [
                'judul'      => 'The Great Gatsby',
                'penulis'    => 'F. Scott Fitzgerald',
                'penerbit'   => 'Scribner',
                'idKategori' => 3,
                'deskripsi'  => 'Novel klasik tentang impian Amerika.',
                'tahunTerbit' => 1925,
                'cover'      => 'great_gatsby.jpg'
            ],
            [
                'judul'      => 'A Brief History of Time',
                'penulis'    => 'Stephen Hawking',
                'penerbit'   => 'Bantam Books',
                'idKategori' => 2,
                'deskripsi'  => 'Penjelasan tentang alam semesta dan fisika kuantum.',
                'tahunTerbit' => 1988,
                'cover'      => 'brief_history_time.jpg'
            ],
            [
                'judul'      => 'The Art of War',
                'penulis'    => 'Sun Tzu',
                'penerbit'   => 'Penguin Classics',
                'idKategori' => 5,
                'deskripsi'  => 'Karya klasik tentang strategi militer.',
                'tahunTerbit' => -500,
                'cover'      => 'art_of_war.jpg'
            ],
            [
                'judul'      => 'Thinking, Fast and Slow',
                'penulis'    => 'Daniel Kahneman',
                'penerbit'   => 'Farrar, Straus and Giroux',
                'idKategori' => 4,
                'deskripsi'  => 'Buku tentang psikologi dan pengambilan keputusan.',
                'tahunTerbit' => 2011,
                'cover'      => 'thinking_fast_slow.jpg'
            ],
            [
                'judul'      => 'To Kill a Mockingbird',
                'penulis'    => 'Harper Lee',
                'penerbit'   => 'J.B. Lippincott & Co.',
                'idKategori' => 3,
                'deskripsi'  => 'Novel tentang rasisme dan keadilan di Amerika Selatan.',
                'tahunTerbit' => 1960,
                'cover'      => 'to_kill_mockingbird.jpg'
            ],
            [
                'judul'      => 'The Selfish Gene',
                'penulis'    => 'Richard Dawkins',
                'penerbit'   => 'Oxford University Press',
                'idKategori' => 2,
                'deskripsi'  => 'Buku tentang evolusi dan genetika.',
                'tahunTerbit' => 1976,
                'cover'      => 'selfish_gene.jpg'
            ],
            [
                'judul'      => '1984',
                'penulis'    => 'George Orwell',
                'penerbit'   => 'Secker & Warburg',
                'idKategori' => 3,
                'deskripsi'  => 'Novel dystopian tentang totalitarianisme.',
                'tahunTerbit' => 1949,
                'cover'      => '1984.jpg'
            ],
            [
                'judul'      => 'The Lean Startup',
                'penulis'    => 'Eric Ries',
                'penerbit'   => 'Crown Business',
                'idKategori' => 1,
                'deskripsi'  => 'Buku tentang metodologi startup yang efisien.',
                'tahunTerbit' => 2011,
                'cover'      => 'lean_startup.jpg'
            ],
            [
                'judul'      => 'Guns, Germs, and Steel',
                'penulis'    => 'Jared Diamond',
                'penerbit'   => 'W. W. Norton & Company',
                'idKategori' => 4,
                'deskripsi'  => 'Analisis tentang faktor-faktor yang mempengaruhi perkembangan peradaban.',
                'tahunTerbit' => 1997,
                'cover'      => 'guns_germs_steel.jpg'
            ],
        ];
        $this->db->table('books')->insertBatch($books);

        // 4. seed bookcopies
        $bookCopies = [
            [
                'idBuku' => 1, 
                'status' => 'tersedia',
                'kodeBuku' => 'CC-001'
            ],
            [
                'idBuku' => 1,
                'status' => 'tidak tersedia',
                'kodeBuku' => 'CC-002'
            ],
            [
                'idBuku' => 2,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-003'
            ],
            [
                'idBuku' => 2,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-004'
            ],
            [
                'idBuku' => 3,
                'status' => 'tidak tersedia',
                'kodeBuku' => 'CC-005'
            ],
            [
                'idBuku' => 3,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-006'
            ],
            [
                'idBuku' => 4,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-007'
            ],
            [
                'idBuku' => 4,
                'status' => 'tidak tersedia',
                'kodeBuku' => 'CC-008'
            ],
            [
                'idBuku' => 5,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-009'
            ],
            [
                'idBuku' => 5,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-010'
            ],
            [
                'idBuku' => 6,
                'status' => 'tidak tersedia',
                'kodeBuku' => 'CC-011'
            ],
            [
                'idBuku' => 6,
                'status' => 'tersedia',
                'kodeBuku' => 'CC-012'
            ]
        ];
        $this->db->table('bookCopies')->insertBatch($bookCopies);
    }
}
