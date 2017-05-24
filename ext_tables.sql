#
# Table structure for table 'tx_wxlottery_domain_model_ticket'
#
CREATE TABLE tx_wxlottery_domain_model_ticket (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description varchar(255) DEFAULT '' NOT NULL,
	category int(11) DEFAULT '0' NOT NULL,
	icon text NOT NULL,
	win_price int(11) DEFAULT '0' NOT NULL,
	cost double(11,2) DEFAULT '0.00' NOT NULL,
	chances double(11,2) DEFAULT '0.00' NOT NULL,
	money_back tinyint(1) unsigned DEFAULT '0' NOT NULL,
	nr_of_tickets int(11) DEFAULT '0' NOT NULL,
	nr_of_tens int(11) DEFAULT '0' NOT NULL,
	superklasse int(1) DEFAULT '0' NOT NULL,
	landpage int(1) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_wxlottery_domain_model_checkout'
#
CREATE TABLE tx_wxlottery_domain_model_checkout (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	last_name varchar(255) DEFAULT '' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	gender int(11) DEFAULT '0' NOT NULL,
	year int(11) DEFAULT '0' NOT NULL,
	country int(11) DEFAULT '0' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	session_id varchar(255) DEFAULT '' NOT NULL,
	d_gender int(11) DEFAULT '0' NOT NULL,
	d_first_name varchar(255) DEFAULT '' NOT NULL,
	d_last_name varchar(255) DEFAULT '' NOT NULL,
	d_country int(11) DEFAULT '0' NOT NULL,
	d_zip varchar(255) DEFAULT '' NOT NULL,
	d_city varchar(255) DEFAULT '' NOT NULL,
	d_address varchar(255) DEFAULT '' NOT NULL,
	d_email varchar(255) DEFAULT '' NOT NULL,
	finished_step int(11) DEFAULT '0' NOT NULL,
	delivery int(11) DEFAULT '0' NOT NULL,
	payment int(11) DEFAULT '0' NOT NULL,
	buy_all_classes int(11) DEFAULT '0' NOT NULL,
	debit_bank_name varchar(255) DEFAULT '' NOT NULL,
	debit_sort_code varchar(255) DEFAULT '' NOT NULL,
	debit_account_nr varchar(255) DEFAULT '' NOT NULL,
	debig_account_holder varchar(255) DEFAULT '' NOT NULL,
	cc_holder_name varchar(255) DEFAULT '' NOT NULL,
	cc_type varchar(255) DEFAULT '' NOT NULL,
	cc_account_nr varchar(255) DEFAULT '' NOT NULL,
	cc_expire_month int(11) DEFAULT '0' NOT NULL,
	cc_expire_year int(11) DEFAULT '0' NOT NULL,
	cc_verification_nr int(11) DEFAULT '0' NOT NULL,
	payment_info text NOT NULL,
	order_sent_to int(11) DEFAULT '0' NOT NULL,
	basket_total_payment double(11,2) DEFAULT '0.00' NOT NULL,
	past_class_payment double(11,2) DEFAULT '0.00' NOT NULL,
	future_class_payment double(11,2) DEFAULT '0.00' NOT NULL,
	delivery_price int(11) DEFAULT '0' NOT NULL,
	grand_total_payment double(11,2) DEFAULT '0.00' NOT NULL,
	comment text NOT NULL,
	currency int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_wxlottery_domain_model_basketitem'
#
CREATE TABLE tx_wxlottery_domain_model_basketitem (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	session_id varchar(255) DEFAULT '' NOT NULL,
	user_agent varchar(255) DEFAULT '' NOT NULL,
	time int(11) DEFAULT '0' NOT NULL,
	amount int(11) DEFAULT '0' NOT NULL,
	ip_address varchar(255) DEFAULT '' NOT NULL,
	status int(11) DEFAULT '0' NOT NULL,
	ticket int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_wxlottery_domain_model_partnerlog'
#
CREATE TABLE tx_wxlottery_domain_model_partnerlog (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	partner int(11) DEFAULT '0' NOT NULL,
	basket_total double(11,2) DEFAULT '0.00' NOT NULL,
	grand_total double(11,2) DEFAULT '0.00' NOT NULL,
	session_id varchar(255) DEFAULT '' NOT NULL,
	currency int(11) DEFAULT '0' NOT NULL,
	year int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_wxlottery_domain_model_company'
#
CREATE TABLE tx_wxlottery_domain_model_company (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	email_sender varchar(255) DEFAULT '' NOT NULL,
	email_name varchar(255) DEFAULT '' NOT NULL,
	email_admin varchar(255) DEFAULT '' NOT NULL,
	weight double(11,2) DEFAULT '0.00' NOT NULL,
	redirect_page int(11) DEFAULT '0' NOT NULL,
	info text,
	logo varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)
);