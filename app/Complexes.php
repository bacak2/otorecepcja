<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complexes extends Model
{
    /*
     * Get all complexes to display in list
     */
    public function mainList($perPage = 10, $filters = null){

        $apartments = DB::table('apartament_group_descriptions')
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

        return $apartment;

    }

    /*
     * Get apartaments to edit form
     */
    public function apartmentToEdit($id){

        $apartment = DB::table('apartament_group_descriptions')
            ->join('apartament_groups', 'apartament_groups.group_id', '=', 'apartament_group_descriptions.apartament_id')
            ->where('group_id', $id)
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
        $apartmentInfo = $this->getApartmentToMerge($apartment['apartments']);
        $apartment['apartaments_amount'] = count($apartment['apartments']);

        $apGroups = DB::table('apartament_groups')
            ->selectRaw('MAX(group_id) AS maxId')
            ->first();

        $groupId = $apGroups->maxId + 1;
        $apartment['group_id'] = $groupId;
        $description['apartament_id'] = $groupId;

        $this->updateApartmentGroupId($apartment['apartments'], $groupId);

        unset($apartment['apartments']);
        $apartment = array_merge($apartment, $apartmentInfo);

        try{
            DB::table('apartament_groups')
                ->insert($apartment);

            DB::table('apartament_group_descriptions')
                ->insert($description);


        }catch(Exception $e){
            dd($e);
        }

    }

    /*
     * Update apartment
     */
    public function saveChanges($request){

        $unselectedId = array_diff(explode(", ", $request->input('mergedIds')), $request->input('apartments'));
        $this->updateApartmentGroupId($unselectedId, 0);

        $groupId = $request->input('apartament_id');

        $description = $this->descriptionFromRequest($request);

        $apartment = $this->apartmentFromRequest($request, $description);
        $this->updateApartmentGroupId($apartment['apartments'], $groupId);
        $apartmentInfo = $this->getApartmentToMerge($apartment['apartments']);
        $apartment['apartaments_amount'] = count($apartment['apartments']);

        unset($apartment['apartments']);
        unset($apartment['mergedIds']);
        $apartment = array_merge($apartment, $apartmentInfo);

        try{
            DB::table('apartament_group_descriptions')
                ->where('apartament_id', $groupId)
                ->where('language_id', 1)
                ->update($description);

            DB::table('apartament_groups')
                ->where('group_id', $groupId)
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

    public function availableApartments(array $idGroup){

        return DB::table('apartaments')
            ->join('apartament_descriptions', 'apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->whereIn('group_id', $idGroup)
            ->where('language_id', 1)
            ->pluck('apartament_name', 'apartaments.id');
    }

    public function selectedApartments($idGroup){

        $result = DB::table('apartaments')
            ->select('apartaments.id')
            ->join('apartament_descriptions', 'apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->where('group_id', $idGroup)
            ->where('language_id', 1)
            ->pluck('apartaments.id');

        return $result->toArray();
    }

    public function allApartmentIds($idGroup){

        $result = DB::table('apartaments')
            ->select('apartaments.id')
            ->join('apartament_descriptions', 'apartaments.id', '=', 'apartament_descriptions.apartament_id')
            ->whereIn('group_id', [$idGroup, 0])
            ->where('language_id', 1)
            ->pluck('apartaments.id');

        return $result->toArray();
    }

    public function updateApartmentGroupId($apartmentIds, $groupId){

        DB::table('apartaments')
            ->whereIn('id', $apartmentIds)
            ->update([
                'group_id' => $groupId
            ]);

    }

    public function getApartmentToMerge($apartmentsId){

        $data = DB::table('apartaments')
            ->selectRaw('
                SUM(apartament_persons) as apartament_persons,
                MAX(apartament_kids) as apartament_kids,
                SUM(apartament_rooms_number) as apartament_rooms_number,
                SUM(apartament_intransitive_rooms) as apartament_intransitive_rooms,
                SUM(apartament_single_beds) as apartament_single_beds,
                SUM(apartament_double_beds) as apartament_double_beds,
                SUM(apartament_bathrooms) as apartament_bathrooms,
                SUM(apartament_bedrooms) as apartament_bedrooms,
                SUM(apartament_living_area) as apartament_living_area,
                MAX(apartament_floors_number) as apartament_floors_number,
                MAX(apartament_levels_number) as apartament_levels_number,
                MAX(apartament_spa) as apartament_spa,
                MAX(apartament_animals) as apartament_animals,
                MAX(apartament_wifi) as apartament_wifi,
                MAX(apartament_parking) as apartament_parking,
                MAX(apartament_tv) as apartament_tv,
                MAX(apartament_vaccum_cleaner) as apartament_vaccum_cleaner,
                MAX(apartament_fireplace) as apartament_fireplace,
                MAX(apartament_balcony) as apartament_balcony,
                MAX(apartament_kid_beds) as apartament_kid_beds,
                MAX(apartament_fridge) as apartament_fridge,
                MAX(apartament_cooker) as apartament_cooker,
                MAX(apartament_washing_machine) as apartament_washing_machine,
                MAX(apartament_electric_kettle) as apartament_electric_kettle,
                MAX(apartament_microvawe_owen) as apartament_microvawe_owen,
                MAX(apartament_shower_cabin) as apartament_shower_cabin,
                MAX(apartament_hair_dryer) as apartament_hair_dryer,
                MAX(apartament_elevator) as apartament_elevator,
                MAX(apartament_iron) as apartament_iron,
                MAX(apartament_toaster) as apartament_toaster,
                MAX(apartament_washer) as apartament_washer,
                MAX(apartament_bathtub) as apartament_bathtub,
                MAX(apartament_other_equipment) as apartament_other_equipment,
                MAX(apartament_other_bathroom_equipment) as apartament_other_bathroom_equipment
            ')
            ->whereIn('apartaments.id', $apartmentsId)
            ->first();

        return (array)$data;

    }

}
