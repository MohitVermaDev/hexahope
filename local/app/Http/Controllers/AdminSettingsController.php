<?php

namespace App\Http\Controllers;

use App\AdminSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function index(Request $request){
        $data['title'] = 'ADMIN WEBISTE SETTINGS';
        return view('admin.settings')->with($data);
    }
    public function savesettings(Request $request){
        $request->validate([
            'charges_percentage'=>'required|numeric',
            'web_title'=>'required|string'
            ]);
        AdminSettings::where('setting_name','web_title')->update([
            'setting_value'=>$request->web_title
            ]);
        AdminSettings::where('setting_name','charges_percentage')->update([
            'setting_value'=>$request->charges_percentage
            ]);
        AdminSettings::where('setting_name','withdraw_charges')->update([
            'setting_value'=>$request->withdraw_charges
            ]);
        AdminSettings::where('setting_name','btc_address')->update([
            'setting_value'=>$request->btc_address
            ]);
        if($request->hasFile('btc_qr'))
            {
                $filenameWithExt = $request->file('btc_qr')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('btc_qr')->getClientOriginalExtension();
                $filenametostore = 'btc_qr'.$filename.'_'.time().'.'.$extension;
                $path = $request->file('btc_qr')->move('images', $filenametostore);
                AdminSettings::where('setting_name','btc_qr')->update([
                    'setting_value'=>$filenametostore
                    ]);
            }
       
        
        return redirect()->back()->with(['success'=>'Settings Updated Successfully']);
    }
}
