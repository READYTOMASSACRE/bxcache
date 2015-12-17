<?php

namespace marvin255\bxcache;

class CPhpCache implements ICache
{
	/**
	 * @param int
	 */
	protected $_defaultTime = 3600;


	/**
	 * @param string $key
	 * @param mixed $data
	 */
	public function set($key, $data, $duration = null)
	{
		$this->delete($key);
		$time = $duration !== null ? (int) $duration : $this->getDefaultTime();
		$obCache = new \CPHPCache();
		$obCache->InitCache($time, $key, '/' . md5($key));
		$obCache->StartDataCache();
		$obCache->EndDataCache($data);
	}
	
	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		$obCache = new \CPHPCache();
		if ($obCache->InitCache($this->getDefaultTime(), $key, '/' . md5($key))) {
			return $obCache->GetVars();
		} else {
			return false;
		}
	}
	
	/**
	 * @param string $key
	 */
	public function delete($key)
	{
		$obCache->InitCache($this->getDefaultTime(), $key, '/' . md5($key));
		return \BXClearCache(md5($key));
	}
	
	/**
	 * @param string $key
	 * @return bool
	 */
	public function exists($key)
	{
		$obCache = new \CPHPCache();
		return (bool) $obCache->InitCache($this->getDefaultTime(), $key, '/' . md5($key));
	}

	/**
	 * @param int $time
	 */
	public function setDefaultTime($time)
	{
		$this->_defaultTime = (int) $time;
	}

	/**
	 * @return int
	 */
	public function getDefaultTime()
	{
		return $this->_defaultTime;
	}
}