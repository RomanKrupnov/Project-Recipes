<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Config;
use App\Http\Controllers\AuthController;

class RecipesController extends Controller
{
    public function index()
    {
        return Recipe::query()->where('is_active', '=', '1')->paginate(4);
    }

    public function show(Recipe $recipe)
    {
        return response()->json([
            'products' => $recipe->products,
            'recipe' => $recipe
        ], 200);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $inputData = $request->except(['products']);
        $recipe = $recipe->fill($inputData);
        $recipe->save();
        $recipe->products()->attach($request->get('products'));
        return response()->json($recipe, 200);
    }


    public function store(Request $request)
    {
        $recipe = Recipe::create($request->all());
        $recipe->products()->attach($request->get('products'));

        return response()->json($recipe, 201);
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->user()->id) {
            return response()->json([
                'message' => 'Доступ запрещен.',
                'status' => 403
            ], 403);
        }

        $recipe->delete();
        return response()->json(null, 204);
    }

    public function getUserRecipes()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Доступ запрещен',
                'status' => 403,
            ], 403);
        }

        return Recipe::query()->where('user_id', '=', $user->id)->paginate(4);
    }

    public function checkUserRecipe(Recipe $recipe)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'message' => 'Доступ запрещен',
                'status' => 403,
            ], 403);
        }

        return response()->json([
            'message' => $user->id === $recipe->user_id,
            'status' => 200,
        ], 200);
    }

}
