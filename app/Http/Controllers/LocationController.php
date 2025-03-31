<?php

namespace App\Http\Controllers;

use App\Dto\LocationDTO;
use App\Service\location\LocationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function findAllLocation(): Collection
    {
        return $this->locationService->findAll();
    }

    public function delete(int $id): RedirectResponse
    {
        $value = $this->locationService->delete($id);
        if ($value) {
            return redirect()->route('delete_location')->with('success', 'Локация удалена');
        }
        return redirect()->route('error')->with('false', 'Локация не найдена');
    }
}
