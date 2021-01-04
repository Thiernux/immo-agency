<?php
namespace App\Entity;
//use Symfony\Component\Validator\Constraints as Assert; // Validation import
use Symfony\Component\Validator\Constraints as Assert; // Validation import


class Contact
{

	/**
	 * @var string | null
	 *@Assert\NotBlank()
	 *@Assert\Length(min=2, max=100)
	 */

	private $firstname;

	/**
	 * @var string | null
	 *@Assert\NotBlank()
	 *@Assert\Length(min=2, max=100)
	 */

	private $lastname;

	/**
	 * @var string | null
	 *@Assert\NotBlank()
	 *@Assert\Regex(
	 * pattern="/[0-9]{10}/"
	 *)
	 */

	private $phone;


	/**
	 * @var string | null
	 *@Assert\NotBlank()
	 *@Assert\Email()
	 */

	private $email;

	/**
	 * @var string | null
	 *@Assert\NotBlank()
	 *@Assert\Length(min=10)
	 *@Assert\Email()
	 */

	private $mesage;

	/**
	*@var Property | null
	*/

	private $property;

	/**
	*@return null | string
	*/

	public function getFirstname(): ?string
	{
		return $this->firstname;
	}

	/**
	*@param null | string $firstname
	*@return Contact
	*/

	public function setFirstname(String $firstname): Contact
	{
		$this->firstname = $firstname;
		return $this;
	}


	/**
	*@return null | string
	*/

	public function getLastname(): ?string
	{
		return $this->lastname;
	}

	/**
	*@param null | string $lastname
	*@return Contact
	*/

	public function setLastname(String $lastname): Contact
	{
		$this->lastname = $lastname;
		return $this;
	}


	/**
	*@return null | string
	*/

	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	*@param null | string $email
	*@return Contact
	*/

	public function setEmail(String $email): Contact
	{
		$this->email = $email;
		return $this;
	}


	/**
	*@return null | string
	*/

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	*@param null | string $phone
	*@return Contact
	*/

	public function setPhone(String $phone): Contact
	{
		$this->phone = $phone;
		return $this;
	}



	/**
	*@return null | string
	*/

	public function getMesage(): ?string
	{
		return $this->mesage;
	}

	/**
	*@param null | string $mesage
	*@return Contact
	*/

	public function setMesage(String $mesage): Contact
	{
		$this->mesage = $mesage;
		return $this;
	}

	/**
	*@return Property | null
	*/

	public function getProperty(): ?Property
	{
		return $this->property;
	}

	/**
	*@param null | string $property
	*@return Property
	*/

	public function setProperty(Property $property): Contact
	{
		$this->property = $property;
		return $this;
	}


}