@extends('layout/main')

@section('content')
    <div class="row m-t">
        <div class="col-md-12">

                <div class="panel panel-success">
                    <div class="panel-heading text-white">
                      <h4><strong>Tender Detail</strong></h4>
                    </div>
                    <div class="panel-body">
                       <div class="form-group row "><label class="col-2 col-form-label"><strong>Tender ID &nbsp; :</strong></label>
                            <div class="col-6">
                                 <label class="col-form-label">{{ $tenderDetails->id }} &nbsp;</label>  

                                 <span class=" label label-{{$tenderDetails->getTenderCorrectStatus()->class_name}}">{{$tenderDetails->getTenderCorrectStatus()->name}}</span>     
                            </div>
                            <div class="col-3 offset-1">
                                  <div class="widget lazur-bg mx-2 no-padding">
                                        <div class="row p-2">
                                            <div class="col-2">
                                                <i class="fa fa-usd fa-3x"></i>
                                            </div>
                                            <div class="col-10 text-right">
                                                <span>Bids Found</span>
                                                <h2 class="font-bold">{{ count($tenderDetails->offers()->get()) }}</h2>
                                            </div>
                                        </div>
                                </div> 

                            </div>
                        </div>
                        
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Title &nbsp; :</strong></label>
                            <div class="col-6">
                                 <label class="col-form-label">{{ $tenderDetails->title }}</label>
                            </div>
                        </div>
                       

                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Description &nbsp; :</strong></label>
                            <div class="col-6">
                                 <label class="col-form-label">{{ $tenderDetails->description }}</label>
                            </div>
                        </div>
                        <div class="form-group row "><label class="col-2 col-form-label"><strong>Category &nbsp; :</strong></label>
                            <div class="col-6">
                                 <label class="col-form-label">{{ $tenderDetails->category->name }}</label>
                            </div>
                        </div>

                    </div>

                </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-success">
                <div class="panel-heading text-white">
                  <h4><strong>Key Values</strong></h4>
                </div>
                <div class="panel-body">
                    <div class="form-group row "><label class="col-2 col-form-label"><strong>Estimated Cost &nbsp; :</strong></label>
                        <div class="col-6">
                             <label class="col-form-label">LKR {{  sprintf('%0.2f', $tenderDetails->estimate_cost)  }}</label>
                        </div>
                    </div>
                    <div class="form-group row "><label class="col-2 col-form-label"><strong>Deposit &nbsp; :</strong></label>
                        <div class="col-6">
                             <label class="col-form-label">LKR {{ sprintf('%0.2f',  $tenderDetails->deposit) }}</label>
                        </div>
                    </div>
                    <div class="form-group row "><label class="col-2 col-form-label"><strong>Start Date &nbsp; :</strong></label>
                        <div class="col-6">
                             <label class="col-form-label">{{ $tenderDetails->getStartDate() }}</label>
                        </div>
                    </div>

                    <div class="form-group row "><label class="col-2 col-form-label"><strong>End Date &nbsp; :</strong></label>
                        <div class="col-6">
                             <label class="col-form-label">{{ $tenderDetails->getEndDate() }}</label>
                        </div>
                    </div>
                    <div class="form-group row "><label class="col-2 col-form-label"><strong>Location &nbsp; :</strong></label>
                        <div class="col-6">
                             <label class="col-form-label">{{ $tenderDetails->location }}</label>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @if($tenderDetails->hasPDF())
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-success">
                <div class="panel-heading text-white">
                  <h4><strong>Tender Documents</strong></h4>
                </div>
                <div class="panel-body">

                    <div id="attachment_preview" class="widget">

                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                            </div>
                            <div class="col-10">

                                <p class="font-bold"><a target="_blank" href="{{ $tenderDetails->getPDFFileURL() }}">Click to View</a></p>
                            </div>
                        </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-white">
                  <h4><strong>Place a Bid for this Tender</strong></h4>
                </div>
                <div class="panel-body">
                    @if(empty(session(config("global.session_user_obj"))))
                        <p>Please <a href="{{url('/login')}}">login</a> or <a href="{{url('/register')}}">register</a> for place a bid for this tender </p>
                    @else
                        @if(session(config("global.session_user_obj"))->um_user_role_id===config("global.user_role_admin"))
                        <p>You're  Admin user and you can't place Bids</p>
                        @elseif($tenderDetails->getOfferUserAlreadySubmited(session(config("global.session_user_obj"))->id)!==null)
                            <p>You have already place a bid for this tender, Have a look it again <a href="{{url('/offer',$tenderDetails->getOfferUserAlreadySubmited(session(config('global.session_user_obj'))->id)->id)  }}">see my bid</a></p>
                        @else
                        <p>You can place a bid by filling the info form. <a href="{{url('/offer/create',$tenderDetails->id)}}">click here</a></p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>







<script>



</script>
@endsection
