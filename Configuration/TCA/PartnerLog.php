<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wxlottery_domain_model_partnerlog'] = array(
	'ctrl' => $TCA['tx_wxlottery_domain_model_partnerlog']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, partner, basket_total, grand_total, currency, session_id, year',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, partner, basket_total, grand_total, currency, session_id, year,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_wxlottery_domain_model_partnerlog',
				'foreign_table_where' => 'AND tx_wxlottery_domain_model_partnerlog.pid=###CURRENT_PID### AND tx_wxlottery_domain_model_partnerlog.sys_language_uid IN (-1,0)',
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
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'partner' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog.partner',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_wxlottery_domain_model_company',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'basket_total' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog.basket_total',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2,required'
			),
		),
      'grand_total' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog.grand_total',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2,required'
			),
		),
      'currency' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.currency',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.currency.0', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.currency.1', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'int'
			),
		),
		'session_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog.session_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_partnerlog.year',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
	),
);

?>