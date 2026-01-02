@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Jadwal Baru</h3>
    <a href="{{ route('schedule.index') }}" class="btn btn-secondary mb-3">Kembali ke Jadwal</a>


    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Deadline</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Waktu</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ old('time') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending" {{ old('status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="ongoing" {{ old('status')=='ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="done" {{ old('status')=='done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Deskripsi</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
        </div>

        <div class="mb-3">
        <label for="priority" class="form-label">Prioritas</label>
        <select name="priority" id="priority" class="form-select" required>
        <option value="low" {{ old('priority')=='low' ? 'selected' : '' }}>Low</option>
        <option value="normal" {{ old('priority')=='normal' ? 'selected' : '' }}>Normal</option>
        <option value="high" {{ old('priority')=='high' ? 'selected' : '' }}>High</option>
        </select>
        </div>


        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
