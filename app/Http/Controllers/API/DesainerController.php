<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesainerResource;
use App\Models\Desainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesainerController extends Controller
{
   public function index()
   {
       $desainer = Desainer::get();
       return response()->json(['Desainer:',DesainerResource::collection($desainer), 'Programs fetched.']);
   }

   public function store(Request $request)
   {
        $validator = Validator::make($request->all(),[
            'img_profil' => 'required|string|max:1200',
            'nama' => 'required|string|max:100',
            'bio' => 'required|string|max:100',
            'rating' => 'required|string|max:10',
            'link_wa' => 'required|string|max:255',
            'link_porto' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'jmlh_project' => 'required|string|max:10',
            'id_kategori' => 'required',
            'id_tarif' => 'required',
            'id_pengalaman' => 'required',
        ]);

       if($validator->fails()){
           return response()->json($validator->errors());       
       }

       $desainer = Desainer::create([
            'img_profil' => $request->img_profil,
            'nama' => $request->nama,
            'bio' => $request->bio,
            'rating' => $request->rating,
            'link_wa' => $request->link_wa,
            'link_porto' => $request->link_porto,
            'gender' => $request->gender,
            'jmlh_project' => $request->jmlh_project,
            'id_kategori' => $request->id_kategori,
            'id_tarif' => $request->id_tarif,
            'id_pengalaman' => $request->id_pengalaman,
        ]);
       
       return response()->json(['Program created successfully.', new DesainerResource($desainer)]);
   }

   public function show($id)
   {
        $desainer = Desainer::find($id);
       if (is_null($desainer)) {
           return response()->json('Data not found', 404); 
       }
       return response()->json([new DesainerResource($desainer)]);
   }

   public function update(Request $request, Desainer $desainer)
    {
        $validator = Validator::make($request->all(),[
            'img_profil' => 'required|string|max:1200',
            'nama' => 'required|string|max:100',
            'bio' => 'required|string|max:100',
            'rating' => 'required|string|max:10',
            'link_wa' => 'required|string|max:255',
            'link_porto' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'jmlh_project' => 'required|string|max:10',
            'id_kategori' => 'required',
            'id_tarif' => 'required',
            'id_pengalaman' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $desainer->id = $request->img_profil;
        $desainer->id = $request->nama;
        $desainer->id = $request->bio;
        $desainer->id = $request->rating;
        $desainer->id = $request->link_wa;
        $desainer->id = $request->link_porto;
        $desainer->id = $request->gender;
        $desainer->id = $request->jmlh_project;
        $desainer->id = $request->id_kategori;
        $desainer->id = $request->id_tarif;
        $desainer->id = $request->id_pengalaman;
        $desainer->save();
        
        return response()->json(['Program updated successfully.', new DesainerResource($desainer)]);
    }

   public function destroy(Desainer $desainer)
   {
    $desainer->delete();

       return response()->json('Desainer deleted successfully');
   }
}
