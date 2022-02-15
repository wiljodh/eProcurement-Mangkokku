@if($flash = session('message'))

    <div class="alert {{ session('flash_message_type') }}" role="alert">

    <i class="fa fa-warning"></i>  {{$flash}}

    </div>
@endif