@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/predicts') }}">Predict</a> :
@endsection
@section("contentheader_description", $predict->$view_col)
@section("section", "Predicts")
@section("section_url", url(config('laraadmin.adminRoute') . '/predicts'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Predicts Edit : ".$predict->$view_col)

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
				{!! Form::model($predict, ['route' => [config('laraadmin.adminRoute') . '.predicts.update', $predict->id ], 'method'=>'PUT', 'id' => 'predict-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'symptom')
					@la_input($module, 'history')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/predicts') }}">Cancel</a></button>
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
	$("#predict-edit-form").validate({
		
	});
});
</script>
@endpush
