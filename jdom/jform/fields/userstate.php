<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('predefinedlist');

/**
 * Field to load a list of available users statuses
 *
 * @package     Joomla.Libraries
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldUserState extends JFormFieldPredefinedList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since   3.2
	 */
	protected $type = 'UserState';

	/**
	 * Available statuses
	 *
	 * @var  array
	 * @since  3.2
	 */
	protected $predefinedOptions = array(
		'0'  => 'JENABLED',
		'1'  => 'JDISABLED'
	);
}