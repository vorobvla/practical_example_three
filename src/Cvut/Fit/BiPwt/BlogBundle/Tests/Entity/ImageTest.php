<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Cvut\Fit\BiPwt\BlogBundle\Entity\Comment;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Image;
use Cvut\Fit\BiPwt\BlogBundle\Entity\Post;

class ImageTest extends EntityTestcase {

	/**
	 * setup - vytvoreni instance podle interfacu ImageInterface
	 */
	public function setUp() {
		$this->object = new Image();
	}

	/* File tests */
	/**
	 * test getteru a setteru pro atribut id
	 */
	public function testId() {
		$this->_testGetterSetter('getId', 'setId');
	}

	/**
	 * test getteru a setteru pro atribut name
	 */
	public function testName() {
		$this->_testGetterSetter('getName', 'setName');
	}

	/**
	 * test getteru a setteru pro atribut file
	 */
	public function testFile() {
		$post = new Post();

		$this->_testGetterSetter('getPost', 'setPost', $post);
	}

	/**
	 * test getteru a setteru pro atribut created
	 */
	public function testCreated() {
		$this->_testGetterSetter('getCreated', 'setCreated', new \DateTime);
	}

	/**
	 * test getteru a setteru pro atribut data
	 */
	public function testData() {
		$this->_testGetterSetter('getData', 'setData');
	}

	/**
	 * test getteru a setteru pro atribut internetMediaType
	 */
	public function testInternetMediaType() {
		$this->_testGetterSetter('getInternetMediaType', 'setInternetMediaType');
	}

	/**
	 * test getteru a setteru pro atribut comment
	 */
	public function testComment() {
		$comment = new Comment();

		$this->_testGetterSetter('getComment', 'setComment', $comment);
	}

	/* Image tests */
	/**
	 * test getteru a setteru pro atributy dimensionX a dimensionY
	 */
	public function testDimensions() {
		$this->_testGetterSetter('getDimensionX', 'setDimensionX');
		$this->_testGetterSetter('getDimensionY', 'setDimensionY');
	}

	/**
	 * test getteru a setteru pro atribut preview
	 */
	public function testPreview() {
		$this->_testGetterSetter('getPreview', 'setPreview');
	}
}