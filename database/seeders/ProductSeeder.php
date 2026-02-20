<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Konfigurasi folder dan category_id terkait
        $folders = [
            'shoes' => 1,
            'clothes' => 2,
            'accessories' => 3,
        ];

        foreach ($folders as $folder => $categoryId) {
            $imagePath = public_path("assets/img/{$folder}/");

            // Lewati jika folder gambar tidak ditemukan
            if (!File::exists($imagePath)) {
                continue;
            }

            $files = File::files($imagePath);

            foreach ($files as $file) {
                // Pastikan folder target di storage tersedia
                $uploadsPath = storage_path('app/public/uploads');
                if (!File::exists($uploadsPath)) {
                    File::makeDirectory($uploadsPath, 0755, true);
                }

                // Nama file unik: misal shoes_nike-air.jpg
                $filename = $folder . '_' . $file->getFilename();

                // Salin file ke storage agar bisa diakses via asset('storage/uploads/...')
                File::copy($file->getRealPath(), $uploadsPath . DIRECTORY_SEPARATOR . $filename);

                // 1. Create Data Product Utama
                $product = Product::create([
                    'category_id' => $categoryId,
                    'name'        => ucwords(str_replace(['-', '_'], ' ', $file->getFilenameWithoutExtension())),
                    'slug'        => Str::slug($file->getFilenameWithoutExtension() . '-' . rand(100, 999)),
                    'price'       => rand(500000, 5000000), // Base price
                    'description' => "This is a luxury product from the {$folder} collection. Crafted with precision and high-quality materials to ensure comfort and style.\n\nLorem ipsum dolor sit amet consectetur adipisicing elit. Quas impedit maxime voluptates laudantium sed quidem accusantium.",
                    'image'       => $filename,
                ]);

                // 2. Logika Penentuan Varian berdasarkan Kategori
                $variantData = match ($categoryId) {
                    1 => [ // SHOES: Menggunakan ukuran angka
                        ['attr' => 'Size', 'val' => '40'],
                        ['attr' => 'Size', 'val' => '41'],
                        ['attr' => 'Size', 'val' => '42'],
                    ],
                    2 => [ // CLOTHES: Menggunakan ukuran huruf
                        ['attr' => 'Size', 'val' => 'M'],
                        ['attr' => 'Size', 'val' => 'L'],
                        ['attr' => 'Size', 'val' => 'XL'],
                    ],
                    3 => [ // ACCESSORIES: Menggunakan varian warna
                        ['attr' => 'Color', 'val' => 'Midnight Black'],
                        ['attr' => 'Color', 'val' => 'Silver Stone'],
                    ],
                    default => [
                        ['attr' => 'Type', 'val' => 'Standard'],
                    ],
                };

                // 3. Simpan Varian ke Database melalui Relasi
                foreach ($variantData as $v) {
                    $product->variants()->create([
                        'attribute_name'  => $v['attr'],
                        'attribute_value' => $v['val'],
                        'price'           => $product->price + rand(0, 100000), // Harga varian bisa beda tipis
                        'stock'           => rand(10, 50),
                    ]);
                }
            }
        }
    }
}
