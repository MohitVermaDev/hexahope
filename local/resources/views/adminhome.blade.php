@extends('layouts.app')

@section('content')
<div class="card ">
    <div class="card-content">
        <div class="row">
            <div class="col m3 s12">
                Total in Hexa Plan 1
                <br>
                <?php 
                $rolesnew = new App\Role;
                $rr = $rolesnew::where('name','user')->first()->users()->where('plan_id',1)->count(); 
                echo $rr;
                ?>
            </div>
             <div class="col m3 s12">
                Total in Hexa Plan 2
                <br>
                <?php 
                $rolesnew = new App\Role;
                $rr = $rolesnew::where('name','user')->first()->users()->where('plan_id',2)->count(); 
                echo $rr;
                ?>
            </div>
             <div class="col m3 s12">
                Total in Hexa Plan 3
                <br>
                <?php 
                $rolesnew = new App\Role;
                $rr = $rolesnew::where('name','user')->first()->users()->where('plan_id',3)->count(); 
                echo $rr;
                ?>
            </div>
             <div class="col m3 s12">
                Total in Hexa Plan 4
                <br>
                <?php 
                $rolesnew = new App\Role;
                $rr = $rolesnew::where('name','user')->first()->users()->where('plan_id',4)->count(); 
                echo $rr;
                ?>
            </div>
            <div class="col m12 s12">
                <hr>
                Total Loyality Income
                <br>
                <?php 
                $AdminSettings = new App\AdminSettings;
                $rr = $AdminSettings::where('setting_name','loyality_income')->first(); 
                echo $rr->setting_value;
                ?>
            </div>
        </div>
    </div>
</div>
@endsection
