<?php


namespace App;

use ReflectionException;

trait RecordsActivity {

	/**
	 * Called for all models with the trait
	 */
	protected static function bootRecordsActivity () {
		if (auth()->guest()) return;
		foreach (self::getActivitiesToRecord() as $event) {
			static::created(function ($model) use ($event) {
				$model->recordActivity($event);
			});
		}

		static::deleting(function ($model) {
			$model->activity()->delete();
		});
	}

	/**
	 * @return array
	 */
	protected static function getActivitiesToRecord () {
		return ['created'];
	}

	/**
	 * @param $event
	 *
	 * @throws ReflectionException
	 */
	protected function recordActivity ($event) {
		$this->activity()->create([
			'user_id' => auth()->id(),
			'type'    => $this->getActivityType($event),
		]);
	}

	/**
	 * @return mixed
	 */
	public function activity () {
		return $this->morphMany(Activity::class, 'subject');
	}

	/**
	 * @param $event
	 *
	 * @return string
	 * @throws ReflectionException
	 */
	protected function getActivityType ($event): string {
		$type = strtolower((new \ReflectionClass($this))->getShortName());

		return "{$event}_{$type}";
	}
}