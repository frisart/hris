<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobGrade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JobGrade as JobGradeResource;
use Exception;


class JobgradeController extends Controller
{
    public function index(Request $request)
    {
        $joblevel = DB::table('job_grade');

        if ($s = $request->input('filter')) {
            $joblevel->whereRaw("name LIKE '%" . $s . "%'");
            // ->orWhereRaw("order LIKE '%" . $s . "%'");
        }


        $joblevels = $joblevel->orderBy(optional($request)->sortBy ?? 'created_at', optional($request)->descending ?? 'desc')
            ->paginate(optional($request)->rowsPerPage ?? 10);


        return JobGradeResource::collection($joblevels);
    }

    public function SaveData(Request $request)
    {
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



        $post = JobGrade::create([
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


        ]);

        if ($validator->fails()) {
            return response()->json([
                'data'      => [],
                'message'   => $validator->errors(),
                'success'   => false
            ]);
        }

        $JobGrade = JobGrade::where('id_job_grade', $id)->firstOrFail();
        $JobGrade->name          = $request->name;
        $JobGrade->order         = $request->order;
        $JobGrade->active         = $request->active;
        $JobGrade->save();


        return response()->json([
            'data'    => $JobGrade,
            'message' => 'Job Grade Update successfully.',
            'code' => 200
        ]);
    }


    public function ShowByid($id, Request  $request)
    {
        $query = JobGrade::where('id_job_grade', $id)->firstOrFail();

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
        $jobtitle = JobGrade::where('id_job_grade', $id)->firstOrFail();

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


    public function multidel(Request  $request)
    {
        // print_r($request->all());

        $idJobLevel = $request->get('id_job_grade');

        $array = explode(" ", $idJobLevel);
        $IdArray = $array[0];
        $id = (explode(",", $IdArray));

        JobGrade::whereIn('id_job_grade', $id)
            ->delete();

        return response()->json([
            'data'  => $id,
            'message' => 'Deleted successfully.',
            'code' => 200
        ]);
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