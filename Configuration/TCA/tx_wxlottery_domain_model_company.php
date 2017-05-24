<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,email_sender,email_name,email_admin,weight,redirect_page,info,logo',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('wx_lottery') . 'Resources/Public/Icons/tx_wxlottery_domain_model_company.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, email_sender, email_name, email_admin, weight, redirect_page, info, logo',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, email_sender, email_name, email_admin, weight, redirect_page, info, logo'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wxlottery_domain_model_company',
				'foreign_table_where' => 'AND tx_wxlottery_domain_model_company.pid=###CURRENT_PID### AND tx_wxlottery_domain_model_company.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email_sender' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.email_sender',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.email_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email_admin' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.email_admin',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'weight' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.weight',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'redirect_page' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.redirect_page',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'integer'
			)
		),
		'info' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.info',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 6
			),
			'defaultExtras'=>'richtext[]'
		),
		'logo' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_company.logo',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		
	),
);