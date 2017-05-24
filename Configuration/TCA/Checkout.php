<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_wxlottery_domain_model_checkout'] = array(
	'ctrl' => $TCA['tx_wxlottery_domain_model_checkout']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, last_name, first_name, gender, country, zip, city, address, email, session_id, d_gender, d_first_name, d_last_name, d_country, d_zip, d_city, d_address, d_email, finished_step, delivery, payment, buy_all_classes, debit_bank_name, debit_sort_code, debit_account_nr, debig_account_holder, cc_holder_name, cc_type, cc_account_nr, cc_expire_month, cc_expire_year, cc_verification_nr, payment_info, order_sent_to, basket_total_payment, past_class_payment, future_class_payment, delivery_price, grand_total_payment, currency, comment, year',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, last_name, first_name, gender, country, zip, city, address, email, session_id, d_gender, d_first_name, d_last_name, d_country, d_zip, d_city, d_address, d_email, finished_step, delivery, payment, buy_all_classes, debit_bank_name, debit_sort_code, debit_account_nr, debig_account_holder, cc_holder_name, cc_type, cc_account_nr, cc_expire_month, cc_expire_year, cc_verification_nr, payment_info, order_sent_to, basket_total_payment, past_class_payment, future_class_payment, delivery_price, grand_total_payment, currency, year, comment,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_wxlottery_domain_model_checkout',
				'foreign_table_where' => 'AND tx_wxlottery_domain_model_checkout.pid=###CURRENT_PID### AND tx_wxlottery_domain_model_checkout.sys_language_uid IN (-1,0)',
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
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.gender',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.gender.1', 1),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.gender.2', 2),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.gender.3', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.country',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'static_countries',
				'foreign_table_where' => 'ORDER BY static_countries.cn_short_en',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0)
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'session_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.session_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_gender',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.gender.1', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.gender.2', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'd_first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_country',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.country.1', 1),
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.country.2', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'd_zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'd_email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.d_email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'finished_step' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.finished_step',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.step.1', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.step.2', 2),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.step.3', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.delivery',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.delivery.1', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.delivery.2', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'payment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.payment',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.payment.1', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.payment.2', 2),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.payment.3', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'buy_all_classes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.buy_all_classes',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.buy_all_classes.1', 1),
               array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.buy_all_classes.2', 2),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'debit_bank_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.debit_bank_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'debit_sort_code' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.debit_sort_code',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'debit_account_nr' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.debit_account_nr',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'debig_account_holder' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.debig_account_holder',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cc_holder_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_holder_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cc_type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_type',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cc_account_nr' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_account_nr',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cc_expire_month' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_expire_month',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'cc_expire_year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_expire_year',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'cc_verification_nr' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.cc_verification_nr',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'payment_info' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.payment_info',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
      'comment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.comment',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'order_sent_to' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.order_sent_to',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_wxlottery_domain_model_company',
				'items' => array(
					array('LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_ticket.select.default', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
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
				'eval' => ''
			),
		),
		'basket_total_payment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.basket_total_payment',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
      'past_class_payment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.past_class_payment',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
		'future_class_payment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.future_class_payment',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
		'delivery_price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.delivery_price',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
      'grand_total_payment' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.grand_total_payment',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'double2'
			),
		),
		'year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:wx_lottery/Resources/Private/Language/locallang_db.xlf:tx_wxlottery_domain_model_checkout.year',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
	),
);

?>