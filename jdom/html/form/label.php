<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <     JDom Class - Cook Self Service library    |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Cook Self Service
* @subpackage	JDom
* @license		GNU General Public License
* @author		Jocelyn HUARD
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class JDomHtmlFormLabel extends JDomHtmlForm
{
	public $domId;
	public $label;
	public $markup;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 *
	 *
	 * 	@domID		: database field name
	 * 	@label		: label caption (JText)
	 *  @domClass	: CSS class
	 * 	@selectors	: raw selectors (Array) ie: javascript events
	 */
	function __construct($args)
	{

		parent::__construct($args);

		$this->arg('dataKey'	, null, $args);
		$this->arg('dataObject'	, null, $args);
		$this->arg('domId'		, null, $args);
		$this->arg('label'		, null, $args);
		$this->arg('domClass'	, null, $args);
		$this->arg('selectors'	, null, $args);
		$this->arg('formControl', null, $args);
		$this->arg('formGroup', null, $args);
		$this->arg('markup', null, $args, 'label');

		if (!$this->domId)
			$this->domId = $this->getInputId();
		
	}

	function build()
	{
		$html = '<'. $this->markup .' for="<%DOM_ID%>" <%CLASS%><%SELECTORS%>>'
			.	$this->JText($this->label)
			.	'</'. $this->markup .'>';
		return $html;
	}
		
	protected function parseVars($vars)
	{
		return parent::parseVars(array_merge(array(
			'DOM_ID'		=> $this->domId,
			'STYLE'		=> $this->buildDomStyles(),
			'CLASS'			=> $this->buildDomClass(),		//With attrib name
			'SELECTORS'		=> $this->buildSelectors(),
		), $vars));
	}
}