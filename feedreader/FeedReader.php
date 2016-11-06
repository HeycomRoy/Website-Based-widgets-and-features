<?php

class FeedReader
{
	protected $config = array(
		'feed' => null,
		'cache_dir' => null,
		'cache_time' => 3600,
		'stream' => null
	);
	
	public function __construct($config)
	{
		$this->config = array_merge($this->config, $config);
	}
	
	public function getXML()
	{
		$this->_fetch();
		return $this->xml;
	}
	
	private function _fetch()
	{
		$cache_file = realpath($this->config['cache_dir']).'/'.md5($this->config['feed']);
		
		if (file_exists($cache_file) && filemtime($cache_file) > (time() - $this->config['cache_time'])) {
			$file = file_get_contents($cache_file);
			$this->xml = new SimpleXMLElement($file);
		} else {
			$file = file_get_contents($this->config['feed'], null, $this->config['stream']);
			$this->xml = new SimpleXMLElement($file);
			
			if ($this->config['cache_dir']) {
				if ($fp = fopen($cache_file, 'w')) {
					fwrite($fp, $this->xml->saveXML());
					fclose($fp);
				}
			}
		}
	}
}

?>