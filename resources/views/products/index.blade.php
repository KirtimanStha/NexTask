@extends('layouts')

@section('content')
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $key => $product)
            <tr id="row-{{ $key }}">
                <td>#</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <button onclick="openDeleteModal('{{ $key }}', '{{ $product->id }}')" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No products found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>

    <!-- Main modal -->
    <div id="default-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteProductButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openDeleteModal(key, productId) {
            $('#default-modal').modal('show');

            $('#deleteProductButton').on('click', function () {
                $.ajax({
                    url: '/products/' + productId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == 'success') {
                            $("#row-" + key).remove();
                            toastr.options.positionClass = 'toast-bottom-right';
                            toastr.success("Product deleted successfully");
                        }
                    },
                    error: function (error) {
                        toastr.options.positionClass = 'toast-bottom-right';
                        toastr.error("Error deleting product");
                    },
                    complete: function () {
                        $('#default-modal').modal('hide');
                    }
                });
            });
        }
    </script>
@endsection
