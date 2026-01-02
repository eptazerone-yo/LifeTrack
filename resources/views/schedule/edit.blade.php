@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Jadwal</h3>


    <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" 
            value="{{ old('title', $schedule->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Deadline</label>
            <input type="date" name="date" id="date" class="form-control" 
            value="{{ old('date', $schedule->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Waktu</label>
            <input type="time" name="time" id="time" class="form-control" 
            value="{{ old('time', $schedule->time) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending" {{ old('status', $schedule->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="ongoing" {{ old('status', $schedule->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="done" {{ old('status', $schedule->status) == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritas</label>
            <select name="priority" id="priority" class="form-select" required>
                <option value="low" {{ $schedule->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="normal" {{ $schedule->priority == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="high" {{ $schedule->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Deskripsi</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $schedule->notes) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('schedule.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
