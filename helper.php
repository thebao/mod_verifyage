<?php
/*------------------------------------------------------------------------
# mod_verifyage - Verify Age
# ------------------------------------------------------------------------
# author    Theo Hennessy
# Copyright (C) 2015 www.theohennessy.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.theohennessy.com
# Technical Support:  http://www.theohennessy.com/support
-------------------------------------------------------------------------*/

class modVerifyAgeHelper
{ 
    /**
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getVerif(&$params)
    {
		return $params;
    }
	
	public function load_jquery(&$params)
 	{       	 
		$doc = &JFactory::getDocument();		 
		$app = &JFactory::getApplication();	 
		static $jqLoaded;		 
		if ($jqLoaded) {		 
			return;		 
		} 
	 
		if ($params->get('load_jquery') && !$app->get('jQuery')){         
	 
			$file = JURI::root(true).'/modules/mod_verifyage/assets/jquery/jquery.min.js';			 
			$app->set('jQuery',1);			 
			$doc->addScript($file);			 
			$doc->addScriptDeclaration("jQuery.noConflict();");			 
			$jqLoaded = TRUE;	 
		}
	 
	}
	
		public function load_bootstrap(&$params)
 	{       	 
		$doc = &JFactory::getDocument();		 
		$app = &JFactory::getApplication();	 
		static $bsLoaded;		 
		if ($bsLoaded) {		 
			return;		 
		} 
	 
		if ($params->get('load_bootstrap')){         
			$js = JURI::root(true).'/modules/mod_verifyage/assets/bootstrap/bootstrap.min.js';	
			$css = JURI::root(true).'/modules/mod_verifyage/assets/bootstrap/bootstrap.min.css';		 
			$app->set('bootstrap',1);			 
			$doc->addScript($js);	
			$doc->addStyleSheet($css);
			$bsLoaded = TRUE;	 
		}
	 
	}
	
}
