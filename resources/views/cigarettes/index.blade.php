@extends('layouts.app')

@section('content')

<!-- Create Task Form... -->
<!-- Bootstrap Boilerplate... -->
<div class="container">
    <div class="panel-info">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="/cig" method="POST" id="frmcig" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="hidden" name="cigarette" id="cigarette" value="1" class="form-control">

                <div class="col-sm-12">

                    <label id="date-cont" class="control-label" style="color:#fff;font-size: 16px;"></label>
                    <input type="hidden" id="date" name="date" id="date" class="form-control">
                    <input type="hidden" id="time" name="time" id="time" class="form-control">
                </div>

            </div>


            <!-- Add cigarette Button -->
            <div class="form-group">


                <div class="col-sm-9">
                    <span  class="btn btn-info btn-lg" id="btnaddcig">
                        <i class="fa fa-plus"></i> Add Cigarette
                    </span>
                </div>
                <div class="col-sm-3" style="font-size:20px;color:#fff;font-weight: bold;"><span style="font-size:64px">{{$count}}</span> today </div>

            </div>
        </form>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            Last 15 days
        </div>
        <div class="panel-body">
            <div id="chart"></div>
        </div>


    </div>

    @if (count($cigarettes) > 0)
    <div class="panel panel-info">
        <div class="panel-heading">
            Smoked Cigarettes
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Table Headings -->
                <thead>
                <th>Cigarettes</th>
                <th>&nbsp;</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($cigarettes as $cigarette)
                    <tr>
                        <!-- Task Name -->
                        <!--td class="table-text">
                            <div>{{ $cigarette->cigarette }}</div>
                        </td-->
                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $cigarette->date }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $cigarette->time }}</div>
                        </td>
                        <td>
                        <td>
                            <form action="/cig/{{$cigarette->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="btn btn-danger">Delete Cigarette</button>
                            </form>
                        </td>
                    <tr>
                        <!-- Delete Button -->


                        @endforeach
                </tbody>
            </table>
            <div class="pagination"> 

                <ul class="pagination">
                    @if ($cigarettes->currentPage()=='1')
                    <li class="disabled"><span>&laquo;</span></li>
                    @else
                    <li><a href="{{ $cigarettes->previousPageUrl()}}"> &laquo; &nbsp;Previous page</a></li> 
                    @endif


                    @if ($cigarettes->currentPage()==$cigarettes->lastPage())
                    <li class="disabled"><span>&raquo;</span></li>
                    @else
                    <li><a href="{{$cigarettes->nextPageUrl()}}"> Next &nbsp;&raquo;</a></li>
                    @endif
                    <li  class="disabled"><span> Page {{$cigarettes->currentPage()}} / {{$cigarettes->lastPage()}} </span></li> 
                    <li  class="disabled"><span > Total: {{$cigarettes->total()}}</span></li> 
                </ul>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('assets/js/cigarettes.index.js')}}">

</script>
@endif
@endsection