<?php

use Illuminate\Database\Seeder;
use Newpixel\StaticPageCRUD\App\Models\StaticPage;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('static_pages')->truncate();

        $pages = [
            [
                'name'            => 'Prima pagina',
                'display_in_menu' => null,
                'details'         => '',
            ],
            [
                'name'            => 'Despre noi',
                'display_in_menu' => 'headerfooter',
                'details'         => '',
            ],
            [
                'name'            => 'Contract cu turistul',
                'display_in_menu' => 'headerfooter',
                'details'         => '',
            ],
            [
                'name'            => 'Termene si conditii',
                'display_in_menu' => 'footer',
                'details'         => '',
            ],
            [
                'name'            => 'Politica de confidentialitate',
                'display_in_menu' => 'footer',
                'details'         => '',
            ],
            [
                'name'            => 'Politica cookie',
                'display_in_menu' => 'footer',
                'details'         => '',
            ],
            [
                'name'            => 'Contact',
                'display_in_menu' => 'headerfooter',
                'details'         => '<p>Ne puteti contacta pentru orice informatie sau problema legata de comanda/produse folosind formularul alaturat sau datele de mai jos.</p>',
            ],
        ];

        foreach ($pages as $item) {
            StaticPage::create([
                'name'            => $item['name'],
                'display_in_menu' => $item['display_in_menu'],
                'details'         => $item['details'],

            ]);
        }
    }
}
