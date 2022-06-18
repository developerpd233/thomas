@extends('layouts.frontend.default')
<style>
    .myTable>tbody>.myTableRow>td {
        padding: 0px;
    }

    .myTable>tbody>.myTableRow>th {
        padding: 0px;
    }
</style>

@section('page_title')
{{ trans('app.tree') }}
@endsection

@section('content')
<br>
<?php $count = 0 ?>
<?php

$authUser = $user;
$countNewRegistrations = -2;

function ifRegisteredThisMonth($created_at) {
    $todayDateee = date("m-Y");
    $registerDate = date("m-Y", strtotime($created_at));
    $diff = ($todayDateee == $registerDate ? "true" : "false");
    return $diff;
}
?>

<form method="POST" action="{{ url('user/tree') }}" accept-charset="UTF-8">
    <style>
        .datepicker table tr td span.disabled,
        .datepicker table tr td span.disabled:hover {
            opacity: 0.4;
        }
    </style>
    <ul class="form-validate-errors"></ul>
    <input name="_token" type="hidden" value="tMbnk4MfFSYMG732qG0w1i9V4cxPZOOnBEKscTwi">
    <input name="commission" type="hidden" value="{{$user_comission ==true?'true':'false'}}">
    <input name="commission_user_id" type="hidden" value="{{isset($id)? $id :null}}">
    <div class="col-md-4">
        <input name="daterange" type="text" placeholder="select Month" autocomplete="off">&nbsp;&nbsp;<input class="btn btn-primary text-white" type="submit" id="btn_submit" value="Apply" disabled="disabled">&nbsp;&nbsp;<a href="{{ url('user/tree') }}" class="btn btn-primary text-white">Reset</a>
    </div>
</form>

<div class="col-md-4">
        @if($month ==1)
        <center><h3>Month: {{(isset($currentMonth))? $currentMonth: '' }}</h3></center>
        @elseif($month ==2)
        <center><h3>Month: {{(isset($currentMonth))? $currentMonth: '' }} </h3></center>
        @else
        <h2></h2>
        @endif
    </div>

<script>
    $(function () {
        var enableDisableSubmitBtn = function (selectedMonth) {
            var disableBtn = (selectedMonth.length == 0);
            $('#btn_submit').attr('disabled', disableBtn);
        }

        var tdate = new Date();
        var MM = tdate.getMonth(); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var currentDate = (MM) + " " + yyyy;

        $('input[name="daterange"]').datepicker({
            autoclose: true,
            format: "MM , yyyy",
            viewMode: "months",
            minViewMode: "months",
            startDate: "Sep 2020",
            endDate: currentDate,
            clearBtn: true,
        }).on('changeMonth', function (e) {
            var currMonth = new Date(e.date).getMonth() + 1;
            var currYear = String(e.date).split(" ")[3];
            var selectedMonth = (currMonth + "-" + currYear);
            enableDisableSubmitBtn(selectedMonth);
        });
    });
</script>

@foreach($users as $user )
<?php $count++ ?>
@endforeach
<?php if ($count) : ?>
    <a href="/group/send/{{$user->username}}" class="btn btn-primary text-white" type="button" style="float: right">
        Message All</a>
