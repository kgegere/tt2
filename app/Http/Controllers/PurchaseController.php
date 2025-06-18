<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->query('search');
        $category = $request->query('category_id');
        $filter = $request->query('filter');
        $sort = $request->query('sort');

        $query = $user->purchases()->with('listing.category');

        if ($category) {
            $query->whereHas('listing', function($q) use ($category) {
                $q->where('category_id', $category);
            });
        }

        if ($search) {
            $query->whereHas('listing', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Optional: add sorting logic if you want to support it
        if ($sort === 'price_asc') {
            $query->whereHas('listing', function($q) {
                $q->orderBy('price', 'asc');
            });
        } elseif ($sort === 'price_desc') {
            $query->whereHas('listing', function($q) {
                $q->orderBy('price', 'desc');
            });
        } elseif ($sort === 'date_asc') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $purchases = $query->paginate(10);
        $categories = Category::all();

        return view('purchases.index', [
            'purchases' => $purchases,
            'categories' => $categories,
            'filter' => $filter,
            'search' => $search,
            'category' => $category,
            'sort' => $sort,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate(['g-recaptcha-response' => 'required|captcha',]);

        // Ensure the item has not been purchased globally
        if ($listing->purchases()->exists()) {
            return redirect()->route('listing.show', $listing->id)
                ->with('error', 'This item has already been purchased.');
        }

        $purchase = $listing->purchases()->create([
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('listing.show', ['listing' => $listing->id])
            ->with('success', 'Your purchase has been completed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
