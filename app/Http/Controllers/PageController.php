<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Experience;
use App\Models\SeoProject;
use App\Models\SeoTool;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredArtworks = Artwork::where('featured', true)->orderBy('sort_order')->get();

        $artworkCards = $featuredArtworks->map(function ($a) {
            $img = null;
            if ($a->image) {
                $img = str_starts_with($a->image, 'artworks/')
                    ? asset('storage/' . $a->image)
                    : asset('images/' . $a->image);
            }
            return [
                'name' => '@keanariela',
                'verified' => true,
                'img' => $img ?? asset('images/placeholder.png'),
                'title' => $a->title,
                'link' => route('project.detail', $a->slug),
                'category' => $a->category ? \Illuminate\Support\Str::slug($a->category) : 'ui-design',
            ];
        })->values()->toArray();

        return view('home', [
            'services' => Service::orderBy('order')->get(),
            'skills' => Skill::orderBy('order')->get(),
            'featuredArtworks' => $featuredArtworks,
            'recentArtworks' => Artwork::orderBy('sort_order')->orderBy('created_at', 'desc')->limit(6)->get(),  // ← fixed
            'artworkCards' => $artworkCards,
            'artworkCategories' => Artwork::where('featured', true)
                ->whereNotNull('category')
                ->distinct()
                ->pluck('category')
                ->sort()
                ->values(),
            'siteSettings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function about()
    {
        return view('about', [
            'skills' => Skill::orderBy('order')->get(),
            'experiences' => Experience::orderBy('order')->get(),
            'siteSettings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function artworks()
    {
        return view('artworks', [
            'artworks' => Artwork::orderBy('sort_order')->orderBy('created_at', 'desc')->get(),  // ← change this
            'categories' => Artwork::whereNotNull('category')->distinct()->pluck('category')->sort()->values(),
            'siteSettings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'siteSettings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function seo()
    {
        return view('seo', [
            // Names match what seo.blade.php uses: $seoProjects and $seoTools
            'seoProjects' => \App\Models\SeoProject::orderBy('order')->get(),
            'seoTools' => \App\Models\SeoTool::orderBy('order')->get(),
            'seoSkills' => \App\Models\SeoSkill::orderBy('order')->get(),
            'siteSettings' => Setting::pluck('value', 'key')->toArray(),
        ]);
    }

    public function project(string $slug)
    {
        $project = Artwork::where('slug', $slug)->firstOrFail();
        return view('project', compact('project'));
    }

    public function projectDetail(string $slug)
    {
        $project = Artwork::where('slug', $slug)->firstOrFail();
        $next = Artwork::where('created_at', '>', $project->created_at)
            ->orderBy('created_at', 'asc')
            ->first();
        return view('project-detail', compact('project', 'next'));
    }


}
