<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complexes extends Model
{
    /*
     * Get all apartments to display in list
     */
    public function mainList($perPage = 10, $filters = null){

        $apartments = DB::table('apartament_descriptions')
            ->select('apartament_id', 'apartament_name')
            ->where('language_id', 1)
            ->paginate($perPage);

        return $apartments;
    }

    /*
     * Get from request inputs witch will add to description table
     */
    public function descriptionFromRequest($request){

        $description = $request->only([
            'apartament_name',
            'apartament_link',
            'apartament_additional_information',
        ]);

        $description['language_id'] = 1;
        $description['apartament_description'] = str_replace( "\n", '<br />', $request->input('apartament_description_begin'))
            ."<end/>".
            str_replace( "\n", '<br />', $request->input('apartament_description_else'));

        return $description;

    }

    /*
     * Get from request inputs witch will add to apartments table
     */
    public function apartmentFromRequest($request, $description){

        $description = array_keys($description);
        $description[] = "_token";
        $description[] = "apartament_id";
        $description[] = "apartament_description_begin";
        $description[] = "apartament_description_else";

        $apartment = $request->except($description);
        if($request->input('apartament_other_equipment')) $apartment['apartament_other_equipment'] = implode(", ", $request->input('apartament_other_equipment'));
        else $apartment['apartament_other_equipment'] = '';
        if($request->input('apartament_other_bathroom_equipment')) $apartment['apartament_other_bathroom_equipment'] = implode(", ", $request->input('apartament_other_bathroom_equipment'));
        else $apartment['apartament_other_bathroom_equipment'] = '';

        return $apartment;

    }

    /*
     * Get apartaments to edit form
     */
    public function apartmentToEdit($id){

        $apartment = DB::table('apartament_descriptions')
            ->join('apartaments', 'apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->where('apartament_id', $id)
            ->where('language_id', 1)
            ->first();

        $firstParagraphEndsPosition = strpos($apartment->apartament_description, '<end/>');
        $apartment->apartament_description_begin = substr($apartment->apartament_description, 0, $firstParagraphEndsPosition);

        // +6 because of <end/>
        $apartment->apartament_description_else = substr($apartment->apartament_description, $firstParagraphEndsPosition+6);

        return $apartment;
    }

    /*
     * Insert apartment
     */
    public function saveNew($request){

        $description = $this->descriptionFromRequest($request);

        $apartment = $this->apartmentFromRequest($request, $description);

        //dd($description);

        try{
            $description['apartament_id'] = DB::table('apartaments')
                ->insertGetId($apartment);

            DB::table('apartament_descriptions')
                ->insert($description);


        }catch(Exception $e){
            dd($e);
        }

    }

    /*
     * Update apartment
     */
    public function saveChanges($request){

        $apartmentId = $request->input('apartament_id');

        $description = $this->descriptionFromRequest($request);

        $apartment = $this->apartmentFromRequest($request, $description);

        try{
            DB::table('apartament_descriptions')
                ->where('apartament_id', $apartmentId)
                ->where('language_id', 1)
                ->update($description);

            DB::table('apartaments')
                ->where('id', $apartmentId)
                ->update($apartment);

        }catch(Exception $e){
            dd($e);
        }

    }

    /*
     * Get all photos to display in list
     */
    public function apartmentPhotos($id){

        $photos = DB::table('apartament_photos')
            ->where('apartament_id', $id)
            ->get();

        return $photos;
    }

    /*
     * Get main photo
     */
    public function apartmentMainPhoto($id){

        $mainPhoto = DB::table('apartament_photos')
            ->select('id')
            ->where('apartament_id', $id)
            ->where('main_photo', 1)
            ->first();

        return $mainPhoto->id;
    }

    public function saveApartmentPhotos($request){

        $photoLinks = array_values($request->except(['_token', 'apartmentId', 'mainPhoto']));

        try{
            DB::table('apartament_photos')
                ->where('apartament_id', $request->apartmentId)
                ->delete();

            foreach($photoLinks as $photoLink){
                DB::table('apartament_photos')
                    ->insert([
                        'apartament_id' => $request->apartmentId,
                        'photo_link' => $photoLink
                    ]);
            }

        }catch(Exception $e){
            dd($e);
        }

    }

    public function checkMainImgChanged($oldMainPhotoId, $apartmentId){

        if($this->apartmentMainPhoto($apartmentId) == $oldMainPhotoId) return false;
        else return true;

    }

    public function getMainImgLink($newMainPhotoId, $apartmentId){

        $mainPhotoLink = DB::table('apartament_photos')
            ->select('photo_link')
            ->where('apartament_id', $apartmentId)
            ->where('id', $newMainPhotoId)
            ->first();

        return $mainPhotoLink->photo_link;

    }

    public function changeMainImg($mainImgLink, $apartmentId){

        try{
            DB::table('apartament_photos')
                ->where('apartament_id', $apartmentId)
                ->update(['main_photo' => 0]);

            DB::table('apartament_photos')
                ->where('apartament_id', $apartmentId)
                ->where('photo_link', $mainImgLink)
                ->update(['main_photo' => 1]);

        }catch(Exception $e){
            dd($e);
        }

    }

    public function resizeMainImg($mainImgLink, $apartmentId){
// "http://dev.otozakopane.com"."/images/apartaments/$apartmentId/$mainImgLink"

        //$img = imagecreatefromfile("http://dev.otozakopane.com"."/images/apartaments/$apartmentId/$mainImgLink");
        $img = imagecreate(12, 12);
        $min = imagescale($img, 100);
        dd($min);

    }

    /*
     * Get all prices to display in list
     */
    public function apartmentPrices($id, $perPage = 30){

        $photos = DB::table('apartament_prices')
            ->select('price_value', 'date_of_price')
            ->where('apartament_id', $id)
            ->where('date_of_price', '>', date('now'))
            ->paginate($perPage);

        return $photos;
    }
}
