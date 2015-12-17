<?php

namespace marvin255\bxcache;

interface ICache
{
	/**
	 * @param string $key
	 * @param mixed $data
	 */
	public function set($key, $data, $duration = null);
	
	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);
	
	/**
	 * @param string $key
	 */
	public function delete($key);
	
	/**
	 * @param string $key
	 * @return bool
	 */
	public function exists($key);

	/**
	 * @param int $time
	 */
	public function setDefaultTime($time);

	/**
	 * @return int
	 */
	public function getDefaultTime();
}