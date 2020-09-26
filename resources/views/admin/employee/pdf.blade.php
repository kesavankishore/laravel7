<center><h1>Employee Details</h1></center>

        <div class="box box-block bg-white">
           
            <table class="table table-striped table-bordered dataTable" id="table-2" style="border: 1px solid rgb(56, 32, 32); width: 100%;">
                
                <tbody>
                   
                    <tr>
                        
                        <td style="border: 1px solid rgb(56, 32, 32);">Employee Name</td>
                        <td style="border: 1px solid rgb(56, 32, 32);">{{ $employee->employee_name }}</td>
                        
                    </tr>
                    <tr>
                        
                        <td style="border: 1px solid rgb(56, 32, 32);">Employee Email</td>
                        <td style="border: 1px solid rgb(56, 32, 32);">{{ $employee->employee_email }}</td>
                        
                    </tr>
                    <tr>
                        
                        <td style="border: 1px solid rgb(56, 32, 32);">Employee Salary</td>
                        <td style="border: 1px solid rgb(56, 32, 32);">${{ $employee->employee_salary }}</td>
                        
                    </tr>
                    <tr>
                        
                        <td style="border: 1px solid rgb(56, 32, 32);">Emploee Address</td>
                        <td style="border: 1px solid rgb(56, 32, 32);">{{ $employee->employee_address}}</td>
                        
                    </tr>
                  
                </tbody>
                
            </table>

            
        </div>
    </div>
</div>

