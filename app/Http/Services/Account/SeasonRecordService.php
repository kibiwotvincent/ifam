<?php

namespace App\Http\Services\Account;

use App\Services\BaseService;
use App\Models\Account\SeasonRecord;
use App\Models\Account\SeasonRecordFile;

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
				$imagePath = $request->file('record_file_'.$i)->store('public/season-record-files');
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

}
