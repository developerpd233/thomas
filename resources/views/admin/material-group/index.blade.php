@extends('layouts.backend.default')

@section('page_title')
    {{ trans('Manage Material Group') }}
@endsection

@section('content')

{!! $grid->render() !!}
	
@endsection
