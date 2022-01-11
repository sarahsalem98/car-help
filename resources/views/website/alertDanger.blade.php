@if(session()->has('error'))
<div class="alert-danger">
    {{ session()->get('error') }}
</div>
@endif