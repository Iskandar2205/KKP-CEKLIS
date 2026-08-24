<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Menambahkan data master produk
     */
    public function run(): void
    {

        Product::create([
            'nama_produk' => 'Cumi Beku',
            'jenis_produk' => 'Frozen Seafood',
        ]);


        Product::create([
            'nama_produk' => 'Udang Beku',
            'jenis_produk' => 'Frozen Seafood',
        ]);


        Product::create([
            'nama_produk' => 'Ikan Tuna',
            'jenis_produk' => 'Frozen Seafood',
        ]);


        Product::create([
            'nama_produk' => 'Salmon Beku',
            'jenis_produk' => 'Frozen Seafood',
        ]);

    }
}