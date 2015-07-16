@if($errors->any())
<div class="alert alert-danger">
	<p><b>Whoops! </b> There were some problems with your input.</p>

	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@else

	@if (Session::has('flash_notification.message'))
	        <div class="alert alert-{{ Session::get('flash_notification.level') }} fade in alert-slideup">
	            <b>{{ Session::pull('flash_notification.message') }}</b>
	        </div>
	@endif

@endif
