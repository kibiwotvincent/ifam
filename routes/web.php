<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Account\FarmController;
use App\Http\Controllers\Account\Admin\FarmController as AdminFarmController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Account\Admin\UserController as AdminUserController;
use App\Http\Controllers\Account\Admin\PermissionController;
use App\Http\Controllers\Account\Admin\RoleController;
use App\Http\Controllers\Account\Admin\FarmCategoryController;
use App\Http\Controllers\Account\Admin\ChildCategoryController;
use App\Http\Controllers\Account\Admin\ChildSubCategoryController;
use App\Http\Controllers\Account\SeasonController;
use App\Http\Controllers\Account\ExpenseController;
use App\Http\Controllers\Account\SaleController;
use App\Http\Controllers\Account\GroupController;
use App\Http\Controllers\Account\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Account\GroupMemberController;
use App\Http\Controllers\Account\GroupMergedSeasonController;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('index');

Route::get('/login', function () {
    return redirect()->route('index');
})->middleware('guest')->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');
				
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('forgot_password');

Route::get('/terms-and-conditions', function () {
    return view('guest.login');
})->name('terms_and_conditions');

Route::get('/dashboard', function () {
    return view('account.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/calendar', function () {
    return view('account.admin.forms');
})->middleware('auth')->name('calendar');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

//individual farms routes
Route::get('/farms', [FarmController::class, 'index'])->middleware('auth')->name('farms');
Route::get('/farms/add', [FarmController::class, 'create'])->middleware('auth')->name('add_farm');
Route::post('/farms/add', [FarmController::class, 'store'])->middleware('auth');
Route::get('/farms/{farm_id}', [FarmController::class, 'view'])->middleware('auth')->name('view_farm');
Route::get('/farms/{farm_id}/report', [FarmController::class, 'report'])->middleware('auth')->name('farm.report');
Route::post('/farms/{farm_id}/report', [FarmController::class, 'farm_report'])->middleware('auth');
Route::get('/farms/{farm_id}/{department_id}', [FarmController::class, 'view_department'])->middleware('auth')->name('view_department');
Route::get('/farms/{farm_id}/{department_id}/seasons/add', [SeasonController::class, 'create'])->middleware('auth')->name('add_season');
Route::post('/farms/{farm_id}/{department_id}/seasons/add', [SeasonController::class, 'store'])->middleware('auth');
Route::get('/farms/{farm_id}/{department_id}/seasons/{season_id}', [SeasonController::class, 'view'])->middleware('auth')->name('view_season');
Route::get('/farms/{farm_id}/{department_id}/seasons/{season_id}/update', [SeasonController::class, 'edit'])->middleware('auth')->name('update_season');
Route::post('/farms/{farm_id}/{department_id}/seasons/{season_id}/update', [SeasonController::class, 'update'])->middleware('auth');
Route::get('/farms/{farm_id}/{department_id}/seasons/{season_id}/expenses/add', [ExpenseController::class, 'create'])->middleware('auth')->name('add_expense');
Route::post('/farms/{farm_id}/{department_id}/seasons/{season_id}/expenses/add', [ExpenseController::class, 'store'])->middleware('auth');
Route::get('/farms/{farm_id}/{department_id}/seasons/{season_id}/sales/add', [SaleController::class, 'create'])->middleware('auth')->name('add_sale');
Route::post('/farms/{farm_id}/{department_id}/seasons/{season_id}/sales/add', [SaleController::class, 'store'])->middleware('auth');

Route::get('/groups', [GroupController::class, 'index'])->middleware('auth')->name('groups');
Route::get('/groups/create', [GroupController::class, 'create'])->middleware('auth')->name('create_group');
Route::post('/groups/create', [GroupController::class, 'store'])->middleware('auth');
Route::get('/groups/{id}', [GroupController::class, 'view'])->middleware('auth')->name('view_group');
Route::get('/groups/{id}/profile', [GroupController::class, 'profile'])->middleware('auth')->name('group_profile');
Route::get('/groups/{id}/report', [GroupController::class, 'report'])->middleware('auth')->name('group.report');
Route::post('/groups/{id}/report', [GroupController::class, 'group_report'])->middleware('auth');
Route::get('/groups/{id}/report/group', [GroupController::class, 'group_only_report'])->middleware('auth')->name('group_only_report');
Route::post('/groups/{id}/report/group', [GroupController::class, 'fetch_group_only_report'])->middleware('auth')->name('fetch_group_only_report');
Route::post('/groups/{id}/members/add', [GroupMemberController::class, 'store'])->middleware('auth')->name('add_group_member');
Route::post('/groups/{id}/members/remove', [GroupMemberController::class, 'remove'])->middleware('auth')->name('remove_group_member');
Route::post('/groups/{id}/members/approve', [GroupMemberController::class, 'approve'])->middleware('auth')->name('approve_group_member');
Route::post('/groups/{id}/members/reject', [GroupMemberController::class, 'reject'])->middleware('auth')->name('reject_group_member');
Route::post('/groups/{id}/members/join', [GroupMemberController::class, 'join'])->middleware('auth')->name('join_group');
Route::post('/groups/{id}/members/leave', [GroupMemberController::class, 'leave'])->middleware('auth')->name('leave_group');
Route::post('/groups/{id}/members/cancel', [GroupMemberController::class, 'cancel'])->middleware('auth')->name('cancel_join_request');
Route::post('/groups/{id}/members/update', [GroupMemberController::class, 'update'])->middleware('auth')->name('update_group_member');
Route::get('/groups/{group_id}/members/{member_id}', [GroupMemberController::class, 'view'])->middleware('auth')->name('view_group_member');
Route::get('/groups/{group_id}/members/{member_id}/report', [GroupMemberController::class, 'report'])->middleware('auth')->name('group_member_report');
Route::post('/groups/{group_id}/members/{member_id}/report', [GroupMemberController::class, 'fetch_report'])->middleware('auth')->name('fetch_group_member_report');
Route::get('/groups/{group_id}/members/{member_id}/seasons/{season_id}', [GroupMergedSeasonController::class, 'view'])->middleware('auth')->name('group.view_merged_season');
Route::post('/groups/{group_id}/members/{member_id}/seasons/{season_id}/unmerge', [GroupMergedSeasonController::class, 'unmerge'])->middleware('auth')->name('group.unmerge_season');

//group farms routes
Route::get('/groups/{group_id}/farms/add', [FarmController::class, 'create'])->middleware('auth')->name('group.add_farm');
Route::get('/groups/{group_id}/farms/{farm_id}', [FarmController::class, 'view'])->middleware('auth')->name('group.view_farm');

Route::get('/groups/{group_id}/farms/{farm_id}/report', [FarmController::class, 'report'])->middleware('auth')->name('group.farm_report');

Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}', [FarmController::class, 'view_department'])->middleware('auth')->name('group.view_department');
Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}/seasons/add', [SeasonController::class, 'create'])->middleware('auth')->name('group.add_season');
Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}/seasons/{season_id}', [SeasonController::class, 'view'])->middleware('auth')->name('group.view_season');
Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}/seasons/{season_id}/update', [SeasonController::class, 'edit'])->middleware('auth')->name('group.update_season');
Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}/seasons/{season_id}/expenses/add', [ExpenseController::class, 'create'])->middleware('auth')->name('group.add_expense');
Route::get('/groups/{group_id}/farms/{farm_id}/{department_id}/seasons/{season_id}/sales/add', [SaleController::class, 'create'])->middleware('auth')->name('group.add_sale');

