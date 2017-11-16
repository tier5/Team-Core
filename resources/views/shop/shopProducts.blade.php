@extends('layouts.apps')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Shop </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
                    <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Products to {{ $shop->shop_name }}
                        <div class="pull-right"><a href="{{ URL::to('shopList') }}" class="btn btn-info btn-xs">Back</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if (Session::has('message'))
                           <div class="alert alert-info"><i class="pe-7s-gleam"></i>{{ Session::get('message') }}</div>
                        @endif
                       <div class="row">
                            <div class="col-lg-12">
                                {{Form::open(array('url' => URL::to('addShopProducts'),'files'=>true,'id'=>'addShopProducts','class'=>'form-horizontal','method'=>'POST'))}}
                                    {{ Form::hidden('id',$shop->id) }}
                                    {{ Form::hidden('shop_name',$shop->shop_name) }}
                                    <div class="form-group col-lg-12">
                                        <label>Add Product</label>
                                       {{ Form::select('products[]', $products,'', ['class' => 'form-control','id' => 'product_dropdown','multiple'=>'multiple']) }}
                                    </div>
                                    <button type="submit" class="btn w-xs btn-success" name="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
       <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Shop Product List
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shopProductsList as $key => $product)
                                    <tr class="odd gradeX">
                                        <td>{{ $product->id }}</td>
                                        <td> {!!HTML::image(config('global.productPath').$product->product_image   , 'alt', array('width'=>'50', 'height'=>'50'))!!}</td> 
                                        <td>{{ $product->product_name }}</td>
                                        <td> $ <input type="text" value="{{ $product->pivot->price }}" name="product_price" productId="{{ $product->id }}" oldPrice="{{ $product->pivot->price }}" shopId="{{ $product->pivot->shop_id }}" class="product_price"></td>
                                        <td>
                                            <a href="javascript:void(0);" id="detachProduct" productId="{{ $product->id }}" shopId="{{ $product->pivot->shop_id }}" ><i style="font-size: 20px;" class="fa fa-trash-o"></i></a>
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

    </div>
    <!-- /.container-fluid -->
</div>
@push('css')
    {!!HTML::style('css/select2.css')!!}
@endpush
@push('scripts')
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js') !!}
    {!!HTML::script('js/select2.js')!!}

    <script type="text/javascript">
        $(document).ready(function(){

            setTimeout(function () {
                $('.alert').hide();
            }, 2000);
            
            $("#addShopProducts").validate({
                rules: {
                    'products[]': {
                        required: true,
                    }
                },
            });

            $("#product_dropdown").select2({
                placeholder: "Select Product",
                multiple: true,
            });

            var token ="{{ csrf_token() }}";
            var base_url="{{URL::to('/')}}";
            
            $('body').on('focusout' , ".product_price", function(){

                var product_id=$(this).attr("productId");
                var price=$(this).val();
                var oldPrice=$(this).attr("oldPrice");
                var shop_id=$(this).attr("shopId");
                var obj=$(this);
                if(oldPrice != price){
                    $.ajax({
                        'type':'post',
                        'url':base_url+'/shopProductPrice',
                        'headers': {'X-CSRF-TOKEN': token},
                        'data':{'product_id':product_id,'shop_id':shop_id,'price':price},
                        'dataType':'json',
                        'success':function(resp){
                            if(resp.status==1){
                                setTimeout(function () {
                                  swal ( "Success" , resp.massage ,  "success" )
                                }, 1000);
                            }else{
                                setTimeout(function () {
                                  swal ( "" , resp.massage ,  "error" )
                                }, 1000);
                            }
                        }
                    });
                }
            });

            $('body').on('click' , "#detachProduct", function(){

                var product_id=$(this).attr("productId");
                var shop_id=$(this).attr("shopId");
                var obj=$(this);
                $.ajax({
                    'type':'post',
                    'url':base_url+'/detachProduct',
                    'headers': {'X-CSRF-TOKEN': token},
                    'data':{'product_id':product_id,'shop_id':shop_id},
                    'dataType':'json',
                    'success':function(resp){
                        console.log(resp);
                        if(resp.status==1){
                            setTimeout(function () {
                              swal ( "Success" , resp.massage ,  "success" );
                            }, 1000);
                            obj.parents('tr').remove();
                            var html='';
                            $.each( resp.data, function( key, value ) {
                                html += "<option value='"+key+"'>"+value+"</option>";
                            });
                            $('#product_dropdown').append(html);

                        }else{
                            setTimeout(function () {
                              swal ( "" , resp.massage ,  "error" )
                            }, 1000);
                        }
                    }
                });
            });
        });
    </script>
@endpush
@endsection