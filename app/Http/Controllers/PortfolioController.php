<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(9);
        return view('portfolios.index', compact('portfolios'));
    }

    public function show($slug)
    {
        $portfolio = Portfolio::with('media')->where('slug', $slug)->firstOrFail();
        
        $relatedPortfolios = Portfolio::where('id', '!=', $portfolio->id)
            ->when($portfolio->category, function($query) use ($portfolio) {
                return $query->where('category', $portfolio->category);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Top up with other projects so the section is a full row of three.
        if ($relatedPortfolios->count() < 3) {
            $relatedPortfolios = $relatedPortfolios->concat(
                Portfolio::whereNotIn('id', $relatedPortfolios->pluck('id')->push($portfolio->id))
                    ->inRandomOrder()
                    ->take(3 - $relatedPortfolios->count())
                    ->get()
            );
        }

        return view('portfolios.show', compact('portfolio', 'relatedPortfolios'));
    }
}
