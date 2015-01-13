<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class YoutubeTwigExtension extends Twig_Extension {
	public function getName() {
		return 'Youtube Embed Twig Extension';
	}

	public function getFilters() {
		return array(
			'youtubeEmbed' => new Twig_Filter_Method($this, 'youtubeEmbed'),
			'youtubeId' => new Twig_Filter_Method($this, 'youtubeId'),
			'youtubeUrl' => new Twig_Filter_Method($this, 'youtubeUrl'),
			'youtubeThumbnail' => new Twig_Filter_Method($this, 'youtubeThumbnail')
		);
	}

	private function parseUrl($url) 
	{
		$parts = parse_url($url);
		if(isset($parts['query']))
		{
		    parse_str($parts['query'], $qs);
		    if(isset($qs['v']))
		    {
				return $qs['v'];
		    } 
		    else if($qs['vi'])
		    {
				return $qs['vi'];
		    }
		}

		if(isset($parts['path']))
		{
		    $path = explode('/', trim($parts['path'], '/'));
		    return $path[count($path)-1];
		}

		return NULL;
   	}


	public function youtubeId($input) {
		$myId = $this->parseUrl($input);
		return $myId;
	}


    public function youtubeUrl($input) 
    {
    	$myId = $this->parseUrl($input);
    	if(!isset($myId)) {
    		return FALSE;
    	}

    	return '//www.youtube.com/embed/'. $myId;
    }


    public function youtubeThumbnail($input, $retina=TRUE) 
    {
    	$myId = $this->parseUrl($input);
    	if(!isset($myId)) {
    		return FALSE;
    	}

    	if($retina===TRUE) {
			return '//img.youtube.com/vi/'. $myId .'/maxresdefault.jpg';
    	}

		return '//img.youtube.com/vi/'. $myId .'/hqdefault.jpg';
    }
}