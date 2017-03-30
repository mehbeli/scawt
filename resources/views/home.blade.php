@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Scammer Search</b></div>
                <div class="panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-border btn-default" type="button"><i class="fa fa-search fa-fw"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Trending Scammers</h3>
            <table class="table table-striped table-scammer-trending">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Scammer Name</th>
                            <th>Location</th>
                            <th>First report date</th>
                            <th>Medium</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 30; $i++)
                        <tr>
                            <td style="widtd: 30px;"><i class="fa fa-fw fa-chevron-up" data-toggle="tooltip" data-placement="bottom" title="Upvote!"></i></td>
                            <td>
                                Testing Name
                            </td>
                            <td>
                                Kuala Lumpur, Malaysia
                            </td>
                            <td>22 April 2015</td>
                            <td>
                                Online
                            </td>
                            <td>
                                @if (rand(0,1))
                                    Buyer
                                @else
                                    Seller
                                @endif
                            </td>
                            <td><a href="#" class="btn btn-xs btn-info">Details</a></td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
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
@endsection
