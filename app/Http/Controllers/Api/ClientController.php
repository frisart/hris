<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('clients')
            ->select('id_client as id', 'name', 'email', 'address', 'order');


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
        $query = Client::where('id_client', $id)->firstOrFail();

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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {

            $client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'active' => $request->active,
                'order' => $request->order,


            ]);

            $token = $client->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 200,
                'data' => $client,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'info' => 'Name Or Email Is Ready',
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
            $Client = Client::where('id_client', $id)->firstOrFail();
            $Client->name          = $request->name;
            $Client->email         = $request->email;

            if ($request->password) {
                $Client->password      = Hash::make($request->password);
            }
            $Client->address       = $request->address;
            $Client->active        = $request->active;
            $Client->order        = $request->order;
            $Client->save();


            return response()->json([
                'data'    => $Client,
                'message' => 'Job Grade Update successfully.',
                'code' => 200
            ]);
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
                'info' => 'Name Or Email Is Ready',
                'code' => 401
            ]);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::guard('client')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $client = Client::where('email', $request->email)->firstOrFail();

        $token = $client->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }


    public function deleteData($id, Request  $request)
    {
        $jobtitle = Client::where('id_client', $id)->firstOrFail();

        if ($jobtitle) {
            $jobtitle->delete();

            return response()->json([
                'message' => 'Client Deleted successfully.',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Client Title id $id not found",

            ]);
        }
    }



    public function logout()
    {
        Auth::client()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }


    public function multidel(Request  $request)
    {
        // print_r($request->all());

        $id = $request->get('id');

        $array = explode(" ", $id);
        $IdArray = $array[0];
        $id = (explode(",", $IdArray));

        Client::whereIn('id_client', $id)
            ->delete();

        return response()->json([
            'data'  => $id,
            'message' => ' Deleted successfully.',
            'code' => 200
        ]);
    }
}