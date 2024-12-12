<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Mail\DishCreated;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $paginateDishes = Dish::withExists(['users as is_favorite' => function($query) {
            $query->where('user_id', Auth::id());
        }])->orderBy('id', 'DESC')->paginate(10);

        return view('welcome', compact('paginateDishes'));
    }

    /**
     * Display a listing of the favorites resource.
     */
    public function favorites(): View
    {
        $paginateDishes = Dish::whereHas('users', function ($users) {
            $users->where('user_id', Auth::id());
        })
        ->withExists(['users as is_favorite' => function($query) {
            $query->where('user_id', Auth::id());
        }])
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('welcome', compact('paginateDishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        $dish = Dish::create($request->validated() + [
            'image' => $request->file('image')->store('public/dishes')
        ]);

        event(new DishCreated($dish));

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('dishes.view', $dish);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('dishes.index', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $dish->update($request->validated() + [
            'image' => $request->file('image')->store('public/dishes')
        ]);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        // @TODO: observers
        $dish->users()->detach();
        $dish->delete();

        return redirect()->back();
    }

    /**
     * Display a listing of the favorites resource.
     */
    public function addFavorite(Dish $dish)
    {
        $dish->users()->toggle(Auth::id());
        
        return redirect()->back();
    }
}
