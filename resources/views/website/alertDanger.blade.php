@if(session()->has('message'))
<div class="alert-danger">
    {{ session()->get('message') }}
</div>
@endif