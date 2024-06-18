@extends('layouts.app')
@section('content')
    @if(count($cart) > 0)
        <section class="items-center py-24 bg-gray-50 font-poppins dark:bg-gray-700">
            <div class="justify-center flex-1 max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
                <h2 class="mb-10 text-4xl font-bold text-center dark:text-gray-400">Корзина</h2>
                <div class="mb-10">
                    @foreach($cart as $item)
                        <div class="cart__raw">
                            <div class="relative flex flex-wrap items-center pb-8 mb-8 -mx-4 border-b border-gray-200 dark:border-gray-500 xl:justify-between border-opacity-40">
                                <div class="w-full mb-4 md:mb-0 h-96 md:h-44 md:w-56">
                                    <img src="{{ Vite::asset('resources/media/images/') . $item->img }}" alt="" class="object-cover w-full h-full">
                                </div>
                                <div class="w-full px-4 mb-6 md:w-96 xl:mb-0">
                                    <a class="block mb-5 text-xl font-medium dark:text-gray-400 hover:underline" href="/catalog">{{ $item->title }}</a>
                                    <div class="flex flex-wrap">
                                        <p class="mr-4 text-sm font-medium">
                                            <span class="dark:text-gray-400">Стоимость:</span>
                                            <span class="text-xl font-medium text-blue-500 dark:text-blue-400">{{ $item->price }}</span>
                                            <span class="text-sm font-medium text-blue-500 dark:text-blue-400">₽</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full px-4 mt-6 mb-6 xl:w-auto xl:mb-0 xl:mt-0">
                                    <div class="flex items-center">
                                        <h2 class="mr-4 font-medium dark:text-gray-400">Количество:</h2>
                                        <div class="inline-flex items-center px-4 font-semibold text-gray-500 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 ">
                                            <button class="btn {{ $item->qty == $item->limit ? 'disabled' : '' }}" id="increase" cartid="{{ $item->id }}">+</button>
                                            <span class="p-3">{{ $item->qty }}</span>
                                            <button class="btn" id="decrease" cartid="{{ $item->id }}">-</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:w-auto">
                                <span class="text-xl font-medium text-blue-500 dark:text-blue-400">
                                        <span class="text-sm">₽</span>
                                        <span>{{ $item->price * $item->qty }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="mb-10">
                            <div class="px-10 py-3 rounded-full dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span class="text-base font-bold md:text-xl ">Всего</span>
                                    <span class="font-bold ">₽{{ $total }}</span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="text-right">
                    <a class="inline-block w-full px-8 py-4 mb-4 mr-6 font-bold text-center uppercase transition duration-200 bg-gray-100 border rounded-md dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800 md:mb-0 md:w-auto hover:bg-gray-200 " href="/">Продолжить покупки</a>
                    <a class="inline-block w-full px-8 py-4 font-bold text-center text-white uppercase transition duration-200 bg-blue-500 rounded-md md:w-auto hover:bg-blue-600 " href="/create-order">Оформить заказ</a>
                </div>
            </div>
        </section>
    @else
        <h3 class="cart__table--empty">Корзина пуста</h3>
    @endif
{{--    <div class="cart">--}}
{{--        @if(count($cart) > 0)--}}
{{--            <table class="cart__table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Название</th>--}}
{{--                    <th>Количество</th>--}}
{{--                    <th>Цена</th>--}}
{{--                    <th>Итого</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($cart as $item)--}}
{{--                    <tr class="cart__raw">--}}
{{--                        <td>{{ $item->title }}</td>--}}
{{--                        <td class="cart__qty">--}}
{{--                            <button class="btn {{ $item->qty == $item->limit ? 'disabled' : '' }}" id="increase" cartid="{{ $item->id }}">+</button>--}}
{{--                            <span class="cart__qty-value">--}}
{{--                            {{ $item->qty }}--}}
{{--                        </span>--}}
{{--                            <button class="btn" id="decrease" cartid="{{ $item->id }}">-</button>--}}
{{--                        </td>--}}
{{--                        <td class="cart__price">{{ $item->price }}</td>--}}
{{--                        <td class="cart__price-total">{{ $item->price * $item->qty }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--            <a href="{{ route('create-order') }}">Оформить заказ</a>--}}
{{--        @else--}}
{{--            <h3 class="cart__table--empty">Корзина пуста</h3>--}}
{{--        @endif--}}
{{--    </div>--}}
    <script>
        const cartRaws = document.querySelectorAll('.cart__raw')

        cartRaws.forEach(raw => {
           const increase = raw.querySelector('#increase')
           const decrease = raw.querySelector('#decrease')
            const pid = Number(increase.attributes.cartid.value)

            increase.addEventListener('click', () => {
               fetch(`/changeqty/incr/${pid}`)
                   .finally(() => window.location.reload())
            })
            decrease.addEventListener('click', () => {
                fetch(`/changeqty/decr/${pid}`)
                    .finally(() => window.location.reload())
            })
        });
    </script>
@endsection
