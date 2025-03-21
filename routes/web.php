<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerSensor;
use App\Http\Controllers\ControllerSemaforo1;
use App\Http\Controllers\ControllerSemaforo2;
use App\Http\Controllers\ControllerEstudiantes;
use App\Http\Controllers\ControladorJs;

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

Route::get('/pagina2', function () {
    return view('user.pagina2');
})->middleware('auth')->name('user.pagina2');


//Prueba de Hola mundo
use App\Http\Controllers\Prueba\HolaMundoController;

Route::get('/hola-mundo', [HolaMundoController::class, 'index']);

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsersImportController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
// CRUD de usuarios
Route::resource('users', UsersController::class)->names('admin.users');
// Importar usuarios desde Excel
Route::get('/importar-usuarios', [UsersImportController::class, 'show'])->name('admin.importar-usuarios.show');
Route::post('/importar-usuarios', [UsersImportController::class, 'import'])->name('admin.importar-usuarios');
});


//Rutas de usuarios
use App\Http\Controllers\User\UserController;

Route::prefix('user')->group(function () {
    Route::get('/register', [UserController::class, 'registerForm'])->name('user.register');
    Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');
    Route::get('/login', [UserController::class, 'loginForm'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
});

///RUTAS API
Route::get('/sensor/registro_sensor', [ControllerSensor::class, 'getSensor'])->name('sensor.registro_sensor');
Route::name('sensor.detalle_sensor')->get('/sensor.detalle_sensor/{Id_sensor}', [ControllerSensor::class,'getSensor1'] );
Route::get('/sensor/sensor_login', [ControllerSensor::class, 'create'])->name('sensor.sensor_login');
Route::post('/sensor_store', [ControllerSensor::class, 'store'])->name('sensor_store'); 
Route::name('deleteSensor')->get('/deleteSensor/{Id_sensor}', [ControllerSensor::class,'deleteSensor'] );
Route::get('/sensor/editar_sensor/{Id_sensor}', [ControllerSensor::class, 'edit'])->name('sensor.editar_sensor');
Route::put('/sensor/{Id_sensor}', [ControllerSensor::class, 'update'])->name('sensor_update');

///RUTAS SEMAFORO ESTUDIANTES
Route::get('/estudiantes/registro_estudiantes', [ControllerEstudiantes::class, 'getEstu'])->name('estudiantes.registro_estudiantes');
Route::name('estudiantes.detalle_estudiantes')->get('/estudiantes.detalle_estudiantes/{Id_semaforo_estu}', [ControllerEstudiantes::class,'getEstu1'] );
Route::get('/estudiantes/estudiantes_login', [ControllerEstudiantes::class, 'create'])->name('estudiantes.estudiantes_login');
Route::post('/estudiantes_store', [ControllerEstudiantes::class, 'store'])->name('estudiantes_store'); 
Route::name('deleteEstu')->get('/deleteEstu/{Id_semaforo_estu}', [ControllerEstudiantes::class,'deleteEstu'] );
Route::get('/estudiantes/editar_estudiantes/{Id_semaforo_estu}', [ControllerEstudiantes::class, 'edit'])->name('estudiantes.editar_estudiantes');
Route::put('/estudiantes/{Id_semaforo_estu}', [ControllerEstudiantes::class, 'update'])->name('estudiantes_update');

///RUTAS SEMAFORO VEHICULOS 1
Route::get('/semaforo1/registro_semaforo1', [ControllerSemaforo1::class, 'getSema'])->name('semaforo1.registro_semaforo1');
Route::name('semaforo1.detalle_semaforo1')->get('/semaforo1.detalle_semaforo1/{Id_semaforo1}', [ControllerSemaforo1::class,'getSema1'] );
Route::get('/seamforo1/semaforo1_login', [ControllerSemaforo1::class, 'create'])->name('semaforo1.semaforo1_login');
Route::post('/semaforo1_store', [ControllerSemaforo1::class, 'store'])->name('semaforo1_store'); 
Route::name('deleteSema')->get('/deleteSema/{Id_semaforo1}', [ControllerSemaforo1::class,'deleteSema'] );
Route::get('/semaforo1/editar_semaforo1/{Id_semaforo1}', [ControllerSemaforo1::class, 'edit'])->name('semaforo1.editar_semaforo1');
Route::put('/semaforo1/{Id_semaforo1}', [ControllerSemaforo1::class, 'update'])->name('semaforo1_update');


///RUTAS SEMAFORO VEHICULOS 2
Route::get('/semaforo2/registro_semaforo2', [ControllerSemaforo2::class, 'getSema2'])->name('semaforo2.registro_semaforo2');
Route::name('semaforo2.detalle_semaforo2')->get('/semaforo2.detalle_semaforo2/{Id_semaforo2}', [ControllerSemaforo2::class,'getSema3'] );
Route::get('/seamforo2/semaforo2_login', [ControllerSemaforo2::class, 'create'])->name('semaforo2.semaforo2_login');
Route::post('/semaforo2_store', [ControllerSemaforo2::class, 'store'])->name('semaforo2_store'); 
Route::name('deleteSema2')->get('/deleteSema/{Id_semaforo2}', [ControllerSemaforo2::class,'deleteSema2'] );
Route::get('/semaforo2/editar_semaforo2/{Id_semaforo2}', [ControllerSemaforo2::class, 'edit'])->name('semaforo2.editar_semaforo2');
Route::put('/semaforo2/{Id_semaforo2}', [ControllerSemaforo2::class, 'update'])->name('semaforo2_update');



