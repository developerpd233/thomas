@extends('layouts.backend.default')

@section('page_title')
    {{ trans('Manage Container Academy') }}
@endsection

@section('content')

{!! $grid->render() !!}
	
@endsection
