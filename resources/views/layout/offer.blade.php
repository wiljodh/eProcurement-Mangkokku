@extends('layout/main')

@section('content')
<div class="row m-t">
        <div class="col-6">
           <div class="panel panel-default">
                <div class="panel-heading text-primary">
                    <h4><strong>Tender Details</strong></h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                          <td>ID</td>
                          <td>{{$Tender->id}}</td>
                        </tr>
                        <tr>
                          <td>Title</td>
                          <td>{{$Tender->title}}</td>
                        </tr>
                        <tr>
                          <td>Description</td>
                          <td>{{$Tender->description}}</td>
                        </tr>
                        <tr>
                          <td>Category</td>
                          <td>
                           <span class="d-inline-flex"><i class="fa fa-2x {{$Tender->category->icon}}"></i>
                           &nbsp;{{$Tender->category->name}}
                           </span>
                          </td>
                        </tr>
                        <tr>
                          <td>Estimate Cost</td>
                          <td>LKR {{  sprintf('%0.2f', $Tender->estimate_cost)  }}</td>
                        </tr>
                        <tr>
                          <td>Deposit</td>
                          <td>LKR {{  sprintf('%0.2f', $Tender->deposit)  }}</td>
                        </tr>
                        <tr>
                          <td>Start Date</td>
                          <td>{{ $Tender->getStartDate() }}</td>
                        </tr>
                        <tr>
                          <td>End Date</td>
                          <td>{{ $Tender->getEndDate() }}</td>
                        </tr>
                        <tr>
                          <td>Location</td>
                          <td>{{ $Tender->location }}</td>
                        </tr>
                        @if($Tender->hasPDF())
                        <tr>
                          <td>Attachment</td>
                          <td><a target="_blank" href="{{ $Tender->getPDFFileURL() }}">Click to View</a></td>
                        </tr>

                        @endif
                    </table>
                </div>
           </div>

        </div>
        <div class="col-6">
        @yield('content-right')
        </div>
</div>

@endsection