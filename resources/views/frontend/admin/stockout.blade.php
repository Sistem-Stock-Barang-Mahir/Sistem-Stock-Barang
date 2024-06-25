@extends('layouts.parent')

@section('title', 'Admin')

@section('main', 'Stock Out')

@section('location')
    <div class="breadcrumb-item">Stock Out</div>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('tambah_stockout') }}" class="btn btn-md btn-success mb-3">
                        <i class="fas fa-plus"></i> Tambah Stock Out
                    </a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">ITEM</th>
                            <th scope="col">SUPPLIER</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">RECEIVED AT</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stockouts as $Stockout)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $Stockout->item->name }}</td>
                                    <td>{{ $Stockout->supplier->nama_supplier }}</td>
                                    <td>{{ $Stockout->quantity }}</td>
                                    <td>{{ $Stockout->received_at }}</td>
                                    <td>
                                        <a href="{{ route('edit_stockout', $Stockout->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('hapus_stockout', $Stockout->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
