<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobLevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JobLevel as JobLevelResource;
use Exception;

class JoblevelController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('job_level')
            ->select('id_job_level as id', 'name', 'order');


        if ($s = $request->input('filter')) {
            $query->whereRaw("name LIKE '%" . $s . "%'");
            // ->orWhereRaw("order LIKE '%" . $s . "%'");
        }

        $query = $query->orderBy(optional($request)->sortBy ?? 'created_at', optional($request)->descending ?? 'desc')
            ->paginate(optional($request)->rowsPerPage ?? 10);

        return response()->json([

            'data' => $query,

        ]);
    }







    public function SaveData(Request $request)
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



        $post = JobLevel::create([
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

        $JobLevel = JobLevel::where('id_job_level', $id)->firstOrFail();
        $JobLevel->name          = $request->name;
        $JobLevel->order         = $request->order;
        $JobLevel->active         = $request->active;
        $JobLevel->save();


        return response()->json([
            'data'    => $JobLevel,
            'message' => 'Job Grade Update successfully.',
            'code' => 200
        ]);
    }


    public function ShowByid($id, Request  $request)
    {
        $query = JobLevel::where('id_job_level', $id)->firstOrFail();

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
        $jobtitle = JobLevel::where('id_job_level', $id)->firstOrFail();

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

        $idJobLevel = $request->get('id_job_level');

        $array = explode(" ", $idJobLevel);
        $IdArray = $array[0];
        $id = (explode(",", $IdArray));

        JobLevel::whereIn('id_job_level', $id)
            ->delete();

        return response()->json([
            'data'  => $id,
            'message' => ' Deleted successfully.',
            'code' => 200
        ]);
    }


    public function DataOption()
    {
        try {
            $query = DB::table('job_level')
                ->where('active', true)
                ->select('id_job_level as value', 'name as label')->get();

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