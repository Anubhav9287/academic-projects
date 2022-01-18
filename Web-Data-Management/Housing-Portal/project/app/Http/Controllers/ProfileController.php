<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserReminderMail;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(\App\User $user) {
        return view('profile_edit', compact('user'));
    }

    public function viewuser(\App\User $user) {
        return view('confirm_delete', compact('user'));
    }
    

    public function destroy(User $user) {
        
        // dd($user->username);
        $loggedin_user = auth()->user();
        // dd($loggedin_user);
        $user->delete();

        return redirect("/profile/{$loggedin_user->id}");
    }

    public function sendreminder(User $user) {
        
        // $email = DB::table('users')->where('id', $user)->select('email')->get();
        $email = $user->email;
        // dd($email);
        Mail::to($email)->send(new NewUserReminderMail());
        $loggedin_user = auth()->user();
        echo "<script>alert('Email Sent');</script>";
        return redirect("/profile/{$loggedin_user->id}");
    }

    public function update(User $user) {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'email',
            'username' => 'required',
            'status' => '',
        ]);

        // dd(auth()->user()->name);
        $loggedin_user = auth()->user();
        // dd($loggedin_user);
        $user->update($data);

        return redirect("/profile/{$loggedin_user->id}");
    }

    public function index($user)
    {
        // $this->authorize('view',$user->id);

        $user = User::findOrFail($user);
        if ($user->signup == 'subdivision') {

            // $users = DB::table('users')->get();
            // $users = User::get();
            $users = DB::table('users')->where('subdivision_name', $user->subdivision_name)->get();
            $build1_occupant = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('signup', 'apartment')->Where('building_no', 1)->Where('status', 'active')->get();
            $build2_occupant = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('signup', 'apartment')->Where('building_no', 2)->Where('status', 'active')->get();
            $build3_occupant = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('signup', 'apartment')->Where('building_no', 3)->Where('status', 'active')->get();
            $build4_occupant = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('signup', 'apartment')->Where('building_no', 4)->Where('status', 'active')->get();
            
            //Values for building 1
            if (count($build1_occupant)) {
                $total_gas_b1 = 0;
                $total_water_b1 = 0;
                $total_elec_b1 = 0;
                foreach ($build1_occupant as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_b1 = $total_gas_b1 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_b1 = $total_water_b1 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_b1 = $total_elec_b1 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f1, $total_water_f1, $total_elec_f1);
            } else {
                $total_gas_b1 = 0;
                $total_water_b1 = 0;
                $total_elec_b1 = 0;
            }

            //Values for Buiding 2
            if (count($build2_occupant)) {
                $total_gas_b2 = 0;
                $total_water_b2 = 0;
                $total_elec_b2 = 0;
                foreach ($build2_occupant as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_b2 = $total_gas_b2 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_b2 = $total_water_b1 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_b2 = $total_elec_b2 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f2, $total_water_f2, $total_elec_f2);
            } else {
                $total_gas_b2 = 0;
                $total_water_b2 = 0;
                $total_elec_b2 = 0;
            }

            //Values for building 3
            if (count($build3_occupant)) {
                $total_gas_b3 = 0;
                $total_water_b3 = 0;
                $total_elec_b3 = 0;
                foreach ($build3_occupant as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_b3 = $total_gas_b3 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_b3 = $total_water_b3 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_b3 = $total_elec_b3 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f3, $total_water_f3, $total_elec_f3);
            } else {
                $total_gas_b3 = 0;
                $total_water_b3 = 0;
                $total_elec_b3 = 0;
            }

            //Values for floor 4
            if (count($build4_occupant)) {
                $total_gas_b4 = 0;
                $total_water_b4 = 0;
                $total_elec_b4 = 0;
                foreach ($build4_occupant as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_b4 = $total_gas_b4 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_b4 = $total_water_b4 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_b4 = $total_elec_b4 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f4, $total_water_f4, $total_elec_f4);
            } else {
                $total_gas_b4 = 0;
                $total_water_b4 = 0;
                $total_elec_b4 = 0;
            }
            $val_build1 = $total_gas_b1+$total_water_b1+$total_elec_b1;
            $val_build2 = $total_gas_b2+$total_water_b2+$total_elec_b2;
            $val_build3 = $total_gas_b3+$total_water_b3+$total_elec_b3;
            $val_build4 = $total_gas_b4+$total_water_b4+$total_elec_b4;
            
            $amount = $total_gas_b1+$total_gas_b2+$total_gas_b3+$total_gas_b4+
            $total_water_b1+$total_water_b2+$total_water_b3+$total_water_b4
            +$total_elec_b1+$total_elec_b2+$total_elec_b3+$total_elec_b4;

            $totalusers = $f1 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('status', 'active')->whereNotNull('floor_no')->get();
            $a= array();
            foreach($totalusers as $s_user)
            {
                $g = DB::table('services')->select('gas')->where('user_id', $s_user->id)->get();
                $w = DB::table('services')->select('water')->where('user_id', $s_user->id)->get();
                $e = DB::table('services')->select('electricity')->where('user_id', $s_user->id)->get();
                $i = DB::table('services')->select('internet')->where('user_id', $s_user->id)->get();
                $t = (int)($g[0]->Gas) + (int)($w[0]->Water) + (int)($e[0]->Electricity) + (int)($i[0]->Internet);
                array_push($a,array("name" => $s_user->name, "email" => $s_user->email, "gas" => $g[0]->Gas,
                "water" => $w[0]->Water,"electricity" => $e[0]->Electricity,"internet" => $i[0]->Internet,"total" => $t ));

            }

            // dd($total_gas_b1+$total_water_b1+$total_elec_b1);
            return view('subdivision', [
                'user' => $user, 'build1_occupant' => $build1_occupant, 'build2_occupant' => $build2_occupant, 'build3_occupant' => $build3_occupant, 'build4_occupant' => $build4_occupant,
                'total_gas_b1'=>$total_gas_b1,'total_water_b1'=>$total_water_b1,'total_elec_b1'=>$total_elec_b1,
                'total_gas_b2'=>$total_gas_b2,'total_water_b2'=>$total_water_b2,'total_elec_b2'=>$total_elec_b2,
                'total_gas_b3'=>$total_gas_b3,'total_water_b3'=>$total_water_b3,'total_elec_b3'=>$total_elec_b3,
                'total_gas_b4'=>$total_gas_b4,'total_water_b4'=>$total_water_b4,'total_elec_b4'=>$total_elec_b4,
                'val_build1'=>$val_build1,'val_build2'=>$val_build2,'val_build3'=>$val_build3,'val_build4'=>$val_build4,
                'amount'=>$amount,'t_u'=>$a,
            ]);
        } else if ($user->signup == 'building') {
            $totalusers = $f1 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('status', 'active')->Where('building_no', $user->building_no)->whereNotNull('floor_no')->get();
            $f1 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('building_no', $user->building_no)->Where('floor_no', '0')->get();
            $f2 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('building_no', $user->building_no)->Where('floor_no', '1')->get();
            $f3 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('building_no', $user->building_no)->Where('floor_no', '2')->get();
            $f4 = DB::table('users')->where('subdivision_name', $user->subdivision_name)->Where('building_no', $user->building_no)->Where('floor_no', '3')->get();

            $a= array();
            foreach($totalusers as $s_user)
            {
                $g = DB::table('services')->select('gas')->where('user_id', $s_user->id)->get();
                $w = DB::table('services')->select('water')->where('user_id', $s_user->id)->get();
                $e = DB::table('services')->select('electricity')->where('user_id', $s_user->id)->get();
                $i = DB::table('services')->select('internet')->where('user_id', $s_user->id)->get();
                $t = (int)($g[0]->Gas) + (int)($w[0]->Water) + (int)($e[0]->Electricity) + (int)($i[0]->Internet);
                array_push($a,array("name" => $s_user->name, "email" => $s_user->email, "gas" => $g[0]->Gas,
                "water" => $w[0]->Water,"electricity" => $e[0]->Electricity,"internet" => $i[0]->Internet,"total" => $t ));

            }


            //Values for floor 1
            if (count($f1)) {
                $total_gas_f1 = 0;
                $total_water_f1 = 0;
                $total_elec_f1 = 0;
                foreach ($f1 as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_f1 = $total_gas_f1 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_f1 = $total_water_f1 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_f1 = $total_elec_f1 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f1, $total_water_f1, $total_elec_f1);
            } else {
                $total_gas_f1 = 0;
                $total_water_f1 = 0;
                $total_elec_f1 = 0;
            }
            //Values for floor 2
            if (count($f2)) {
                $total_gas_f2 = 0;
                $total_water_f2 = 0;
                $total_elec_f2 = 0;
                foreach ($f2 as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_f2 = $total_gas_f2 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_f2 = $total_water_f1 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_f2 = $total_elec_f2 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f2, $total_water_f2, $total_elec_f2);
            } else {
                $total_gas_f2 = 0;
                $total_water_f2 = 0;
                $total_elec_f2 = 0;
            }

            //Values for floor 3
            if (count($f3)) {
                $total_gas_f3 = 0;
                $total_water_f3 = 0;
                $total_elec_f3 = 0;
                foreach ($f3 as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_f3 = $total_gas_f3 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_f3 = $total_water_f3 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_f3 = $total_elec_f3 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f3, $total_water_f3, $total_elec_f3);
            } else {
                $total_gas_f3 = 0;
                $total_water_f3 = 0;
                $total_elec_f3 = 0;
            }

            //Values for floor 4
            if (count($f4)) {
                $total_gas_f4 = 0;
                $total_water_f4 = 0;
                $total_elec_f4 = 0;
                foreach ($f4 as &$value) {
                    $id = $value->id;
                    $temp_gas = DB::table('services')->select('gas')->where('user_id', $id)->get();
                    $total_gas_f4 = $total_gas_f4 + (int)($temp_gas[0]->Gas);
                    $temp_water = DB::table('services')->select('water')->where('user_id', $id)->get();
                    $total_water_f4 = $total_water_f4 + (int)($temp_water[0]->Water);
                    $temp_elec = DB::table('services')->select('electricity')->where('user_id', $id)->get();
                    $total_elec_f4 = $total_elec_f4 + (int)($temp_elec[0]->Electricity);
                }
                // dd($total_gas_f4, $total_water_f4, $total_elec_f4);
            } else {
                $total_gas_f4 = 0;
                $total_water_f4 = 0;
                $total_elec_f4 = 0;
            }
            $amount = $total_gas_f1+$total_gas_f2+$total_gas_f3+$total_gas_f4+
            $total_water_f1+$total_water_f2+$total_water_f3+$total_water_f4
            +$total_elec_f1+$total_elec_f2+$total_elec_f3+$total_elec_f4;

            return view('building', [
                'user' => $user, 'f1' => $f1, 'f2' => $f2, 'f3' => $f3, 'f4' => $f4, 
                'total_gas_f1' => $total_gas_f1, 'total_gas_f2' => $total_gas_f2, 'total_gas_f3' => $total_gas_f3,'total_gas_f4' => $total_gas_f4,
                'total_water_f1'=>$total_water_f1,'total_water_f2'=>$total_water_f2,'total_water_f3'=>$total_water_f3,'total_water_f4'=>$total_water_f4,
                'total_elec_f1'=>$total_elec_f1,'total_elec_f2'=>$total_elec_f2,'total_elec_f3'=>$total_elec_f3,'total_elec_f4'=>$total_elec_f4,
                'amount'=>$amount,'t_u'=>$a,
            ]);
        } 
        else if ($user->signup == 'admin'){
            
            $users = DB::table('users')->where('subdivision_name','Slytherin')->orWhere('subdivision_name','Gryffindor')->orWhere('subdivision_name','Ravenclaw')->orWhere('subdivision_name','Hufflepuff')->get();
            // dd($users);
            return view('superuser', [
                'user' => $user,'allusers'=>$users,
            ]);
        }
        else {
            $totalusers = $f1 = DB::table('users')->where('id', $user->id)->Where('status', 'active')->whereNotNull('floor_no')->get();
            $a= array();
            foreach($totalusers as $s_user)
            {
                $g = DB::table('services')->select('gas')->where('user_id', $s_user->id)->get();
                $w = DB::table('services')->select('water')->where('user_id', $s_user->id)->get();
                $e = DB::table('services')->select('electricity')->where('user_id', $s_user->id)->get();
                $i = DB::table('services')->select('internet')->where('user_id', $s_user->id)->get();
                $t = (int)($g[0]->Gas) + (int)($w[0]->Water) + (int)($e[0]->Electricity) + (int)($i[0]->Internet);
                array_push($a,array("name" => $s_user->name, "email" => $s_user->email, "gas" => $g[0]->Gas,
                "water" => $w[0]->Water,"electricity" => $e[0]->Electricity,"internet" => $i[0]->Internet,"total" => $t ));

            }
            return view('home', [
                'user' => $user,'t_u'=>$a,
            ]);
        }
    }
}
