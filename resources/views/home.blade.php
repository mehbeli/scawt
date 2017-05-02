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
                <button class="btn btn-danger btn-block btn-vote victim-scam" data-id="" data-type="victim" data-dismiss="modal">I'm also a victim of this scam</button>
                <button class="btn btn-success btn-block btn-vote acknowledge-scam" data-id="" data-type="acknowledge" data-dismiss="modal">I acknowledge this scam</button>
                <button class="btn btn-info btn-block btn-vote upvote-scam" data-id="" data-type="upvote" data-dismiss="modal">I just want to upvote</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('table').tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    scamList = $('#scammer-list').DataTable({
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
                    if (data == 'voted') {
                        return '<span class="text-success"><i data-toggle="tooltip" title="Thanks for the upvote!" class="fa fa-fw fa-check"></i></span>';
                    } else {
                        return '<a href="#" data-toggle="modal" data-target="#upvoteModal" data-id="'+data+'"><i data-toggle="tooltip" title="Upvote!" class="fa fa-fw fa-chevron-up"></i></a>';
                    }
                    @else
                    return '<a href="#" class="need-login"><i class="fa fa-fw fa-chevron-up"></i></a>';
                    @endif
                }
            }
        ],
        language: {
            "info": "Showing _START_ to _END_ stories",
            "processing": "Loading Stories...",
            "loadingRecords": "Loading Stories...",
        }
    });

    $('#upvoteModal').on('show.bs.modal', function (event) {
        $(this).find('[data-id]').attr('data-id', $(event.relatedTarget).data('id'));
    });

    $('#upvoteModal').on('click', '.btn-vote', function (event) {
        console.log($(this).attr('data-type'));
        $.ajax({
            method: "POST",
            url: "/reports/upvote",
            cache: false,
            data: {
                id: $(this).attr('data-id'),
                rtype: $(this).attr('data-type'),
            }
        }).done(function (data) {

            if (data.response == 'error') {
                swal({
                  title: 'Ooops!',
                  text: data.message,
                  type: 'error',
                  timer: 2000,
                  showConfirmButton: false
                });
            } else {
                swal({
                  title: 'Thanks!',
                  text: data.message,
                  type: 'success',
                  timer: 2000,
                  showConfirmButton: false
                });
            }
            scamList.draw(false);
        }).fail(function (xhr, status) {
            scamList.draw(false);
        });
    });

    $('#upvoteModal').on('click', '.acknowledge-scam', function (event) {
        console.log($(this).attr('data-id'));
    })

@if (\Auth::guest())
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
@endif
</script>
@endsection
