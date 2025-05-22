<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    private array $protectedEmails = ['admin.atk@injourneyairports.id'];

    public function index()
    {
        $users = User::with('unit')->paginate(10);
        $masterUnit = MasterUnit::orderBy('nama_unit')->get();
        $protectedEmails = ['admin.atk@injourneyairports.id'];

        return view('kelola_user.index', compact('users', 'masterUnit', 'protectedEmails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,staff',
            'id_unit' => 'required|exists:master_unit,id_unit',
        ], [
            'email.unique' => 'Email sudah digunakan, harap gunakan email yang lain.',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'id_unit' => $request->id_unit,
        ]);

        return redirect()->route('kelola-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user  = User::findOrFail($id);
        if (in_array($user->email, $this->protectedEmails)) {
            return abort(403, 'User ini tidak boleh diubah atau dihapus.');
        }
        $masterUnit = MasterUnit::orderBy('nama_unit')->get();
        return view('kelola_user.edit', compact('user', 'masterUnit'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (in_array($user->email, $this->protectedEmails)) {
            return abort(403, 'User ini tidak boleh diubah atau dihapus.');
        }
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'email'     => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user'),
            ],
            'password'  => 'nullable|string|min:8|confirmed',
            'role'      => ['required', Rule::in(['admin', 'staff'])],
            'id_unit'   => 'required|exists:master_unit,id_unit',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('kelola-user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (in_array($user->email, $this->protectedEmails)) {
            return abort(403, 'User ini tidak boleh diubah atau dihapus.');
        }
        $user->delete();

        return redirect()->route('kelola-user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
