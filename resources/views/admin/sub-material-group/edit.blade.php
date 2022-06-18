@extends('layouts.backend.default')

@section('page_title')
    {{ trans('Edit Sub Material Group') }}
@endsection

@section('content')

<div class="ibox float-e-margins">
    <div class="ibox-content">
        {!! Form::open(array('method' => 'put', 'files' => true,'class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
	
            <div class="form-group required">
                <div class="col-md-4">
                    {!! Form::label('group_id', trans(' Material Group'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::selectGroup('group_id', old('group_id', $SubmaterialGroup->group_id), ['id'=>'group_id', 'class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    {!! Form::label('title', trans('Sub Material Group'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('title', old('title', $SubmaterialGroup->title), ['id'=>'title', 'class'=>'form-control']) !!}
                </div>
            </div>
                                                                
            <div class="form-group required">
                <div class="col-md-4">
                    {!! Form::label('slug', trans('Slug'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('slug', old('slug', $SubmaterialGroup->slug), ['id'=>'slug', 'class'=>'form-control']) !!}                    
                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    {!! Form::label('price', trans('Price'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('price', old('price', $SubmaterialGroup->price), ['id'=>'price', 'class'=>'form-control']) !!}                    
                </div>
            </div>
            <div class="form-group required" id="thumbnail">
                <div class="col-md-4">
                    {!! Form::label('group_thumbnail_url', trans('Thumbnail'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::file('group_thumbnail_url') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    {!! Form::label('enable_payment_button', trans('Enable'), ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::checkbox('enable_payment_button', 'YES', ($SubmaterialGroup->enable_payment_button=='YES' ? true:false)) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="{{ URL::route('admin.sub-material-group') }}">{{ trans('Cancel') }}</a>
                    {!! Form::submit(trans('Update Changes'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
            

        {!! Form::close() !!}
    </div>
</div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            //Generate Slug
            $('#slug').slugify('#title');

            //Display CKEDITOR for long description
            CKEDITOR.replace( 'description',
            {
                toolbar : 'Standard', /* this does the magic */
            });
        })
    </script>
@endpush