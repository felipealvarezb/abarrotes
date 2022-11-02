@extends('layouts.app')
@section('title', $viewData["title"]) 
@section('subtitle', __('My Orders')) 
@section('content')
@forelse ($viewData["orders"] as $order)
<div class="card mb-4">
    <div class="card-header">
        {{ __('Order') }} #{{ $order->getId() }} 
        <div class="d-flex flex-row-reverse">
            <a href="{{ route('myaccount.pdf', ['id'=> $order->getId()]) }}" class="btn btn-primary ">PDF</a>
        </div>
    </div>
    <div class="card-body">
        <b>{{ __('Date') }}</b>: {{ $order->getCreatedAt() }}<br /> 
        <b>{{ __('Total') }}</b> ${{ $order->getTotal() }}<br />
        <table class="table table-bordered table-striped text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">{{ __('Item ID') }}</th>
                    <th scope="col">{{ __('Product Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->getItems() as $item) 
                    <tr>
                        <td>{{ $item->getId() }}</td>
                        <td>
                            <a class="link-success"
                                href="{{ route('product.show', ['id'=> $item->getProduct()->getId()]) }}">
                                {{ $item->getProduct()->getName() }} </a>
                        </td>
                        <td>${{ $item->getPrice() }}</td>
                        <td>{{ $item->getQuantity() }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
@empty
    <div class="alert alert-danger" role="alert">
        {{ __(' Seems to be that you have not purchased anything in our store ') }} 
    </div>
@endforelse
@endsection