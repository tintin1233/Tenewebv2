<?php

use App\Models\User;
use App\Models\BillPayment;
use App\Models\Conversation;
use App\Models\AnnouncementFeed;
use App\Models\ConversationMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\SmsController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\PreRegisterController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\SuperAdmin\RoomController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\Tenant\DocumentController;
use App\Http\Controllers\Admin\MasterListController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Tenant\BillPaymentController;
use App\Http\Controllers\SuperAdmin\TenementController;
use App\Http\Controllers\Admin\PaymentAccountController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\Admin\UnverifiedTenantController;
use App\Http\Controllers\Tenant\AnnouncementFeedController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Tenant\BillController as TenantBillController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Tenant\AnnouncementController as TenantAnnouncementController;
use App\Http\Controllers\Tenant\ConversationController as TenantConversationController;
use App\Http\Controllers\Admin\AnnouncementFeedController as AdminAnnouncementFeedController;
use App\Http\Controllers\SuperAdmin\AnnouncementController as SuperAdminAnnouncementController;
use App\Http\Controllers\SuperAdmin\BillController as SuperAdminBillController;
use App\Http\Controllers\SuperAdmin\BuildingController;
use App\Http\Controllers\SuperAdmin\MasterListController as SuperAdminMasterListController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\Tenant\ArchiveController as TenantArchiveController;
use App\Http\Controllers\Tenant\FamilyMemberController;
use App\Http\Controllers\Tenant\ProfileController as TenantProfileController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pre-register')->as('pre.register.')->group(function(){
    Route::get('', [PreRegisterController::class, 'create'])->name('create');
    Route::get('/tenement/{tenement}/rooms', [PreRegisterController::class, 'getRooms']);
    Route::post('', [PreRegisterController::class, 'store'])->name('store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::post('conversation/{conversation}/seen', function(string $id){
        $conversation = Conversation::find($id);


        $messages = $conversation->messages;


        collect($messages)->map(function($c_message) {
            $message = ConversationMessage::where('id', $c_message->id)
            ->where('receiver_id', Auth::user()->id);

            $message->update([
                'is_seen' => true
            ]);
        });


        return response([
            'message' => 'message seen',
        ], 200);
    });

    Route::get('tenement/{tenement}/tenant', function(Request $request, $id){
        $search = $request->search;

        $tenants = User::where(function($q) use($id, $search){
            $q->whereHas('tenant', function($q) use($id){
                $q->whereHas('room', function($q) use($id){
                    $q->where('tenement_id', $id);
                });
            })
            ->where(function($q) use($search){
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhereHas('profile', function($q) use($search){
                    $q->where('last_name', '%' . $search . '%')
                    ->orWhere('first_name', '%' . $search . '%');
                });
            });
        })->with(['profile'])->orderBy('name')->get();


        return response([
            'tenants' => $tenants,
            'total_result' => count($tenants)
        ]);
    });

    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');


        Route::prefix('rooms')->as('rooms.')->group(function(){
            Route::get('archives', [AdminRoomController::class, 'archives'])->name('archives');
        });

        Route::prefix('comments')->as('comments.')->group(function(){
            Route::get('', [AdminAnnouncementFeedController::class, 'index'])->name('index');
            Route::put('{comment}/approved', [AdminAnnouncementFeedController::class, 'approved'])->name('approved');
            Route::delete('{comment}/destroy', [AdminAnnouncementFeedController::class, 'destroy'])->name('destroy');
            Route::get('{comment}', [AdminAnnouncementFeedController::class, 'show'])->name('show');
            Route::get('{comment}/restore', [AdminAnnouncementFeedController::class, 'restore'])->name('restore');
            Route::delete('{comment}/delete', [AdminAnnouncementFeedController::class, 'delete'])->name('delete');
            Route::post('', [AdminAnnouncementFeedController::class, 'store'])->name('store');
        });


        Route::prefix('archives')->as('archives.')->group(function(){
            Route::get('', [ArchiveController::class, 'index'])->name('index');
            Route::prefix('announcements')->as('announcements.')->group(function(){
                Route::get('', [ArchiveController::class, 'announcementsIndex'])->name('index');
            });
            Route::prefix('comments')->as('comments.')->group(function(){
                Route::get('', [ArchiveController::class, 'commentsIndex'])->name('index');
            });
            Route::prefix('payment-accounts')->as('payment-accounts.')->group(function(){
                Route::get('', [ArchiveController::class, 'paymentAccountIndex'])->name('index');
            });
            Route::prefix('tenants')->as('tenants.')->group(function(){
                Route::get('', [ArchiveController::class, 'tenantIndex'])->name('index');
            });
            // Route::prefix('master-list')->as('master-list.')->group(function(){
            //     Route::get('', [ArchiveController::class, 'masterListIndex'])->name('index');
            // });
        });

        Route::prefix('sms')->as('sms.')->group(function(){
            Route::get('', [SmsController::class, 'create'])->name('create');
            Route::post('send', [SmsController::class, 'send'])->name('send');
        });

        Route::prefix('announcements')->as('announcements.')->group(function(){
            Route::get('{announcement}/restore', [AnnouncementController::class, 'restore'])->name('restore');
            Route::delete('{announcement}/delete', [AnnouncementController::class, 'delete'])->name('delete');
        });

        Route::prefix('payment-accounts')->as('payment-accounts.')->group(function(){
            Route::get('{payment_account}/restore', [PaymentAccountController::class, 'restore'])->name('restore');
            Route::delete('{payment_account}/delete', [PaymentAccountController::class, 'delete'])->name('delete');
        });

        // Route::prefix('master-list')->as('master-list.')->group(function(){
        //     Route::get('{master_list}/restore', [MasterListController::class, 'restore'])->name('restore');
        //     Route::delete('{master_list}/delete', [MasterListController::class, 'delete'])->name('delete');
        // });


        Route::prefix('bills')->as('bills.')->group(function(){
            Route::post('create-all', [BillController::class, 'createAll'])->name('createAll');
            Route::prefix('payments')->as('payments.')->group(function(){
                Route::get('', [PaymentController::class, 'index'])->name('index');
                Route::get('{payment}', [PaymentController::class, 'show'])->name('show');
                Route::put('{payment}/verified', [PaymentController::class, 'verified'])->name('verified');
                Route::delete('{payment}', [PaymentController::class, 'destroy'])->name('destroy');
                Route::put('{payment}/reject', [PaymentController::class, 'reject'])->name('reject');
            });
        });

        Route::prefix('conversations')->as('conversations.')->group(function(){
            Route::get('', [ConversationController::class, 'index'])->name('index');
            Route::post('{conversation}/add-message', [ConversationController::class, 'addMessage'])->name('addMessage');
        });


        Route::prefix('tenants')->as('tenants.')->group(function(){
            Route::post('{tenant}/move-out', [AdminTenantController::class, 'moveOut'])->name('move_out');
        });


        Route::prefix('master-list')->as('master-list.')->group(function() {
            Route::post('generate-account', [MasterListController::class, 'generateAccount'])->name('generate-account');
        });

        Route::resource('tenants', AdminTenantController::class);
        Route::resource('rooms', AdminRoomController::class);
        Route::resource('unverified-tenant', UnverifiedTenantController::class)->except(['create']);
        Route::resource('bills', BillController::class);
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('payment-accounts', PaymentAccountController::class);
        Route::resource('master-list', MasterListController::class)->only(['index', 'show']);
    });

    Route::middleware(['role:super-admin'])->prefix('super-admin')->as('super-admin.')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::prefix('users')->as('users.')->group(function(){
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::resource('admins', AdminController::class);
            Route::resource('tenants', TenantController::class);
        });

        Route::prefix('master-list')->as('master-list.')->group(function(){
            Route::get('{master_list}/restore', [SuperAdminMasterListController::class, 'restore'])->name('restore');
            Route::delete('{master_list}/delete', [SuperAdminMasterListController::class, 'delete'])->name('delete');
        });


        Route::prefix('buildings')->as('buildings.')->group(function(){
            Route::get('{building}',[BuildingController::class, 'show'])->name('show');
            Route::prefix('room')->as('room.')->group(function(){
                Route::get('{room}', [BuildingController::class, 'room'])->name('room');
            });
        });


        Route::prefix('report')->as('report.')->group(function(){
            Route::get('', [ReportController::class, 'index'])->name('index');
        });

        Route::resource('rooms', RoomController::class);
        Route::resource('tenements', TenementController::class);
        Route::resource('master-list', SuperAdminMasterListController::class);
        Route::resource('announcements', SuperAdminAnnouncementController::class);
        Route::resource('bills', SuperAdminBillController::class)->only(['index', 'show']);
    });

    Route::middleware(['role:tenant'])->prefix('tenant')->as('tenant.')->group(function(){
        Route::get('/dashboard', [TenantDashboardController::class, 'dashboard'])->name('dashboard');


        Route::prefix('bills')->as('bills.')->group(function(){
            Route::get('', [TenantBillController::class, 'index'])->name('index');
            Route::get('{bill}', [TenantBillController::class, 'show'])->name('show');
        });

        Route::prefix('bill-payment')->as('bill-payment.')->group(function(){
            Route::get('{paymentAccount}', [BillPaymentController::class, 'pay'])->name('pay');
            Route::post('', [BillPaymentController::class, 'store'])->name('store');
        });

        Route::prefix('documents')->as('documents.')->group(function(){
            Route::get('', [DocumentController::class, 'index'])->name('index');
            Route::get('/agreement', [DocumentController::class, 'agreement'])->name('agreement');
            Route::get('/penalty', [DocumentController::class, 'penalty'])->name('penalty');
            Route::get('/requirement', [DocumentController::class, 'requirement'])->name('requirement');
        });


        Route::prefix('announcements')->as('announcements.')->group(function(){
            Route::get('', [TenantAnnouncementController::class, 'index'])->name('index');
            Route::get('{announcement}', [TenantAnnouncementController::class, 'show'])->name('show');
        });


        Route::prefix('conversations')->as('conversations.')->group(function(){
            Route::get('', [TenantConversationController::class, 'index'])->name('index');
            Route::post('{conversation}/add-message', [TenantConversationController::class, 'addMessage'])->name('addMessage');
            Route::post('admin/{id}/create', [TenantConversationController::class, 'createAdminConversation']);
        });

        Route::prefix('profile')->as('profile.')->group(function(){
            Route::get('', [TenantProfileController::class, 'show'])->name('show');
        });
        Route::prefix('archives')->as('archives.')->group(function(){
            Route::get('', [TenantArchiveController::class, 'index'])->name('index');
        });
        Route::resource('announcement-feeds', AnnouncementFeedController::class);
        Route::resource('family-members', FamilyMemberController::class);
    });

});




require __DIR__.'/auth.php';
