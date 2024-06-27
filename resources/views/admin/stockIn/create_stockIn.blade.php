@extends('layouts.parent')
@section('title', 'Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
                <h1>Stock In</h1>
        </div>
        <!-- Users List Table -->
        <div class="container mt-5">
                <!-- Form -->
                <form action="{{route('admin.stockin.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="category">Items</label>
                        <select class="form-control" id="category" required>
                            @foreach($items as $item)
                                <option value="">Pilih Items</option>
                                <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="category">Supplier</label>
                        <select class="form-control" id="category" required>
                            @foreach($supplier as $supply)
                                <option value="">Pilih Supplier</option>
                                <option value="{{$supply->name}}">{{$supply->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Quantity</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Masukkan Jumlah stock yang masuk">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        <!-- Modal Backdrop -->
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('.datatables-users').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'td.control'
                    }
                },
                columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                }],
                pagingType: "full_numbers",
                language: {
                    search: "",
                    searchPlaceholder: "Search..."
                }
            });

            $('.edit-record').on('click', function() {
                let userId = $(this).data('id');
                let userName = $(this).data('name');
                let userEmail = $(this).data('email');
                let userRole = $(this).data('role');
                let userBilling = $(this).data('billing');
                let userStatus = $(this).data('status');

                $('#editName').val(userName);
                $('#editEmail').val(userEmail);
                $('#editRole').val(userRole);
                $('#editBilling').val(userBilling);
                $('#editStatus').val(userStatus);
            });

            $('.delete-record').on('click', function() {
                let userId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        // Call delete API or function here
                    }
                })
            });
        });
    </script>

@endpush
