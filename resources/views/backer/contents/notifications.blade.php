@extends('backer.layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
<style>
    .table-campaign-title{
        white-space: nowrap;
        overflow: hidden;
    }
    th { font-size: 12px; }
    td { font-size: 12px; }
</style>
@endsection

@section('content')
<section>
    <div class="row mb-2">
        <div class="col-md-9">
            <h2 class="float-left mb-0">All notifications</h2>
        </div>
        <div class="col-md-3">
            <button type="button" class="float-right btn btn-link btn-mark-all-read">Mark all as read</button>
        </div>
    </div>
</section>
<section class="notifications-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="notifications-list-table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heading</th>
                        <th>About</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notification)
                    <tr>
                        <td width="15%">{{$notification->created_at->format('M d, Y')}}</td>
                        <td>{{@$notification->data['heading']}}</td>
                        <td>{{@$notification->data['text']}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center"><h3>No Notifications Found</h3></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>      
@endsection


@section('external_js')
<script src="{{asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endsection
@section('scripts')
<script>
    $(function(){
        'user strict';

        $('.btn-mark-all-read').on('click', function(){
            $.get("{{route('backer.notifications.markall')}}").then((resp)=>{
                Swal.fire({
                    title: 'Success!',
                    text: resp.msg,
                    icon: 'success'
                }).then(()=>{
                    location.reload();
                });
            });
        });
    })
</script>
@endsection