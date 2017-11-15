@extends('layouts.app')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Shop </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
                    <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Shop List
                        <div class="pull-right"><a href="{{ URL::to('addShop') }}" class="btn btn-info btn-xs">Add Shop</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Shop</th>
                                    <th>Shop Address</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($shops as $key => $shop)
	                                <tr class="odd gradeX">
	                                    <td>{{ $shop->id }}</td>
	                                    <td> {!!HTML::image(config('global.shopPath').$shop->shop_images , 'alt', array('width'=>'50', 'height'=>'50'))!!}</td> 
	                                    <td>{{ $shop->shop_name }}</td>
                                        <td>{{ $shop->shop_address }}</td>
	                                    <td>{{ $shop->shop_detail }}</td>
	                                    <td>
                                            <a href="{{ URL::to('ShopProducts').'/'.urlencode(str_replace('/', '&#47;',$shop->shop_name)).'/'.$shop->id}}" class="btn btn-primary btn-xs"><i class="fa fa-list" ></i> Products</a>

                                            <a href="{{ URL::to('editShop').'/'.urlencode(str_replace('/', '&#47;',$shop->shop_name)).'/'.$shop->id}}"><i style="font-size: 20px;" class="fa fa-edit"></i></a>

                                            <a href="javascript:void(0);" id="deleteShop" shopId="{{ $shop->id }}"><i style="font-size: 20px;" class="fa fa-trash-o"></i></a>
                                        </td>
	                                </tr>
	                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@push('css')
	<!-- DataTables CSS -->
	{!! HTML::style('admintheam/vendor/datatables-plugins/dataTables.bootstrap.css') !!}
    <!-- DataTables Responsive CSS -->
    {!! HTML::style('admintheam/vendor/datatables-responsive/dataTables.responsive.css') !!}

@endpush
@push('scripts')
	{!! HTML::script('admintheam/vendor/datatables/js/jquery.dataTables.min.js') !!}
	{!! HTML::script('admintheam/vendor/datatables-plugins/dataTables.bootstrap.min.js') !!}
	{!! HTML::script('admintheam/vendor/datatables-responsive/dataTables.responsive.js') !!}
    
	<script type="text/javascript">
		$(document).ready(function() {

            var token ="{{ csrf_token() }}";
            var base_url="{{URL::to('/')}}";

            $('#dataTables-example').DataTable({
                responsive: true
            });

            $('body').on('click' , "#deleteShop", function(){
            // alert();
                var shop_id=$(this).attr("shopId");
                var obj=$(this);
                
               bootbox.confirm("Are you sure to delete this Shop?", function(result) {
                    if(result){
                        $.ajax({
                            'type':'post',
                            'url':base_url+'/deleteShop',
                            'headers': {'X-CSRF-TOKEN': token},
                            'data':{'shop_id':shop_id},
                            'dataType':'json',
                            'success':function(resp){
                                if(resp.status==1){
                                    setTimeout(function () {
                                      swal ( "Success" , resp.massage ,  "success" )
                                    }, 1000);
                                    obj.parents('tr').remove();
                                }else{
                                    setTimeout(function () {
                                      swal ( "" , resp.massage ,  "error" )
                                    }, 1000);
                                }
                            }
                        });
                    }
                });
            });

        });
	</script>
@endpush
@endsection