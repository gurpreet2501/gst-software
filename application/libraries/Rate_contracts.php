<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate_contracts
{
	function __construct() {}

	// from date should be same ?
	// account should be same  => AAR Tech Engine
	// if date range 
	// should be in date 
	// quantity
	// if (QUINTALS) then count weight 
	// if BAG count bags in case max out 
	// get contract price

	private $record = [];
	private $quantity = 0;



	/**
	 * @var integer $accountId
	 * @var integer $stockItemId
	 * @var string  $fromDate start date of contract
	 * @var integer $quantity number of bags/quantiles
	 * @var string  $unit should be BAGS or quantiles
	 * @var string  $toDate (optional) End Date of contract 
	 */
	public function getRate($accountId, $stockItemId, $fromDate, $quantity, $unit, $toDate = null)
	{
		$item = $this->findContractsStockItems($accountId, $stockItemId, $fromDate, $quantity, $unit, $toDate);
		if (empty($item))
			return null;

		$this->record = $item;
		$this->quantity = $quantity;

		$stockItem = $item['matched_stock_item']['contract_id'];

		// if toDate is present the contract is based on date. so we dont need to check wight limit or bag limit.
		if (!empty($toDate))
			return $this->buildResp();

		
		
		// if BAG count bags in case max out 
		if ($unit === $item['contract_row']['unit'] &&  $unit == 'BAGS')
		{
			$bagCount = Models\GEStockItems::where('id', $stockItemId)->where()->get()->sum('bags');

			if (($bagCount + $quantity) > intval($item['contract_row']['quantity']))
			{
				return null;
			}
			else
			{
				return $this->buildResp();
			}
		}

		return null;
	}

	private function findContractsStockItems($accountId, $stockItemId, $fromDate, $quantity, $unit, $toDate = null)
	{
		if (empty($accountId) || empty($fromDate))
			return null;

		$rateContracts = Models\RateContracts::where('account_id', $accountId)->where('from_date', '>=', $fromDate);

		if (!empty($toDate))
		{
			$rateContracts->where('to_date', '<=', $toDate);
		}

		$rateContracts->with('contractsStockItems');

		$ret = null;
		foreach ($rateContracts->get()->toArray() as $items) 
		{
			foreach ($items['contracts_stock_items'] as $item)
			{
				if ($item['stock_item_id'] == $stockItemId)
				{
					$ret = [
						'contract_row' => $items,
						'matched_stock_item' => $item,
					];

					break;
				}
			}
		}

		return $ret;
	}

	public function buildResp()
	{
		return [
			'contract_id' => $this->record['matched_stock_item']['contract_id'],
			'rate' => ($this->record['matched_stock_item']['rate'] * $this->quantity)
		];
	}


  
}
