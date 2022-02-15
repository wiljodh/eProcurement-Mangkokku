
@extends('layout/offer')

@section('content-right')

<div class="panel panel-primary">
    <div class="panel-heading text-white">
      <h4><strong>You're already submitted an offer</strong></h4>
    </div>
    <div class="panel-body">
        <div class="ibox ">
            <div class="ibox-content">

                
                <div class="form-group row "><label class="col-4 col-form-label">Offer Id :</label>
                   <div class="col-8">
                   <input type="text" value="{{$Offer->id}}" class="form-control" name="offer_id" disabled/>
                    </div>
                  </div>
                  <div class="form-group row "><label class="col-4 col-form-label">Bid Amount :</label>
                   <div class="col-8">
                        <input type="text"  class="form-control" name="bid_amount" value="LKR {{$Offer->bid_amount}}" disabled/>
                    </div>
                  </div>
                  <div class="form-group row "><label class="col-4 col-form-label">Period:</label>
                      <div class="col-8">
                            <input type="text"  class="form-control" name="period" value="{{$Offer->period}}" disabled />                                                          
                        </div>
                  </div>
                  <div class="form-group row "><label class="col-4 col-form-label">Note :</label>
                   <div class="col-8">
                         <textarea class="form-control" name="note" disabled>{{$Offer->note}}</textarea>
                    </div>
                  </div>
                  
          

            </div>
        </div>
    </div>
</div>

@endsection