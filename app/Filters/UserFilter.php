<?php

namespace App\Filters;

class UserFilter extends Filters
{

	/**
	 * Register filter properties
	 */
	protected $filters = [
		'date', 'role', 'keyword'
	];

	/**
	 * Filter by date.
	 */
	public function date($value) 
	{
		$date = split_daterange($value);

		return $this->builder->whereDate('created_at', '>=', $date['from'])
							->whereDate('created_at', '<=', $date['to']);	
	}

	/**
	 * Filter by category.
	 */
	public function role($value) 
	{
		return $this->builder->where('role', $value);
	}

	/**
	 * Filter by date range.
	 */
	public function keyword($value) 
	{
		return $this->builder
			->where(function ($query) use ($value) {
				$query->where('name', 'LIKE', "%{$value}%")		
					  ->orWhere('email', 'LIKE', "%{$value}%")
					  ->orWhere('phone', 'LIKE', "%{$value}%");
			});
	}

}