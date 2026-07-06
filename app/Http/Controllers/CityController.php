<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'latitude.numeric' => 'La latitud debe ser un número válido.',
            'longitude.numeric' => 'La longitud debe ser un número válido.',
            'name.required' => 'El nombre de la ciudad es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen válida (jpeg,png,jpg).',
        ]);

        $imagePath = $request->file('image')->store('cities', 'public');

        City::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('cities.create')->with('success', 'Ciudad registrada con éxito.');
    }

    public function create()
    {
        return view('cities.create');
    }

    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

    public function destroy(City $city)
    {
        if ($city->image_path) {
            Storage::disk('public')->delete($city->image_path);
        }

        $city->delete();

        return redirect()->route('cities.index')->with('success', 'Ciudad eliminada correctamente.');
    }
    
}
