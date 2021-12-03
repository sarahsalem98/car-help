@if ($errors->has($field))
<span class="alert-danger">
  {{ $errors->first($field) }}
</span>
@endif