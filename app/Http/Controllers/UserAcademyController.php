<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// Request & Response
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Facades
use Grid;
use Date;
use Helper;

// Models and Repo
use App\Repositories\PaymentRepository;
use App\Repositories\PaymentDetailsRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialGroupRepository;
use App\Repositories\MaterialSubGroupRepository;
use App\Repositories\SubMaterialGroupRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAcademyController extends Controller
{
    protected $academy;

    protected $academyDetail;

    protected $materialSubGroup;

    protected $SubmaterialGroup;

    protected $materialGroup;

    protected $material;

    public function __construct(
        PaymentRepository $academy,
        PaymentDetailsRepository $academyDetail,
        MaterialSubGroupRepository $materialSubGroup,
        SubMaterialGroupRepository $SubmaterialGroup,
        MaterialGroupRepository $materialGroup,
        MaterialRepository $material
    )
    {
        $this->academy = $academy;
        $this->academyDetail = $academyDetail;

        $this->materialSubGroup = $materialSubGroup;
        $this->SubmaterialGroup = $SubmaterialGroup;
        $this->materialGroup = $materialGroup;
        $this->material = $material;
    }

    public function view_video()
    {
        $lang = App::getLocale();
        $materialGrp = DB::table('material_group')
            ->where('lang', $lang)
            ->get();

        return view('user-academy.view_video', ['materialGroup' => $materialGrp]);
       
    }

    public function view_course()
    {
        $lang = App::getLocale();
        $materialGroup = DB::table('material_group')->where('lang', $lang)->get();
        return view('user-academy.view_course', ['materialGroup' => $materialGroup]);
    }

    public function viewMaterial($id)
    {
		 
        $material = $this->material->find($id);
        $material_details = DB::table('material')->where('id', $id)->first();
        
        return view('user-academy.view-material', ['material' => $material, 'material_details' => $material_details]);
    }

    public function viewSubMatGroup($id)
    {
        //$materialGrp = DB::table('material_group')->where('id', $id)->get();
        //$sub_materials = $this->SubmaterialGroup->find($id);
        $sub_material_details = DB::table('sub_material_group')->where('group_id', $id)->get();
        
        return view('user-academy.view-sub-material', [ 'sub_material_details' => $sub_material_details]);
    }

    public function viewPdf($id)
    {
        $material = $this->material->find($id);
        return view('user-academy.view_pdf', ['material' => $material]);
    }

    public function viewGroup($groupID)
    {
        $lang = App::getLocale();
        
        /************edited By Avdesh  04-06-2020*************/
        
        /*$groupLanguage = fmod($groupID,2);
		if($lang == "en" && $groupLanguage == 0){
            $groupID = $groupID - 1;
        }elseif($lang == "fr" && $groupLanguage != 0){
            $groupID = $groupID + 1;
        }*/
        /****************************************************/
        
        
      /*  $materialGrp = DB::table('material_group')
            ->where('lang', $lang)
            ->get();
        $flag = false;
        foreach ($materialGrp as $materialg) {
            if ($materialg->id == $groupID) {
                $flag = true;
            }
        }*/

       /* if ($flag == false) {
            return redirect('/user-academy/video');
        }*/

        $material = DB::table('material')->
        where('group_id', $groupID)->
        where('id', '!=', 30)->
            where('material_type','VIDEO')->
        orderBYRaw('title + 0', 'ASC', 'title')->
        paginate(15);
        
        if($material){
        //  dd(($material));

        return view('user-academy.view-material-group', ['material' => $material]);
        }
        return redirect('/user-academy/video');
    }

    public function courseGroup($groupID)
    {
        $lang = App::getLocale();
        $materialGrp = DB::table('material_group')
            ->where('lang', $lang)
            ->get();
        $flag = false;
        foreach ($materialGrp as $material) {
            if ($material->id == $groupID) {
                $flag = true;
            }
        }

        if ($flag == false) {
            return redirect('/user-academy/course');
        }

        $material = DB::table('material')->where('group_id', $groupID)->where('material_type', 'COURSE')->orderBYRaw('title + 0', 'ASC', 'title')->get();
        return view('user-academy.view_pdf_group', ['material' => $material]);
    }

    public function groupMaterialPayment($groupID)
    {
        $materialGroup = DB::table('material_group')
            ->where('id', $groupID)
            ->first();
        return view('user-academy.payment', ['item' => $materialGroup, 'type' => 'group']);
    }

    public function subMaterialgroupPayment($submatgroupID)
    {
        $submaterialGroup = DB::table('sub_material_group')
            ->where('id', $submatgroupID)
            ->first();
        return view('user-academy.payment', ['item' => $submaterialGroup, 'type' => 'submatgroup']);
    }

    public function materialPayment($materialID)
    {
        $material = DB::table('material')
            ->where('id', $materialID)
            ->first();
        return view('user-academy.payment', ['item' => $material, 'type' => 'material']);
    }

    public function paymentSuccess($type, $id)
    {
        if ($type == 'group') {
            $materialGroup = DB::table('material_group')
                ->where('id', $id)
                ->first();
            $transactionID = DB::table('payments')
                ->insertGetId(
                    [
                        'user_id' => Auth::user()->id,
                        'payment_mode' => 'ONLINE',
                        'payment_type' => $materialGroup->payment_type,
                        'paid_for' => 'GROUP', 'amount_paid' => $materialGroup->price,
                        'status' => 'APPROVED',
                        'created_at' => Carbon::now()->toDateTimeString()
                    ]
                );

            DB::table('payments_details')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'group_id' => $materialGroup->id,
                    'start_date' => ($materialGroup->payment_type == 'RECURRING') ? Carbon::now()->startOfMonth() : Carbon::now()->toDateString(),
                    'end_date' => ($materialGroup->payment_type == 'RECURRING') ? Carbon::now()->endOfMonth() : null,
                    'amount' => $materialGroup->price,
                    'transaction_id' => $transactionID
                ]
            );

            return redirect('/user-academy/viewGroup/' . $materialGroup->id);
        } elseif ($type == 'material') {
            $material = DB::table('material')
                ->where('id', $id)
                ->first();
            $transactionID = DB::table('payments')
                ->insertGetId(
                    ['user_id' => Auth::user()->id,
                        'payment_mode' => 'ONLINE',
                        'payment_type' => $material->payment_type,
                        'paid_for' => 'MATERIAL',
                        'amount_paid' => $material->price,
                        'status' => 'APPROVED',
                        'created_at' => Carbon::now()->toDateTimeString()
                    ]
                );

            DB::table('payments_details')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'material_id' => $material->id,
                    'start_date' => ($material->payment_type == 'RECURRING') ? Carbon::now()->startOfMonth() : Carbon::now()->toDateString(),
                    'end_date' => ($material->payment_type == 'RECURRING') ? Carbon::now()->endOfMonth() : null,
                    'amount' => $material->price,
                    'transaction_id' => $transactionID
                ]
            );

            return redirect('/user-academy/view/' . $material->id);
        } else {
            return abort(404);
        }
    }
}
