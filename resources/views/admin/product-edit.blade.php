@extends('layouts.app')
@section('content')
    <div class="product-edit flex justify-center items-center bg-white shadow">
        <form action="/product-update/{{ $product->id }}" method="POST" class="flex justify-center items-center flex-col p-5">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Количество</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Изображение</label>
                <input type="text" class="form-control" id="img" name="img" value="{{ $product->img }}"
                placeholder="Введите название изображения">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Категория</label>
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->product_type == $product->product_type) > {{ $category->product_type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-primary bg-blue-700" value="Подтвердить">
        </form>
    </div>
@endsection
