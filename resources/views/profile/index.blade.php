@extends('layouts.app')
@section('content')
    <div class="user">
        @if(count($orders))
            <div class="user-orders orders">
                @foreach($orders as $order)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Код
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Статус
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Название
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Количество
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Стоимость
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Действие
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <code>{{ $order->number }}</code>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $order->status }}
                                </td>
                                @foreach($order->products as $product)
                                <td class="px-6 py-4">
                                    {{ $product->title }}
                                </td>
                                    <td class="px-6 py-4">
                                        {{ $order->totalQty }}шт.
                                    </td>
                                <td class="px-6 py-4">
                                    {{ $product->price }}
                                </td>
                                @endforeach
                                @if($order->status == 'Новый')
                                    <form action="/order-delete/{{ $order->number }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <td class="px-6 py-4">
                                            <input type="submit" value="Удалить" class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                        </td>
                                    </form>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="cart__table--empty">Здесь будут отображаться заказы</h3>
        @endif
    </div>
@endsection
