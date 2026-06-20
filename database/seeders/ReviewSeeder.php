<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure enough users and products exist so reviews can reference them
        if (User::count() < 50) {
            User::factory(50)->create();
        }

        if (Product::count() < 50) {
            Product::factory(100)->create();
        }

        $this->command->info('Membuat 300 review dalam 3 chunk ...');
        $bar = $this->command->getOutput()->createProgressBar(300);
        $bar->start();

        // Create in chunks of 100 to control memory usage
        collect(range(1, 3))->each(function () use ($bar) {
            Review::factory()
                ->count(100)
                ->create();

            $bar->advance(100);
        });

        $bar->finish();
        $this->command->newLine();
        $this->command->info('✅ 300 review berhasil dibuat.');
    }
}
