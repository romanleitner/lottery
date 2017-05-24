<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wxlottery_domain_model_ticket'] = array(
	'ctrl' => $TCA['tx_wxlottery_domain_model_ticket']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, category, icon, win_price, cost, chances, money_back, nr_of_tickets, nr_of_tens',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, category, icon, win_price, cost, chances, money_back, nr_of_tickets, nr_of_tens,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_wxlottery_domain_model_ticket',
				'foreign_table_where' => 'AND tx_wxlottery_domain_model_ticket.pid=###CURRENT_PID### AND tx_wxlottery_domain_model_ticket.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'category' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category.1', 1),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category.2', 2),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category.3', 3),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category.4', 4),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.category.5', 5),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'icon' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.icon',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_wxlottery',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'win_price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.win_price',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'cost' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.cost',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
		'chances' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.chances',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			),
		),
		'money_back' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.money_back',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'nr_of_tickets' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.nr_of_tickets',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array(1, 1),
               array(2, 2),
               array(3, 3),
               array(4, 4),
               array(5, 5),
               array(6, 6),
               array(7, 7),
               array(8, 8),
               array(9, 9),
               array(10, 10)
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'nr_of_tens' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.nr_of_tens',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array(1, 1),
					array(2, 2),
					array(3, 3),
					array(4, 4),
					array(5, 5),
					array(6, 6),
					array(7, 7),
					array(8, 8),
					array(9, 9),
					array(10, 10),
					array(11, 11),
					array(12, 12),
					array(13, 13),
					array(14, 14),
					array(15, 15),
					array(16, 16),
					array(17, 17),
					array(18, 18),
					array(19, 19),
					array(20, 20),
					array(21, 21),
					array(22, 22),
					array(23, 23),
					array(24, 24),
					array(25, 25),
					array(26, 26),
					array(27, 27),
					array(28, 28),
					array(29, 29),
					array(30, 30),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'landpage' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.landpage',
			'config' => ['type'=>'none', 'size' => 1],
		),
		'superklasse' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.superklasse',
			'config' => ['type'=>'check', 'size' => 1],
		),
	),
);

?>