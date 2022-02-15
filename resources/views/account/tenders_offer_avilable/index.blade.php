
@extends('layout/account')

@section('content')

<div class="row">
        <div class="col-12 ">

            <div class="table-responsive pt-2" >

                <table class="table  table-bordered table-hover dataTables-bids">
                    <thead>
                        <tr>
                            <th>Tender Id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Offers/Bids</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($Offer_avilable_tenders as $tender)
                        <tr>

                            <td>{{ $tender->id }}</td>
                            <td>{{ $tender->title }}</td>
                            <td>{{ $tender->category->name }}</td>
                            <td>{{ count($tender->offers()->get()) }}</td>
                            <td><a target="_blank" href="{{url('account/tender/bids',$tender->id)}}">View Bids</a></td>
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
    $('.dataTables-bids').DataTable({
        pageLength: 10,
        responsive: true
    });
}


createDataTable();

});

</script>
@endsection
