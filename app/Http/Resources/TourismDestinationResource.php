<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TourismDestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->image;
        $imageUrl = null;

        if ($image) {
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                $imageUrl = $image;
            } else {
                $imagePath = ltrim($image, '/');

                if (Storage::disk('public')->exists($imagePath)) {
                    $imageUrl = asset('storage/' . $imagePath);
                } elseif (Storage::disk('public')->exists('tourism/' . $imagePath)) {
                    $imageUrl = asset('storage/tourism/' . $imagePath);
                } elseif (file_exists(public_path($imagePath))) {
                    $imageUrl = asset($imagePath);
                } elseif (file_exists(public_path('storage/' . $imagePath))) {
                    $imageUrl = asset('storage/' . $imagePath);
                } elseif (file_exists(public_path('storage/tourism/' . $imagePath))) {
                    $imageUrl = asset('storage/tourism/' . $imagePath);
                } else {
                    $imageUrl = asset('storage/' . $imagePath);
                }
            }
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'long_description_en' => $this->long_description_en,
            'long_description_ar' => $this->long_description_ar,
            'location_en' => $this->location_en,
            'location_ar' => $this->location_ar,
            'duration_en' => $this->duration_en,
            'duration_ar' => $this->duration_ar,
            'price' => $this->price,
            'rating' => $this->rating,
            'image' => $image,
            'image_url' => $imageUrl,
            'images' => $this->images,
            'features_en' => $this->features_en,
            'features_ar' => $this->features_ar,
            'includes_en' => $this->includes_en,
            'includes_ar' => $this->includes_ar,
            'not_includes_en' => $this->not_includes_en,
            'not_includes_ar' => $this->not_includes_ar,
            'itinerary_en' => $this->itinerary_en,
            'itinerary_ar' => $this->itinerary_ar,
            'basic_info' => $this->basic_info,
            'contact_info' => $this->contact_info,
            'payment_methods' => $this->payment_methods,
            'region' => $this->region,
            'trip_code' => $this->trip_code,
            'available_to' => $this->available_to,
            'person_prices' => $this->person_prices,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
