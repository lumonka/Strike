@extends('layouts.app')
@section('content')
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
                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="inline-block w-full px-8 py-4 font-bold text-center text-white uppercase transition duration-200 bg-blue-500 rounded-md md:w-auto hover:bg-blue-600 " href="/create-order">Оформить заказ</button>
                </div>
{{--                <div class="">К оплате <span>{{ $total }}</span></div>--}}
{{--                <form action="/create-order" method="post">--}}
{{--                    @csrf--}}
{{--                    <input type="password" class="password form-control" value="{{ old('password') }}" autocomplete="current-password" name="password"--}}
{{--                           placeholder="Введите пароль" required>--}}
{{--                    <input type="submit" value="Сформировать заказ" class="order__confirm btn btn-outline-success">--}}
{{--                </form>--}}
            </div>
        </section>

        <!-- Main modal -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center container mx-auto items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Подтвердите действие
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" method="post" action="/create-order">
                            @csrf
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваш пароль</label>
                                <input type="password" name="password" value="{{ old('password') }}" autocomplete="current-password" id="password" placeholder="••••••••" class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <button type="submit" class="order__confirm w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Оформить заказ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const btn = document.querySelector('.order__confirm')
            const password = document.querySelector('.password')
            btn.addEventListener('click', (e) => {
                e.preventDefault()
                let response = undefined;
                fetch(`/create-order`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        'password': password.value
                    }),
                    method: "POST"
                })
                    .then(res => response = res.json())
                    .finally(async () => {
                        let message = await response
                        if (message.message === 'err') {
                            password.classList.add('is-invalid')
                            setTimeout(() => {
                                password.classList.remove('is-invalid')
                            }, 10000);
                        } else {
                            password.classList.remove('is-invalid')
                            password.classList.add('is-valid')
                            setTimeout(() => {
                                window.location.replace('/user')
                            }, 500);
                        }
                    })
            })
        </script>
@endsection
