<?php

class emailsTest extends WebTestCase
{
	public $fixtures=array(
		'emails'=>'emails',
	);

	public function testShow()
	{
		$this->open('?r=emails/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=emails/create');
	}

	public function testUpdate()
	{
		$this->open('?r=emails/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=emails/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=emails/index');
	}

	public function testAdmin()
	{
		$this->open('?r=emails/admin');
	}
}
