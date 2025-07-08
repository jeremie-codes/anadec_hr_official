<?php

namespace App\Http\Controllers;

use App\Models\SousDirection;
use App\Models\Direction;
use Illuminate\Http\Request;

class SousDirectionController extends Controller
{
    public function index(Request $request)
    {
        $query = SousDirection::with('direction')->withCount('agents');

        // Filtrage par direction
        if ($request->filled('direction_id')) {
            $query->where('direction_id', $request->direction_id);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $sous_directions = $query->where('name', '!=', 'Aucun')->orderBy('name')->paginate(10);

        dd($sous_directions);

        // Statistiques
        $stats = [
            'total' => SousDirection::count(),
            'total_agents' => \App\Models\Agent::count(),
        ];

        $directions = Direction::orderBy('name')->get();

        return view('sous_directions.index', compact('sous_directions', 'stats', 'directions'));
    }

    public function create()
    {
        $directions = Direction::orderBy('name')->get();
        return view('sous_directions.create', compact('directions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'direction_id' => 'required|exists:directions,id',
            'name' => 'required|string|max:255',
        ]);

        // Vérifier l'unicité du name dans la direction
        $existingSousDirection = SousDirection::where('direction_id', $validated['direction_id'])
            ->where('name', $validated['name'])
            ->first();

        if ($existingSousDirection) {
            return back()->withErrors(['name' => 'Un service avec ce name existe déjà dans cette direction.'])
                         ->withInput();
        }

        SousDirection::create($validated);

        return redirect()->route('sous_directions.index')
            ->with('success', 'SousDirection créé avec succès.');
    }

    public function show(SousDirection $sous_direction)
    {
        $sous_direction->load(['direction', 'agents']);

        // Statistiques du service
        $stats = [
            'total_agents' => $sous_direction->agents()->count(),
        ];

        return view('sous_directions.show', compact('sous_direction', 'stats'));
    }

    public function edit(SousDirection $sous_direction)
    {
        $directions = Direction::orderBy('name')->get();
        return view('sous_directions.edit', compact('sous_direction', 'directions'));
    }

    public function update(Request $request, SousDirection $sous_direction)
    {
        $validated = $request->validate([
            'direction_id' => 'required|exists:directions,id',
            'name' => 'required|string|max:255',
        ]);

        // Vérifier l'unicité du name dans la direction (sauf pour le service actuel)
        $existingSousDirection = SousDirection::where('direction_id', $validated['direction_id'])
            ->where('name', $validated['name'])
            ->where('id', '!=', $sous_direction->id)
            ->first();

        if ($existingSousDirection) {
            return back()->withErrors(['name' => 'Un service avec ce name existe déjà dans cette direction.'])
                         ->withInput();
        }

        $sous_direction->update($validated);

        return redirect()->route('sous_directions.show', $sous_direction)
            ->with('success', 'SousDirection modifié avec succès.');
    }

    public function destroy(SousDirection $sous_direction)
    {
        // Vérifier s'il y a des agents associés
        if ($sous_direction->agents()->count() > 0) {
            return redirect()->route('sous_directions.index')
                ->with('error', 'Impossible de supprimer un service qui contient des agents.');
        }

        $sous_direction->delete();

        return redirect()->route('sous_directions.index')
            ->with('success', 'SousDirection supprimé avec succès.');
    }

    // API pour obtenir les sous_directions d'une direction
    public function getsous_directionsByDirection(Direction $direction)
    {
        $sous_directions = $direction->sous_directions()->orderBy('name')->get();
        return response()->json($sous_directions);
    }
}
