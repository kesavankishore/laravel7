<?php

namespace App\Http\Controllers;

use PDF;
use Storage;
use Mail;
use App\Employee;
use App\EmployeeDocument;
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
        
        $employees = Employee::all();
        //dd($employee);
       if ($request->is('api/*')) {
       return response()->json([
           'success' => true,
           'data' => $employees
         ], 200);
     } else {

      return view('admin.employee.index', compact('employees'));
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
            'employee_email' => 'required|unique:employees,employee_email|email|max:255',
            'employee_salary' => 'required',
            'employee_address' => 'required',
        ]);

        
       $employee = new Employee();
       $employee->employee_name = $request->employee_name;
       $employee->employee_email = $request->employee_email;
       $employee->employee_salary = $request->employee_salary;
       $employee->employee_address = $request->employee_address;
       $employee->save();
       return response()->json([ 'success'=> 'Form is successfully submitted!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $pdf = PDF::loadView('admin.employee.pdf', compact('employee'));
        //return $pdf->download('invoice.pdf');
        return $pdf->stream('employee.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

       if(!$employee){
           return response()->json([
            'success' => false,
           'data' => 'Employee with id' . $id . 'not found',
        ], 400);
       }
       
       return view('admin.employee.edit', compact('employee'));
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
        $request->validate([
            'employee_name' => 'required',
            'employee_email' => 'unique:employees,employee_email,'.$id,
            'employee_salary' => 'required',
            'employee_address' => 'required',
        ]);
        
        $employee = Employee::find($id);
        $employee->employee_name = $request->employee_name;
        $employee->employee_email = $request->employee_email;
        $employee->employee_salary = $request->employee_salary;
        $employee->employee_address = $request->employee_address;
        $employee->save();
       return response()->json([ 'success'=> 'Employee is successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);

     if (!$employee){
        return response()->json([
                'success' => false,
                'message' => 'Employee with id'. $id . 'not found'
        ], 400);
     }

     if($employee->delete()){
      
        return back()->with('flash_success', 'Employee deleted successfully');
        
     }else{
        return response()->json([
                'success' => false,
                'message' => 'Employee could not be deleted'
         ], 500);
     }
    }

    public function multiple()
    {   
        $emps = Employee::all();
        return view('admin.uploads.multi', compact('emps'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'emp_id' => 'required',
            'emp_doc' => 'required',
        ]);
        
        if ($request->hasFile('emp_doc')) {
            foreach ($request->emp_doc as $key => $value) {
                $employeeDoc = new EmployeeDocument();
                $employeeDoc->emp_id = $request->emp_id;
                $employeeDoc->originalName = $value->getClientOriginalName();
                $employeeDoc->emp_doc = $value->store('employee/upload');
                $employeeDoc->save();
            }
        }
        return response()->json([ 'success'=> 'Employee Documents Uploaded successfully...!']);
        
    }

    public function document(Request $request)
    {   
        
        
        $employeeDocuments = EmployeeDocument::join('employees','employees.id','=','employee_documents.emp_id')->select('employee_documents.*', 'employees.employee_name')->get();
        //dd($employeeDocuments);
      return view('admin.uploads.index', compact('employeeDocuments'));
     
    }

    public function delete(Request $request, $id)
    {   
        $employeeDocuments = EmployeeDocument::find($id);
        
        if($employeeDocuments->delete()){
      
            return back()->with('flash_success', 'Employee Document deleted successfully');
            
         }
     
    }

    public function email()
    {   
        $emps = Employee::all();
        return view('admin.employee.email', compact('emps'));
     
    }

    public function send(Request $request)
    {      

        $employee = Employee::find($request->emp_id);
       
        $to_name = $employee->employee_name;
        $to_email = $employee->employee_email;
        $title = 'Test Mail';
        $body = 'Test Body';
        $data = [
        'title' => $request->title,
        'body' => $request->msg
        ];
    
    Mail::send('email.mail', $data, function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)
            ->subject('Mail send from kesavan maiwand task..');
    $message->from('maiwandkesavan@gmail.com','Maiwand Test');
    });

    //\Mail::to($to_email)->send(new \App\Mail\Exaplemail($data));
    return response()->json([ 'success'=> 'Email send successfully. Check your mailbox...!']);
     
    }

    public function topfive(Request $request)
    {   
        
        $employees = Employee::orderBy('employee_salary','desc')->limit(5)->get();
        
       if ($request->is('api/*')) {
       return response()->json([
           'success' => true,
           'data' => $employees
         ], 200);
     } else {

      return view('admin.employee.top', compact('employees'));
     }
    }
}
