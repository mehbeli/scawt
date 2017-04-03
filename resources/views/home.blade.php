@extends('layouts.app')
@section('css')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <!-- Tab panes -->
                <table id="scammer-list" class="table table-striped table-scammer-trending">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 27px !important;"></th>
                            <th>Scammer Name</th>
                            <th>Location</th>
                            <th>First report date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
$(function() {
    $('#scammer-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('scammer-list') !!}',
        columns: [
            { data: 'rownum', name: 'rownum'},
            { data: 'uv', name: 'uv' },
            { data: 'name', name: 'name' },
            { data: 'location', name: 'location', visible: false  },
            { data: 'first_report', name: 'first_report' },
            { data: 'details', name: 'details' }
        ],
        order: [[0, 'asc']],
        lengthChange: false,
        columnDefs: [
            {
                targets: 5,
                sortable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return '<a href="/scammer/'+data+'" class="btn btn-xs btn-info">Details</a>';
                }
            },
            {
                targets: 1,
                sortable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return '<i class="fa fa-fw fa-chevron-up" data-id="'+data+'"></i>';
                }
            }
        ]
    });
});
</script>
@endsection
