@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/diseases') }}">Disease</a> :
@endsection
@section("contentheader_description", $disease->$view_col)
@section("section", "Diseases")
@section("section_url", url(config('laraadmin.adminRoute') . '/diseases'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Diseases Edit : ".$disease->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($disease, ['route' => [config('laraadmin.adminRoute') . '.diseases.update', $disease->id ], 'method'=>'PUT', 'id' => 'disease-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'level')
					@la_input($module, 'description')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/diseases') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#disease-edit-form").validate({
		
	});
});
</script>
@endpush
