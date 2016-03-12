@extends('layouts.app')
@section('content')
<script>
  $(function () {
       
        $("#insertTestButtonDiv").hide();
    });
</script>
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                Registrati
            </div>
            <div class="panel-body">
               
                <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- New Task Form -->
                <form action="/auth/register" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text" name="name"  class="form-control" value="" >
                        </div>
                    </div>
               
                    <!-- E-Mail Address -->
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">E-Mail</label>
                        <div class="col-sm-6">
                            <input type="email" name="email"  class="form-control" value="">
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="password"  class="form-control">
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-3 control-label">Conferma Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation"  class="form-control">
                        </div>
                    </div>
                    <!-- Register Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default" disabled="true">
                                <span class="fa fa-btn fa-sign-in"></span>&nbsp;Registrati
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection