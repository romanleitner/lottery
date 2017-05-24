<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.' . $_EXTKEY,
	'List',
	array(
		'Ticket' => 'list, overlay',
		
	),
	// non-cacheable actions
	array(
		'Ticket' => 'list, overlay',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.' . $_EXTKEY,
	'Basket',
	array(
		'BasketItem' => 'list, delete',
		
	),
	// non-cacheable actions
	array(
		'BasketItem' => 'list, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.' . $_EXTKEY,
	'Minibasket',
	array(
		'BasketItem' => 'minibasket, list',
		
	),
	// non-cacheable actions
	array(
		'BasketItem' => 'minibasket, list',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.' . $_EXTKEY,
	'Checkout',
	array(
		'Checkout' => 'new, create, payment, overview, confirmOrder',
		
	),
	// non-cacheable actions
	array(
		'Checkout' => 'new, create, payment, overview, confirmOrder',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.' . $_EXTKEY,
	'GoogleTracking',
	array(
		'Checkout' => 'googleTracking',
		
	),
	// non-cacheable actions
	array(
		'Checkout' => 'googleTracking',
		
	)
);
//[L:] Landpage button
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WX.'.$_EXTKEY,
	'LandingPageButton',
	['Landpage'=>'button, addLandpageTicket'],
	['Landpage'=>'button, addLandpageTicket']
);
