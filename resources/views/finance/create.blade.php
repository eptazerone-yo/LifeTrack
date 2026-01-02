@extends('layouts.app')

@section('content')
<h3>Tambah Data Keuangan</h3>

<a href="{{ route('finance.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Keuangan</a>



<form action="{{ route('finance.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="type" class="form-label">Tipe</label>
        <select name="type" id="type" class="form-select">
            <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
            <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Kategori</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}">
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Jumlah</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
