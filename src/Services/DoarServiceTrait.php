<?php

namespace Doar\Services;

trait DoarServiceTrait
{
	/**
	 * @access public
     * @param string $attribute
     * @param string|array $value
     *
     * @return $this
     */
	public function setAttribute($attribute, $value)
	{
		if (property_exists($this, $attribute))
		{
			if (is_array($this->{$attribute})) {
				$this->{$attribute}[] = $value;
			}  else {
				$this->{$attribute} = $value;
			}
		}
		
		return $this;
	}
}
