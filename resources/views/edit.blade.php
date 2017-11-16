@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <form class="form-horizontal" action="/api/edit-user" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Username</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="input btn-log"  name="name"  value="{{$user->name}}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Email</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="input btn-log" name="email"   value="{{$user->email}}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"> Edit User</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
