@extends('layouts.app')
@section('content')
<?php
    $url = route('products.store');
    if(isset($product)) $url = route('products.update', $product->id);
?>
<form action="{{ $url }}" method="POST" class="space-y-4">
    @csrf
    @if(isset($product))
        @method('PATCH')
    @endif
    <div>
        <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
        <input type="text" id="title" name="title" value="{{ isset($product) ? $product->title : '' }}" class="mt-1 p-2 w-full border rounded-md">
    </div>
    <div>
        <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
        <input type="number" id="price" name="price" value="{{ isset($product) ? $product->price : '' }}" class="mt-1 p-2 w-full border rounded-md">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ isset($product) ? 'Update' : 'Add' }} Product</button>
</form>
@endsection