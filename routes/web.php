<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController; 
use  App\Http\Controllers\FrontController; 

use App\Http\Livewire\User\Profile;
use App\Http\Livewire\User\ListProperty;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\User\ChangePassword;
use App\Http\Livewire\Admin\StateManage;
use App\Http\Livewire\Admin\CityManage;
use App\Http\Livewire\Admin\PagesCreate;
use App\Http\Livewire\Admin\PagesManage;
use App\Http\Livewire\Admin\PagesUpdate;
use App\Http\Livewire\Admin\ManageCategory;
use App\Http\Livewire\Admin\ManageTag;
use App\Http\Livewire\Admin\CreateBlog;
use App\Http\Livewire\Admin\UpdateBlog;
use App\Http\Livewire\Admin\ManageBlog;
use App\Http\Livewire\Admin\FindByLocation;
use App\Http\Livewire\Admin\PenddingPropety;
use App\Http\Livewire\Admin\SettingManage;
use App\Http\Livewire\Admin\ThemeCustom;
use App\Http\Livewire\User\SubmitProperty;
use App\Http\Livewire\User\UpdateProperty;
use App\Http\Livewire\ContactUs;
use App\Http\Livewire\ListingProperties;
use App\Http\Livewire\SendNotification;





















/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{



     
Route::get('/',[FrontController::class,'homepage'])->name('home');


Route::get('/property/{slug}',[FrontController::class,'property'])->name('property');
Route::get('/pdf/property/{slug}',[FrontController::class,'propertypdf'])->name('property.pdf');
Route::get('/properties/{slug}',[FrontController::class,'searchproperties'])->name('search.properties');
Route::get('/blogs/{category?}',[FrontController::class,'blogview'])->name('blogs');
Route::get('/blogs/tag/{tag}',[FrontController::class,'tagview'])->name('blog.tag');
Route::get('/blog/search/',[FrontController::class,'searchblog'])->name('blog.search');
Route::get('/blog/{slug}',[FrontController::class,'blog'])->name('blog');
Route::get('/page/{slug}',[FrontController::class,'page'])->name('page.view');
Route::get('/contact-us',ContactUs::class)->name('contactus');
Route::get('/properties-for-rent',[FrontController::class,'properties_for_rent'])->name('rent.properties');
Route::get('/properties-for-sale',[FrontController::class,'properties_for_sale'])->name('sale.properties');
Route::get('/listproperties',ListingProperties::class)->name('list.properties');

Route::get('auth/google',[UserController::class,'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback',[UserController::class,'GoogleCallback']);
Route::get('auth/facebook',[UserController::class,'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback',[UserController::class,'FacebookCallback']);




Route::fallback(function () {
    return view('errors.404');
})->name('404');

Route::get('/user/forgot/password',ForgotPassword::class)->name('forgot.password');
Route::get('/user/reset/password/{token}',[UserController::class,'resetpasswordform'])->name('reset.password');
//Route::post('/user/reset/password/{token}',[UserController::class,'resetpassword'])->name('reset.password');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/create/property',SubmitProperty::class)->name('create.property');




Route::middleware(['auth'])->group(function(){

   
     Route::get('/account/profile',Profile::class)->name('profile');
     Route::get('/account/update/password',ChangePassword::class)->name('update.password');
     Route::get('/account/email/verify',[UserController::class,'emailverify'])->name('email.verify');
     Route::get('/account/email/verify/{token}',[UserController::class,'callbackemailverify'])->name('email.verify.back');
     Route::get('/account/myproperty/',ListProperty::class)->name('myproperty');
     Route::get('/update/property/{slug}',UpdateProperty::class)->name('update.property');
    /* Start Admin area  */
    Route::middleware(['checkadmin'])->group(function(){
        Route::get('/account/admin/state',StateManage::class)->name('state');
        Route::get('/account/admin/city',CityManage::class)->name('city');
        Route::get('/account/admin/category',ManageCategory::class)->name('category');
        Route::get('/account/admin/tag',ManageTag::class)->name('tag');

        Route::get('/account/admin/blog/create',CreateBlog::class)->name('blog.create'); 
        Route::get('/account/admin/blog/{id}/update',UpdateBlog::class)->name('blog.update'); 
        
        Route::get('/account/admin/blog',ManageBlog::class)->name('blog.manage'); 
        Route::get('/account/admin/findbylocation',FindByLocation::class)->name('findbylocation'); 
        Route::get('/account/admin/setting',SettingManage::class)->name('setting.manage'); 
        Route::get('/account/admin/pending',PenddingPropety::class)->name('pending.property');
        

        Route::get('/account/admin/page/create',PagesCreate::class)->name('page.create');
        Route::get('/account/admin/page',PagesManage::class)->name('page');
        Route::get('/account/admin/page/{id}/update',PagesUpdate::class)->name('page.update');

        Route::get('/account/admin/theme',ThemeCustom::class)->name('theme');
        Route::get('/account/admin/sendnotification',SendNotification::class)->name('send.notification');


        
        
    });
    /* End Admin area  */
});


Route::get('/{state}/{city?}/{type?}',[FrontController::class,'list_properties'])->name('listing.properties');
});