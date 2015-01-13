<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class NewsTwigExtension extends Twig_Extension {
	public function getName() {
		return 'News Twig Extension';
	}

	public function getFilters() {
		return array(
			'hasvideo' => new Twig_Filter_Method($this, 'hasVideo'),
			'linkify' => new Twig_Filter_Method($this, 'linkify'),
			'translate' => new Twig_Filter_Method($this, 'translate'),
		);
	}


	public function translate($date, $formatting) {
		setlocale(LC_ALL, "nl_NL");
		return strftime($formatting, strtotime($date));
	}


    public function hasVideo($input) {
    	if($input->section->handle!=="news") {
    		return FALSE;
    	}
    	
    	$myHasVideo = FALSE;
    	switch($input->type) {
    		case "newsitem":
				foreach ($input->body as $block) {
					$myHasVideo = $block->type == "youtube" || $myHasVideo;
				}
	    		break;

	    	case "legacyitem":
	    		$myHasVideo = strpos($input->legacyBody, "youtube.com/embed")!==FALSE;
	    		break;

	    	default:
	    		$myHasVideo = FALSE;
		}

    	return $myHasVideo;
    }


    public function linkify($input) {
    	return $input;
		return preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $input);
    }
}