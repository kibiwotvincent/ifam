<?php

namespace App\Http\Services\Account;

use App\Models\Account\SeasonRecord;
use App\Models\Account\SeasonRecordFile;
use App\Services\BaseService;

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
		
		//fill season events files
		/*foreach($data['files'] as $file) {
			RecordFile::create(['eventable_type' => SeasonRecord::MODEL_NAME, 'eventable_id' => $seasonRecord['id'], 'name' => $name]);
		}*/
		
        return  $seasonRecord;
    }

}
