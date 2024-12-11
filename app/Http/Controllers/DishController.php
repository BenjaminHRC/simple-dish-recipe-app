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
        $paginateDishes = Dish::orderBy('id', 'DESC')->paginate(10);

        $this->addFavoriteAttribute($paginateDishes); //@TODO: eager loading (withExists)

        return view('welcome', compact('paginateDishes'));
    }

    /**
     * Display a listing of the favorites resource.
     */
    public function favorites(): View
    {
        $paginateDishes = Dish::whereHas('users', function ($users) {
            $users->where('user_id', Auth::id());
        })->orderBy('id', 'DESC')->paginate(10);

        $this->addFavoriteAttribute($paginateDishes);

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
        $dish = new Dish($request->all()); //$request->validated()

        $dish->setAttribute('image', $request->file('image')->store('public/dishes'));
        $dish->save();

        // @TODO: passer par une notification qui contient un mailable
        Mail::to(Auth::user())->send(new DishCreated($dish)); // Pas le bon endroit --> Observer(bof) --> event / listeners

        // Toujours des redirections nommées (par nom de route)
        return redirect()->to('/');
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
        // Validated()
        $data = $request->all();
        // eviter la manipulation d'array
        $data['image'] = $request->file('image')->store('public/dishes');
        $dish->save($data);

        return redirect()->to('/');
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
        //@TODO: mettre dans un relation controller (voir méthode laravel orion)
        //@TODO: toggle ?
        $this->isFavorite($dish)
            ? $dish->users()->detach(Auth::id())
            : $dish->users()->attach(Auth::id());

        return redirect()->back();
    }

    //@TODO: a enlever
    private function addFavoriteAttribute($dishes): void
    {
        foreach ($dishes as $dish) {
            $this->isFavorite($dish);
        }
    }

    //@TODO: a enlever
    private function isFavorite($dish): bool
    {
        $isFavorite = false;

        //$dish->users()->contains(Auth::id())
        //dish->users()->whereKey(Auth::id())->exists()
        if (in_array(Auth::id(), $dish->users()->pluck('id')->toArray())) {
            $isFavorite = true;
        }

        return $dish->isFavorite = $isFavorite;
    }
}
