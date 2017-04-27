@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <!-- Tab panes -->
                <table id="scammer-list" class="table table-striped table-scammer-trending">
                    <thead>
                        <tr>
                            <th style="width: 20px !important;"></th>
                            <th style="width: 27px !important;"></th>
                            <th>Title</th>
                            <th style="width: 80px !important;"></th>
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
{{-- Details Modal --}}
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button> --}}
<div class="modal fade details-modal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Scam Details</h4>
      </div>
      <div class="modal-body">
          testing
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
    $('table').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
</script>
<script>
$(function() {
    $('#scammer-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('storylist') !!}',
        columns: [
            { data: 'rownum', name: 'rownum'},
            { data: 'uv', name: 'uv' },
            { data: 'title', name: 'title' },
            { data: 'details', name: 'details' }
        ],
        order: [[0, 'asc']],
        filter: false,
        lengthChange: false,
        pagingType: 'simple',
        columnDefs: [
            {
                targets: 3,
                sortable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return '<a href="/scammer/'+data.id+'" class="btn btn-xs btn-info">Details</a>';
                }
            },
            {
                targets: 2,
                sortable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    console.log(data);
                    if (data.external == 1) {
                        return '<div><b><a href="'+data.url+'">[EXT] '+data.title+'</a></b></div><div style="font-size: 10px;">'+data.points+' points</div>';
                    } else {
                        return '<div><b>'+data.title+'</b></div><div style="font-size: 10px;">'+data.location+' &bull; '+data.points+' points</div>';
                    }
                }
            },
            {
                targets: 1,
                sortable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    @if (!\Auth::guest())
                    return '<a href="#" data-toggle="modal" data-target="#upvoteModal" data-id="'+data+'"><i data-toggle="tooltip" title="Upvote!" class="fa fa-fw fa-chevron-up"></i></a>';
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
