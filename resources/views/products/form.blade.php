@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <?php
    $url = route('products.store');
    if (isset($product)) $url = route('products.update', $product->id);
    ?>
    <form action="{{ $url }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($product))
            @method('PATCH')
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" value="{{ isset($product) ? $product->title : '' }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" value="{{ isset($product) ? $product->price : '' }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($product) ? 'Update' : 'Add' }} Product
        </button>
    </form>
</div>
@endsection
