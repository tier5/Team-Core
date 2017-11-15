@extends('layouts.app')
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
                        Edit Shop
                        <div class="pull-right"><a href="{{ URL::to('shopList') }}" class="btn btn-info btn-xs">Back</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @if (Session::has('message'))
                           <div class="alert alert-info"><i class="pe-7s-gleam"></i>{{ Session::get('message') }}</div>
                        @endif
                       <div class="row">
                            <div class="col-lg-12">
                                {{Form::open(array('url' => URL::to('updateShop'),'files'=>true,'id'=>'updateShop','class'=>'form-horizontal','method'=>'POST'))}}
                                    {{ Form::hidden('id',$shop->id) }}
                                    <div class="form-group col-lg-12">
                                        <label>Shop Name</label>
                                        {{ Form::text('shop_name', $shop->shop_name, array('class' => 'form-control','placeholder'=>"Shop Name")) }}
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Shop Image</label>
                                        {{ Form::hidden('old_shop_images', $shop->shop_images ) }}
                                        {{ Form::file('shop_images') }}
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Shop Address</label>
                                        {{ Form::text('shop_address', $shop->shop_address , array('class' => 'form-control','placeholder'=>"Shop Address")) }}
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Shop Detail</label>
                                        {{ Form::textarea('shop_detail', $shop->shop_detail ,array('class' => 'form-control','placeholder'=>"Shop Detail",'size' => '30x3')) }}
                                    </div>

                                    <!-- <div class="form-group col-lg-12">
                                        <label>Add Product</label>
                                       {{ Form::select('products[]', $products,'', ['class' => 'form-control','id' => 'product_dropdown','multiple'=>'multiple']) }}
                                    </div> -->
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
            $("#updateShop").validate({
                rules: {
                    'shop_name': {
                        required: true
                    },
                    'shop_images': {
                        extension: "jpg|jpeg|png"
                    },
                    'shop_address': {
                        required: true
                    },
                    'shop_detail': {
                        required: true
                    },
                    'products': {
                        required: true
                    }
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

                /********** select 2 dropdown initialize *************/
            });

            $("#product_dropdown").select2({
                placeholder: "Select Product",
                multiple: true,
            });
        });
    </script>
@endpush
@endsection