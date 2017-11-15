@extends('layouts.app')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Products </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
                    <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product List
                        <div class="pull-right"><a href="{{ URL::to('addProduct') }}" class="btn btn-info btn-xs">Add Product</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($products as $key => $product)
	                                <tr class="odd gradeX">
	                                    <td>{{ $product->id }}</td>
	                                    <td> {!!HTML::image(config('global.productPath').$product->product_image   , 'alt', array('width'=>'50', 'height'=>'50'))!!}</td> 
	                                    <td>{{ $product->product_name }}</td>
	                                    <td>{{ $product->product_detail }}</td>
	                                    <td>
                                            <a href="{{ URL::to('editProduct').'/'.urlencode(str_replace('/', '&#47;',$product->product_name)).'/'.$product->id}}"><i style="font-size: 20px;" class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0);" id="deleteProduct" productId="{{ $product->id }}"><i style="font-size: 20px;" class="fa fa-trash-o"></i></a>
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

            $('body').on('click' , "#deleteProduct", function(){
            // alert();
                var product_id=$(this).attr("productId");
                var obj=$(this);
                
               bootbox.confirm("Are you sure to delete this Product?", function(result) {
                    if(result){
                        $.ajax({
                            'type':'post',
                            'url':base_url+'/deleteProduct',
                            'headers': {'X-CSRF-TOKEN': token},
                            'data':{'product_id':product_id},
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