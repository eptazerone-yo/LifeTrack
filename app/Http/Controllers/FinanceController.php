<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $finances = Finance::where('user_id', Auth::id())
                            ->orderBy('date', 'desc')
                            ->get();

        return view('finance.index', compact('finances'));
    }

    public function create()
    {
        return view('finance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Finance::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'category' => $request->category,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('finance.index')->with('success', 'Data keuangan berhasil ditambahkan!');
    }

    public function edit(Finance $finance)
    {
        $this->authorizeFinance($finance);
        return view('finance.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $this->authorizeFinance($finance);

        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|integer',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $finance->update($request->only(['type','category','amount','date','description']));

        return redirect()->route('finance.index')->with('success', 'Yeay, Data keuangan berhasil diupdate!');
    }

    public function destroy(Finance $finance)
    {
        $this->authorizeFinance($finance);
        $finance->delete();

        return redirect()->route('finance.index')->with('success', 'Yeay, Data keuangan berhasil dihapus!');
    }

    private function authorizeFinance(Finance $finance)
    {
        if ($finance->user_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
