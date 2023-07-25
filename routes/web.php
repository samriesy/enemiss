<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\User;


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


    /**
     * SQL Queries
     * 
     * @link https://laravel.com/docs/10.x/queries#ordering
     * 
     */

    // Select all users ---------------------------------------------------
    // $all_users = DB::select("select * from users");
    
    // or
    // $users = DB::table('users')->get();
    
    // or
    // $user = User::all();
    
    // Log::info($all_users);


    // select specific user ---------------------------------------------------
    
    // $single_user = DB::select('select * from users where email=?', [
    //     'samuel-riesterer@outlook.de',
    // ]);

    // or
    // $users = DB::table('users')->where('id', 1)->get();

    // Log::info($single_user);
    // Log::info($single_user[0]->name);


    // create new User ---------------------------------------------------
    // $new_user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
    //     'Dave',
    //     'samuel-riesterer@outlook.com', 
    //     'password',
    // ]);

    // or
    // $user = DB::table('users')->insert([
    //     'name'  => 'David',
    //     'email' => 'samuel-riesterer@outlook.com',
    //     'password' => 'password',
    // ]);

    // or
    // $user = User::create([
    //     'name'  => 'Samuel',
    //     'email' => 'samuel-iesterer@outlook.de',
    //     'password'  => 'password',
    // ]);


    // update user ---------------------------------------------------
    // $update_user = DB::update('update users set name=? where name=?', [
    //     'Hallo',
    //     'Dave',
    // ]);

    // or
    // $user = DB::table('users')->where('id', 1)->update(['email' => 'samuel-riesterer@outlook.de']);
    
    // or>
    // $user = User::where('id', 2)->get();    // or = User::find(6);
    // $user->update([
    //     'email' => 'samuel-riesterer@outlook.de',
    // ]);
    
    // delete user ---------------------------------------------------
    // $delete_user = DB::delete('delete from users where name=?', [
    //     'Hallo',
    // ]);

    // or
    // $user = DB::table('users')->where('id', 1)->delete();

    // or
    // $user = User::find(2);
    // $user->delete();




    // Query Builder -------------------------------------------------

    // First User
    // $user = DB::table('users')->first();
    // $user = DB::table('users')->where('id', 1)->first();

    // Specific value (email in this example)
    // $user = DB::table('users')->where('name', 'Samuel Riesterer')->value('email');

    // Pluck: get a collection of user titles
    // $user = DB::table('users')->where('name', 'Sam')->pluck('title');

    // Chunk: Handle big DB contents as chunks so it loads faster 
    // $user = DB::table('users')->orderby('id')->chunk(100, function (Collection $users) {
    //     foreach ($users as $user) {
            
    //     }
    // });

    // 'All together'
    // $user = DB::table('users')->where('name', 'Sam')->chunkById(100, function(Collection $users) {
    //     foreach($users as $user) {
    //         DB::table('users')->where('id', $user->id)->update(['active' => true]);
    //     }
    // });


    // Other syntax with same functionality
    // $users = User::where('id', 1)->first();


    //
    // Dump and die ---------------------------------------------------
    // dd($all_users);







    /* Console Commands/Prompts

    # php artisan make:migration update_users_table_added_avatar_field --table=users
    

    # php artisan model:show user       Shows all related fields to the user eloquent model
    
    # php artisan config:cache          Creates a config.php file in /bootstrap/cache/ so all config settings can be cached instead of beeing loaded all the time.
    # php artisan config:clear          Has to be called everytime the .env file is updated.




    */

    return view('welcome');
});


Route::get('/tests', function() {

    // $user1 = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
    //     'User1', 
    //     'user1@web.de',
    //     'password1',
    // ]);

    // $user2 = DB::table('users')->insert([
    //     'name'  => 'User2',
    //     'email' => 'user2@web.de',
    //     'password'  => 'password2',
    // ]);

    // $user3 = User::create([
    //     'name'  => 'User3',
    //     'email' => 'user3@web.de',
    //     'password'  => 'password3',
    // ]);

    // User::__set('primaryKey', 'name'); 

    $users = User::all();

    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
