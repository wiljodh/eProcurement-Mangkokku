
@extends('layout/account')

@section('content')

<div class="ibox ">
        <div class="ibox-title">
            <h5 class="text-success">Edit Tender Category</h5>

        </div>
        <div class="ibox-content row">
            <div class="container">
            <form action="/tender-actions/category/update" class="col-10" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                @include('include.flash')
                @include('include.errors')
                <input type="hidden"  class="form-control" name="id" value="{{ $categoryDetails->id }}">

                <div class="form-group row "><label class="col-2 col-form-label">Name :</label>
                   <div class="col-10">
                        <input type="text"  class="form-control" name="name" value="{{ $categoryDetails->name }}">
                    </div>
               </div>
                <div class="form-group row "><label class="col-2 col-form-label">Icon :</label>
                    <div class="col-4">
                            <input type="text" id="icon_txt"  class="form-control" name="icon" value="{{ $categoryDetails->icon }}">

                    </div>
                    <div class="col-3">
                        <button onclick="onChangeIconName() ; return false;" class="btn btn-outline btn-default btn-block">Check Icon</button>
                    </div>
                    <div class="col-3">
                        <i id="icon_preview" class="fa fa-3x"></i>
                    </div>
                </div>
                 <div class="form-group row ">
                    <div class="col-3 col-offset-3 pt-4">
                        <button class="btn-block btn btn-sm btn-success float-left ml" type="submit">Update</button>
                    </div>
             </div>
             </div>
            </form>
        </div>

</div>


<script>

function onChangeIconName(){
    if($("#icon_txt").val()!==""){
        var value=$("#icon_txt").val();

        var class_val="fa fa-3x "+value;
        console.log(class_val);
        $("#icon_preview").removeClass();
        $("#icon_preview").addClass(class_val);
    }
}

</script>

@endsection
