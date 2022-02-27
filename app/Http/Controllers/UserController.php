<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\verifyMail;
use App\Models\NotificationToken;
use  App\Models\RoleUser;
use App\Models\User;
use Carbon\Carbon;
use Mail;



class UserController extends Controller
{

     /** Auth with FACEBOOKK */
   public function redirectToFacebook()
   {
       return Socialite::driver('facebook')->redirect();
   }


   public function FacebookCallback()

   {
       
       try{
   
           $user = Socialite::driver('facebook')->stateless()->user();
           $finduser = User::where('facebook_id',$user['id'])->first();
           if($finduser){

               Auth::login($finduser);
                return redirect()->route('profile');

           }else{
               $userdata = User::where('email',$user['email'])->first();
               if($userdata){
                   User::where('id',$userdata->id)->update([
                       'facebook_id' => $user['id'] 
                   ]);


               }else{
                     if($user->avatar){
                       $filename =   time() . '-' .Str::slug($user['name'],'_').'.jpg';
                       $path = 'images/avatar/'.$filename;
                       Image::make($user->avatar)->resize(200,200)->save(public_path('/').$path);
                     }

           
                   $userdata = User::create([
                       'fullname'  => $user['name'],
                       'email'     => $user['email'],
                       'avatar'    => ($path) ? $path : null,
                       'google_id' => $user['id'],
                       'password'  => bcrypt('123456')
                   ]);

                   RoleUser::create([
                       'user_id'=>$userdata->id,
                        'role_id'=> 2
                   ]);
                  
               }
              
       
               Auth::login($userdata);
               return redirect()->route('profile');

           }


       } catch (Exception $e) {

           return redirect()->route('404','404');

       }

   }
  /*************************************/   
   

   /** Auth with GOOGLE */
   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function GoogleCallback()

    {
        
        try{
    
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id',$user['id'])->first();
            if($finduser){

                Auth::login($finduser);
                 return redirect()->route('profile');

            }else{
                $userdata = User::where('email',$user['email'])->first();
                if($userdata){
                    User::where('id',$userdata->id)->update([
                        'google_id' => $user['id'] 
                    ]);


                }else{
                      if($user->avatar){
                        $filename =   time() . '-' .Str::slug($user['name'],'_').'.jpg';
                        $path = 'images/avatar/'.$filename;
                        Image::make($user->avatar)->resize(200,200)->save(public_path('/').$path);
                      }

            
                    $userdata = User::create([
                        'fullname'  => $user['name'],
                        'email'     => $user['email'],
                        'avatar'    => ($path) ? $path : null,
                        'google_id' => $user['id'],
                        'password'  => bcrypt('123456')
                    ]);

                    RoleUser::create([
                        'user_id'=>$userdata->id,
                        'role_id'=> 2
                    ]);
                   
                }
               
        
                Auth::login($userdata);
                return redirect()->route('profile');

            }


        } catch (Exception $e) {

            return redirect()->route('404','404');

        }

    }

    /*********************** save browser token ******************/
    
     public  function savetoken(Request $request) {
         
        // return $request->all();
        $checkToken = NotificationToken::where('token',$request->user)->first();
        if(!$checkToken){
            NotificationToken::create([
              'token'=>$request->user
            ]);
            return "yes";
        }
        
        return "exist";
        
     }
    
    
   /*************************************/   
    public  function logout() {
        Auth::logout();
        session()->flash('message',__('lang.yourlogout'));
        return redirect('/');
    }
    public  function emailverify() {
    
        if(Auth::check()){
               $user = Auth::user();
             if(empty($user->email_verified_at)){
                $token = app('auth.password.broker')->createToken($user);
                $data = DB::table('emailverify')->insert([
                       'email'      =>$user->email,
                       'token'      =>$token,
                       'created_at' =>Carbon::now()
                ]);
               
          
            try {
               Mail::to($user->email)->send(new verifyMail($token));
            
             } catch (\Exception $e) {
                session()->flash('error',__('lang.waswrong'));
                return redirect()->route('profile'); 
             }
           
              
                return redirect()->route('profile')->with('success',__('lang.messageverify'));
             }
             return redirect()->route('profile');
        }    
    
        return back();
    }

    public   function  callbackemailverify($token){

            $check_token = DB::table('emailverify')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(24))->first();
            if($check_token){
                $user = User::where('email',$check_token->email)
                            ->update(['email_verified_at'=> Carbon::now()]);
                            DB::table('emailverify')
                                ->where('email',$check_token->email)
                                ->delete();
                     return redirect()->route('profile')->with('sucess',__('lang.account_verified'));             
           }
           return redirect()->route('profile')->with('error',__('lang.token_invalid'));               
    }

    public function resetpasswordform($token){
        $check_token = DB::table('password_resets')
        ->where('token',$token)
        ->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){ 

            return view('account.user.restpassword',['email'=>$check_token->email]);
        }
        return view('errors.404');
    }

    public function resetpassword(Request $request,$token){
        $check_token = DB::table('password_resets')
        ->where('token',$token)
        ->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){ 
            $request->validate([
              'password'              =>  ['required','confirmed','min:6'],
              'password_confirmation' =>  ['required']
            ]);

            $user = User::where('email',$check_token->email)
            ->update(
             ['password'=>bcrypt($request->password)]);

             DB::table('password_resets')
              ->where('email',$check_token->email)
              ->delete();
              Auth::attempt(['email'=>$check_token->email,'password'=>$request->password]);
              return redirect()->route('profile'); 
        }
        return view('errors.404');
    }
}
