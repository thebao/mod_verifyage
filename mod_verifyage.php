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

 
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
 
modVerifyAgeHelper::load_jquery($params);
modVerifyAgeHelper::load_bootstrap($params);
$myVars = modVerifyAgeHelper::getVerif($params);
require JModuleHelper::getLayoutPath('mod_verifyage');