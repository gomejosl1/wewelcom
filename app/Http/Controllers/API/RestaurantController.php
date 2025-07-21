<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * API de Restaurantes
 * 
 * API RESTful para gestionar información de restaurantes
 */

class RestaurantController extends Controller
{
    /**
     * Mostrar un listado de todos los restaurantes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        
        return response()->json([
            'success' => true,
            'data' => $restaurants,
            'message' => 'Restaurantes recuperados con éxito'
        ]);
    }

    /**
     * Almacenar un nuevo restaurante en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'cuisine_type' => 'nullable|string|max:100',
            'rating' => 'nullable|numeric|min:0|max:5',
            'active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $restaurant = Restaurant::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $restaurant,
            'message' => 'Restaurante creado con éxito'
        ], Response::HTTP_CREATED);
    }

    /**
     * Mostrar el restaurante especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $restaurant,
            'message' => 'Restaurante recuperado con éxito'
        ]);
    }

    /**
     * Actualizar el restaurante especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'cuisine_type' => 'nullable|string|max:100',
            'rating' => 'nullable|numeric|min:0|max:5',
            'active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Error de validación'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $restaurant->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $restaurant,
            'message' => 'Restaurante actualizado con éxito'
        ]);
    }

    /**
     * Eliminar el restaurante especificado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        $restaurant->delete();

        return response()->json([
            'success' => true,
            'message' => 'Restaurante eliminado con éxito'
        ]);
    }
}
