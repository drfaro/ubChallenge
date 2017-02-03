<?php

class urlsTest extends WebTestCase
{
	public $fixtures=array(
		'urls'=>'urls',
	);

	public function testShow()
	{
		$this->open('?r=urls/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=urls/create');
	}

	public function testUpdate()
	{
		$this->open('?r=urls/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=urls/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=urls/index');
	}

	public function testAdmin()
	{
		$this->open('?r=urls/admin');
	}
}
