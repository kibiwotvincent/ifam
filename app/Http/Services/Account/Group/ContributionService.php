<?php

namespace App\Http\Services\Account\Group;

use App\Models\Account\Contribution;
use App\Services\BaseService;

/**
 * Class ContributionService.
 */
class ContributionService extends BaseService
{
    /**
     * Service constructor.
     *
     * @param  Service  $contribution
     */
    public function __construct(Contribution $contribution)
    {
        $this->model = $contribution;
    }

    public function store(array $data = []): Contribution
    {
		$contribution = Contribution::create([
							'group_member_id' => $data['group_member_id'],
							'target_year' => $data['target_year'],
							'target_month' => $data['target_month'],
							'amount' => $data['amount'],
							'date_received' => $data['date_received'],
							'payment_mode' => $data['payment_mode'],
							'transaction_info' => $data['transaction_info'],
						]);
		
        return  $contribution;
    }
	
}
