<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payload = $request->validate(["search"=>"string"]);
        if(isset($payload["search"])){
            $search = $payload["search"];
        }
        else{
            $search = null;
        }
        return view('chirps.index', [
            'chirps' =>
                Chirp::with('user')
                ->where('message', 'LIKE', '%'.$search.'%')
                ->latest()
                ->paginate(5)
                ->withQueryString(),
            'search'=>$search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $request->user()->chirps()->create($validated);
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $chirp->update($validated);
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
