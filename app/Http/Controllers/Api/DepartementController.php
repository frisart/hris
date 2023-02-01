<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeparTement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DeparTement as DeparTementResource;

class DepartementController extends Controller
{
    public function index(Request $request)
    {
        $alldept = DB::table('departement')
            ->select('ID_departement as id', 'Parent', 'name as label')->orderBy('id', "asc")->get();
        // ->select('ID_departement as id', 'Parent', 'name as label')->get();


        $rootdepts = $alldept->whereNull('Parent');

        self::formatTree($rootdepts, $alldept);

        // foreach ($rootdepts as $rootdept) {

        //     $rootdept->children = $alldept->where('Parent', $rootdept->id)->values();

        //     foreach ($rootdept->children as $child) {
        //         $child->children = $alldept->where('Parent', $child->id)->values();
        //     }
        // }

        return response()->json([
            'data' => $rootdepts,

        ]);
    }


    private static function formatTree($departes, $alldeparte)
    {
        foreach ($departes as $departe) {
            $departe->children = $alldeparte->where('Parent', $departe->id)->values();

            if ($departe->children->isNotEmpty()) {
                self::formatTree($departe->children, $alldeparte);
            }
        }
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



        $post = DeparTement::create([
            'Parent'        => $request->parent,
            'name'          => $request->name,
            'order'         => $request->order,
            'departement_head' => $request->departement_head,
            'active'        => $request->active

        ]);

        return response()->json([
            'data' => $post,
            'message' => 'Departement created successfully.',
            'success' => true,
            'code' => 200

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

        $DeparTement = DeparTement::where('ID_departement', $id)->firstOrFail();
        $DeparTement->Parent            = $request->parent;
        $DeparTement->name              = $request->name;
        $DeparTement->order             = $request->order;
        $DeparTement->departement_head  = $request->departement_head;
        $DeparTement->active            = $request->active;
        $DeparTement->save();


        return response()->json([
            'data'    => $DeparTement,
            'message' => 'Departement Update successfully.',
            'code' => 200
        ]);
    }


    public function ShowByid($id, Request  $request)
    {
        $query = DeparTement::where('ID_departement', $id)->firstOrFail();

        if ($query->Parent != '') {
            $dataparent = DeparTement::where('ID_departement', $query->Parent)->firstOrFail();
        } else {
            $dataparent = '';
        }

        // print_r($dataparent);
        //  $query

        if (is_null($query)) {

            return response()->json([
                'message' => 'Data Department Not Found',
                'code' => 200
            ]);
        } else {

            return response()->json(
                [

                    'data' => $query,
                    'dataparent' => $dataparent
                ]
            );
        }
    }


    public function deleteData($id, Request  $request)
    {

        $parent = DB::table('departement')
            ->select('ID_departement as id', 'Parent')->where('Parent', $id)->get();

        if ($parent) {

            DB::table('departement')->where('ID_departement', $id)->delete();
            foreach ($parent as $child) {
                // print_r($child->id);
                // $this->deleteData($child->id);
                self::deleteData($child->id, $request);
            }

            return response()->json([
                'code' => 200
            ]);
        } else {
            return response()->json([
                'code' => 200
            ]);
        }


        // $parent->delete();
    }
}