<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Facility;
use App\Models\Info;
use App\Models\TripCategory;
use App\Models\Page;
use App\Models\Deck;
use App\Models\Partner;
use App\Models\SliderPhoto;
use App\Models\Tripadvisor;
use App\Models\Unique;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Get all galleries with photos
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function galleries(Request $request)
    {
        $galleries = Gallery::with('galleryPhotos')->get();

        return response()->json([
            'success' => true,
            'data' => $galleries
        ]);
    }

    /**
     * Get all facilities
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function facilities(Request $request)
    {
        $facilities = Facility::all();

        return response()->json([
            'success' => true,
            'data' => $facilities
        ]);
    }

    /**
     * Get general information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function infos(Request $request)
    {
        $location = Info::where('key', 'location')->first();
        $mobile = Info::where('key', 'mobile')->first();
        $email = Info::where('key', 'email')->first();

        return response()->json([
            'success' => true,
            'data' => compact('location', 'mobile', 'email')
        ]);
    }

    /**
     * Get itineraries (trip categories with descriptions)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function itineraries(Request $request)
    {
        $tripCategories = TripCategory::with('itineraries')->get();

        return response()->json([
            'success' => true,
            'data' => $tripCategories
        ]);
    }

    /**
     * Get a specific page by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function page($id)
    {
        $page = Page::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $page
        ]);
    }

    /**
     * Get all decks
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function decks()
    {
        $decks = Deck::all();

        return response()->json([
            'success' => true,
            'data' => $decks
        ]);
    }

    /**
     * Get homepage content
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function homepage()
    {
        $sliderPhotos = SliderPhoto::all();
        $partners = Partner::all();
        $tripadvisor = Tripadvisor::all();
        $uniques = Unique::all();

        return response()->json([
            'success' => true,
            'data' => compact('sliderPhotos', 'partners', 'tripadvisor', 'uniques')
        ]);
    }
}
