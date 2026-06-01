<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $settings = [
            'brand_name' => 'Keana',
            'hero_title' => 'Working through the night to bring wise ideas to light.',
            'hero_description' => 'Creative portfolio solutions for brands that want to stand out online.',
            'about_title' => 'Highly effective solutions',
            'about_description' => 'I design and launch websites that help businesses grow and tell their story visually.',
            'about_hero_title' => 'UI/UX Designer & SEO Specialist',
            'about_hero_description' => 'A designer who bridges aesthetics and discoverability — combining user-centered design with data-driven SEO strategies.',
            'contact_email' => 'contact@brixagency.com',
            'contact_phone' => '(414) 850 - 0417',
            'contact_intro' => 'Reach out any time and I will respond as soon as possible.',
            'facebook_url' => '#',
            'twitter_url' => '#',
            'instagram_url' => '#',
            'linkedin_url' => '#',
            'github_url' => '#',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Service::insert([
            ['title' => 'Web design', 'description' => 'Elegant layouts, polished visuals, and conversion-focused interfaces.', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Web development', 'description' => 'Responsive websites with clean, maintainable code.', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'UX/UI design', 'description' => 'User-centered experiences crafted for real people.', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Search Engine Optimization', 'description' => 'Technical SEO and content strategies to improve discoverability.', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Skill::insert([
            ['category' => 'Front-End', 'name' => 'HTML5', 'description' => 'Semantic markup and accessible page structure.', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Front-End', 'name' => 'CSS3', 'description' => 'Responsive layouts, animations, and modern style systems.', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Front-End', 'name' => 'JavaScript', 'description' => 'Interactive UI and client-side enhancements.', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Artwork::insert([
            [
                'title' => 'TUC Urgent Care',
                'slug' => 'tuc-urgent-care',
                'category' => 'Web Design',
                'description' => 'A clean, patient-focused redesign for urgent care services.',
                'image' => 'tuc.png',
                'link' => '#',
                'tools' => json_encode(['Figma', 'CSS', 'JavaScript']),
                'featured' => true,
                'meta' => 'Healthcare website redesign with a focus on trust and conversion.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lazy Chimp',
                'slug' => 'lazy-chimp',
                'category' => 'Branding',
                'description' => 'A playful branding refresh for a digital startup.',
                'image' => 'lazychimp.png',
                'link' => '#',
                'tools' => json_encode(['Photoshop', 'Figma']),
                'featured' => false,
                'meta' => 'Brand identity and visual system for a modern brand.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        ContactMessage::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '(123) 456-7890',
            'company' => 'Example Co',
            'message' => 'I would love to discuss a new website project with you.',
        ]);
    }
}
