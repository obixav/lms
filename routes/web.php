<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', [EmployeeController::class, 'dashboard'])->name('home');
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::get('/employees', [EmployeeController::class, 'listEmployees'])->name('employees');
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'listEmployees'])->name('employees.edit');
    Route::get('/employees/create', [EmployeeController::class, 'createEmployee'])->name('employees.create');
    Route::post('employees',[EmployeeController::class,'saveEmployee'])->name('employees.store');
    Route::get('/employees/details/{id}', [EmployeeController::class, 'viewEmployee'])->name('employees.details');
    Route::get('/employees/details/{id}', [EmployeeController::class, 'viewEmployee'])->name('employees.details');
    Route::get('/leave_requests/create', [LeaveController::class, 'createLeaveRequest'])->name('leave_requests.create');
    Route::get('/my_leave_requests', [LeaveController::class, 'myRequests'])->name('leave_requests.employee');
    Route::get('/employees_search', [EmployeeController::class, 'employeeSearch'])->name('employees.search');

    Route::get('/leave_requests/get_leave_requested_days', [LeaveController::class, 'leaveDaysRequested'])->name('leave_requests.requested');
    Route::get('/leave_requests/get_leave_balance', [LeaveController::class, 'leaveBalance'])->name('leave_requests.balance');
    Route::post('/leave_requests', [LeaveController::class, 'saveRequest'])->name('leave_requests.store');
    Route::get('/leave_requests_calendar', [LeaveController::class, 'leaveRequestCalendar'])->name('leave_requests.calendar');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'saveSettings'])->name('settings.save');
    Route::get('/workflows', [AdminController::class, 'workflows'])->name('workflows');
    Route::post('/workflows', [AdminController::class, 'saveWorkflows'])->name('workflows.save');
    Route::get('/grades', [AdminController::class, 'grades'])->name('grades');
    Route::post('/grades', [AdminController::class, 'saveGrades'])->name('grades.save');
    Route::post('/grade_leave_types', [AdminController::class, 'saveGradeLeaveTypes'])->name('grades_leave_types.save');
    Route::get('/holidays', [AdminController::class, 'holidays'])->name('holidays');
    Route::post('/holidays', [AdminController::class, 'saveHolidays'])->name('holidays.save');
    Route::get('/leave_settings', [AdminController::class, 'leaveSettings'])->name('leave_settings');
    Route::post('/leave_settings', [AdminController::class, 'saveLeaveSettings'])->name('leave_settings.save');
    Route::get('/leave_types', [AdminController::class, 'leaveTypes'])->name('leave_types');
    Route::post('/leave_types', [AdminController::class, 'saveLeaveTypes'])->name('leave_types.save');
    Route::get('/leave_details', [LeaveController::class, 'leaveDetails'])->name('leave_requests.details');
    Route::get('/leave_approvals', [LeaveController::class, 'getApprovals'])->name('leave_requests.approvals');
    Route::get('/leave_cancellation_approvals', [LeaveController::class, 'getLeaveCancellationApprovals'])->name('leave_requests.cancellation_approvals');
    Route::post('/leave_approvals', [LeaveController::class, 'approveRequest'])->name('leave_requests.save_approval');
    Route::post('/leave_cancellation_approvals', [LeaveController::class, 'approveCancellationRequest'])->name('leave_requests.save_cancellation_approval');
    Route::get('/leave_advice', [LeaveController::class, 'leaveAdvice'])->name('leave_advice');
    Route::post('/cancel_leave_request', [LeaveController::class, 'cancelLeaveRequest'])->name('leave_requests.cancel');
    Route::get('/leave_report', [LeaveController::class, 'Report'])->name('leave_requests.report');
});
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

//payment


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
