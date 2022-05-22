<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konveksi;
use App\Http\Resources\KonveksiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KonveksiController extends Controller
{
    public function index()
    {
        $konveksi = Konveksi::get();
        return response()->json(['Konveksi:',KonveksiResource::collection($konveksi), 'Programs fetched.']);
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
             'jmlh_project' => 'required|string|max:10',
             'id_kategori' => 'required',
             'id_tarif' => 'required',
             'id_pengalaman' => 'required',
         ]);
 
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
 
        $konveksi = Konveksi::create([
             'img_profil' => $request->img_profil,
             'nama' => $request->nama,
             'bio' => $request->bio,
             'rating' => $request->rating,
             'link_wa' => $request->link_wa,
             'link_porto' => $request->link_porto,
             'jmlh_project' => $request->jmlh_project,
             'id_kategori' => $request->id_kategori,
             'id_tarif' => $request->id_tarif,
             'id_pengalaman' => $request->id_pengalaman,
         ]);
        
        return response()->json(['Program created successfully.', new KonveksiResource($konveksi)]);
    }
 
    public function show($id)
    {
         $konveksi = Konveksi::find($id);
        if (is_null($konveksi)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new KonveksiResource($konveksi)]);
    }
 
    public function update(Request $request, Konveksi $konveksi)
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
             'id_kategori' => 'required|integer|max:11',
             'id_tarif' => 'required|integer|max:11', 
             'id_pengalaman' => 'required|integer|max:11',
         ]);
 
         if($validator->fails()){
             return response()->json($validator->errors());       
         }
 
         $konveksi->id = $request->img_profil;
         $konveksi->id = $request->nama;
         $konveksi->id = $request->bio;
         $konveksi->id = $request->rating;
         $konveksi->id = $request->link_wa;
         $konveksi->id = $request->link_porto;
         $konveksi->id = $request->jmlh_project;
         $konveksi->id = $request->id_kategori;
         $konveksi->id = $request->id_tarif;
         $konveksi->id = $request->id_pengalaman;
         $konveksi->save();
         
         return response()->json(['Program updated successfully.', new KonveksiResource($konveksi)]);
     }
 
    public function destroy(Konveksi $konveksi)
    {
     $konveksi->delete();
 
        return response()->json('Konveksi deleted successfully');
    }
}
