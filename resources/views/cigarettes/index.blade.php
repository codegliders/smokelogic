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
            <div class="row">
                <div class="col-sm-12">

                    <label id="date-cont" class="control-label" style="color:#fff;font-size: 16px;"></label>
                    <input type="hidden" id="date" name="date" id="date" class="form-control">
                    <input type="hidden" id="time" name="time" id="time" class="form-control">
                    <input type="hidden" name="cigarette" id="cigarette" value="1" class="form-control">
                </div>
            </div>

            <br />

            <!-- Add cigarette Button -->
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <button  class="btn btn-info btn-lg" id="btnaddcig">
                            <i class="fa fa-plus fa-lg"></i> Add Cigarette
                        </button>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-6 col-xs-6 info-text-md "><span class="info-value-md">{{$yesterdaycigarettes}}</span> yesterday </div>
                <div class="col-sm-6 col-xs-6 info-text-md"><span class="info-value-lg">{{$count}}</span> today </div>

            </div>

            <div class="row">
                <div class="col col-sm-6 col-xs-6 info-text-md" >
                    <span  class="info-value-md">{{$weekcigarettes}}/day</span> last 7 days

                </div>
                <div class="col col-sm-6 col-xs-6 info-text-md" >
                    <span  class="info-value-md">{{$monthcigarettes}}/day</span> last 30 days

                </div>
            </div>
        </form>
    </div>
    <!--div class="panel panel-info">
        <div class="panel-heading">
            Minutes between cigarettes today
        </div>
        <div class="panel-body">
            <div class="row">
                 <div class="col col-sm-6">
                    <div id="gauge2-container">
                        <div id="gauge2"></div>
                        <input id="gauge2-value" disabled="true" value="{ {$lastcigarettemin} }">
                    </div>
                    <div class="col col-md-6 center-block">  Minutes from last cigarette</div>

                </div>
                <div class="col col-sm-6">
                    <div id="gauge-container">
                        <div id="gauge"></div>
                        <input id="gauge-value" disabled="true" value="{ {$minutesbycigarettes} }">
                    </div>
                    <div class="col col-md-6 center-block">  Minutes between all cigarettes today</div>

                </div>
               
            </div>

        </div>


    </div-->
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
            <table class="table table-striped task-table" id="cigarettes-table">

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

                                <button class="btn btn-danger" data-id="{{ $cigarette->id }}">Delete Cigarette</button>
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