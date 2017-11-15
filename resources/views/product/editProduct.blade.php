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
                        Edit Product
                        <div class="pull-right"><a href="{{ URL::to('productList') }}" class="btn btn-info btn-xs">Back</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if (Session::has('message'))
                           <div class="alert alert-info"><i class="pe-7s-gleam"></i>{{ Session::get('message') }}</div>
                        @endif
                       <div class="row">
                            <div class="col-lg-12">
                                {{Form::open(array('url' => URL::to('updateProduct'),'files'=>true,'id'=>'updateProduct','class'=>'form-horizontal','method'=>'POST'))}}
                                    {{ Form::hidden('id',$product->id) }}

                                    <div class="form-group col-lg-12">
                                        <label>Product Name</label>
                                        {{ Form::text('product_name', $product->product_name , array('class' => 'form-control','placeholder'=>"Product Name")) }}
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>product Image</label>
                                        {{ Form::hidden('old_product_image', $product->product_image ) }}
                                        {{ Form::file('product_image') }}
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>Product Detail</label>
                                        {{ Form::textarea('product_detail' , $product->product_detail , array('class' => 'form-control' , 'placeholder'=>"Product Detail" , 'size' => '30x3')) }}
                                    </div>

                                    <button type="submit" class="btn w-xs btn-success" name="submit">Update</button>

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
    </div>
    <!-- /.container-fluid -->
</div>
@push('scripts')
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js') !!}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#updateProduct").validate({
                rules: {
                    'product_name': {
                        required: true
                    },
                    'product_image': {
                        extension: "jpg|jpeg|png"
                    },
                    'product_detail': {
                        required: true
                    },
                },
                /*submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $("#createProduct").serialize(),
                        success: function(response) {
                            console.log(response);
                        }            
                    });
                }*/
            });
        });
    </script>
@endpush
@endsection