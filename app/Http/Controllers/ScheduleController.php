<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'date'     => 'required|date',
            'time'     => 'required',
            'status'   => 'required|in:pending,ongoing,done',
            'priority' => 'required|in:low,normal,high',
            'notes'    => 'nullable|string',
        ]);

        Schedule::create([
            'user_id'  => Auth::id(),
            'title'    => $validated['title'],
            'date'     => $validated['date'],
            'time'     => $validated['time'],
            'status'   => $validated['status'],
            'priority' => $validated['priority'],
            'notes'    => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Yeay, Jadwal berhasil ditambahkan!');
    }

    public function edit(Schedule $schedule)
    {
        $this->authorizeSchedule($schedule);

        return view('schedule.edit', compact('schedule'));
    }


    public function update(Request $request, Schedule $schedule)
    {
        $this->authorizeSchedule($schedule);

        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'date'     => 'required|date',
            'time'     => 'required',
            'status'   => 'required|in:pending,ongoing,done',
            'priority' => 'required|in:low,normal,high', // tambahkan prioritas
            'notes'    => 'nullable|string',
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Yeay, Jadwal berhasil diperbarui!');
    }


    public function destroy(Schedule $schedule)
    {
        $this->authorizeSchedule($schedule);

        $schedule->delete();

        return redirect()
            ->route('schedule.index')
            ->with('success', 'Yeay, Jadwal berhasil dihapus!');
    }


    private function authorizeSchedule(Schedule $schedule)
    {
        if ($schedule->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
