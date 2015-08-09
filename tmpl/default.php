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

// no direct access
defined('_JEXEC') or die;

function runJavaScript($script) {
    $javascript .= 'if(window.addEventListener){ // Mozilla, Netscape, Firefox' . "\n";
    $javascript .= '    window.addEventListener("load", function(){ ' . $script . '}, false);' . "\n";
    $javascript .= '} else { // IE' . "\n";
    $javascript .= '    window.attachEvent("onload", function(){ ' . $script . '});' . "\n";
    $javascript .= '}';
    return $javascript;
}


$mois = [
	JText::_( "MOD_VERIFYAGE_MONTH_A" ),
	JText::_( "MOD_VERIFYAGE_MONTH_B" ),
	JText::_( "MOD_VERIFYAGE_MONTH_C" ),
	JText::_( "MOD_VERIFYAGE_MONTH_D" ),
	JText::_( "MOD_VERIFYAGE_MONTH_E" ),
	JText::_( "MOD_VERIFYAGE_MONTH_F" ),
	JText::_( "MOD_VERIFYAGE_MONTH_G" ),
	JText::_( "MOD_VERIFYAGE_MONTH_H" ),
	JText::_( "MOD_VERIFYAGE_MONTH_I" ),
	JText::_( "MOD_VERIFYAGE_MONTH_J" ),
	JText::_( "MOD_VERIFYAGE_MONTH_K" ),
	JText::_( "MOD_VERIFYAGE_MONTH_L" )
	];
$document = JFactory::getDocument();
?>
<div class="modal fade" id="datModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo JText::_( "MOD_VERIFYAGE_GUI_TITLE" );?></h4>
      </div>
      <div class="modal-body">
        <p>
		<?php 
			echo $myVars->get('warn_content');
		?>
        </p>
        <form class="form-inline" style="display:flex;">
        	<select name="day"
        		<?php
        			$fmt = $myVars->get('dateformat');
        			if($fmt==1)
        				echo 'style="order:1;">';
        			if($fmt==2)
        				echo 'style="order:3;">';
        			if($fmt==3 || $fmt==4)
        				echo 'style="order:2;">';
        		?>
              <option value="" disabled selected><?php echo 
	JText::_( "MOD_VERIFYAGE_GUI_DAY" );?></option>
              <?php
				for($i=1;$i<32;$i++){
                  echo "<option value=".sprintf("%02d", $i).">$i</option>";
                }
              ?>
          </select>
          <select name="month"
          		<?php
        			$fmt = $myVars->get('dateformat');
        			if($fmt==3)
        				echo 'style="order:3;">';
        			if($fmt==4)
        				echo 'style="order:1;">';
        			if($fmt==1 || $fmt==2)
        				echo 'style="order:2;">';
        		?>
              <option value="" disabled selected><?php echo 
	JText::_( "MOD_VERIFYAGE_GUI_MONTH" );?></option>
              <?php
				foreach($mois as $i=>$m){
                  echo "<option value=".sprintf("%02d", $i+1).">$m</option>";
                }
              ?>
          </select>
          
          <select name="year"
          		<?php
        			$fmt = $myVars->get('dateformat');
        			if($fmt==1 || $fmt==4)
        				echo 'style="order:3;">';
        			if($fmt==2 || $fmt==3)
        				echo 'style="order:1;">';
        		?>              
        		<option value="" disabled selected><?php echo 
	JText::_( "MOD_VERIFYAGE_GUI_YEAR" );?></option>
              <?php
				for($i=date("Y");$i>=1925;$i--){
                  echo "<option value=$i>$i</option>";
                }
              ?>
          </select>
        </form>
      </div>
      <div class="modal-footer">
		<?php if($myVars->get('redirect_user'))
			echo '<a href="'.$myVars->get('redirurl').'" type="button" class="btn btn-default ">'.
	JText::_( "MOD_VERIFYAGE_GUI_CANCEL" ).'</a>';
	?>
        <button id="validAge" type="button" class="btn btn-primary"><?php echo 
	JText::_( "MOD_VERIFYAGE_GUI_SUBMIT" );?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php


$cookies  = JFactory::getApplication()->input->cookie;
$ageCookie = $cookies->get('ageVerified');
//$inputCookie->set($name = 'myCookie', $value = '123', $expire = 0);
if ($ageCookie === null){
	$document->addScriptDeclaration(runJavaScript(	'jQuery("#datModal").modal("show");'));
}

$document->addScriptDeclaration(runJavaScript(
		'jQuery("#validAge").on("click",function(){'.
		  'day = jQuery("select[name=day]").val();'.
		  'month = jQuery("select[name=month]").val();'.
		  'year = jQuery("select[name=year]").val();'.
		  'if(day==null || month==null || year==null){alert("'.
	JText::_( "MOD_VERIFYAGE_GUI_INVALIDDATE" ).'");return false;}'.
		  'date = ""+year.toString()+"-"+month.toString()+"-"+day.toString();'.
		  'birth = Date.parse(date);'.
		  'today = new Date();'.
		  'age = (today-birth)/31536000000;'.
		  'if(age >= '.$myVars->get('count').'){'.
			'jQuery("#datModal").modal("hide");'.
			'if('.$myVars->get('set_cookie').'==1){'.
				'document.cookie="ageVerified=true";'.
			'}'.
		  '}'.
		  'else if('.$myVars->get('redirect_user').'==1)'.
			'window.location.replace("'.$myVars->get('redirurl').'");'.
		'});'
));

?>


