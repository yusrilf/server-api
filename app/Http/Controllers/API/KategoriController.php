<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
   {
       $kategori = Kategori::get();
       return response()->json(['Kategori:',KategoriResource::collection($kategori), 'Programs fetched.']);
   }

   public function store(Request $request)
   {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|max:100',
            'img_kategori' => 'required|string|max:255',
        ]);

       if($validator->fails()){
           return response()->json($validator->errors());       
       }

       $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'img_kategori' => $request->img_kategori,
        ]);
       
       return response()->json(['Program created successfully.', new KategoriResource($kategori)]);
   }

   public function show($id)
   {
        $kategori = Kategori::find($id);
       if (is_null($kategori)) {
           return response()->json('Data not found', 404); 
       }
       return response()->json([new KategoriResource($kategori)]);
   }

   public function update(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|max:100',
            'img_kategori' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->img_kategori = $request->img_kategori;
 
        $kategori->save();
        
        return response()->json(['Program updated successfully.', new KategoriResource($kategori)]);
    }

   public function destroy(Kategori $kategori)
   {
    $kategori->delete();

       return response()->json('Kategori deleted successfully');
   }
}