//profile
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profile', [UserController::class, 'update'])->middleware('auth');
Route::post('/profile/change-password', [UserController::class, 'changePassword'])->middleware('auth')->name('profile.change_password');
Route::post('/profile/change-profile-photo', [UserController::class, 'changeProfilePhoto'])->middleware('auth')->name('profile.change_profile_photo');

Route::get('/information-center', function () {
    return view('account.information-center');
})->middleware('auth')->name('information_center');

Route::get('/settings', function () {
    return view('account.settings');
})->middleware('auth')->name('settings');

Route::get('/contact-support', function () {
    return view('account.contact-support');
})->middleware('auth')->name('contact_support');

/*admin route*/
//groups
Route::get('/admin/groups', [AdminGroupController::class, 'index'])->middleware('auth')->name('admin.groups');
Route::get('/admin/groups/report', [AdminGroupController::class, 'groups_report'])->middleware('auth')->name('admin.groups_report');
Route::post('/admin/groups/report', [AdminGroupController::class, 'fetch_groups_report'])->middleware('auth');
Route::get('/admin/groups/{group_id}', [AdminGroupController::class, 'view'])->middleware('auth')->name('admin.group');
Route::get('/admin/groups/{group_id}/report', [AdminGroupController::class, 'group_report'])->middleware('auth')->name('admin.group_report');
Route::get('/admin/groups/{group_id}/report/group', [AdminGroupController::class, 'group_only_report'])->middleware('auth')->name('admin.group_only_report');
Route::get('/admin/groups/{group_id}/members/{member_id}/report', [AdminGroupController::class, 'group_member_report'])->middleware('auth')->name('admin.group_member_report');
Route::get('/admin/groups/{group_id}/farms/{farm_id}/report', [AdminFarmController::class, 'report'])->middleware('auth')->name('admin.farm_report');

