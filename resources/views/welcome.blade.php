<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Strikeball</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
    @extends('layouts.app')
    @section('content')


        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-[900px] overflow-hidden">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ Vite::asset('resources/media/images/slider/0_kapak-91.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ Vite::asset('resources/media/images/slider/1666785467_33-mykaleidoscope-ru-p-pro-spetsnaz-oboi-34.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ Vite::asset('resources/media/images/slider/classic-indoor-airsoft-in-prague.60e5abc7e6a58.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
            </button>
        </div>

        {{--        <section class="info">--}}
{{--            <div class="info__container">--}}
{{--                <div class="info__wrapper">--}}
{{--                    <div class="info__title">СКИДКА 85% НА ВСЕ ТОВАРЫ</div>--}}
{{--                    <div class="info__desc">Акция скоро закончится, поспеши!</div>--}}
{{--                    <a type="button" href="#!" class="info__button bg-blue-700">Подробнее</a>--}}
{{--                </div>--}}
{{--                <div class="info__img">--}}
{{--                    <img src="{{ Vite::asset("resources/media/images/info.png") }}" alt="sale" width="768px">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <section class="catalog container mx-auto mt-[169px] max-[768px]:text-center">
            <div class="catalog__title">Каталог товаров</div>
            <div class="wrapper mt-[70px] gap-8 flex flex-wrap max-[768px]:justify-center">
            @foreach($products as $product)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="/product/{{ $product->id }}">
                        <img class="p-8 rounded-t-lg" src="{{ Vite::asset('resources/media/images/') . $product->img }}" alt="{{ Vite::asset('resources/media/images/') . $product->img }}" />
                    </a>
                    <div class="px-5 pb-5">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->title }}</h5>
                        <div class="flex items-center mt-2.5 mb-5">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">В наличии: {{ $product->qty }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $product->price }}₽</span>
                            <a href="/product/{{ $product->id }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </section>
        <section class="promo">
            <div class="promo__container flex items-center justify-around">
                <div class="info__wrapper max-[768px]:text-center">
                    <div class="promo__title highlight text-center max-[768px]:text-[48px]">
                        <span>РАСПРОДАЖА</span>
                    </div>
                    <div class="promo__subtitle mt-5 max-[768px]:text-[28px]">АКЦИЯ ДО 1 ОКТЯБРЯ!</div>
                    <div class="promo__desc mt-[68px] max-[768px]:text-base max-[768px]:w-auto">Кстати, сторонники тоталитаризма в науке объективно рассмотрены соответствующими инстанциями. Лишь диаграммы связей призывают нас к новым свершениям, которые, в свою очередь, должны быть объективно рассмотрены соответствующими инстанциями.</div>
                    <a type="button" href="#!" class="info__button mt-[35px] text-white bg-[#53532C] hover:bg-[#3A3A1F] focus:ring-4 focus:outline-none focus:ring-blue-300
                font-medium rounded-[17px] text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Подробнее</a>
                </div>
                <div class="promo__img max-[997px]:hidden">
                    <img src="{{ Vite::asset("resources/media/images/promo.png") }}" alt="promo">
                </div>
            </div>
        </section>
        <section class="app mt-[169px]">
            <div class="container mx-auto">
                <div class="app__wrapper flex justify-between items-center max-[768px]:text-center">
                    <div class="app__info max-[768px]:mx-auto max-[768px]:text-center">
                        <div class="app__title max-[768px]:text-[32px] max-[768px]:w-auto">У НАС ПОЯВИЛОСЬ СВОЕ ПРИЛОЖЕНИЕ!</div>
                        <div class="app__subtitle max-[768px]:w-auto">Получи скидку в 30% при скачивании приложения!</div>
                        <div class="app__icons flex gap-4 max-[768px]:justify-center">
                            <a href="#!"><img src="{{ Vite::asset("resources/media/images/icons/app-store.png") }}" alt="app-store"></a>
                            <a href="#!"><img src="{{ Vite::asset("resources/media/images/icons/google-play.png") }}" alt="google-play"></a>
                        </div>
                    </div>
                    <div class="app__img max-[768px]:hidden">
                        <img src="{{ Vite::asset("resources/media/images/vouchers-img.png") }}" alt="vouchers-img">
                    </div>
                </div>
            </div>
        </section>
    @endsection
    </body>
</html>
