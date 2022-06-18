<?php $baseUrl = URL::to('/');?>
@if(env('SITE') == 'ENG')
        <div class="row">
            @if( env('SITE') == 'ENG')
                <h1 class="text-center text-primary">{{trans('register.video_page_token')}}</h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>{{trans('register.video_page_label')}}</label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="{{$_GET['id']}}">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="token"
                                       placeholder="{{trans('register.video_page_label')}}">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="{{trans('register.enter_code')}}">
                        </div>
                    </div>
                </form>
            @endif

                <h1 class="text-center text-primary">{{trans('register.video_page_code')}}</h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>{{trans('register.enter_code_label')}}</label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="{{$_GET['id']}}">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="{{trans('register.enter_code_label')}}">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="{{trans('register.enter_code')}}">
                        </div>
                    </div>
                </form>
           
            @if(env('SITE') == 'ENG')
                <h1 class="text-center text-primary">{{trans('register.video_page_BTC_token')}}</h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>{{trans('register.video_page_BTC_token')}}</label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="type" value="webinar">
                                <input type="hidden" name="id" value="{{$_GET['id']}}">
                                <input type="text" class="form-control" name="token"
                                       placeholder="{{trans('register.video_page_BTC_token')}}">
                            </div> 
                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="{{trans('register.enter_code')}}">
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <br>
    @else
        <div class="row">
                <h1 class="text-center text-primary">{{trans('register.video_page_code')}}</h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>{{trans('register.enter_code_label')}}</label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="{{$_GET['id']}}">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="{{trans('register.enter_code_label')}}">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="{{trans('register.enter_code')}}">
                        </div>
                    </div>
                </form>
        </div>
        <br>
    @endif
