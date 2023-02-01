<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('employee')
            ->leftJoin('departement', 'employee.departement', '=', 'departement.ID_departement')
            ->leftJoin('job_title', 'employee.job_title', '=', 'job_title.id_job_title')
            ->leftJoin('job_grade', 'employee.job_grade', '=', 'job_grade.id_job_grade')
            ->leftJoin('job_level', 'employee.job_level', '=', 'job_level.id_job_level')
            ->select('employee.id_employee', 'employee.emp_no', 'employee.nik', 'employee.name', 'employee.departement', 'employee.job_title', 'employee.job_grade', 'employee.job_level', 'employee.email', 'employee.phone', 'employee.address', 'employee.bill_rate', 'employee.client', 'employee.active', 'job_title.name as jobtitle', 'job_grade.name as jobgrade', 'job_level.name as joblevel', 'departement.name as namedepartement');


        if ($s = $request->input('filter')) {
            $query->whereRaw("employee.name LIKE '%" . $s . "%'");
            // ->orWhereRaw("order LIKE '%" . $s . "%'");
        }

        $query = $query->orderBy(optional($request)->sortBy ?? 'employee.created_at', optional($request)->descending ?? 'desc')
            ->paginate(optional($request)->rowsPerPage ?? 10);

        return response()->json([

            'data' => $query,

        ]);
    }


    public function ShowByid($id, Request  $request)
    {
        $query = Employee::where('id_employee', $id)->firstOrFail();

        if (is_null($query)) {

            return response()->json([
                'message' => 'Data Employee Not Found',
                'code' => 200
            ]);
        } else {

            return response()->json(
                $query
            );
        }
    }

    public function SaveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {

            $Employee = Employee::create([
                'emp_no'                 => $request->emp_no,
                'nik'                    => $request->nik,
                'name'                   => $request->name,
                'departement'            => $request->departement,
                'job_title'              => $request->job_title,
                'job_grade'              => $request->job_grade,
                'job_level'              => $request->job_level,
                'email'                  => $request->email,
                'phone'                  => $request->phone,
                'address'                => $request->address,
                'bill_rate'              => $request->bill_rate,
                'client'                 => $request->client,
                'birthplace'             => $request->birthplace,
                'birthdate'              => $request->birthdate,
                'religi'                 => $request->religi,
                'marriage_status'        => $request->marriage_status,
                'numberofchild'          => $request->numberofchild,
                'tax_status'             => $request->tax_status,
                'npwp_no'                => $request->npwp_no,
                'npwp_address'           => $request->npwp_address,
                'ktp_address'            => $request->ktp_address,
                'blood_type'             => $request->blood_type,
                'bank'                   => $request->bank,
                'account_bank_name'      => $request->account_bank_name,
                'account_bank_number'    => $request->account_bank_number,
                'join_date'              => $request->join_date,
                'end_date'               => $request->end_date,
                'active'                 => $request->active,
            ]);



            return response()->json([
                'code' => 200,
                'data' => $Employee,

            ]);
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'info' => 'Name  Is Ready',
                'code' => 401
            ]);
        }
    }

    public function updateData($id, Request $request)
    {
        // print_r($request->all());
        $validator = Validator::make($request->all(), [
            'name'   => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'data'      => [],
                'message'   => $validator->errors(),
                'success'   => false
            ]);
        }

        try {
            $Employee = Employee::where('id_employee', $id)->firstOrFail();
            $Employee->name          = $request->name;
            $Employee->active        = $request->active;
            $Employee->order        = $request->order;
            $Employee->save();


            return response()->json([
                'data'    => $Employee,
                'message' => 'Job Grade Update successfully.',
                'code' => 200
            ]);
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'info' => 'Name Is Ready',
                'code' => 401
            ]);
        }
    }


    public function deleteData($id, Request  $request)
    {
        $jobtitle = Employee::where('id_employee', $id)->firstOrFail();

        if ($jobtitle) {
            $jobtitle->delete();

            return response()->json([
                'message' => 'Employee Deleted successfully.',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Employee Title id $id not found",

            ]);
        }
    }


    public function multidel(Request  $request)
    {
        // print_r($request->all());

        $id = $request->get('id');

        $array = explode(" ", $id);
        $IdArray = $array[0];
        $id = (explode(",", $IdArray));

        Employee::whereIn('id_employee', $id)
            ->delete();

        return response()->json([
            'data'  => $id,
            'message' => ' Deleted successfully.',
            'code' => 200
        ]);
    }
}