@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@if($errors->any())
<div class="alert alert-warning">
  <p>{{ $errors->first() }}</p>
</div>
@endif
