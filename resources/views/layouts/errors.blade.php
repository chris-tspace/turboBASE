@if (count($errors))
	<div class="alert alert-danger alert-dismissible">
	<h4><i class="icon fa fa-ban"></i> Alert!</h4>
  	@foreach ($errors->all() as $error)
	  	<li>{{ $error }}</li>
	@endforeach
	</div>
@endif
