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
        $folders = [
            'shoes' => 1,
            'clothes' => 2,
            'accessories' => 3,
        ];

        foreach ($folders as $folder => $categoryId) {
            $imagePath = public_path("assets/img/{$folder}/");

            if (!File::exists($imagePath)) {
                continue;
            }

            $files = File::files($imagePath);

            foreach ($files as $file) {
                // Pastikan folder uploads ada di storage/app/public
                $uploadsPath = storage_path('app/public/uploads');
                if (!File::exists($uploadsPath)) {
                    File::makeDirectory($uploadsPath, 0755, true);
                }

                // Gunakan nama file yang unik dengan prefix folder untuk menghindari konflik
                $filename = $folder . '_' . $file->getFilename();

                // Salin file dari public/assets/img/... ke storage/app/public/uploads/
                File::copy($file->getRealPath(), $uploadsPath . DIRECTORY_SEPARATOR . $filename);

                Product::create([
                    'category_id' => $categoryId,
                    'name' => ucwords(str_replace(['-', '_'], ' ', $file->getFilenameWithoutExtension())),
                    'slug' => Str::slug($file->getFilenameWithoutExtension()),
                    'price' => rand(500000, 5000000),
                    'stock' => rand(10, 100),
                    'description' => 'This is a sample description for ' . $file->getFilenameWithoutExtension() . '.' . "\n" . 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas impedit maxime voluptates laudantium sed quidem accusantium aperiam exercitationem cumque eius suscipit.',
                    // Simpan hanya nama file; view menggunakan asset('storage/uploads/' . $product->image)
                    'image' => $filename,
                ]);
            }
        }
    }
}
