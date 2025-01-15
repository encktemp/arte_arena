<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Listar todos os itens
     */
    public function index()
    {
        return response()->json(Item::all());
    }

    /**
     * Criar um novo item
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Cria o item no banco
        $item = Item::create($validated);

        return response()->json($item, 201);
    }

    /**
     * Exibir um item específico
     */
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json($item);
    }

    /**
     * Atualizar um item existente
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Valida os dados recebidos
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        // Atualiza o item
        $item->update($validated);

        return response()->json($item);
    }

    /**
     * Remover um item do banco de dados
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
}
