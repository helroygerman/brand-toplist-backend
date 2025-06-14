<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Toplist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ToplistController extends Controller
{
    public function index(Request $request)
    {
       // $this->generateDefaultToplist();
       $country = $request->header('CF-IPCountry') ?? 'XX';

    $toplist = Toplist::where('country_code', $country)->first();

    // Fallback to 'XX' if the exact country is not found
    if (!$toplist) {
        $toplist = Toplist::where('country_code', 'XX')->first();
    }

    $brands = Brand::whereIn('brand_id', $toplist->brand_ids ?? [])->get();

    return response()->json([
        'country' => $country,
        'brands' => $brands,
    ]);
    }

    /**
     * Validate ISO-2 country code format
     */
    private function isValidCountryCode(?string $code): bool
    {
        return $code && 
               is_string($code) && 
               strlen($code) === 2 && 
               ctype_alpha($code) &&
               $code !== 'XX'; // Cloudflare uses XX for unknown countries
    }

    /**
     * Generate a default toplist if it doesn't exist
     * This method is called to ensure that there is always a toplist available
     * for the default country code 'XX'.
     *
     * @return Toplist|null
     */

    public static function generateDefaultToplist()
    {
        $brands = Brand::orderBy('rating', 'desc')->get();
        
        // Check if a toplist for country_code 'XX' already exists
        $toplist = Toplist::where('country_code', 'XX')->first();

        if (!$toplist) {
            // Create new toplist if it doesn't exist
            if ($brands->count() > 0) {
            return Toplist::create([
                'country_code' => 'XX', // Default toplist
                'brand_ids' => $brands->pluck('brand_id')->toArray()
            ]);
            }
        } else {
            // Update toplist to include any new brands not already present
            $existingBrandIds = is_array($toplist->brand_ids) ? $toplist->brand_ids : [];
            $allBrandIds = $brands->pluck('brand_id')->toArray();
            $newBrandIds = array_unique(array_merge($existingBrandIds, $allBrandIds));
            if ($newBrandIds !== $existingBrandIds) {
            $toplist->brand_ids = $newBrandIds;
            $toplist->save();
            }
        }
        
        return null;
    }

  
}
