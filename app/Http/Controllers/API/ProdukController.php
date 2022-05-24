<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
   {
       $produk = Produk::get();
       return response()->json(['Produk:',ProdukResource::collection($produk), 'Programs fetched.']);
   }

   public function store(Request $request)
   {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:100',
            'img_produk' => 'required|string|max:255',
            'harga' => 'required|string|max:100',
            'rating' => 'required|string|max:10',
            'deskripsi' => 'required|string|max:255',
            'id_desainer' => 'required|integer|max:11',
            'id_konveksi' => 'required|integer|max:11',
        ]);

       if($validator->fails()){
           return response()->json($validator->errors());       
       }

       $produk = Produk::create([
            'nama' => $request->nama,
            'img_produk' => $request->img_produk,
            'harga' => $request->harga,
            'rating' => $request->rating,
            'deskripsi' => $request->deskripsi,
            'id_desainer' => $request->id_desainer,
            'id_konveksi' => $request->id_konveksi,
        ]);
       
       return response()->json(['Program created successfully.', new ProdukResource($produk)]);
   }

   public function show($id)
   {
        $produk = Produk::find($id);
       if (is_null($produk)) {
           return response()->json('Data not found', 404); 
       }
       return response()->json([new ProdukResource($produk)]);
   }

   public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:100',
            'img_produk' => 'required|string|max:255',
            'harga' => 'required|string|max:100',
            'rating' => 'required|string|max:10',
            'deskripsi' => 'required|string|max:255',
            'id_desainer' => 'required|integer|max:11',
            'id_konveksi' => 'required|integer|max:11',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $produk->id = $request->nama;
        $produk->id = $request->img_produk;
        $produk->id = $request->harga;
        $produk->id = $request->rating;
        $produk->id = $request->deskripsi;
        $produk->id = $request->id_desainer;
        $produk->id = $request->id_konveksi;
        $produk->save();
        
        return response()->json(['Program updated successfully.', new ProdukResource($produk)]);
    }

   public function destroy(Produk $produk)
   {
    $produk->delete();

       return response()->json('Produk deleted successfully');
   }
}
