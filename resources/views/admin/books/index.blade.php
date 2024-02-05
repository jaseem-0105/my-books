@extends('layouts.master')
@section('title')
    @lang('my-book')
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- @component('components.breadcrumb')
        @slot('li_1')
            Book
        @endslot
        @slot('title')
            Grid Js
        @endslot
    @endcomponent --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4 class="card-title mb-0 flex-grow-1">Books</h4>
                    </div>
                    <div class="col-12 col-xl-auto ">
                        <a class="btn btn-sm text-white" style="background-color:#4219d8" href="#"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:22px;">SN</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Language</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th class="col-2">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/books" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Book</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Book Name"
                                    value="" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Author</label>
                                <input class="form-control" name="author" type="text" placeholder="Enter Author Name"
                                    value="" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Language</label>
                                <input class="form-control" name="language" type="text" placeholder="Enter Language"
                                    value="" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Price</label>
                                <input class="form-control" name="price" type="number" placeholder="Enter Price"
                                    value="" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Description</label>
                                <textarea class="form-control" name="description" type="text" placeholder="Enter Description"
                                    value=""  > </textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="small mb-1" for="inputFirstName">Image</label>
                                <input type="file" class="image" name="image" id="image" accept="image/*"
                                    required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary"
                            type="submit">Add</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Book</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Book Name"
                                    value="{{ old('name') }}" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Author</label>
                                <input class="form-control" name="author" type="text"
                                    placeholder="Enter Author Name" value="{{ old('author') }}" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Language</label>
                                <input class="form-control" name="language" type="text" placeholder="Enter Language"
                                    value="{{ old('language') }}" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Price</label>
                                <input class="form-control" name="price" type="number" placeholder="Enter Price"
                                    value="{{ old('price') }}" required />
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Description</label>
                                <textarea class="form-control" name="description" type="text" placeholder="Enter Description"
                                    value="{{ old('description') }}"  > </textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <img id="oldImage" src="" alt="Old Image"
                                    style="max-width: 100px; height: 100px;">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="small mb-1 mt-2" for="inputFirstName"> New Image</label>
                                <input type="file" class="image" name="image" id="image" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button"
                            data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Save
                            changes</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('backend/assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/js/app.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                "drawCallback": function(settings) {
                    feather.replace();
                },
                processing: true,
                serverSide: true,
                autoWidth: false,
                stateSave: true,
                scrollX: true,
                header: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                ajax: "{{ url('admin/books') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'author',
                        name: 'author',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'language',
                        name: 'language',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });

            $(document).on('click', '.editBook', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "/admin/books/" + id + "/edit",
                    success: function(response) {
                        console.log(response);
                        $('#editModal form').attr('action', '/admin/books/' + id);
                        $('#editModal form input[name="name"]').val(response.name);
                        $('#editModal form input[name="author"]').val(response.author);
                        $('#editModal form input[name="price"]').val(response.price);
                        $('#editModal form input[name="language"]').val(response.language);
                        $('#editModal form textarea[name="description"]').val(response.description);

                        var newImageUrl = response.image_url;
                        if (newImageUrl) {
                            $('#editModal img#oldImage').attr('src', newImageUrl).show();
                        } else {
                            $('#editModal img#oldImage').hide();
                        }

                        $('#editModal').modal('show');
                    }
                });
            });

            $(document).on('click', '.deleteBook', function() {
                var id = $(this).data('id');
                const swalWithBootstrapButtons = Swal.mixin({
                    buttonsStyling: true,
                });

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: "/admin/books/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                $('#datatablesSimple').DataTable().ajax.reload(null,
                                    false);
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Book has been deleted.',
                                    'success'
                                );
                            }
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'file is safe :)',
                            'error'
                        )
                    }
                });
            });

        });
    </script>
@endsection
