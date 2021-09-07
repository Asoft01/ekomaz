<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\CmsPage;

class CmsPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsPagesRecords = [
            ['id'=> 1, 'title' => 'About Us', 'description' => 'Content is coming soon', 'url' => 'about-us', 'meta_title' => 'About Us', 'meta_description' => 'About E-commerce website', 'meta_keywords' => 'about us, about ecommerce', 'status' => 1],
            ['id'=> 2, 'title' => 'Privacy Policy', 'description' => 'Content is coming soon', 'url' => 'privacy-policy', 'meta_title' => 'Privacy Policy', 'meta_description' => 'Privacy Policy website', 'meta_keywords' => 'privacy policy of about ecommerce', 'status' => 1],
        ];
        CmsPage::insert($cmsPagesRecords);
    }
}
