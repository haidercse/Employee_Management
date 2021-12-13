<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('pages.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'   => 'required|max:255',
            'email'  => 'required|max:255|email',
            'phone'  => 'required|max:15',
            'status' => 'required',
            'image'  => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->status = $request->status;

        //insert image
        if($request->has('image')){
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/employee');
            $image->move($dest,$reImage);

            // save in database
            $employee->image = $reImage;
        }
        $employee->save();

       return redirect()->route('employee.index')->with('success','Employee has been added successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $employee = Employee::find($id);
        if(!is_null($employee)){
            return view('pages.employee.edit',compact('employee'));
        }else{
            return back()->with('error','There is no data in this employee id');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'nullable|max:255',
            'email'  => 'nullable|max:255|email',
            'phone'  => 'nullable|max:15',
            'status' => 'nullable',
            'image'  => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $employee =  Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->status = $request->status;

        //insert image
        if($request->has('image')){
            if(File::exists('images/employee/'.$employee->image)){
                File::delete('images/employee/'.$employee->image);
            }
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/employee');
            $image->move($dest,$reImage);

            // save in database
            $employee->image = $reImage;
        }
        $employee->save();

       return redirect()->route('employee.index')->with('success','Employee has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if(!is_null($employee)){
            if(File::exists('images/employee/'.$employee->image)){
                File::delete('images/employee/'.$employee->image);
            }
            $employee->delete();
        }
        return back()->with('success','Employee deleted successfully!!');
    }
}
