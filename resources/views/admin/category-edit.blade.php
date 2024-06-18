@extends('layouts.app')
@section('content')
    <div class="category-edit flex justify-center items-center bg-white shadow">
        <form action="/category-update/{{ $category->id }}" method="POST" class="flex justify-center items-center flex-col p-5">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $category->product_type }}">
            </div>
            <input type="submit" class="btn btn-primary bg-blue-700" value="Подтвердить">
        </form>
    </div>
@endsection
