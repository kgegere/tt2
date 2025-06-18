<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class HomeController extends Controller
{
    public function index()
    {
        $recentIds = session('recently_viewed', []);
        $recentListings = collect();
        if (!empty($recentIds)) {
            $recentListings = Listing::whereIn('id', $recentIds)->get()
                ->sortBy(function($listing) use ($recentIds) {
                    return array_search($listing->id, $recentIds);
                });
        }
        return view('welcome', compact('recentListings'));
    }
}
