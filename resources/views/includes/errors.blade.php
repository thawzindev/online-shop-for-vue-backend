@if ($errors->any())
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
				<li class="text-normal">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif