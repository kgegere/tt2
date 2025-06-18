<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'available');
        $search = $request->query('search');
        $category = $request->query('category');
        $sort = $request->query('sort');

        $query = \App\Models\Listing::query();

        if ($filter === 'available') {
            $query->doesntHave('purchases');
        } elseif ($filter === 'purchased') {
            $query->has('purchases');
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'date_asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'date_desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // default
        }

        $listings = $query->with('category')->paginate(9);
        $categories = Category::all();

        return view('listings.index', [
            'listings' => $listings,
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
        if (!Auth::user() || !(Auth::user()->isSeller() || Auth::user()->isAdmin())) {
            abort(403, 'You are not allowed to create listings.');
        }
        $categories = Category::all();
        return view('listings.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user() || !(Auth::user()->isSeller() || Auth::user()->isAdmin())) {
            abort(403, 'You are not allowed to create listings.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $validated['image'] = $request->file('image')->store('listings', 'public');

        $validated['user_id'] = Auth::id();

        \App\Models\Listing::create($validated);

        return redirect()->route('listing.index')->with('success', 'Listing created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listing = \App\Models\Listing::with(['user', 'category', 'firstPurchase.user'])->findOrFail($id);

        // Get current recently viewed from session or empty array
        $recent = session()->get('recently_viewed', []);

        // Remove if already exists, then prepend
        $recent = array_diff($recent, [$listing->id]);
        array_unshift($recent, $listing->id);

        // Limit to 6 items
        $recent = array_slice($recent, 0, 6);

        // Save back to session
        session(['recently_viewed' => $recent]);

        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Listing $listing)
    {
        $this->authorize('update', $listing);
        $categories = \App\Models\Category::all();
        return view('listings.edit', compact('listing', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Listing $listing)
    {
        $this->authorize('update', $listing);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image', // Add image validation
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($listing->image && \Storage::disk('public')->exists($listing->image)) {
                \Storage::disk('public')->delete($listing->image);
            }
            $data['image'] = $request->file('image')->store('listings', 'public');
        }

        $listing->update($data);

        return redirect()->route('listing.show', $listing->id)->with('success', 'Listing updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->delete();
        return redirect()->route('listing.mine')->with('success', 'Listing deleted!');
    }

    /**
     * Purchase the specified resource.
     */
    public function purchase(Request $request, $id)
    {
        $request->validate([
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        $listing = \App\Models\Listing::findOrFail($id);

        if ($listing->is_purchased) {
            return redirect()->route('listing.show', $listing->id)
                ->with('error', 'This item has already been purchased.');
        }

        \App\Models\Purchase::create([
            'user_id' => Auth::id(),
            'listing_id' => $listing->id,
        ]);

        return redirect()->route('listing.show', $listing->id)
            ->with('success', 'Purchase successful!');
    }

    /**
     * Display the authenticated user's listings.
     */
    public function mine(Request $request)
    {
        $user = Auth::user();

        $search = $request->query('search');
        $category = $request->query('category_id');
        $filter = $request->query('filter');
        $sort = $request->query('sort');

        $query = \App\Models\Listing::where('user_id', $user->id);

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'date_asc') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $listings = $query->with('category')->paginate(10);
        $categories = \App\Models\Category::all();

        return view('listings.mine', [
            'listings' => $listings,
            'categories' => $categories,
            'filter' => $filter,
            'search' => $search,
            'category' => $category,
            'sort' => $sort,
        ]);
    }

    public function lucky()
    {
        $listing = \App\Models\Listing::doesntHave('purchases')
            ->inRandomOrder()
            ->first();

        if (!$listing) {
            return redirect()->route('listing.index')->with('error', 'No listings found.');
        }

        return redirect()->route('listing.show', $listing->id);
    }
}
