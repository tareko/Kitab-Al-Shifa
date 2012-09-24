<?php
App::uses('Trade', 'Model');

/**
 * Trade Test Case
 *
 */
class TradeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.trade', 'app.user', 'app.shift', 'app.trades_detail', 'app.shifts_type', 'app.location');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Trade = ClassRegistry::init('Trade');
	}

	
	public function testGetUnprocessedTrades() {
		$result = $this->Trade->getUnprocessedTrades();
		$expected = array (
			0 => array(
					'Trade' => array(
						'id' => '12',
						'user_id' => '4',
						'shift_id' => '483',
						'status' => '0',
						'user_status' => '1',
						'token' => 'a50e7ad2e87fe32ef46d9bb84db20012',
						'updated' => '2012-05-23 11:59:42'
					),
					'User' => array(
						'id' => '4',
						'name' => 'Jacqueline Beaudoin',
						'email' => 'false4@false.com'
					),
					'Shift' => array(
						'id' => '483',
						'date' => '2011-12-26',
						'shifts_type_id' => '11',
						'ShiftsType' => array(
							'location_id' => '3',
							'times' => '1000-1700 ',
							'Location' => array(
								'location' => 'Come on pretty mama'
							)
						)
					),
					'TradesDetail' => array()
				),
				1 => array(
					'Trade' => array(
						'id' => '11',
						'user_id' => '5',
						'shift_id' => '513',
						'status' => '0',
						'user_status' => '1',
						'token' => '15b6a69f207d8f6cd29c66b4cb729d40',
						'updated' => '2012-05-23 11:59:41'
					),
					'User' => array(
						'id' => '5',
						'name' => 'Sabine Chatigny',
						'email' => 'false5@false.com'
					),
					'Shift' => array(
						'id' => '513',
						'date' => '2011-12-28',
						'shifts_type_id' => '12',
						'ShiftsType' => array(
							'location_id' => '1',
							'times' => '0400-1000 ',
							'Location' => array(
								'location' => 'Bermuda'
							)
						)
					),
					'TradesDetail' => array()
				),
				2 => array(
					'Trade' => array(
						'id' => '10',
						'user_id' => '5',
						'shift_id' => '513',
						'status' => '0',
						'user_status' => '1',
						'token' => '15b6a69f207d8f6cd29c66b4cb729d39',
						'updated' => '2012-05-23 11:59:40'
					),
					'User' => array(
						'id' => '5',
						'name' => 'Sabine Chatigny',
						'email' => 'false5@false.com'
					),
					'Shift' => array(
						'id' => '513',
						'date' => '2011-12-28',
						'shifts_type_id' => '12',
						'ShiftsType' => array(
							'location_id' => '1',
							'times' => '0400-1000 ',
							'Location' => array(
								'location' => 'Bermuda'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '20',
							'trade_id' => '10',
							'user_id' => '4',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
							)
						),
						1 => array(
							'id' => '21',
							'trade_id' => '10',
							'user_id' => '3',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '3',
								'name' => 'Madeline Cremin',
								'email' => 'false3@false.com'
							)
						)
					)
				),
				3 => array(
					'Trade' => array(
						'id' => '9',
						'user_id' => '5',
						'shift_id' => '153',
						'status' => '0',
						'user_status' => '1',
						'token' => 'ad096b2b5654477ab9f4708f1ca6e2c7',
						'updated' => '2012-05-23 11:59:39'
					),
					'User' => array(
						'id' => '5',
						'name' => 'Sabine Chatigny',
						'email' => 'false5@false.com'
					),
					'Shift' => array(
						'id' => '153',
						'date' => '2011-12-08',
						'shifts_type_id' => '7',
						'ShiftsType' => array(
							'location_id' => '1',
							'times' => '1000-2000 S/S',
							'Location' => array(
								'location' => 'Bermuda'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '18',
							'trade_id' => '9',
							'user_id' => '2',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
							)
						),
						1 => array(
							'id' => '19',
							'trade_id' => '9',
							'user_id' => '3',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '3',
								'name' => 'Madeline Cremin',
								'email' => 'false3@false.com'
							)
						)
					)
				),
				4 => array(
					'Trade' => array(
						'id' => '8',
						'user_id' => '4',
						'shift_id' => '483',
						'status' => '0',
						'user_status' => '2',
						'token' => 'a50e7ad2e87fe32ef46d9bb84db20000',
						'updated' => '2012-05-23 11:59:38'
					),
					'User' => array(
						'id' => '4',
						'name' => 'Jacqueline Beaudoin',
						'email' => 'false4@false.com'
					),
					'Shift' => array(
						'id' => '483',
						'date' => '2011-12-26',
						'shifts_type_id' => '11',
						'ShiftsType' => array(
							'location_id' => '3',
							'times' => '1000-1700 ',
							'Location' => array(
								'location' => 'Come on pretty mama'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '16',
							'trade_id' => '8',
							'user_id' => '5',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '5',
								'name' => 'Sabine Chatigny',
								'email' => 'false5@false.com'
							)
						),
						1 => array(
							'id' => '17',
							'trade_id' => '8',
							'user_id' => '1',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '1',
								'name' => 'James Bynum',
								'email' => 'false1@false.com'
							)
						)
					)
				),
				5 => array(
					'Trade' => array(
						'id' => '7',
						'user_id' => '4',
						'shift_id' => '137',
						'status' => '0',
						'user_status' => '2',
						'token' => '696a521644768fe95e28505b5c8e602b',
						'updated' => '2012-05-23 11:59:37'
					),
					'User' => array(
						'id' => '4',
						'name' => 'Jacqueline Beaudoin',
						'email' => 'false4@false.com'
					),
					'Shift' => array(
						'id' => '137',
						'date' => '2011-12-07',
						'shifts_type_id' => '6',
						'ShiftsType' => array(
							'location_id' => '2',
							'times' => '0800-1600 ',
							'Location' => array(
								'location' => 'Bahamas'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '14',
							'trade_id' => '7',
							'user_id' => '3',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '3',
								'name' => 'Madeline Cremin',
								'email' => 'false3@false.com'
							)
						),
						1 => array(
							'id' => '15',
							'trade_id' => '7',
							'user_id' => '4',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
							)
						)
					)
				),
				6 => array(
					'Trade' => array(
						'id' => '6',
						'user_id' => '3',
						'shift_id' => '213',
						'status' => '0',
						'user_status' => '3',
						'token' => 'e8aa4be97281849d511568b450ee2b7f',
						'updated' => '2012-05-23 11:59:36'
					),
					'User' => array(
						'id' => '3',
						'name' => 'Madeline Cremin',
						'email' => 'false3@false.com'
					),
					'Shift' => array(
						'id' => '213',
						'date' => '2011-12-11',
						'shifts_type_id' => '10',
						'ShiftsType' => array(
							'location_id' => '3',
							'times' => '0800-1500 ',
							'Location' => array(
								'location' => 'Come on pretty mama'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '12',
							'trade_id' => '6',
							'user_id' => '1',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '1',
								'name' => 'James Bynum',
								'email' => 'false1@false.com'
							)
						),
						1 => array(
							'id' => '13',
							'trade_id' => '6',
							'user_id' => '2',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
							)
						)
					)
				),
				7 => array(
					'Trade' => array(
						'id' => '5',
						'user_id' => '3',
						'shift_id' => '86',
						'status' => '0',
						'user_status' => '3',
						'token' => 'd5182d222b2a3cac6ce9fbeb9476d71f',
						'updated' => '2012-05-23 11:59:35'
					),
					'User' => array(
						'id' => '3',
						'name' => 'Madeline Cremin',
						'email' => 'false3@false.com'
					),
					'Shift' => array(
						'id' => '86',
						'date' => '2011-12-04',
						'shifts_type_id' => '5',
						'ShiftsType' => array(
							'location_id' => '2',
							'times' => '0400-1000 ',
							'Location' => array(
								'location' => 'Bahamas'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '10',
							'trade_id' => '5',
							'user_id' => '5',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '5',
								'name' => 'Sabine Chatigny',
								'email' => 'false5@false.com'
							)
						),
						1 => array(
							'id' => '11',
							'trade_id' => '5',
							'user_id' => '4',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
							)
						)
					)
				),
				8 => array(
					'Trade' => array(
						'id' => '4',
						'user_id' => '2',
						'shift_id' => '196',
						'status' => '0',
						'user_status' => '4',
						'token' => '1daeeb555a5afa403d36cb6683f113a1',
						'updated' => '2012-05-23 11:59:34'
					),
					'User' => array(
						'id' => '2',
						'name' => 'Harold Morrissey',
						'email' => 'false2@false.com'
					),
					'Shift' => array(
						'id' => '196',
						'date' => '2011-12-10',
						'shifts_type_id' => '9',
						'ShiftsType' => array(
							'location_id' => '3',
							'times' => '1200-2000 ',
							'Location' => array(
								'location' => 'Come on pretty mama'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '8',
							'trade_id' => '4',
							'user_id' => '3',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '3',
								'name' => 'Madeline Cremin',
								'email' => 'false3@false.com'
							)
						),
						1 => array(
							'id' => '9',
							'trade_id' => '4',
							'user_id' => '4',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
							)
						)
					)
				),
				9 => array(
					'Trade' => array(
						'id' => '3',
						'user_id' => '2',
						'shift_id' => '52',
						'status' => '0',
						'user_status' => '4',
						'token' => 'ba8bbb41dc0356d6849a00c18b2044de',
						'updated' => '2012-05-23 11:59:33'
					),
					'User' => array(
						'id' => '2',
						'name' => 'Harold Morrissey',
						'email' => 'false2@false.com'
					),
					'Shift' => array(
						'id' => '52',
						'date' => '2011-12-02',
						'shifts_type_id' => '3',
						'ShiftsType' => array(
							'location_id' => '1',
							'times' => '1000-1600 U45',
							'Location' => array(
								'location' => 'Bermuda'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '6',
							'trade_id' => '3',
							'user_id' => '1',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '1',
								'name' => 'James Bynum',
								'email' => 'false1@false.com'
							)
						),
						1 => array(
							'id' => '7',
							'trade_id' => '3',
							'user_id' => '2',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
							)
						)
					)
				),
				10 => array(
					'Trade' => array(
						'id' => '2',
						'user_id' => '1',
						'shift_id' => '167',
						'status' => '0',
						'user_status' => '0',
						'token' => '',
						'updated' => '2012-05-23 11:59:32'
					),
					'User' => array(
						'id' => '1',
						'name' => 'James Bynum',
						'email' => 'false1@false.com'
					),
					'Shift' => array(
						'id' => '167',
						'date' => '2011-12-09',
						'shifts_type_id' => '8',
						'ShiftsType' => array(
							'location_id' => '2',
							'times' => '1000-1800 ',
							'Location' => array(
								'location' => 'Bahamas'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '4',
							'trade_id' => '2',
							'user_id' => '4',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-23 11:29:36',
							'User' => array(
								'id' => '4',
								'name' => 'Jacqueline Beaudoin',
								'email' => 'false4@false.com'
							)
						),
						1 => array(
							'id' => '5',
							'trade_id' => '2',
							'user_id' => '5',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-24 01:03:30',
							'User' => array(
								'id' => '5',
								'name' => 'Sabine Chatigny',
								'email' => 'false5@false.com'
							)
						)
					)
				),
				11 => array(
					'Trade' => array(
						'id' => '1',
						'user_id' => '1',
						'shift_id' => '16',
						'status' => '0',
						'user_status' => '0',
						'token' => '',
						'updated' => '2012-05-23 11:59:31'
					),
					'User' => array(
						'id' => '1',
						'name' => 'James Bynum',
						'email' => 'false1@false.com'
					),
					'Shift' => array(
						'id' => '16',
						'date' => '2011-12-01',
						'shifts_type_id' => '1',
						'ShiftsType' => array(
							'location_id' => '1',
							'times' => '0800-1600 ',
							'Location' => array(
								'location' => 'Bermuda'
							)
						)
					),
					'TradesDetail' => array(
						0 => array(
							'id' => '2',
							'trade_id' => '1',
							'user_id' => '2',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-23 11:29:36',
							'User' => array(
								'id' => '2',
								'name' => 'Harold Morrissey',
								'email' => 'false2@false.com'
							)
						),
						1 => array(
							'id' => '3',
							'trade_id' => '1',
							'user_id' => '3',
							'token' => '',
							'status' => '0',
							'timestamp' => '2012-05-23 11:29:36',
							'User' => array(
								'id' => '3',
								'name' => 'Madeline Cremin',
								'email' => 'false3@false.com'
							)
						)
					)
				)
			);
		$this->assertEquals($expected, $result);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Trade);

		parent::tearDown();
	}

}
