<?php

namespace App\Base\Services;

use App\Models\ServiceRateLimit;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GoogleMapsService
{
   /**
    * Services to be used for places search text
    *
    * @var array
    */
   private $placesSearchTextServices = [
      'places.id', // free
      'places.formattedAddress', // basic
      'places.location', // basic
      'places.displayName', // basic
      'places.googleMapsUri', // basic
      'places.primaryTypeDisplayName', // basic
      'places.accessibilityOptions', // basic
      'places.photos', // basic
      'places.types', // basic
      'places.priceLevel', // advanced
      'places.currentOpeningHours', // advanced
      'places.websiteUri', // advanced
      'places.rating', // advanced
      'places.nationalPhoneNumber', // advanced
   ];

   /**
    * Force fresh data from the API
    *
    * @var bool
    */
   const FORCE_FRESH_DATA = true;

   /**
    * call a fetch method for a given endPoint
    *
    * @throws \Exception
    */
   public function fetch(string $endPoint, array $params): array
   {
      if (!method_exists($this, 'fetch_' . $endPoint)) {
         throw new \Exception("End point $endPoint not found");
      }

      if ($this->excededLimit($endPoint)) {
         return response()->json(['error' => 'Rate limit exceeded'], 429);
      }

      $results = $this->{'fetch_' . $endPoint}($params);

      // If this is not production, use the test data
      if (config('app.env') != 'production' && !self::FORCE_FRESH_DATA) {
         return $results;
      }

      $results->throwUnlessStatus(200);

      /**
       * If results come back with an error, there will be a structure like this
       * 
       * {
       *   "error": {
       *    "code": 400,
       *   "message": "Invalid request. Missing the 'query' parameter.",
       *  "status": "INVALID_ARGUMENT"
       * }
       * 
       * This can be used to provide a more user friendly error message
       */

      $this->setCurrentUsage($endPoint);

      return $results->json();
   }

   /**
    * Check if the usage of the endpoint is greater than the free tier limit
    */
   public function excededLimit(string $endPoint): bool
   {
      $config = config('ff.google.maps');

      $usage = $this->getCurrentUsage($endPoint);

      // if usage + cost of the endpoint is greater than the free tier limit, return false
      if ($usage + $config['rate_limits'][$endPoint] > $config['free_tier_limit']) {
         return true;
      }

      return false;
   }

   /**
    * Get the current usage of the endpoint
    */
   private function getCurrentUsage(string $endPoint): int
   {
      $serviceRateLimit = ServiceRateLimit::where('service', 'google_maps')
         ->where('endpoint', $endPoint)
         ->first();

      // This monthly credit resets on the first day of each month, at midnight Pacific time.
      // if the $serviceRateLimit->updated_at is not in the current month, reset the usage to 0
      if ($serviceRateLimit && $serviceRateLimit->updated_at->format('Y-m') != now()->format('Y-m')) {
         $serviceRateLimit->usage = 0;
         $serviceRateLimit->save();
      }

      return $serviceRateLimit->usage ?? 0;
   }

   /**
    * Set the current usage of the endpoint
    */
   private function setCurrentUsage(string $endPoint): void
   {
      $serviceRateLimit = ServiceRateLimit::firstOrCreate([
         'service' => 'google_maps',
         'endpoint' => $endPoint,
      ]);
      $serviceRateLimit->usage += config('ff.google.maps.rate_limits.' . $endPoint);
      $serviceRateLimit->save();
   }

   /**
    * ========================================
    * ============ Endpoints =================
    * ========================================
    */

   /**
    * Endpoint to fetch places using searchText
    
    * @param array ['textQuery' => 'coffee']
    */
   private function fetch_places_searchText(array $params): Response|array
   {
      // If this is not production, use the test data
      if (config('app.env') != 'production' && !self::FORCE_FRESH_DATA) {
         return Storage::json('test_data/google_maps_places_searchText.json');
      }

      return Http::withHeaders([
         'X-Goog-Api-Key' => config('ff.google.maps.api_key'),
         'Content-Type' => 'application/json',
         'X-Goog-FieldMask' => implode(',', $this->placesSearchTextServices),
      ])->post('https://places.googleapis.com/v1/places:searchText', [
         'minRating' => 0.5,
         ...$params
      ]);
   }
}
