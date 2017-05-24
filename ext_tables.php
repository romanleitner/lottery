<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'List',
	'List of tickets'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Basket',
	'Basket'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Minibasket',
	'Mini basket'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Checkout',
	'Checkout'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'GoogleTracking',
	'Google eCommerce tracking'
);


//[L:] Landpage button
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'LandingPageButton',
	'Ticket Button for Landing Page'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Lottery');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wxlottery_domain_model_ticket', 'EXT:wx_lottery/Resources/Private/Language/locallang_csh_tx_wxlottery_domain_model_ticket.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wxlottery_domain_model_ticket');
$TCA['tx_wxlottery_domain_model_ticket'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,category,icon,win_price,cost,chances,money_back,nr_of_tickets,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Ticket.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wxlottery_domain_model_ticket.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wxlottery_domain_model_checkout', 'EXT:wx_lottery/Resources/Private/Language/locallang_csh_tx_wxlottery_domain_model_checkout.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wxlottery_domain_model_checkout');
$TCA['tx_wxlottery_domain_model_checkout'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout',
		'label' => 'last_name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'last_name,first_name,gender,country,zip,city,address,email,session_id,d_gender,d_first_name,d_last_name,d_country,d_zip,d_city,d_address,d_email,finished_step,delivery,payment,buy_all_classes,debit_bank_name,debit_sort_code,debit_account_nr,debig_account_holder,cc_holder_name,cc_type,cc_account_nr,cc_expire_month,cc_expire_year,cc_verification_nr,payment_info,order_sent_to,past_class_payment,future_class_payment,delivery_price,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Checkout.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wxlottery_domain_model_checkout.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wxlottery_domain_model_basketitem', 'EXT:wx_lottery/Resources/Private/Language/locallang_csh_tx_wxlottery_domain_model_basketitem.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wxlottery_domain_model_basketitem');
$TCA['tx_wxlottery_domain_model_basketitem'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_basketitem',
		'label' => 'session_id',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'session_id,user_agent,time,amount,ip_address,status,ticket,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/BasketItem.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wxlottery_domain_model_basketitem.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wxlottery_domain_model_partnerlog', 'EXT:wx_lottery/Resources/Private/Language/locallang_csh_tx_wxlottery_domain_model_partnerlog.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wxlottery_domain_model_partnerlog');
$TCA['tx_wxlottery_domain_model_partnerlog'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog',
		'label' => 'partner',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'partner,amount,session_id,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/PartnerLog.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_wxlottery_domain_model_partnerlog.gif'
	),
);

if (TYPO3_MODE === 'BE') {
	//[L:] Register Backend Module for Company Manager
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'WX.'.$_EXTKEY,
		'tools',
		'companymanager',
		'',
		['Company' => 'list, create, delete, update, deleteOrder'],
		[
			'access' => 'user,group',
			'icon' => 'EXT:'.$_EXTKEY.'/ext_icon.gif',
			'labels' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_company.xlf',
		]
	);

	//[L:] Register Backend Module for LandingPage
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'WX.'.$_EXTKEY,
		'tools',
		'landpagemanager',
		'',
		['Landpage' => 'list,save'],
		[
			'access' => 'user,group',
			'icon' => 'EXT:'.$_EXTKEY.'/ext_icon.gif',
			'labels' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_landpage.xlf',
		]
	);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Company');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wxlottery_domain_model_company', 'EXT:wx_lottery/Resources/Private/Language/locallang_csh_tx_wxlottery_domain_model_company.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wxlottery_domain_model_company');
}