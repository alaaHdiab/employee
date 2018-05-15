<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // // $request->user()->id;

        // User::create($request->all());

        // $user = new User();
        // $user->name = $request->name;

        // $users = User::get();

        // // return view('users.index', compact('users'));
        // return response()->json(['data' => $users]);
        $emps=Employee::All();
        return view('admins.index',compact('emps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user=new User();
        $user->username=$request->firstname.$request->lastname;
        $user->password=$request->firstname.$request->lastname;
        $user->isAdmin=0;
        $user->save();
        $emp=new Employee();
        $emp->first_name=$request->firstname;
        $emp->last_name=$request->lastname;
        $emp->status='not_active';
        $emp->user_id=$user->id;
        $emp->job=$request->job;
        //$emp->location
        $emp->save();

         return back();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = Employee::find($id);
        return view('admins.edit',compact('employee'));
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emp = Employee::find($id);
        // dd($emp);
        $emp->first_name=$request->firstname;
        $emp->last_name=$request->lastname;
       
        $emp->job=$request->job;
       
        $emp->save();
        $user=User::find($emp->user_id);
        // dd($user);
        $user->username=$request->firstname.$request->lastname;
        $user->password=$request->firstname.$request->lastname;
        $user->save();
        
        
        return redirect()->route('admins.index');

    }

    public function showDetails($id){


     $emp=Employee::find($id);
     return response()->json(['data' => $emp]);

    }
    public function searchByName(Request $request){
        $name=$request->searchName;
        $emps = Employee::where('first_name', 'LIKE', "%$name%")
                        ->orWhere('last_name', 'LIKE', "%$name%")
                        ->get();
        //dd($emp);
        return view('admins.search',compact('emps'));

    }
    public function searchApi($name){

        $emps = Employee::where('first_name', 'LIKE', "%$name%")
                        ->orWhere('last_name', 'LIKE', "%$name%")
                        ->get();
        //dd($emp);
        //return view('admins.search',compact('emps'));
        return response()->json(['data' => $emps]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
     $employee = Employee::find($id);
     $employee->delete();
     //return Redirect::route('admins.index');
     return back();
    }
}
