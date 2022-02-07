<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CondominiumController extends Controller
{
    public function list(Request $req) {
        $sortMethod = "asc";

        if ($req->query("sort") != null) {
            $sortMethod = $req->query("sort");
        }

        return Condominium::orderBy("number_cond", $sortMethod)->get();
    }

    public function detail($id) {
        return Condominium::where("id", $id)->first();
    }

    public function create(Request $req) {
        // Get data from request
        $condominiumData = json_decode($req->getContent());

        $condominium = new Condominium();

        $condominium->name = $condominiumData->name;
        $condominium->photo = $condominiumData->photo;
        $condominium->common = $condominiumData->common;
        $condominium->province = $condominiumData->province;
        $condominium->address = $condominiumData->address;
        $condominium->cap = $condominiumData->cap;
        $condominium->number_cond = $condominiumData->number_cond;
        $condominium->consumption = $condominiumData->consumption;
        $condominium->remote = $condominiumData->remote;
        $condominium->accounting = $condominiumData->accounting;
        $condominium->probe = $condominiumData->probe;
        $condominium->device = $condominiumData->device;

        $condominium->save();

        return response()->json($condominium, 201);
    }

    public function modify(Request $req, $id) {
        $condominium = Condominium::where("id", $id)->first();

        // Get data from request
        $condominiumData = json_decode($req->getContent());

        $condominium->name = $condominiumData->name;
        $condominium->photo = $condominiumData->photo;
        $condominium->common = $condominiumData->common;
        $condominium->province = $condominiumData->province;
        $condominium->address = $condominiumData->address;
        $condominium->cap = $condominiumData->cap;
        $condominium->number_cond = $condominiumData->number_cond;
        $condominium->consumption = $condominiumData->consumption;
        $condominium->remote = $condominiumData->remote;
        $condominium->accounting = $condominiumData->accounting;
        $condominium->probe = $condominiumData->probe;
        $condominium->device = $condominiumData->device;

        $condominium->save();

        return response()->json($condominium, 200);
    }

    public function destroy($id) {
        return Condominium::destroy($id);
    }
}
