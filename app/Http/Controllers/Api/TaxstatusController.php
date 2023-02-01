<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaxStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;


class TaxstatusController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tax_status')
            ->select('id_tax_status as id', 'name',  'order');


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


    public function ShowByid($id, Request  $request)
    {
        $query = TaxStatus::where('id_tax_status', $id)->firstOrFail();

        if (is_null($query)) {

            return response()->json([
                'message' => 'Data TaxStatus Not Found',
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

            $TaxStatus = TaxStatus::create([
                'name' => $request->name,
                'active' => $request->active,
                'order' => $request->order,


            ]);



            return response()->json([
                'code' => 200,
                'data' => $TaxStatus,

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
            $TaxStatus = TaxStatus::where('id_tax_status', $id)->firstOrFail();
            $TaxStatus->name          = $request->name;
            $TaxStatus->active        = $request->active;
            $TaxStatus->order        = $request->order;
            $TaxStatus->save();


            return response()->json([
                'data'    => $TaxStatus,
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
        $jobtitle = TaxStatus::where('id_tax_status', $id)->firstOrFail();

        if ($jobtitle) {
            $jobtitle->delete();

            return response()->json([
                'message' => 'TaxStatus Deleted successfully.',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "TaxStatus Title id $id not found",

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

        TaxStatus::whereIn('id_tax_status', $id)
            ->delete();

        return response()->json([
            'data'  => $id,
            'message' => ' Deleted successfully.',
            'code' => 200
        ]);
    }

    public function GetData()
    {
        echo "test";
    }
}