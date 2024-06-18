@extends('layouts.app')
@section('content')
    <div class="product mt-8 flex items-center justify-evenly">
        <img src="{{ Vite::asset('resources/media/images/') . $product->img }}" alt="" class="product__image">
        <div class="product__main-info">
            <div class="product__title">{{ $product->title }}</div>
            <div class="product__price"><span>Цена: </span>
                <hr style="background: #1a202c; width: 45%;"><p class="bg-blue-100 text-blue-800 text-[16px] font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $product->price }}₽</p></div>
            <div class="product__characteristic"><span>Категория: </span>
                <hr style="background: #1a202c; width: 25%;"><p class="bg-blue-100 text-blue-800 text-[16px] font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $product->product_type }}</p></div>
{{--            <div class="product__offer-button">--}}
{{--                <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Войти в аккаунт</a>--}}
{{--            </div>--}}
            @if(Auth::check())
                <div class="product__offer-button">
{{--                    <button class="product__add-to-cart btn btn-primary p-2 m-1">Добавить в корзину</button>--}}
                    <button class="product__add-to-cart text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Приобрести</button>
{{--                    <div class="toast error align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">--}}
{{--                        <div class="d-flex">--}}
{{--                            <div class="toast-body">--}}
{{--                                В наличии столько нет--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="toast success align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">--}}
{{--                        <div class="d-flex">--}}
{{--                            <div class="toast-body">--}}
{{--                                Товар добавлен в корзину--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            @else
                <div class="product__offer-button">
                    <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Войти в аккаунт</a>
                </div>
            @endif
        </div>
    </div>
    <script>
        const pid = {{ $product->id }}
        const button = document.querySelector('.product__add-to-cart')
        button.addEventListener('click', () => {
            let status = 0
            fetch(`/add-to-cart/${pid}`)
                .then(response => status = response.status)
                .then(() => {
                    if (status > 100) {
                        alert('Добавлено в корзину!')
                        window.location.href = '/cart'
                    } else {
                        alert('Товара нет в наличии!')
                    }
                })
        })
    </script>
@endsection
