@extends('layouts.master')
@section('title')
    @lang('my-book')
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title mb-0 flex-grow-1">Orders</h4>
                    </div>

                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:22px;">SN</th>
                                <th>Name</th>
                                <th>Total_Amount</th>
                                <th class="col-2">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
                ajax: "{{ url('admin/view-orders') }}",
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
                        data: 'total_amount',
                        name: 'total_amount',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });





        });
    </script>
@endsection

