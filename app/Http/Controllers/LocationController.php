<?php

namespace App\Http\Controllers;

use App\Dto\LocationDTO;
use App\Service\location\LocationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    public function showLocation(): Response
    {
        $locations = $this->locationService->findAll();
        return response()->view('locations.show', ['locations' => $locations]);
    }

    public function createLocation(): Response
    {
        return response()->view('locations.create');
    }

    public function create(Request $request): RedirectResponse
    {
        $location = new LocationDTO(
            $request->get('name'),
            $request->get('latitude'),
            $request->get('longitude')
        );
        $this->locationService->create($location);
        return redirect()->route('create')->with('success', 'Локация добавлена');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->locationService->delete($id);
        return redirect()->route('delete')->with('success', 'Локация удалена');
    }
}
