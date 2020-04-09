<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', User::paginate(10));
    }

    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $teacherTest = $user->hasRole('teacher');
        $studentTest = $user->hasRole('student');
        
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        
        if($user->hasRole('teacher') && $teacherTest==false){
            DB::table('teachers')->insert(['user_id' => $user->id]);
        }
        else if($user->hasRole('teacher')==false && $teacherTest==true){
            DB::table('teachers')->where('user_id', $user->id)->delete();
        }

        if($user->hasRole('student') && $studentTest==false){
            DB::table('students')->insert(['user_id' => $user->id, 'class_id' => 1]);
        }
        else if($user->hasRole('student')==false && $studentTest==true){
            DB::table('students')->where('user_id', $user->id)->delete();
        }

        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the user');
        }

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect()->route('admin.users.index');
        }

        if($user->hasRole('teacher')){
            DB::table('teachers')->where('user_id', $user->id)->delete();
        }

        if($user->hasRole('student')){
            DB::table('students')->where('user_id', $user->id)->delete();
        }

        $user->roles()->detach();
        
        if($user->delete()){
            session()->flash('success', $user->name . ' has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the user');
        }

        return redirect()->route('admin.users.index');
    }
}