//farm categories
Route::get('/admin/farm-categories', [FarmCategoryController::class, 'index'])->middleware('auth')->name('admin.farm_categories');
Route::get('/admin/farm-categories/add', [FarmCategoryController::class, 'create'])->middleware('auth')->name('admin.add_farm_category');
Route::post('/admin/farm-categories/add', [FarmCategoryController::class, 'store'])->middleware('auth');

Route::get('/admin/farm-categories/{id}', [FarmCategoryController::class, 'view'])->middleware('auth')->name('admin.view_farm_category');
Route::get('/admin/farm-categories/{id}/add', [ChildCategoryController::class, 'create'])->middleware('auth')->name('admin.add_child_category');
Route::post('/admin/farm-categories/{id}/add', [ChildCategoryController::class, 'store'])->middleware('auth');
Route::get('/admin/farm-categories/{id}/{child_category_id}', [ChildCategoryController::class, 'view'])->middleware('auth')->name('admin.view_child_category');

Route::get('/admin/farm-categories/{id}/{child_category_id}/add', [ChildSubCategoryController::class, 'create'])->middleware('auth')->name('admin.add_child_sub_category');
Route::post('/admin/farm-categories/{id}/{child_category_id}/add', [ChildSubCategoryController::class, 'store'])->middleware('auth');

//roles
Route::get('/admin/roles-and-permissions', [RoleController::class, 'index'])->middleware('auth')->name('admin.roles');
Route::post('/admin/permissions/create', [PermissionController::class, 'store'])->middleware('auth')->name('admin.permissions.store');
Route::post('/admin/permissions/{id}/delete', [PermissionController::class, 'delete'])->middleware('auth')->name('admin.permissions.delete');
Route::post('/admin/roles/create', [RoleController::class, 'store'])->middleware('auth')->name('admin.roles.store');
Route::get('/admin/roles/{id}', [RoleController::class, 'view'])->middleware('auth')->name('admin.roles.view');
Route::post('/admin/roles/{id}/update', [RoleController::class, 'update'])->middleware('auth')->name('admin.roles.update');
Route::post('/admin/roles/{id}/delete', [RoleController::class, 'delete'])->middleware('auth')->name('admin.roles.delete');

//users
Route::get('/admin/users', [AdminUserController::class, 'index'])->middleware('auth')->name('admin.users');
Route::post('/admin/users/{id}/update/role', [AdminUserController::class, 'updateRole'])->middleware('auth')->name('admin.users.update.role');
