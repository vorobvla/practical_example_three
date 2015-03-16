<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Tests\Service;

use Cvut\Fit\BiPwt\BlogBundle\Entity\User;
use Cvut\Fit\BiPwt\BlogBundle\Service\UserInterface;
use Doctrine\Common\Collections\Criteria;

class UserServiceTest extends ServiceTestcase {

	/**
	 * @var UserInterface - implementace Service/UserInterface
	 */
	protected $service;

	/**
	 * setup - vytvoreni instance podle interfacu UserInterface
	 */
	public function setUp() {
		$client = static::createClient();
		$container = $client->getContainer();

		$this->service = $container->get('cvut_fit_ict_bipwt_user_service');
	}

	/**
	 * pomocna metoda pro vytvoreni uzivatele a otestovani
	 */
	protected function _create($id, $name) {
		$user = $this->service->create($id, $name);
		$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $user, "'create' method doesn't return object of proper class.");
		//$this->assertTrue($user->getId() == $id, "User doesn't have requested ID.");
		$this->assertTrue($user->getName() == $name, "User doesn't have requested name.");

		return $user;
	}

	/**
	 * test metody pro vytvoreni uzivatele
	 */
	public function testCreate() {
		$user = $this->_create(1, 'Žluťoučký kůň');
		$user2 = $this->service->find($user->getId());
		$this->assertNotNull($user2, "Created user cannot be found.");
	}

	/**
	 * test metody pro aktualizaci uzivatele
	 */
	public function testUpdate() {
		$newVal = 'Jiří Stárek';
		$user = $this->_create(2, 'Jan Novák');
		$user->setName($newVal);
		$user2 = $this->service->update($user);
		$user3 = $this->service->find($user->getId());

		$this->assertTrue($user == $user2, "'update' method doesn't return proper object.");
		$this->assertTrue($user3->getName() == $newVal, "User name didn't change properly.");
	}

	/**
	 * test metody pro smazani uzivatele
	 */
	public function testDelete() {
		$user = $this->_create(3, 'Petr Blogger');
		$id = $user->getId();
		$user2 = $this->service->delete($user);

		$this->assertTrue($user == $user2, "'delete' method doesn't return proper object.");
		$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $user2, "'delete' method doesn't return object of proper class.");

		try {
			$user3 = $this->service->find($id);
			$this->assertNull($user3, "Deleted user still can be found.");
		} catch(\Exception $e) {}
	}

	/**
	 * test metody pro vyhledani uzivatele podle id
	 */
	public function testFind() {
		$user = $this->_create(4, 'Karel Hledač');
		$id = $user->getId();

		$user2 = $this->service->find($id);

		$this->assertTrue($user2->getId() == $id, "User ID is improper.");
		$this->assertTrue($user2->getName() == $user->getName(), "User name is improper.");

		$this->assertTrue($user == $user2, "'find' method doesn't return proper instance (equal).");
		$this->assertTrue($user === $user2, "'find' method doesn't return proper instance (identity).");
	}

	/**
	 * test metody pro vyhledani vsech uzivatelu
	 */
	public function testFindAll() {
		$data = [
			5 => 'Alois Andrle',
			6 => 'Bohumil Brodský',
			7 => 'Cyril Cabrnoch',
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $id => $name) {
			$user = $this->_create($id, $name);
			//vytvorime si zaznamy s novym id
			$newData[$user->getId()] = $name;
		}

		$users = $this->service->findAll();
		$this->assertInstanceOf($collectionClass, $users, "'findAll' method doesn't return object of proper class.");

		foreach($users as $user2) {
			$id = $user2->getId();

			//vsimame si jen polozek, ktere jsme ted vlozili
			if (isset($newData[$id])) {
				$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $user2, "Item isn't object of proper class.");
				$this->assertTrue($user2->getName() == $newData[$id], "User name for item #{$id} is improper.");
				//odstranime polozku, pokud byla nalezena
				unset($newData[$id]);
			}
		}

		$this->assertEmpty($newData, "Some of inserted items was not found.");
	}

	/**
	 * test metody pro vyhledani uzivatelu podle kriterii
	 */
	public function testFindBy() {
		$data = [
			8 => 'Alois Andrle',
			9 => 'Bohumil Brodský',
			10 => 'Cyril Cabrnoch',
		];
		$collectionClass = 'Doctrine\Common\Collections\Collection';

		$newData = [];
		foreach($data as $id => $name) {
			$user = $this->_create($id, $name);
			//vytvorime si zaznamy s novym id
			$newData[$user->getId()] = $name;
		}

		//test na operator 'eq'
		$criteria = new Criteria;
		$name = 'Alois Andrle';
		$criteria->andWhere($criteria->expr()->eq('name', $name));

		$users = $this->service->findBy($criteria);
		$this->assertInstanceOf($collectionClass, $users, "'findBy' method doesn't return object of proper class.");

		foreach($users as $user2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $user2, "Item isn't object of proper class.");
			$this->assertTrue($user2->getName() == $name, "User name for item #{$user2->getId()} is improper.");
		}

		//test na operator 'contains'
		$criteria = new Criteria;
		$str = 'B';
		$criteria->andWhere($criteria->expr()->contains('name', $str));

		$users = $this->service->findBy($criteria);
		$this->assertNotEmpty($users, "Returned collection should not be empty.");
		$this->assertInstanceOf($collectionClass, $users, "'findBy' method doesn't return object of proper class.");

		foreach($users as $user2) {
			$this->assertInstanceOf('Cvut\Fit\BiPwt\BlogBundle\Entity\User', $user2, "Item isn't object of proper class.");
			$this->assertTrue(strstr($user2->getName(), $str) !== FALSE, "Item #{$user2->getId()} doesn't fit criterion.");
		}
	}
}
