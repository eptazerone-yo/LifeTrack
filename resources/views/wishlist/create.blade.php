@extends('layouts.app')

@section('content')
<h3>Tambah Wishlist</h3>

<a href="{{ route('wishlist.index') }}" class="btn btn-secondary mb-3">Kembali</a>

<form action="{{ route('wishlist.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Item</label>
        <input type="text" name="item_name" class="form-control"
               value="{{ old('item_name') }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control"
               value="{{ old('price', 0) }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="ingin" {{ old('status')=='ingin' ? 'selected' : '' }}>Ingin</option>
            <option value="ditunda" {{ old('status')=='ditunda' ? 'selected' : '' }}>Ditunda</option>
            <option value="dibeli" {{ old('status')=='dibeli' ? 'selected' : '' }}>Dibeli</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Prioritas</label>
        <input type="number" name="priority" class="form-control"
               value="{{ old('priority', 1) }}" min="1" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
