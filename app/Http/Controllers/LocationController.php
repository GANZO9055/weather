<?php

namespace App\Http\Controllers;

use App\Dto\LocationDTO;
use App\Service\location\LocationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController
{
    private LocationService $locationService;

    /**
     * @param LocationService $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index(): Response
    {
        $locations = $this->locationService->getAllLocation();
        return response()->view('locations.index', ['locations' => $locations]);
    }

    public function createLocation(): Response
    {
        return response()->view('locations.create');
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $location = new LocationDTO(
            $request->get('name'),
            $request->get('user_id'),
            $request->get('latitude'),
            $request->get('longitude')
        );
        $this->locationService->addLocation($location);
        return redirect()->route('create')->with('success', 'Локация добавлена');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->locationService->deleteLocation($id);
        return redirect()->route('delete')->with('success', 'Локация удалена');
    }
}
