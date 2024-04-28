<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => esc_attr__('Value needs to be Alphabet', 'vp_textdomain'),
		'alphanumeric' => esc_attr__('Value needs to be Alphanumeric', 'vp_textdomain'),
		'numeric'      => esc_attr__('Value needs to be Numeric', 'vp_textdomain'),
		'email'        => esc_attr__('Value needs to be Valid Email', 'vp_textdomain'),
		'url'          => esc_attr__('Value needs to be Valid URL', 'vp_textdomain'),
		'maxlength'    => esc_attr__('Length needs to be less than {0} characters', 'vp_textdomain'),
		'minlength'    => esc_attr__('Length needs to be more than {0} characters', 'vp_textdomain'),
		'maxselected'  => esc_attr__('Select no more than {0} items', 'vp_textdomain'),
		'minselected'  => esc_attr__('Select at least {0} items', 'vp_textdomain'),
		'required'     => esc_attr__('This is required', 'vp_textdomain'),
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => esc_attr__('Import succeed, option page will be refreshed..', 'vp_textdomain'),
		'import_failed'     => esc_attr__('Import failed', 'vp_textdomain'),
		'export_success'    => esc_attr__('Export succeed, copy the JSON formatted options', 'vp_textdomain'),
		'export_failed'     => esc_attr__('Export failed', 'vp_textdomain'),
		'restore_success'   => esc_attr__('Restoration succeed, option page will be refreshed..', 'vp_textdomain'),
		'restore_nochanges' => esc_attr__('Options identical to default', 'vp_textdomain'),
		'restore_failed'    => esc_attr__('Restoration failed', 'vp_textdomain'),
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => esc_attr__('Select option(s)', 'vp_textdomain'),
		// fontawesome chooser
		'fac_placeholder'     => esc_attr__('Select an Icon', 'vp_textdomain'),
	),

);

/**
 * EOF
 */