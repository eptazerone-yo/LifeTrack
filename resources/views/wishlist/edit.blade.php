@extends('layouts.app')

@section('content')
<h3>Edit Wishlist</h3>

<a href="{{ route('wishlist.index') }}" class="btn btn-secondary mb-3">Kembali</a>

<form action="{{ route('wishlist.update', $wishlist->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Item</label>
        <input type="text" name="item_name" class="form-control"
        value="{{ old('item_name', $wishlist->item_name) }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control"
        value="{{ old('price', $wishlist->price) }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="ingin" {{ $wishlist->status=='ingin' ? 'selected' : '' }}>Ingin</option>
            <option value="ditunda" {{ $wishlist->status=='ditunda' ? 'selected' : '' }}>Ditunda</option>
            <option value="dibeli" {{ $wishlist->status=='dibeli' ? 'selected' : '' }}>Dibeli</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Prioritas</label>
        <input type="number" name="priority" class="form-control"
        value="{{ old('priority', $wishlist->priority) }}" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
