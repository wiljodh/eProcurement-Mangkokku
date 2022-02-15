@if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li><i class="fa fa-warning"></i> {{  $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
