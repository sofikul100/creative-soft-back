<?php

use App\Http\Controllers\LogoController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDetailsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WhatClientSaysController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/admin/dashboard', function () {
    return view('backend.dashboard.dashboard');
})->middleware(['auth', 'verified', 'preventBackHistory'])->name('dashboard');



Route::middleware('auth', 'preventBackHistory')->group(function () {
    //============== all profile routes here==============//
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::post('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');

        Route::get('/password/change', 'change_password_form')->name('change.password');
        Route::post('/password/change', 'change_password')->name('change_password');

        //--------------ajax request for check current password--------------//
        Route::post('/check/current/password', 'check_current_password');
    });


    //============ all role and permission routes here===============//
    Route::controller(RoleController::class)->group(function () {
        //----------all permission routes----------//
        Route::get('/all-permission', 'all_permission')->name('all.permission')->middleware('permission:permission.menu');
        Route::post('/add-permission', 'add_permission')->name('add.permission')->middleware('permission:add.permission');
        Route::get('/edit-permission/{id}', 'edit_permission')->name('edit.permission')->middleware('permission:edit.permission');
        Route::post('/delete-permission', 'delete_permission')->name('delete.permission')->middleware('permission:delete.permission');
        Route::post('/update-permission/{id}', 'update_permission')->name('update.permission');

        //-----------all role routes-----------------//
        Route::get('/all-role', 'all_role')->name('all.role')->middleware('permission:role.menu');
        Route::post('/add-role', 'add_role')->name('add.role')->middleware('permission:add.role');
        Route::get('/edit-role/{id}', 'edit_role')->name('edit.role')->middleware('permission:edit.role');
        Route::post('/update-role/{id}', 'update_role')->name('update.role');
        Route::post('/delete-role', 'delete_role')->name('delete.role')->middleware('permission:delete.role');

        //---------all role in permission routes here----------//
        Route::get('/add-role-permission', 'role_permission')->name('role.permission');
        Route::post('/add-role-permission', 'add_role_permission')->name('add.role.permission')->middleware('permission:add.role_in_permission');
        Route::get('/all-role-permissions', 'all_role_permissions')->name('all.role.permission')->middleware('permission:all.role_in_permission');
        Route::get('/edit-role-permission/{id}', 'edit_role_permission')->name('edit.role.permission')->middleware('permission:edit.role_in_permission');
        Route::post('/update-role-permission/{id}', 'update_role_permission')->name('update.role.permission');
        Route::post('/delete-role-permission', 'delete_role_permission')->name('delete.role.permission')->middleware('permission:delete.role_in_permission');

        //========ajax for role permission========
        Route::post('/check-role-has-permission', 'check_role_has_permission')->name('check.role.has.permission');
    });

    //============ manage users all routes here==========//
    Route::controller(ManageUserController::class)->group(function () {
        Route::get('/all-users', 'all_users')->name('all.users')->middleware('permission:all.user_menu');
        Route::get('/add-user-form', 'add_user_form')->name('add.user.form')->middleware('permission:add.user');
        Route::post('/add-user', 'add_user')->name('add.user')->middleware('permission:add.user');
        Route::get('/edit-user/{id}', 'editUser')->name('edit.user')->middleware('permission:edit.user');
        Route::post('/update-user/{id}', 'update_user')->name('user.update');
        Route::post('/delete-user', 'delete_user')->name('delete.user')->middleware('permission:edit.user');
    });


    //============= manage logo all routes here==========//
    Route::controller(LogoController::class)->group(function () {
        Route::get('/logo-index', 'logo_index')->name('logo.index')->middleware('permission:logo.menu');
        Route::post('/add-logo', 'add_logo')->name('add.logo')->middleware('permission:add.logo');

        Route::get('/edit-logo', 'edit_logo')->name('logo.edit')->middleware('permission:edit.logo');
        Route::post('/update-logo', 'update_logo')->name('update.logo');
        Route::post('/delete-logo', 'delete_logo')->name('delete.logo')->middleware('permission:delete.logo');
    });


    //================ manage service all routes here==============//
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/service-index', 'service_index')->name('service.index')->middleware('permission:service.menu');
        Route::post('/add-service', 'add_service')->name('add.service')->middleware('permission:add.service');
        Route::get('/edit-service', 'edit_service')->name('edit.service')->middleware('permission:edit.service');
        Route::post('/update-service', 'update_service')->name('update.service');
        Route::post('/delete-service', 'delete_service')->name('delete.service')->middleware('permission:delete.service');
    });

    //================ manage project all routes here==============//
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/project-index', 'project_index')->name('project.index')->middleware('permission:project.menu');
        Route::post('/add-project', 'add_project')->name('add.project')->middleware('permission:add.project');
        Route::get('/edit-project', 'edit_project')->name('edit.project')->middleware('permission:edit.project');
        Route::post('/update-project', 'update_project')->name('update.project');
        Route::post('/delete-project', 'delete_project')->name('delete.project')->middleware('permission:delete.project');

        //ajax
        Route::get('/project/change/status', 'change_project_status')->name('change.project.s');
    });


    //================ manage team mumbers all routes here==============//
    Route::controller(TeamController::class)->group(function () {
        Route::get('/team-index', 'team_index')->name('team.index')->middleware('permission:team.menu');
        Route::post('/add-team', 'add_Team_mumber')->name('add.team')->middleware('permission:add.team');
        Route::get('/edit-team', 'edit_team_mumber')->name('edit.team')->middleware('permission:edit.team');
        Route::post('/update-team', 'update_team_mumber')->name('update.team');
        Route::post('/delete-team', 'delete_team_mumber')->name('delete.team')->middleware('permission:delete.team');

        //ajax
        Route::get('/change-team-status', 'change_team_status')->name('change.team.mumber.status');
    });



    //================ manage what client says all routes here==============//
   Route::controller(WhatClientSaysController::class)->group(function (){
    Route::get('/client-says-index','client_says_index')->name('client_says.index')->middleware('permission:clientsay.menu'); 
    Route::post('/add-client-say','add_client_say')->name('add.client_say')->middleware('permission:add.clientsay'); 
    Route::get('/edit-client-say','edit_client_say')->name('edit.client_say')->middleware('permission:edit.clientsay');
    Route::post('/update-client-say','update_client_say')->name('update.client_say');
    Route::post('/delete-client-say','delete_client_say')->name('delete.client_say')->middleware('permission:delete.clientsay');   
    //ajax
    Route::get('/change-client-say-status','change_clientsay_status')->name('change.client.say.status');
   });

   //============ manage slider all routes here============//
   Route::controller(SliderController::class)->group(function (){
    Route::get('/slider-index','slider_index')->name('slider.index')->middleware('permission:slider.menu'); 
    Route::post('/add-slider','add_slider')->name('add.slider')->middleware('permission:add.slider'); 
    Route::get('/edit-slider','edit_slider')->name('edit.slider')->middleware('permission:edit.slider');
    Route::post('/update-slider','update_slider')->name('update.slider');
    Route::post('/delete-slider','delete_slider')->name('delete.slider')->middleware('permission:delete.slider');   
    //ajax
    Route::get('/change-slider-status','change_slider_status')->name('change.slider.status');
   });




   //============project details all routes here==========//
   Route::controller(ProjectDetailsController::class)->group(function () {
        Route::get('/project-details-index','project_details_index')->name('project_details.index')->middleware('permission:project_d_section.menu');
        Route::post('/add-project-detail-section','add_project_detail_section')->name('add.project_detail_section')->middleware('permission:add.project_d_section');
        Route::get('/edit-project-detail-section/{id}','edit_project_detail_section')->name('edit.project_detail_section')->middleware('permission:edit.project_d_section');
        Route::post('/update-project-detail-section/{id}','update_project_detail_section')->name('upate.project_detail_section');
        Route::post('/delete-project-detail-section','delete_project_detail_section')->name('delete.project_detail_section')->middleware('permission:delete.project_d_section');
        //=ajx==//
        Route::get('/change-project-detail-section-status','change_project_detail_section_status')->name('change.project.detail.section.status');


        //=========project pricing routes here===========//
        Route::get('/project-pricing-index','project_pricing_index')->name('project_pricing.index')->middleware('permission:project_price.menu');

        Route::post('/add-project-pricing','add_project_pricing')->name('add.projet_pricing')->middleware('permission:add.project_price');
        Route::get('/edit-project-pricing/{id}','edit_project_pricing')->name('edit.product_pricing')->middleware('permission:edit.project_price');
        Route::post('/update-project-pricing/{id}','update_project_pricing')->name('update.project_pricing');
        Route::post('/delete-project-pricing','delete_project_pricing')->name('delete.project_pricing')->middleware('permission:delete.project_price');

        //========ajax==========//
        Route::get('/change-project-pricing-status','change_project_pricing_status')->name('change.project.pricing.status');
        Route::get('/change-is-populer','change_ispopuler')->name('change.project.pricing.is_populer');
   });








});

require __DIR__ . '/auth.php';
