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
                            <th>Title</th>
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
{{-- Modal --}}
<div class="modal fade" id="upvoteModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upvote</h4>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger btn-block victim-scam" data-id="">I'm also a victim of this scam</button>
                <button class="btn btn-success btn-block acknowledge-scam" data-id="" data-dismiss="modal">I acknowledge this scam</button>
                <button class="btn btn-info btn-block upvote-scam" data-id="" data-dismiss="modal">I just want to upvote</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        @if (\Auth::guest())
        filter: false,
        @endif
        lengthChange: false,
        pagingType: 'simple',
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
                    @if (!\Auth::guest())
                    return '<a href="#" data-toggle="modal" data-target="#upvoteModal" data-id="'+data+'"><i class="fa fa-fw fa-chevron-up"></i></a>';
                    @else
                    return '<a href="#" class="need-login"><i class="fa fa-fw fa-chevron-up"></i></a>';
                    @endif
                }
            }
        ],
        language: {
            "info": "Showing _START_ to _END_ stories",
        }
    });
});
</script>
<script>
    $('#upvoteModal').on('show.bs.modal', function (event) {
        $(this).find('[data-id]').attr('data-id', $(event.relatedTarget).data('id'));
    });

    $('#upvoteModal').on('click', '.acknowledge-scam', function (event) {
        console.log($(this).attr('data-id'));
    })
</script>
@if (\Auth::guest())
<script>
$('#scammer-list').on('click', '.need-login', function () {
    swal({
        title: "Ooops!",
        text: "You need to login first before performing this action",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "rgba(240,98,146 ,1)",
        confirmButtonText: "Login",
        closeOnConfirm: false
    },
    function(){
        window.location = "/login";
    });
})
</script>
@endif
@endsection
