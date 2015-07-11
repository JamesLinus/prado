<?php
/**
 * TImageMap and related class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://github.com/pradosoft/prado
 * @copyright Copyright &copy; 2005-2016 The PRADO Group
 * @license https://github.com/pradosoft/prado/blob/master/COPYRIGHT
 * @package Prado\Web\UI\WebControls
 */

namespace Prado\Web\UI\WebControls;
use Prado\TPropertyValue;

/**
 * Class TCircleHotSpot.
 *
 * TCircleHotSpot defines a circular hot spot region in a {@link TImageMap}
 * control.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package Prado\Web\UI\WebControls
 * @since 3.0
 */
class TCircleHotSpot extends THotSpot
{
	/**
	 * @return string shape of this hotspot.
	 */
	public function getShape()
	{
		return 'circle';
	}

	/**
	 * @return string coordinates defining this hotspot shape
	 */
	public function getCoordinates()
	{
		return $this->getX().','.$this->getY().','.$this->getRadius();
	}

	/**
	 * @return integer radius of the circular HotSpot region. Defaults to 0.
	 */
	public function getRadius()
	{
		return $this->getViewState('Radius',0);
	}

	/**
	 * @param integer radius of the circular HotSpot region.
	 */
	public function setRadius($value)
	{
		$this->setViewState('Radius',TPropertyValue::ensureInteger($value),0);
	}

	/**
	 * @return integer the X coordinate of the center of the circular HotSpot region. Defaults to 0.
	 */
	public function getX()
	{
		return $this->getViewState('X',0);
	}

	/**
	 * @param integer the X coordinate of the center of the circular HotSpot region.
	 */
	public function setX($value)
	{
		$this->setViewState('X',TPropertyValue::ensureInteger($value),0);
	}

	/**
	 * @return integer the Y coordinate of the center of the circular HotSpot region. Defaults to 0.
	 */
	public function getY()
	{
		return $this->getViewState('Y',0);
	}

	/**
	 * @param integer the Y coordinate of the center of the circular HotSpot region.
	 */
	public function setY($value)
	{
		$this->setViewState('Y',TPropertyValue::ensureInteger($value),0);
	}
}