<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class GPlus extends Module
{	
	function __construct()
	{
		$this->name = 'gplus';
		$this->tab = 'social_networks';
		$this->version = '1.2';
		$this->author = 'jorgevrgs';
		$this->displayName = $this->l('Google +1');

		parent::__construct();

		$this->description = $this->l('Integra el boton Google +1 en su tienda');
		$this->confirmUninstall = $this->l('Esta seguro que quiere borrar sus detalles?');
	}

	function install()
	{
		if (!parent::install() || !$this->registerHook('header') || !$this->registerHook('home') || !$this->registerHook('footer'))
			return false;
		return true;
	}
	
	function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitGPlus') AND ($gplus_size = Tools::getValue('gplus_size')) AND ($gplus_annotation = Tools::getValue('gplus_annotation')) )
		{
			$gplus_size = htmlentities($gplus_size, ENT_COMPAT, 'UTF-8');
			Configuration::updateValue('GPLUS_SIZE', $gplus_size);
			
			$gplus_annotation = htmlentities($gplus_annotation, ENT_COMPAT, 'UTF-8');
			Configuration::updateValue('GPLUS_ANNOTATION', $gplus_annotation);
			
			$output .= '
			<div class="conf confirm">
				<img src="../img/admin/ok.gif" alt="" title="" />
				'.$this->l('Configuracion actualizada').'
			</div>';
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset><legend>'.$this->l('Configuracion').'</legend>
			
				<label>'.$this->l('Tamano').'</label>
				<div class="margin-form">
					<SELECT name="gplus_size" cols="90" rows="10" />'.Tools::safeOutput(Tools::getValue('gplus_size', Configuration::get('GPLUS_SIZE'))).'
						<OPTION value="small">'.$this->l('Pequeno (15 cm)').'</OPTION>
						<OPTION value="medium">'.$this->l('Mediano (20 cm)').'</OPTION>
						<OPTION value="default">'.$this->l('Estandar (24 cm)').'</OPTION>
						<OPTION value="tall">'.$this->l('Alto (60 cm)').'</OPTION>
					</SELECT>
					'.$this->l('Actual').' "<TEXT>'.Configuration::get('GPLUS_SIZE').'</TEXT>" 
				</div>
				
				<label>'.$this->l('Anotacion').'</label>
				<div class="margin-form">
					<SELECT name="gplus_annotation" cols="90" rows="10" />'.Tools::safeOutput(Tools::getValue('gplus_annotation', Configuration::get('GPLUS_ANNOTATION'))).'
						<OPTION value="inline">'.$this->l('Directa').'</OPTION>
						<OPTION value="default">'.$this->l('Cuadro').'</OPTION>
						<OPTION value="none">'.$this->l('Ninguna').'</OPTION>
					</SELECT>
					'.$this->l('Actual').' "<TEXT>'.Configuration::get('GPLUS_ANNOTATION').'</TEXT>" 
				</div>
				
				<center><input type="submit" name="submitGPlus" value="'.$this->l('Update settings').'" class="button" /></center>			
			</fieldset>
		</form>';
		return $output;
	}

	function hookDisplayFooter($params)
	{
		$this->context->smarty->assign(array(
			'size' => Configuration::get('GPLUS_SIZE'),
			'annotation' => Configuration::get('GPLUS_ANNOTATION'),
			'url' => 'http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__
		));
		return $this->display(__FILE__, 'footer.tpl');
	}
	
	function hookDisplayLeftColumn($params)
	{
		return $this->hookDisplayFooter($params);
	}
	
	function hookDisplayRightColumn($params)
	{
		return $this->hookDisplayFooter($params);
	}
	
	function hookTop($params)
	{
		return $this->hookDisplayFooter($params);
	}
	
	function hookDisplayHeader($params)
	{
		//$this->context->controller->addJS(($this->_path).'js/plusone.js');
		$this->context->controller->addCSS(($this->_path).'css/gplus.css', 'all');
	}
	
	function hookDisplayRightColumnProduct($params)
	{
		$this->context->smarty->assign(array(
			'size' => Configuration::get('GPLUS_SIZE'),
			'annotation' => Configuration::get('GPLUS_ANNOTATION'),
			'url' => 'http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__
		));
		return $this->display(__FILE__, 'gplus_product.tpl');
	}
    
    function hookDisplayHome($params)
	{
		$this->context->smarty->assign(array(
                                             'size' => Configuration::get('GPLUS_SIZE'),
                                             'annotation' => Configuration::get('GPLUS_ANNOTATION'),
                                             'url' => 'http://'.$_SERVER['HTTP_HOST'].__PS_BASE_URI__
                                             ));
		return $this->display(__FILE__, 'home.tpl');
	}
}
