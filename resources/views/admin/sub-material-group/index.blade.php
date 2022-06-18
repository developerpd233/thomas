@extends('layouts.backend.default')

@section('page_title')
    {{ trans('Sub Material Groups') }}
@endsection

@section('content')

{!! $grid->render() !!}
	
@endsection
