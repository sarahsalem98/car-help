@if(session()->has('message'))
<div class="alert-success">
    {{ session()->get('message') }}
</div>
@endif