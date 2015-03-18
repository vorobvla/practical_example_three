<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class EntityTestcase extends WebTestCase {

	protected $object;

	/**
	 * obecny test getteru a setteru na objektu $this->object
	 * @param $getter - nazev metody pro get
	 * @param $setter - nazev metody pro set
	 * @param null $a - dosazovana hodnota (pokud je potreba konkretni typ)
	 */
	protected function _testGetterSetter($getter, $setter, $a = NULL) {
		$this->assertNotNull($this->object, "Object is NULL.");
		$this->assertTrue(method_exists($this->object, $setter), "Setter method {$setter} doesn't exist.");
		$this->assertTrue(method_exists($this->object, $getter), "Getter method {$getter} doesn't exist.");

		if(is_null($a))
			$a = uniqid();

		$object = $this->object->$setter($a);
		//$this->assertEquals($this->object, $object, "{$setter} is not fluent.");
		$v = $this->object->$getter();
		$this->assertEquals($a, $v, "{$getter} returns another value.");
	}

	/**
	 * obecny test add/remove a getteru pro kolekci na objektu $this->object
	 * @param $add - nazev metody pro pridani do kolekce (add)
	 * @param $remove - nazev metody pro odebrani do kolekci (remove)
	 * @param $get - nazev metody pro get cele kolekce
	 * @param $inverseGet - nazev metody pro get entity vlastnici kolekci
	 * @param null $a - dosazovana hodnota (pokud je potreba konkretni typ)
	 */
	protected function _testAddRemove($add, $remove, $get, $inverseGet, $a = NULL) {
		$this->assertNotNull($this->object, "Object is NULL.");
		$this->assertTrue(method_exists($this->object, $add), "Setter method {$add} doesn't exist.");
		$this->assertTrue(method_exists($this->object, $remove), "Getter method {$remove} doesn't exist.");

		if(is_null($a))
			$a = uniqid();

		$object = $this->object->$add($a);
		//$this->assertEquals($this->object, $object, "{$add} is not fluent.");
		/** @var Collection $collection */
		$collection = $this->object->$get();
		$this->assertTrue($collection->contains($a), "Collection doesn't contain item after {$add}");

		$inverse = $a->$inverseGet();
		if($inverse instanceof Collection) {
			$this->assertTrue($a->$inverseGet()->contains($this->object), "Collection item isn't contained ({$inverseGet}) in inverse collection after {$add}");
		} else {
			$this->assertTrue($a->$inverseGet() == $this->object, "Collection item doesn't refer ({$inverseGet}) to inverse object after {$add}");
		}



		$object = $this->object->$remove($a);
		//$this->assertEquals($this->object, $object, "{$remove} is not fluent.");
		$collection = $this->object->$get();
		$this->assertFalse($collection->contains($a), "Collection contains item after {$remove}");
		//$this->assertTrue($a->$inverseGet() == $this->object, "Collection item still refer ({$inverseGet}) to owning object after {$remove}");
	}


}
