@extends('layouts.app')

@section('content')
<h3>Edit Data Keuangan</h3>

<form action="{{ route('finance.update', $finance->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tipe</label>
        <select name="type" class="form-control" required>
            <option value="income" {{ $finance->type == 'income' ? 'selected' : '' }}>Income</option>
            <option value="expense" {{ $finance->type == 'expense' ? 'selected' : '' }}>Expense</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="category" value="{{ $finance->category }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="amount" value="{{ $finance->amount }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="date" value="{{ $finance->date }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control">{{ $finance->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('finance.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
