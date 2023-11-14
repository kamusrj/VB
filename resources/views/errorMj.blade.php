<div class="messages-container  ">
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
</div>

@if (Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

@if (Session::has('delete'))
<div class="alert alert-danger">
    {{ Session::get('delete') }}
</div>
@endif