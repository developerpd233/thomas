@extends('layouts.frontend.default')
@section('page_title')
    {{ trans('user_academy.my_academy') }}
@endsection

@section('content')
@foreach ($sub_material_details as $sub_material_detail)
        @if($sub_material_detail->title != '' && $sub_material_detail->title != null )
            <div class="col-sm-6 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        @if($sub_material_detail->price > 0.00)
                            <h4 class="pull-right text-success">{{$sub_material_detail->price}}</h4>
                        @endif
                        <h4>
                            <a href="{!! url('user-academy/viewGroup/' . $sub_material_detail->group_id) !!}">{{ $sub_material_detail->title }}</a>
                        </h4>
                        <hr>
                    </div>
                    <a href="{!! url('user-academy/viewGroup/' . $sub_material_detail->group_id)!!}">
                        <img src="{{$sub_material_detail->group_thumbnail_url}}"
                             style="width: 300px; height: 300px; margin-top: 0"/>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
@endsection
<style>
    .thumbnail {
        margin: 20px 20px 0 0;
        height: 425px;
    }

    .thumbnail:hover {
        -webkit-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        -moz-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
    }
</style>