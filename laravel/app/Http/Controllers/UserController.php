<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,mechanic,client',
        ]);

        User::create([

            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'address' => $request->address,
            'status' => $request->status ?? 1,
            'registrationDate' => now(),

        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->updateDate = now(); 

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
    }

    /**
     * Registrar nuevo cliente desde formulario público
     */
    public function registerClient(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ], [
            'firstName.required' => 'El nombre es obligatorio',
            'lastName.required' => 'El apellido es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        try {
            User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'client', // Siempre se crea como cliente
                'address' => $request->address,
                'status' => 1, // Activo por defecto
                'registrationDate' => now(),
            ]);

            // Opcional: Iniciar sesión automáticamente después del registro
            // Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            return redirect()->route('login')
                ->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el usuario: ' . $e->getMessage())
                ->withInput();
        }
    }
    public function clients()
    {
        $users = User::where('role','=','client')->get();
        return view('clients.index', compact('users'));
    }

    public function mechanics()
    {
        $users = User::where('role','=','mechanic')->get();
        return view('mechanic.index', compact('users'));
    }

}
