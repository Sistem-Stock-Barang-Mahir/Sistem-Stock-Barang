@extends('layouts.parent')

@section('title', 'Admin')

@section('main', 'Stock In')

@section('location')
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{route('admin.stockin.create')}}" class="btn btn-md btn-success mb-3">TAMBAH STOK MASUK</a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ITEM</th>
                            <th scope="col">SUPPLIER</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">RECEIVED AT</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($stocks as $stock)
                                    <th scope="row">{{$stock->id}}</th>
                                    <td>{{$stock->id_items}}</td>
                                    <td>{{$stock->id_supplier->name}}</td>
                                    <td>{{$stock->quantity}}</td>
                                    <td>{{$stock->updated_at}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
