<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function create()
    {
        return view('wishlist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required|in:ingin,ditunda,dibeli',
            'priority' => 'required|integer',
        ]);

        Wishlist::create([
            'user_id' => Auth::id(),
            'item_name' => $request->item_name,
            'price' => $request->price,
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Yeay, Wishlist berhasil ditambahkan!');
    }

    public function edit(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) abort(403);
        return view('wishlist.edit', compact('wishlist'));
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) abort(403);

        $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|integer',
            'status' => 'required|in:ingin,ditunda,dibeli',
            'priority' => 'required|integer',
        ]);

        $wishlist->update($request->only(['item_name', 'price', 'status', 'priority']));

        return redirect()->route('wishlist.index')->with('success', 'Yeay, Wishlist berhasil diperbarui!');
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) abort(403);

        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Yeay, Wishlist berhasil dihapus!');
    }
}

