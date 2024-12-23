<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\ModelService;
use App\Models\AppSetting;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class AppSettingsController extends Controller
{
    protected AppSetting $appSettingService;


    public function __construct(ModelService $modelService){
        $this->appSettingService = $modelService->appSettingService();
    }

    public function index(Request $request){
        $settingList = $this->appSettingService->all();
        return Inertia::render('AppSetting/Index',[
            'type' => 'list',
            'settingList' => $settingList
        ]);
    }

    public function store(Request $request){
        try{
            $rules = [
                'name' => 'required',
                'type' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);


            if ($validator->fails()) {
                return response()->json(['type' => 'validation','errors' => [
                    'name' => $validator->errors()->first('name'),
                    'type' => $validator->errors()->first('type'),
                ]], 400);
            }
            if(!empty($request->name)){
                $slug = Helper::generateUniqueKey($request->name);
                $request['key'] = $slug;
            }
            $request['status'] = 1;
            $this->appSettingService->create($request->all());
            return response()->json([
                'success' => true,
                'status' => 'success',
                'message' => 'App Setting Created Successfully'
            ], 200);

        }catch(\Exception $e){
            return response()->json(['error',$e->getMessage()],400);
        }
    }

    public function settingFields(Request $request){
        return Inertia::render('AppSetting/SettingFields/Index',[
            
        ]);
    }

    public function edit(Request $request){
        if(!empty($request->id)){
            $detail = $this->appSettingService->find($request->id);
        } 
        return Inertia::render('AppSetting/Index',[
            'type' => 'edit',
            'detail' => $detail
        ]);
    }

    public function destroy(Request $request){
        dd($request->id);
    }
}
