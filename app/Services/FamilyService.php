<?php

namespace App\Services;

use App\Model\Family;
use App\Model\TempFiles;

class FamilyService extends Service
{
    public function getFamilyByWhere($params)
    {
        $results = [];
        $results['draw'] = $params['draw'];
        $results['recordsTotal'] = Family::all()->count();
        $results['recordsFiltered'] = Family::all()->count();
        $results['data'] = Family::offset($this->_offset)
            ->orderBy($this->_sort_field, $this->_sort_type)
            ->limit($this->_length)
            ->get()
            ->toArray();

        return $results;
    }

    public function saveFamily($params)
    {
        $family = new Family();
        $family->name = strip_tags($params['name']);
        $family->age = intval($params['age']);
        $family->title = strip_tags($params['title']);
        $family->relationship = strip_tags($params['relationship']);
        $family->description = strip_tags($params['description']);
        $family->photo = $this->getPhotoInfo($params['temp_files']);
        $family->save();

        return $family->id;
    }


    private function getPhotoInfo($temp_files_id)
    {
        $photo_real_path = base_path('public/storage/photo/');
        $photo_save_path = '';
        $temp_files_id = intval($temp_files_id);
        if ($temp_files_id > 0) {
            $temp_files = TempFiles::find($temp_files_id);
            if (! empty($temp_files)) {
                if (! is_dir($photo_real_path)) {
                    @mkdir($photo_real_path, 0755, true);
                }
                $photo_save_path = '/storage/photo/' . $temp_files->filename;
                $photo_real_path .= $temp_files->filename;
                $photo_now_path = base_path('public/storage/') . $temp_files->filename;
                if (file_exists($photo_now_path)) {
                    @rename($photo_now_path, $photo_real_path);
                    TempFiles::destroy($temp_files_id);
                }
            }
        }

        return $photo_save_path;
    }
}
