<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Affiche toutes les équipes
    public function index()
    {
        $teams = Team::with('users')->get(); // Charger les membres
        return view('teams.index', compact('teams'));
    }

    // Affiche le formulaire pour créer une équipe
    public function create()
    {
        return view('teams.create');
    }

    // Stocke une nouvelle équipe
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Team::create($request->only('name', 'description'));

        return redirect()->route('teams.index')->with('success', 'Équipe créée avec succès !');
    }

    // Affiche le formulaire pour modifier une équipe
 public function edit(Team $team)
{
    // Récupérer les IDs des utilisateurs déjà invités à cette équipe
    $invitedUserIds = $team->users()->pluck('users.id')->toArray();

    // Récupérer les utilisateurs qui ne sont pas encore invités
    $users = \App\Models\User::whereNotIn('id', $invitedUserIds)->get();

    // Retourner la vue avec l'équipe et les utilisateurs non invités
    return view('teams.edit', compact('team', 'users'));
}



    // Met à jour l'équipe
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $team->update($request->only('name', 'description'));

        return redirect()->route('teams.index')->with('success', 'Équipe mise à jour !');
    }

    // Supprime une équipe
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Équipe supprimée !');
    }

    // Inviter des utilisateurs à l'équipe
   public function inviteUsers(Request $request, Team $team)
{
    $request->validate([
        'users' => 'required|array',
        'users.*' => 'exists:users,id',
    ]);

    $alreadyInvited = [];
    $newInvites = [];

    foreach ($request->users as $userId) {
        if ($team->users()->where('user_id', $userId)->exists()) {
            $alreadyInvited[] = $userId; // déjà invité
        } else {
            $newInvites[] = $userId;
        }
    };

    if (!empty($newInvites)) {
        $team->users()->attach($newInvites);
    }

    if (!empty($alreadyInvited)) {
        $userNames = \App\Models\User::whereIn('id', $alreadyInvited)->pluck('name')->join(', ');
        return redirect()->back()->with('error', "Ces utilisateurs ont déjà été invités : $userNames");
    }

    return redirect()->back()->with('success', 'Utilisateurs invités avec succès !');
}
public function showUsers(Team $team)
{
    $users = $team->users; // récupère les utilisateurs de l'équipe
    return view('teams.users', compact('team', 'users'));
}

};
