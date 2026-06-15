{{-- Penggunaan Component Layout --}}


{{-- resources/views/products/create.blade.php --}}


@extends('layouts.master')


@section('title', 'Tambah Produk')


@section('content')


<div class="container">




<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">
        Tambah Produk Baru
    </h4>


    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>


<div class="card shadow-sm border-0">
    <div class="card-body">


        <form
            action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="mb-3">
                <label class="form-label">
                    Nama Produk
                </label>


                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                >
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Slug
                </label>


                <input
                    type="text"
                    id="slug"
                    name="slug"
                    class="form-control"
                    readonly
                >
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Kategori
                </label>


                <select
                    name="category_id"
                    class="form-select"
                >
                    <option value="">
                        Pilih Kategori
                    </option>


                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Harga
                </label>


                <input
                    type="number"
                    name="price"
                    class="form-control"
                    value="{{ old('price') }}"
                >
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Stok
                </label>


                <input
                    type="number"
                    name="stock"
                    class="form-control"
                    value="{{ old('stock') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan Produk
            </button>


        </form>


    </div>
</div>

<script>
document.getElementById('name').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '');

    document.getElementById('slug').value = slug;
});
</script>


</div>


@endsection
