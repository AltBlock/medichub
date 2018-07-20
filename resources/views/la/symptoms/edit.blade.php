@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/symptoms') }}">Symptom</a> :
@endsection
@section("contentheader_description", $symptom->$view_col)
@section("section", "Symptoms")
@section("section_url", url(config('laraadmin.adminRoute') . '/symptoms'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Symptoms Edit : ".$symptom->$view_col)

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
				{!! Form::model($symptom, ['route' => [config('laraadmin.adminRoute') . '.symptoms.update', $symptom->id ], 'method'=>'PUT', 'id' => 'symptom-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'description')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/symptoms') }}">Cancel</a></button>
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
	$("#symptom-edit-form").validate({
		
	});
});
</script>
@endpush
