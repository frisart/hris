<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTitle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JobTitles as JobTitleResource;
use Exception;


class JobtitleController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = DB::table('job_title')
    //         ->leftJoin('departement', 'job_title.departement', '=', 'departement.ID_departement')
    //         ->select('job_title.name', 'departement.name as namedepartement');


    //     // Pencarian
    //     if ($s = $request->input('s')) {
    //         $query->whereRaw("employee.id_employee LIKE '%" . $s . "%'")
    //             ->orWhereRaw("employee.name LIKE '%" . $s . "%'");
    //     }

    //     // Sort
    //     if ($sort = $request->input('sort')) {
    //         $query->orderBy('id_employee', $sort);
    //     }

    //     // Group Perkiraan
    //     if ($group = $request->input('group')) {
    //         $query->where('source', $group);
    //     } else {
    //         $group = '';
    //     }


    //     $perPage = 10;
    //     $page = $request->input('page');
    //     $from = $page - 1;
    //     $total = $query->count();
    //     $last_page_url = url('api/jotitle?page=' . ceil($total / $perPage) . '&group=' . $group);
    //     $next_page_url = url('api/jotitle?page=' . ($page + 1) . '&group=' . $group);
    //     $prev_page_url = url('api/jotitle?page=' . ($page - 1) . '&group=' . $group);

    //     $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

    //     return response()->json([
    //         'first_page_url' => url('api/jotitle?page=1&group=' . $group),
    //         'current_page' => $page,
    //         'data' => $result,
    //         'from' => $from,
    //         'last_page' => ceil($total / $perPage),
    //         'last_page_url' => $last_page_url,
    //         'links' => '[{url: null, label: "&laquo; Previous", active: false},…]',
    //         'next_page_url' => $next_page_url,
    //         'path' => url('/api/jotitle'),
    //         'total' => $total,
    //         'per_page' =>  $perPage,
    //         'prev_page_url' => (($from > 0)) ? $prev_page_url : '',
    //         'to' => $perPage,
    //         'perpage' => $perPage,
    //         'page' => $page,
    //         'group' => $group,
    //     ]);
    // }

    public function index(Request $request)
    {


        $query = DB::table('job_title')
            ->select('id_job_title as id', 'name', 'order');
        // ->join('departement', 'job_title.departement', '=', 'departement.ID_departement')
        // ->select('id_job_title', 'job_title.name', 'departement.name as namedepartement', 'job_title.order');


        if ($s = $request->input('filter')) {
            $query->whereRaw("job_title.name LIKE '%" . $s . "%'");
            // ->orWhereRaw("order LIKE '%" . $s . "%'");
        }

        $query = $query->orderBy(optional($request)->sortBy ?? 'job_title.created_at', optional($request)->descending ?? 'desc')
            ->paginate(optional($request)->rowsPerPage ?? 5);

        return response()->json([

            'data' => $query,

        ]);
    }


    public function SaveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'departement'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data'      => [],
                'message'   => $validator->errors(),
                'success'   => false
            ]);
        }



        $post = JobTitle::create([
            'departement'   => $request->departement,
            'name'          => $request->name,
            'order'         => $request->order,
            'active'         => $request->active,

        ]);

        return response()->json([
            'data' => $post,
            'message' => 'Job Title created successfully.',
            'success' => true
        ]);
    }


    public function updateData($id, Request $request)
    {
        // print_r($request->all());
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'departement'  => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'data'      => [],
                'message'   => $validator->errors(),
                'success'   => false
            ]);
        }

        $jobtitle = JobTitle::where('id_job_title', $id)->firstOrFail();
        $jobtitle->departement   = $request->departement;
        $jobtitle->name          = $request->name;
        $jobtitle->order         = $request->order;
        $jobtitle->active         = $request->active;
        $jobtitle->save();


        return response()->json([
            'data'    => $jobtitle,
            'message' => 'Job Title created successfully.',
            'code' => 200
        ]);
    }


    public function ShowByid($id, Request  $request)
    {
        $query = DB::table('job_title')
            ->leftJoin('departement', 'job_title.departement', '=', 'departement.ID_departement')
            ->select('job_title.name', 'departement.name as namedepartement')
            ->where('job_title.id_job_title', $id)
            ->first();

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


    public function deleteData($id, Request  $request)
    {
        $jobtitle = JobTitle::where('id_job_title', $id)->firstOrFail();

        if ($jobtitle) {
            $jobtitle->delete();
            return response()->json([
                'message' => 'Job Title Deleted successfully.',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Job Title id $id not found",

            ]);
        }
    }

    public function DataOption()
    {
        try {
            $query = DB::table('job_title')
                ->where('active', true)
                ->select('id_job_title as value', 'name as label')->get();

            return response()->json([
                'code' => 200,
                'data' => $query,

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'info' => 'Error',
                'code' => 401
            ]);
        }
    }
}