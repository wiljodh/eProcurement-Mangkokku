
@extends('layout/account')

@section('content')

<div class=" row">
    <div class="col-3 offset-9 pt-2 pb-2">
       <a  class="btn-block btn btn-sm btn-success float-right m-r" href="{{url('/account/tender/categorries/new')}}">Create New +</a>
       
    </div>
</div>
<div class="row">
        <div class="col-12 ">

            <div class="table-responsive" >

                <table class="table table-striped table-bordered table-hover dataTables-category">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Icon</th>
                            <th>Tenders</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($tenderCategories as $category)
                        <tr>

                            <td>{{ $category->name }}</td>
                            <td class="text-center "><i class="text-navy {{ $category->icon }}"></i></td>
                            <td>{{ count($category->tenders()->get()) }}</td>
                            <td>
                                <a  class="btn btn-sm btn-default float-right m-r" href="{{url('/account/tender/categorries/edit',$category->id)}}"><i class="fa fa-edit"></i></a>
                                @if(count($category->tenders()->get())===0)
                                <a  class="btn btn-sm btn-danger float-right m-r" href="{{url('/tender-actions/category/delete',$category->id)}}"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
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
    $('.dataTables-category').DataTable({
        pageLength: 10,
        responsive: true
    });
}


createDataTable();

});

</script>
@endsection
