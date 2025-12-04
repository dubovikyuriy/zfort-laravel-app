<?php

namespace App\Http\Controllers;

use App\Actions\GetOpenAIPrompt;
use App\Actions\ListActors;
use App\Actions\ShowActorForm;
use App\Actions\SubmitActorData;
use App\Http\Requests\StoreActorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActorController extends Controller
{
    public function create(ShowActorForm $action): View
    {
        return $action->execute();
    }

    public function store(StoreActorRequest $request, SubmitActorData $action): RedirectResponse
    {
        try {
            $action->execute($request->validated());

            return redirect()
                ->route('actors.index')
                ->with('success', 'Actor processed successfully!');

        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                throw $e;
            }

            report($e);

            return back()
                ->withInput()
                ->withErrors(['general' => 'AI Service is currently unavailable. Please try again later.']);
        }
    }

    public function index(ListActors $action): View
    {
        return view('actors.index', [
            'actors' => $action->execute()
        ]);
    }

    public function promptValidation(GetOpenAIPrompt $action): JsonResponse
    {
        return response()->json([
            'message' => $action->execute(),
        ]);
    }
}
