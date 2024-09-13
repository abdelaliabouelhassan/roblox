<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
Route::get('/', function () {
   
   
    $games = [
        [
            'id' => '4777817887',
            'tags' => ['QA', 'Testing', 'Roblox']
        ],
        [
            'id' => '3476371299',
            'tags' => ['Programming', 'Coding', 'Scripting']
        ],
        [
            'id' => '2937673012',
            'tags' => ['Game Design', 'Development']
        ]
    ];
    
    // Extract only the game IDs for the API request
    $gameIds = array_column($games, 'id');
    
    // Fetch game data from Roblox API
    $response = Http::get('https://games.roblox.com/v1/games', [
        'universeIds' => implode(',', $gameIds),
    ]);
    
    if (!$response->ok()) {
        return response()->json(['error' => 'Unable to fetch game data'], 500);
    }
    
    $gamesData = $response->json();
    $gamesWithImages = [];
    
    // Loop through games data from API response
    foreach ($gamesData['data'] as $game) {
        $id = $game['id'];
        $name = $game['name'];
        $playing = $game['playing'];
        $visits = $game['visits'];
        $favoritedCount = $game['favoritedCount'];
        $rootPlaceId = $game['rootPlaceId'];
    
        // Fetch the tags associated with the current game ID
        $gameTags = collect($games)->firstWhere('id', $id)['tags'] ?? [];
    
        // Check if the image URL is cached
        $cacheKey = "roblox_game_image_{$id}";
        $thumbnailUrl = Cache::get($cacheKey);
    
        if (!$thumbnailUrl) {
            // Fetch media data
            $mediaResponse = Http::get("https://games.roblox.com/v2/games/{$id}/media");
    
            if ($mediaResponse->ok()) {
                $mediaData = $mediaResponse->json();
                $imageId = $mediaData['data'][0]['imageId'] ?? null;
    
                if ($imageId) {
                    // Fetch thumbnail image
                    $thumbnailResponse = Http::get("https://thumbnails.roblox.com/v1/games/{$id}/thumbnails", [
                        'thumbnailIds' => $imageId,
                        'size' => '768x432',
                        'format' => 'Png',
                        'isCircular' => 'false',
                    ]);
    
                    if ($thumbnailResponse->ok()) {
                        $thumbnailData = $thumbnailResponse->json();
                        $thumbnailUrl = $thumbnailData['data'][0]['imageUrl'] ?? null;
    
                        // Cache the image URL for 2 weeks
                        if ($thumbnailUrl) {
                            Cache::put($cacheKey, $thumbnailUrl, 20160); // Cache for 2 weeks
                        }
                    }
                }
            }
        }
    
        // Add the game details along with tags to the final array
        $gamesWithImages[] = [
            'id' => $id,
            'name' => $name,
            'image' => $thumbnailUrl,
            'playing' => $playing,
            'visits' => $visits,
            'favoritedCount' => $favoritedCount,
            'rootPlaceId' => $rootPlaceId,
            'tags' => $gameTags // Include the tags
        ];
    }

     $gamesWithImages;
    
    // Return the view and pass the data to your Vue.js component
    return view('welcome', compact('gamesWithImages'));
  

});
