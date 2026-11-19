<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Dosen;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\News;
use App\Models\OrganisasiMahasiswa;
use App\Models\Partner;
use App\Models\Prestasi;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $isAdmin = $user?->isAdmin() ?? false;
        $isPenulis = $user?->hasExactRole('penulis') ?? false;
        $isOrganisasi = $user?->hasExactRole('organisasi') ?? false;

        // 1. Metric Counters
        $totalNewsPublished = News::where('status', 'published')->count();
        $totalNewsDraft = News::where('status', 'draft')->count();
        $totalNews = $isPenulis && ! $isAdmin ? News::where('user_id', $user->id)->count() : News::count();
        $myNewsPublished = News::where('user_id', $user->id)->where('status', 'published')->count();
        $myNewsDraft = News::where('user_id', $user->id)->where('status', 'draft')->count();

        $totalDosen = Dosen::count();
        $totalLayanan = Layanan::count();
        $totalPrestasi = Prestasi::count();
        $totalGalleries = Gallery::count();
        $totalTestimonials = Testimonial::count();
        $totalFaqs = Faq::count();
        $totalPartners = Partner::count();
        $totalBanners = Banner::count();
        $totalUsers = User::count();

        // Organisasi Metrics
        $totalOrganisasi = OrganisasiMahasiswa::count();
        $totalOrganisasiActive = OrganisasiMahasiswa::where('is_active', true)->count();
        $totalOrganisasiOprec = OrganisasiMahasiswa::whereNotNull('link_pendaftaran')->where('link_pendaftaran', '!=', '')->count();

        // 2. Charts Data
        // A. Monthly News Trend (Last 6 Months)
        $months = [];
        $newsMonthlyCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M Y');
            $months[] = $monthName;

            $query = News::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month);
            if ($isPenulis && ! $isAdmin) {
                $query->where('user_id', $user->id);
            }
            $newsMonthlyCounts[] = $query->count();
        }

        // B. Ormawa Categories Distribution
        $ormawaCategories = OrganisasiMahasiswa::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        // C. Testimonials Ratings Breakdown
        $testimonialRatings = Testimonial::select('bintang', DB::raw('count(*) as total'))
            ->groupBy('bintang')
            ->orderBy('bintang', 'desc')
            ->pluck('total', 'bintang')
            ->toArray();

        // 3. Recent Feeds
        $latestNewsQuery = ($isPenulis && ! $isAdmin) ? News::where('user_id', $user->id) : News::query();
        $latestNews = $latestNewsQuery->latest('id')->take(5)->get();

        $latestTestimonials = Testimonial::latest('id')->take(5)->get();
        $latestOrganisasis = OrganisasiMahasiswa::orderBy('urutan')->latest('id')->take(5)->get();
        $latestPrestasis = Prestasi::latest('id')->take(5)->get();

        return view('layouts.dashboard.index', compact(
            'isAdmin',
            'isPenulis',
            'isOrganisasi',
            'user',
            'totalNews',
            'totalNewsPublished',
            'totalNewsDraft',
            'myNewsPublished',
            'myNewsDraft',
            'totalDosen',
            'totalLayanan',
            'totalPrestasi',
            'totalGalleries',
            'totalTestimonials',
            'totalFaqs',
            'totalPartners',
            'totalBanners',
            'totalUsers',
            'totalOrganisasi',
            'totalOrganisasiActive',
            'totalOrganisasiOprec',
            'months',
            'newsMonthlyCounts',
            'ormawaCategories',
            'testimonialRatings',
            'latestNews',
            'latestTestimonials',
            'latestOrganisasis',
            'latestPrestasis'
        ));
    }
}
