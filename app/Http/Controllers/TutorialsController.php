<?php

namespace App\Http\Controllers;

use App\Models\tutorial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TutorialsController extends Controller
{
    public function index()
    {

        $data = Tutorial::all();

        return Inertia::render('Tutorials/Index', $data);
        // return Inertia::render('Tutorials/Index', [
        //     'filters' => Request::all('search', 'trashed'),
        //     'tutorials' => Auth::user()->account->tutorials()
        //         ->orderBy('name')
        //         ->filter(Request::only('search', 'trashed'))
        //         ->paginate()
        //         ->only('id', 'name', 'phone', 'city', 'deleted_at'),
        // ]);
    }

    public function create()
    {
        return Inertia::render('Tutorials/Create');
    }

    public function store()
    {
        Auth::user()->account->tutorials()->create(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::route('tutorials')->with('success', 'tutorial created.');
    }

    public function edit(Tutorial $tutorial)
    {
        return Inertia::render('tutorials/Edit', [
            'tutorial' => [
                'id' => $tutorial->id,
                'name' => $tutorial->name,
                'email' => $tutorial->email,
                'phone' => $tutorial->phone,
                'address' => $tutorial->address,
                'city' => $tutorial->city,
                'region' => $tutorial->region,
                'country' => $tutorial->country,
                'postal_code' => $tutorial->postal_code,
                'deleted_at' => $tutorial->deleted_at,
                'contacts' => $tutorial->contacts()->orderByName()->get()->map->only('id', 'name', 'city', 'phone'),
            ],
        ]);
    }

    public function update(Tutorial $tutorial)
    {
        $tutorial->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'tutorial updated.');
    }

    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();

        return Redirect::back()->with('success', 'tutorial deleted.');
    }

    public function restore(Tutorial $tutorial)
    {
        $tutorial->restore();

        return Redirect::back()->with('success', 'tutorial restored.');
    }
}
