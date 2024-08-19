<?php

namespace SevenShores\Hubspot\Utils;

/**
 * Class Timestamp
 *
 * This utility class provides methods related to timestamps.
 *
 * @package SevenShores\Hubspot\Utils
 */
class Timestamp{
	/**
	 * Returns the current timestamp with milliseconds.
	 *
	 * This method retrieves the current time as a timestamp, including milliseconds.
	 *
	 * @return int
	 */
	public static function getCurrentTimestampWithMilliseconds(): int{
		return (int)(microtime(true) * 1000);
	}
}