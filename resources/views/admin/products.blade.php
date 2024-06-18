@extends('layouts.app')
@section('content')
    <table class="cart__table container mx-auto bg-white shadow">
        <thead>
        <tr>
            <th>Изображение</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="cart__raw">
                <td><img src="{{ Vite::asset('resources/media/images/') . $product->img }}" alt="" srcset=""
                    width="100px"></td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->product_type }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->price }}</td>
                <td class="">
                    <a href="/product-edit/{{ $product->id }}" class="btn btn-primary">Редактировать</a>
                    <form action="/product-delete/{{ $product->id }}" method="post" class="flex mt-5">
                        @method('delete')
                        @csrf
                        <input type="submit" class="btn btn-danger bg-red-700" value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
