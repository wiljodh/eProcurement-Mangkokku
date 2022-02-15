
@extends('layout/account')

@section('content')


    <div class="ibox ">
        <div class="ibox-title">
            <h5 class="text-success">Create Tender</h5>

        </div>
        <div class="ibox-content">
            <form action="/tender-actions/create" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                @include('include.flash')
                @include('include.errors')
           <div class="form-group row "><label class="col-2 col-form-label">Title :</label>
                   <div class="col-10">
                        <input type="text"  class="form-control" name="title" value="{{old('title')}}">
                    </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Description :</label>
                    <div class="col-10">
                        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                    </div>
            </div>
            <div class="form-group row" id="data_1"><label class="col-2 col-form-label">Start Date :</label>
                    <div class="input-group date col-10">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control form-control-sm" name="start_date" value="{{old('start_date')}}">
                    </div>
            </div>
            <div class="form-group row" id="data_1"><label class="col-2 col-form-label">End Date :</label>
                    <div class="input-group date col-10">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control form-control-sm" name="end_date" value="{{old('end_date')}}">
                    </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Deposit :</label>
                <div class="col-10">
                    <div class="input-group-prepend">
                        <span class="input-group-addon">Rs</span>
                        <input type="text"  class="form-control" name="deposit" value="{{old('deposit')}}">
                    </div>
                 </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Estimate Cost :</label>
                <div class="col-10">
                    <div class="input-group-prepend">
                        <span class="input-group-addon">Rs</span>
                        <input type="text"  class="form-control" name="estimate_cost" value="{{old('estimate_cost')}}">
                    </div>
                 </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Location :</label>
                <div class="col-10">
                     <input type="text"  class="form-control" name="location" value="{{old('location')}}">
                 </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">File :</label>
                <div class="col-10 input-group">
            
     <div class="custom-file">
         <input id="inputGroupFile01" name="attachment" type="file" class="custom-file-input" accept="application/pdf">
         <label class="custom-file-label" for="inputGroupFile01" >Choose file</label>
     </div>

                 </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Category :</label>
                <div class="col-10">
                    <select class="select2_demo_3 form-control" name="category_id" value="{{old('category_id')}}">
                        <option value="-1">Select One</option>
                         @foreach ($tenderCategories as $categories)
                        <option value="{{ $categories->id }}" @if (old('category_id') == $categories->id) selected="selected" @endif>{{ $categories->name }}</option>
                         @endforeach
                     </select>
                </div>
            </div>
            <div class="form-group row"><label class="col-2 col-form-label">Status :</label>
                <div class="col-10">
                    <select class="select2_demo_3 form-control" name="tender_status" value="{{old('tender_status')}}">
                        <option value="-1">Select One</option>
                         @foreach ($tenderStatus as $status)
                        <option value="{{ $status->id }}" @if (old('tender_status') == $status->id) selected="selected" @endif>{{ $status->name }}</option>
                         @endforeach
                     </select>
                </div>
            </div>
        </div>
    </div>
            <div class="form-group row">
                    <div class="col-3 offset-9">
                        <button class="btn-block btn btn-sm btn-success float-right m-r" type="submit">Save</button>
                    </div>
             </div>
        </form>
        </div>
    </div>


    <script>
        $(".select2_demo_3").select2({
            placeholder: "Select a state",
            allowClear: true
        });
        var mem = $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $(document).ready(function(){
            bsCustomFileInput.init()
        })
    </script>

@endsection