<?php endif; ?>
@if($user_comission == true)
<a href="{{url('admin/user/pay_commission')}}" class="btn btn-primary text-white" value="Back" style="margin-right: 5px; float: right;">Back</a>
@endif
<br>
<table class="table myTable">
    <thead class="thead-dark">
        <?php if ($count) : ?>
            <tr>
                <th scope="col">Level</th>
                <th scope='col'>SN</th>
                <th scope="col">Subscribers</th>
                <th>Created At</th>
                <th scope="col">Status</th>
                <th scope="col">Total fees</th>
                <th scope="col">Total commissions</th>
                <th scope="col">Paid At</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <!--?php echo"<pre>";print_r($month);echo"</pre>";?-->
            {{-- 8888888888888888888888888888888888888   Level one    88888888888888888888888888888888888888888888888888888888--}}
            <?php
            $count = 1;
            $level = 1;
            $one = 0;
            ?>
    <?php foreach ($users as $list) : ?>
            <?php if(!$final_filter): ?>
                <tr class="myTableRow">
                    <th>{{$level}}</th>
                    <td>{{$count}}</td>
                    <td>{{$list->first_name." ". $list->last_name}}</td>
                    <td>{{!$list->created_at? '__':$list->created_at}}</td>
                    <td> <?php
                        if ($list->is_active == 'YES') {
                            if(ifRegisteredThisMonth($list->created_at) == "true"){
                                $countNewRegistrations += 1;
                                //echo '&#x274C';                                   
                                if($list->subscriber_commision >= 50):
                                    echo '&#9989'; //right
                                    $one++;
                                else:
                                    echo '&#x274C';//wrong
                                endif;
                            } else{
                                /* C-ON-2021-09-15
                                echo '&#9989'; //right 
                                $one++;
                                */
                                echo '&#x274C';//wrong
                            }
                        } else {
                            echo '&#x274C';//&#x274C
                        }                        
                        ?></td>
                    <td>
                        <?php
                        if ($list->is_active == 'YES') {                            
                            if (ifRegisteredThisMonth($list->created_at) == "true") {
                                if($list->subscriber_commision >= 50):
                                    echo $amount;                                       
                                else:
                                    echo 'Not paid';
                                endif;
                            } else {
                                /* C-ON-2021-09-15
                                echo $amount;
                                */
                                echo 'Not paid';
                            }
                        } else {
                            echo 'Not paid';
                        }
                        ?>
                    </td>
                    <td> 
                        <?php
                        if ($list->is_active == 'YES') {                            
                            if (ifRegisteredThisMonth($list->created_at) == "true") {
                                if($list->subscriber_commision >= 50):
                                    echo $comm;                                      
                                else:
                                    echo '0';
                                endif;
                            } else {
                                /* C-ON-2021-09-15 
                                echo $comm;
                                */
                                echo 0;
                            }
                        } else {
                            echo '0';
                        }
                        ?>
                    </td>
                    @if($list->paid_at == null)
                    <td id="{{$list->id}}">
                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                    </td>
                    @else
                    <td id="{{$list->id}}">{{(new \DateTime($list->paid_at))->format('d-M-Y')}}</td>
                    @endif
                    <td>
                        <a href="/message/{{$user->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                    </td>
                </tr>
                <?php
                $count++;
                $level = "";
                ?>
                <?php elseif( date('Y-m', strtotime($list->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                    <tr class="myTableRow">
                        <th>{{$level}}</th>
                        <td>{{$count}}</td>
                        <td>{{$list->first_name." ". $list->last_name}}</td>
                        <td>{{!$list->created_at? '__':$list->created_at}}</td>
                        <td> <?php
                            if ($list->is_active == 'YES') {
                                if(ifRegisteredThisMonth($list->created_at) == "true"){
                                    $countNewRegistrations += 1;
                                    if($list->subscriber_commision >= 50):
                                        echo '&#9989'; //right
                                        $one++;
                                    else:
                                        echo '&#x274C';//wrong
                                    endif;
                                }
                                else{
                                    echo '&#9989'; //right 
                                    $one++;
                                }

                            } else {
                                echo '&#x274C';//&#x274C
                            }
                            ?></td>
                        <td>
                            <?php
                            if ($list->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($list->created_at) == "true") {
                                    if($list->subscriber_commision >= 50):
                                        echo $amount;                                       
                                    else:
                                        echo 'Not paid';
                                    endif;
                                } else {
                                    echo $amount;
                                }
                            } else {
                                echo 'Not paid';
                            }
                            ?>
                        </td>
                        <td> 
                            <?php
                            if ($list->is_active == 'YES') {                            
                                if (ifRegisteredThisMonth($list->created_at) == "true") {
                                    if($list->subscriber_commision >= 50):
                                        echo $comm;                                      
                                    else:
                                        echo '0';
                                    endif;
                                } else {
                                    echo $comm;
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                        </td>
                        @if($list->paid_at == null)
                        <td id="{{$list->id}}">
                            <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                        </td>
                        @else
                        <td id="{{$list->id}}">{{(new \DateTime($list->paid_at))->format('d-M-Y')}}</td>
                        @endif
                        <td>
                            <a href="/message/{{$user->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                        </td>
                    </tr>
                    <?php
                    $count++;
                    $level = "";
                    ?>
                <?php endif; ?>
    <?php endforeach; ?>

            {{-- 8888888888888888888888888888888888888   Level Two    88888888888888888888888888888888888888888888888888888888--}}
            <tr>
                <td colspan="7"></td>
            </tr>
            <?php
            $count1 = 1;
            $secondLevel = 2;
            $two = 0;
            ?>
            @foreach($users as $user)
                <?php $second_level = $user->children ?>
                    @foreach($second_level as $second)
                    <?php if(!$final_filter): ?>
                        <tr class="myTableRow">
                            <th>{{$secondLevel}}</th>
                            <td><?php echo $count1 ?></td>
                            <td>{{$second->first_name." ".$second->last_name}}</td>
                            <td>{{!$second->created_at? '__':$second->created_at}}</td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo '&#9989'; //right
                                            $two++;
                                        else:
                                            echo '&#x274C';//wrong
                                        endif;
                                    } else {
                                        /* C-ON-2021-09-15 
                                        echo '&#9989'; //right 
                                        $two++;
                                        */
                                        echo '&#x274C';//wrong
                                    }
                                } else {
                                    echo '&#x274C'; //wrong
                                }                                
                                ?>
                            </td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo $amount;                                       
                                        else:
                                            echo 'Not paid';
                                        endif;
                                    } else {
                                        /* C-ON-2021-09-15 
                                        echo $amount;
                                        */
                                        echo 'Not paid';                                        
                                    }
                                } else {
                                    echo 'Not paid';
                                }
                                ?>
                            </td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo $comm;                                      
                                        else:
                                            echo '0';
                                        endif;
                                    } else {
                                        /* C-ON-2021-09-15 
                                        echo $comm;
                                        */
                                        echo 0;
                                    }
                                } else {
                                    echo '0';
                                }
                                ?>
                            </td>
                            @if($second->paid_at == null)
                            <td id="{{$second->id}}">
                                <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                            </td>
                            @else
                            <td id="{{$second->id}}">{{(new \DateTime($second->paid_at))->format('d-M-Y')}}</td>
                            @endif
                            <td>
                                <a href="/message/{{$second->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                            </td>
                        </tr>
                        <?php
                        $count1++;
                        $secondLevel = "";
                        ?>
                    <?php elseif( date('Y-m', strtotime($second->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>    
                        <tr class="myTableRow">
                            <th>{{$secondLevel}}</th>
                            <td><?php echo $count1 ?></td>
                            <td>{{$second->first_name." ".$second->last_name}}</td>
                            <td>{{!$second->created_at? '__':$second->created_at}}</td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo '&#9989'; //right
                                            $two++;
                                        else:
                                            echo '&#x274C';//wrong
                                        endif;
                                    } else {
                                        echo '&#9989'; //right 
                                        $two++;
                                    }
                                } else {
                                    echo '&#x274C'; //wrong
                                }                                
                                ?>
                            </td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo $amount;                                       
                                        else:
                                            echo 'Not paid';
                                        endif;
                                    } else {
                                        echo $amount;
                                    }
                                } else {
                                    echo 'Not paid';
                                }
                                ?>
                            </td>
                            <td> 
                                <?php
                                if ($second->is_active == 'YES') {                            
                                    if (ifRegisteredThisMonth($second->created_at) == "true") {
                                        if($second->subscriber_commision >= 50):
                                            echo $comm;                                      
                                        else:
                                            echo '0';
                                        endif;
                                    } else {
                                        echo $comm;
                                    }
                                } else {
                                    echo '0';
                                }
                                ?>
                            </td>
                            @if($second->paid_at == null)
                            <td id="{{$second->id}}">
                                <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                            </td>
                            @else
                            <td id="{{$second->id}}">{{(new \DateTime($second->paid_at))->format('d-M-Y')}}</td>
                            @endif
                            <td>
                                <a href="/message/{{$second->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                            </td>
                        </tr>
                        <?php
                        $count1++;
                        $secondLevel = "";
                        ?>
                    <?php endif; ?>    
                @endforeach
            @endforeach

            {{-- //////////////////////////////////////////  Level 3  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
            <tr>
                <td colspan="7"></td>
            </tr>
            <?php
            $levelThree = 3;
            $count2 = 0;
            $three = 0;
            ?>
            @foreach($users as $user)
                <?php $second_level = $user->children; ?>
                    @foreach($second_level as $second)
                        <?php $third_level = $second->children ?>
                        @foreach($third_level as $third)
                            <?php if(!$final_filter): ?>
                                <tr class="myTableRow">
                                    <th>{{$levelThree}}</th>
                                    <td>{{++$count2}}</td>
                                    <td>{{$third->first_name." ".$third->last_name}}</td>
                                    <td>{{!$third->created_at? '__':$third->created_at}}</td>
                                    <td> 
                                        <?php
                                        if ($third->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo '&#9989'; //right
                                                    $three++;
                                                else:
                                                    echo '&#x274C';//wrong
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15 
                                                echo '&#9989'; //right 
                                                $three++;
                                                */
                                                echo '&#x274C'; //wrong
                                            }
                                        } else {
                                            echo '&#x274C'; //wrong
                                        }
                                        ?>
                                    </td>
                                    <td> 
                                        <?php
                                        if ($third->is_active == 'YES') {
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo $amount;                                       
                                                else:
                                                    echo 'Not paid';
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15
                                                echo $amount;
                                                */
                                                echo 'Not paid';
                                            }
                                        } else {
                                            echo 'Not paid';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($third->is_active == 'YES') {
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo $comm;                                      
                                                else:
                                                    echo '0';
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15
                                                echo $comm;
                                                */
                                                echo 0;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </td>
                                    @if($third->paid_at == null)
                                    <td id="{{$third->id}}">
                                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                    </td>
                                    @else
                                    <td id="{{$third->id}}">{{(new \DateTime($third->paid_at))->format('d-M-Y')}}</td>
                                    @endif
                                    <td>
                                        <a href="/message/{{$third->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                    </td>
                                </tr>     
                                <?php $levelThree = "" ?>
                            <?php elseif( date('Y-m', strtotime($third->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                                <tr class="myTableRow">
                                    <th>{{$levelThree}}</th>
                                    <td>{{++$count2}}</td>
                                    <td>{{$third->first_name." ".$third->last_name}}</td>
                                    <td>{{!$third->created_at? '__':$third->created_at}}</td>
                                    <td> 
                                        <?php
                                        if ($third->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo '&#9989'; //right
                                                    $three++;
                                                else:
                                                    echo '&#x274C';//wrong
                                                endif;
                                            } else {
                                                echo '&#9989'; //right 
                                                $three++;
                                            }
                                        } else {
                                            echo '&#x274C'; //wrong
                                        }
                                        ?>
                                    </td>
                                    <td> 
                                        <?php
                                        if ($third->is_active == 'YES') {
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo $amount;                                       
                                                else:
                                                    echo 'Not paid';
                                                endif;
                                            } else {
                                                echo $amount;
                                            }
                                        } else {
                                            echo 'Not paid';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($third->is_active == 'YES') {
                                            if (ifRegisteredThisMonth($third->created_at) == "true") {
                                                if($third->subscriber_commision >= 50):
                                                    echo $comm;                                      
                                                else:
                                                    echo '0';
                                                endif;
                                            } else {
                                                echo $comm;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </td>
                                    @if($third->paid_at == null)
                                    <td id="{{$third->id}}">
                                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                    </td>
                                    @else
                                    <td id="{{$third->id}}">{{(new \DateTime($third->paid_at))->format('d-M-Y')}}</td>
                                    @endif
                                    <td>
                                        <a href="/message/{{$third->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                    </td>
                                </tr>
                                <?php $levelThree = "" ?>    
                            <?php endif; ?>                                
                    @endforeach
                @endforeach
            @endforeach

            {{-- //////////////////////////////////////////////////////////// Level Four \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\--}}
            <tr>
                <td colspan="7"></td>
            </tr> 
            <?php
            $levelFour = 4;
            $count3 = 0;
            $four = 0
            ?>
            @foreach($users as $user)
                <?php $second_level = $user->children ?>
                @foreach($second_level as $second)
                    <?php $third_level = $second->children ?>
                    @foreach($third_level as $third)
                    <?php $forth_level = $third->children ?>
                        @foreach($forth_level as $forth)
                            <?php if(!$final_filter): ?>
                                <tr class="myTableRow">
                                    <th>{{$levelFour}}</th>
                                    <td>{{++$count3}}</td>
                                    <td>{{$forth->first_name." ".$forth->last_name}}</td>
                                    <td>{{!$forth->created_at? '__':$forth->created_at}}</td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo '&#9989'; //right
                                                    $four++;
                                                else:
                                                    echo '&#x274C';//wrong
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15
                                                echo '&#9989'; //right 
                                                $four++;
                                                */
                                                echo '&#x274C'; //wrong                                                
                                            }
                                        } else {
                                            echo '&#x274C'; //wrong
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo $amount;                                       
                                                else:
                                                    echo 'Not paid';
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15
                                                echo $amount;
                                                */
                                                echo 'Not paid';
                                            }
                                        } else {
                                            echo 'Not paid';
                                        }    
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo $comm;                                      
                                                else:
                                                    echo '0';
                                                endif;
                                            } else {
                                                /* C-ON-2021-09-15
                                                echo $comm;
                                                */
                                                echo 0;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </td>
                                    @if($forth->paid_at == null)
                                    <td id="{{$forth->id}}">
                                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                    </td>
                                    @else
                                    <td id="{{$forth->id}}">{{(new \DateTime($forth->paid_at))->format('d-M-Y')}}</td>
                                    @endif
                                    <td><a href="/message/{{$forth->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                    </td>
                                </tr>
                                <?php $levelFour = "";?>
                            <?php elseif( date('Y-m', strtotime($forth->created_at)) == date('Y-m', strtotime($final_filter)) ): ?>
                               <tr class="myTableRow">
                                    <th>{{$levelFour}}</th>
                                    <td>{{++$count3}}</td>
                                    <td>{{$forth->first_name." ".$forth->last_name}}</td>
                                    <td>{{!$forth->created_at? '__':$forth->created_at}}</td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo '&#9989'; //right
                                                    $four++;
                                                else:
                                                    echo '&#x274C';//wrong
                                                endif;
                                            } else {
                                                echo '&#9989'; //right 
                                                $four++;
                                            }
                                        } else {
                                            echo '&#x274C'; //wrong
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo $amount;                                       
                                                else:
                                                    echo 'Not paid';
                                                endif;
                                            } else {
                                                echo $amount;
                                            }
                                        } else {
                                            echo 'Not paid';
                                        }    
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($forth->is_active == 'YES') {                            
                                            if (ifRegisteredThisMonth($forth->created_at) == "true") {
                                                if($forth->subscriber_commision >= 50):
                                                    echo $comm;                                      
                                                else:
                                                    echo '0';
                                                endif;
                                            } else {
                                                echo $comm;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </td>
                                    @if($forth->paid_at == null)
                                    <td id="{{$forth->id}}">
                                        <button class="btn btn-warning btn-xs"  type="button" style="color: white" disabled>Paid</button>
                                    </td>
                                    @else
                                    <td id="{{$forth->id}}">{{(new \DateTime($forth->paid_at))->format('d-M-Y')}}</td>
                                    @endif
                                    <td><a href="/message/{{$forth->username}}" class="btn btn-primary btn-xs" type="button" style="color: white">Message</a>
                                    </td>
                                </tr>
                               <?php $levelFour = ""; ?>
                            <?php endif; ?>
                        @endforeach                            
                    @endforeach
                @endforeach
            @endforeach


            {{-- ???????????????????????????????????  Total ???????????????????????????????????????????????????????????????????????????????????????--}}
            <?php $total = $one + $two + $three + $four; ?>
            
            <?php if(ifRegisteredThisMonth($authUser->created_at) == "true"): //if user registered for this month?> 
                @if(!$final_filter) <?php //if filter is not applied - count by subscription ?>
                    <tr>
                        <th colspan="4" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                        <!-- Right/wrong arrow -->
                        <td style="font-size: 2rem">
                            <?php      
                            if( ((int) $authUser->subscriber_commision) >= 50):
                                echo '&#9989'; //write
                            else:
                                echo '&#x274C'; //wrong
                            endif;
                            ?>
                        </td>
                        <!-- Total fees -->
                        <td style="font-size: 2rem">$0</td>
                        <!-- Total commissions -->
                        <td style="font-size: 2rem">                    
                            <?php
                            if( ((int) $authUser->subscriber_commision) > 50) :
                                if( ((int) $authUser->subscriber_commision) >= 100) :
                                    echo $amount; //$50
                                else:
                                    echo '$0'; //if commison=$25
                                endif;
                            else:
                                echo '$0';
                            endif;
                            ?>                            
                        </td>
                        <!-- User can with drawn -->
                        <td style="font-size: 2rem">
                            <?php
                            if( ((int) $authUser->subscriber_commision) > 100) :
                                $canWithDrawn = ( ((int) $authUser->subscriber_commision) - 100 );
                                if($canWithDrawn > 24 ):                                
                                    echo '$'.((int)$canWithDrawn);
                                endif;
                            endif;                                                        
                            ?>
                        </td>
                    </tr>
                @else
                    <tr>
                        <th colspan="4" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                        <!-- Right/wrong arrow -->
                        <td style="font-size: 2rem">
                            <?php      
                            if ($countNewRegistrations >= 0) {
                                if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25) || $countNewRegistrations >= 0) {
                                    echo '&#9989';
                                } else {
                                    echo '&#x274C';
                                }
                            } else {
                                echo '&#x274C';
                            }
                            ?>
                        </td>
                        <!-- Total fees -->
                        <td style="font-size: 2rem">$0</td>
                        <!-- Total commissions -->
                        <td style="font-size: 2rem">                    
                            <?php
                            if ($countNewRegistrations >= 0) {
                                if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25) || $countNewRegistrations >= 0) {
                                    echo $amount;                                                        
                                }                            
                            } else {
                                echo 'Not Paid';
                            }
                            ?> 
                        </td>
                        <!-- User can with drawn -->
                        <td style="font-size: 2rem">
                            <?php
                            if ($countNewRegistrations > 0) {
                                $canWithDrawn = (($countNewRegistrations) * 25);
                                if($canWithDrawn > 0):
                                    echo '$'.((int)$canWithDrawn);
                                endif;
                            }
                            ?>
                        </td>
                    </tr>
                @endif                
            <?php else:  //if user not registered for this month?>  
                @if(!$final_filter) <?php //if filter is not applied - count by subscription ?>
                    <tr>
                        <th colspan="4" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                        <!-- Right/wrong arrow -->
                        <td style="font-size: 2rem">
                            <?php
                            if( ((int) $authUser->subscriber_commision) >= 50):
                                echo '&#9989'; //write
                            else:
                                echo '&#x274C'; //wrong
                            endif;
                            ?>
                        </td>
                        <!-- Total fees -->
                        <td style="font-size: 2rem">
                            <?php
                            if( ((int) $authUser->subscriber_commision) >= 50):
                                echo $amount;
                            else:
                                echo 'Not Paid';
                            endif;
                            ?>                    
                        </td>
                        <!-- Total commissions	-->
                        <td style="font-size: 2rem">                    
                            <?php
                            if( ((int) $authUser->subscriber_commision) > 50) :
                                if( ((int) $authUser->subscriber_commision) >= 100) :
                                    echo '$50';
                                else:
                                    echo '0'; //if commison=$25
                                endif;
                            else:
                                echo '0';
                            endif;
                            ?>
                        </td>
                        <!-- User can with drawn -->
                        <td style="font-size: 2rem">
                            <?php
                            if( ((int) $authUser->subscriber_commision) > 100) :
                                $canWithDrawn = ( ((int) $authUser->subscriber_commision) - 100 );
                                if($canWithDrawn > 24 ):                                
                                    echo '$'.((int)$canWithDrawn);
                                endif;
                            endif;                            
                            ?>                        
                        </td>
                    </tr>
                @else   <?php //if filter is applied ?>
                    <tr>
                        <th colspan="4" style="text-align: center;font-size: 2rem">Monthly Fees Through Subscriptions</th>
                        <!-- Right/wrong arrow -->
                        <td style="font-size: 2rem">
                            <?php      
                            if ($countNewRegistrations >= 0) {
                                if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25) || $countNewRegistrations >= 0) {
                                    echo '&#9989';
                                } else {
                                    echo '&#x274C';
                                }
                            } else {
                                echo '&#x274C';
                            }
                            ?>
                        </td>
                        <!-- Total fees -->
                        <td style="font-size: 2rem">
                            <?php
                            if ($countNewRegistrations >= 0) {
                                if (((int) $authUser->subscriber_commision) == ($countNewRegistrations * 25) || $countNewRegistrations >= 0) {
                                    echo $amount;                                                        
                                }                            
                            } else {
                                echo 'Not Paid';
                            }
                            ?>                    
                        </td>
                        <!-- Total commissions	-->
                        <td style="font-size: 2rem">                    
                            <?php
                            if ($countNewRegistrations == 1 || $countNewRegistrations == 2 ) {
                                //echo (((int) $authUser->subscriber_commision / 25) * 500) . 'F';
                                $totaComission = ( ($countNewRegistrations) * 25);
                                echo '$'.$totaComission;
                            } elseif($countNewRegistrations > 2) {   
                                $totaComission = ( 2 * 25);
                                echo '$'.$totaComission;
                            } else {
                                echo '0';
                            }
                            ?>
                        </td>
                        <!-- User can with drawn -->
                        <td style="font-size: 2rem">
                            <?php
                            if ($countNewRegistrations > 2) {
                                $canWithDrawn = (($countNewRegistrations - 2) * 25);
                                if($canWithDrawn > 0):
                                    echo '$'.((int)$canWithDrawn);
                                endif;
                            }
                            ?>                        
                        </td>
                    </tr>
                @endif                
            <?php endif; ?>    
            <tr>
                <th colspan="3" style="text-align: center;font-size: 2rem">Total Fees Paid by Subscribers (at 4 Levels)</th>
                <td colspan="3" style="text-align: center;font-size: 2rem">
                    @if(env('SITE') == 'ENG')
                    ${{$total*50}}
                    @else
                    {{$total*1000}}F
                    @endif
                </td>
            </tr>
            <tr>
                <th colspan="3" style="text-align: center;font-size: 2rem">Total Commission at 4 levels 60% (50% at each level)</th>
                <td colspan="3" style="text-align: center;font-size: 2rem">
                    @if(env('SITE') == 'ENG')
                    <?php $commission_perc = (50*50)/100; ?>
                    ${{$total*$commission_perc}}
                    @else
                    <?php $commission_perc = (1000*50)/100; ?>
                    {{$total*$commission_perc}}
                    @endif
                </td>
            </tr>
        <?php /* ?>    
         <tr>
            <th colspan="3" style="text-align: center;font-size: 2rem">Total amount to be paid</th>
            <td colspan="3" style="text-align: center;font-size: 2rem">
              @if(env('SITE') == 'ENG')
                <?php
                $subscription_amount = ((int) $authUser->subscriber_commision);
                $commission_perc = (50*50)/100; 
                $total_comission_paid = $total*$commission_perc;
                if ($countNewRegistrations >= 1) {
                    echo '$' . ($commission_perc + $total_comission_paid);
                } else {
                    echo '$' . ($total_comission_paid);
                }
                ?>
                @else
                <?php
                $subscription_amount = (((int) $authUser->subscriber_commision / 25) * 500);
                $commission_perc = (1000*50)/100;
                $total_comission_paid = $total*$commission_perc;
                if ($countNewRegistrations >= 1) {
                    echo ($commission_perc + $total_comission_paid). 'F';
                } else {
                    echo ($total_comission_paid). 'F';
                }
                ?>
                @endif
        </tr>
       <?php */ ?> 
<?php else : ?>
        <h1>Users don't have any subscriber</h1>
<?php endif; ?>
</tbody>
</table>
<!-- <script> 
    $(document).ready(function() {
        $('.pay_amount').click(function() {
            var user_id = $(this).attr("data-id");
            var history_saved_at = $(this).attr("data-history_saved_at");
            alert(user_id + "----" + history_saved_at);
            // $.ajax({
            //     url: "{{route('admin.user.amountPaid')}}",
            //     type: 'post',
            //     dataType: "json",
            //     data: {user_id: user_id},
            //     success: function (response) {
            //         //location.reload();
            //     }

            // });

            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('admin.user.amountPaid') }}",
                data: {
                    user_id: user_id,
                    history_saved_at: history_saved_at
                },
                success: (response) => {
                    if (!response) {
                        alert('Something went wrong, try Again!');
                    } else {
                        alert("Success------" + response['id']);
                        $('#' + response['id']).html(response['data']);
                    }
                    //window.location.assign("{{ url('user/tree') }}")
                },
                error: (response) => {
                    alert("Error------" + response);
                }
            })
        });
    });
</script> -->

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@endsection