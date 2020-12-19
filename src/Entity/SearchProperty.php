<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert; //Validation for the doctrine component (Entity)
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 */
class SearchProperty
{
	/**
	*@var int | null
	*/

	private $maxPrice;

	/**
	*@var int | null
	*/

	/**
     * @var int | null
     * @Assert\Range(
     *      min = 10, max = 400,
     *      notInRangeMessage = "Vous devez entrer une surface minimale de {{ min }}m2 et maximale de {{ max }}m2",
     * )
     */
	private $minSurface;

	/**
	*@var ArrayCollection
	*/
	private $options;

	public function __construct()
	{
		$this->options= new ArrayCollection();
	}


	/**
	*@param int | null $maxPrice
	*@return SearchProperty
	*/
	public function setMaxPrice($maxPrice): SearchProperty
	{
		$this->maxPrice=$maxPrice;
		return $this;
	}


	/**
	*@return int | null
	*/
	public function getMaxPrice(): ?int
	{
		return $this->maxPrice;
	}

	/**
	*@param int | null $minSurface $minSurface
	* @return SearchProperty
	*/
	public function setMinSurface($minSurface): SearchProperty
	{
		$this->minSurface=$minSurface;
		return $this;
	}

	/**
	*@return int | null
	*/
	public function getMinSurface(): ?int
	{
		 return $this->minSurface;
	}


	/**
	*@return ArrayCollection
	*/

	public function getOption(): ArrayCollection
	{
		return $this->options;
	}

	/**
	*@param ArrayCollection $options
	*/

	public function setOption(ArrayCollection $options): void
	{
		$this->options = $options;
	}

}