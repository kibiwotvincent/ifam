<?php

namespace App\Http\Services\Account;

use App\Services\BaseService;
use App\Models\Account\SeasonRecord;
use App\Models\Account\SeasonRecordFile;
use Storage;

/**
 * Class SeasonRecordService.
 */
class SeasonRecordService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $seasonRecord
     */
    public function __construct(SeasonRecord $seasonRecord)
    {
        $this->model = $seasonRecord;
    }

    public function store(array $data = []): SeasonRecord
    {
		$seasonRecord = SeasonRecord::create([
			'season_id' => $data['season_id'],
			'title' => $data['title'],
			'summary' => $data['summary'],
			'record_date' => $data['record_date'],
		]);
		
		$request = request();
		//fill season records files
		for($i = 1; $i <= 5; $i++) {
			if($request->hasfile('record_file_'.$i)) {
				$imagePath = $request->file('record_file_'.$i)->store('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER);
				$imageName = isset(explode('/', $imagePath)[2]) ? explode('/', $imagePath)[2] : null;
				if($imageName != null) {
					SeasonRecordFile::create([
						'season_record_id' => $seasonRecord['id'],
						'name' => $imageName
					]);
				}
			}
		}
		
        return  $seasonRecord;
    }
	
	/**
     * Update season record.
     *
     * @param  array
     * @return \App\Models\Account\SeasonRecord
     */
    public function update(array $data = []): SeasonRecord
    {
		$seasonRecord = SeasonRecord::find($data['season_record_id']);
		
		$request = request();
		//upload season records files
		for($i = 1; $i <= 5; $i++) {
			if($request->hasfile('record_file_'.$i)) {
				$imagePath = $request->file('record_file_'.$i)->store('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER);
				$imageName = isset(explode('/', $imagePath)[2]) ? explode('/', $imagePath)[2] : null;
				if($imageName != null) {
					SeasonRecordFile::create([
						'season_record_id' => $seasonRecord['id'],
						'name' => $imageName
					]);
				}
			}
		}
		
		$seasonRecord->title = $data['title'];
		$seasonRecord->summary = $data['summary'];
		$seasonRecord->record_date = $data['record_date'];
		$seasonRecord->save();
		
		return $seasonRecord;
	}
	
	/**
     * Delete season record.
     *
     * @param  int $seasonRecordID
     * @return bool
     */
    public function delete($seasonRecordID)
    {
		return SeasonRecord::find($seasonRecordID)->delete();
	}
	
	/**
     * Permanently delete season record.
     *
     * @param  int $seasonRecordID
     * @return bool
     */
    public function destroy($seasonRecordID)
    {
		$seasonRecord = SeasonRecord::withTrashed()->find($seasonRecordID);
		
		$this->deleteSeasonRecordFiles($seasonRecord);
		//delete files from database
		$seasonRecord->files()->delete();
		
		return $seasonRecord->forceDelete();
	}
	
	/**
     * Restore deleted season record.
     *
     * @param  int $seasonRecordID
     * @return bool
     */
    public function restore($seasonRecordID)
    {
		return SeasonRecord::withTrashed()->find($seasonRecordID)->restore();
	}
	
	/**
     * Permanently delete season record file.
     *
     * @param  int $seasonRecordID
     * @return bool
     */
    public function destroySeasonRecordFile($seasonRecordFileID)
    {
		$seasonRecordFile = SeasonRecordFile::find($seasonRecordFileID);
		
		$this->deleteSeasonRecordFile($seasonRecordFile->name);
		
		return $seasonRecordFile->delete();
	}
	
	/**
     * Delete season record files if it exist
     *
     * @param  \App\Models\Account\SeasonRecord $seasonRecord
     * @return bool
     */
    public function deleteSeasonRecordFiles($seasonRecord)
    {
		if($seasonRecord->files()->count() > 0) {
			//delete files from server
			foreach($seasonRecord->files as $file) {
				if(Storage::exists('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$file['name'])){
					Storage::delete('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$file['name']);
				}
			}
		}
	}
	
	/**
     * Delete season record file if it exists
     *
     * @param  str $seasonRecordFileName
     * @return bool
     */
    public function deleteSeasonRecordFile($seasonRecordFileName)
    {
		//delete file from server
		if(Storage::exists('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$seasonRecordFileName)){
			Storage::delete('public/'.SeasonRecord::SEASON_RECORD_FILES_FOLDER.'/'.$seasonRecordFileName);
		}
	}

}
