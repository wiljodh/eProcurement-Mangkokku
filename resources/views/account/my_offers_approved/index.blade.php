@extends('layout/account')

@section('content')

<div class="row">
    <div class="col-12 py-2">
            <h5 class="text-success ml-3">Approved Bids</h5>
    </div>
</div>
<div class="row">
        <div class="col-12 ">

            <div class="table-responsive" >

                <table class="table table-striped table-bordered table-hover dataTables-mybids">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tender Id</th>
                            <th>Category</th>
                            <th>Remian Days</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($Offers as $Offer)
                        <tr>

                            <td>{{ $Offer->id }}</td>
                            <td>{{ $Offer->tm_tender_id }}</td>
                            <td>{{ $Offer->tender->category->name }}</td>
                            <td>{{ $Offer->tender->daysRemain() }}</td>
                            <td> <span class=" label label-{{$Offer->offerStatus->class_name }}">{{$Offer->offerStatus->name}}</span></td>
                            <td><a target="_blank" href="{{url('offer',$Offer->id)}}">View</a></td>
                            
                        </tr>

                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function(){
        function createDataTable(){
            $('.dataTables-mybids').DataTable({
                pageLength: 10,
                responsive: true
            });
        }
        createDataTable();
    });

</script>

@endsection