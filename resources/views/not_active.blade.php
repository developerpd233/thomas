@extends('layouts.frontend.default')

@section('page_title')

@endsection

@section('content')
    <br>
    <div class="alert alert-success" role="alert">
        <a href="#" class="alert-link">
        @if($blockAlert == '3')
            {{__('app.not_active3')}}
            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="{{route('online-payment.activate')}}"> {{ __('app.click_here') }}</a>
        @elseif($blockAlert == '2')
            {{__('app.not_active2')}}
            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="{{route('online-payment.activate')}}"> {{ __('app.click_here') }}</a>
        @else
            {{__('app.not_active')}}
            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="{{route('online-payment.activate')}}"> {{ __('app.click_here') }}</a>
        @endif
        <!--{{ __('app.not_active') }} >
        </a> &nbsp;&nbsp;&nbsp;
        <a style="color : #fff" type="button" class="btn btn-success"
           href="{{route('online-payment.activate')}}"> {{ __('app.click_here') }}</a-->
    </div>
    <div class="alert alert-info" role="alert">
        <b class="text-danger">Important</b>: {{trans('app.this_is_how')}}
    <a href="pages/how-to-pay-in-opportunity-4" style="font-weight:bold;color:blue"> {{ trans('app.click_here') }}</a>
    </div>
    <br>
    <br>
    <br>
@endsection
