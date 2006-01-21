<?php
/**
 * THiddenField class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.xisc.com/
 * @copyright Copyright &copy; 2004-2005, Qiang Xue
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version $Revision: $  $Date: $
 * @package System.Web.UI.WebControls
 */

/**
 * THiddenField class
 *
 * THiddenField displays a hidden input field on a Web page.
 * The value of the input field can be accessed via {@link getValue Value} property.
 * If upon postback the value is changed, a {@link onValueChanged OnValueChanged}
 * event will be raised.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Revision: $  $Date: $
 * @package System.Web.UI.WebControls
 * @since 3.0
 */
class THiddenField extends TControl implements IPostBackDataHandler
{
	/**
	 * @return string tag name of the hidden field.
	 */
	protected function getTagName()
	{
		return 'input';
	}

	/**
	 * Sets focus to this control.
	 * This method overrides the parent implementation by forbidding setting focus to this control.
	 */
	public function focus()
	{
		throw new TNotSupportedException('hiddenfield_focus_unsupported');
	}

	/**
	 * Renders the control.
	 * This method overrides the parent implementation by rendering
	 * the hidden field input element.
	 * @param THtmlWriter the writer used for the rendering purpose
	 */
	protected function render($writer)
	{
		$uniqueID=$this->getUniqueID();
		$this->getPage()->ensureRenderInForm($this);
		$writer->addAttribute('type','hidden');
		if($uniqueID!=='')
			$writer->addAttribute('name',$uniqueID);
		if($this->getID()!=='')
			$writer->addAttribute('id',$this->getClientID());
		if(($value=$this->getValue())!=='')
			$writer->addAttribute('value',$value);
		$writer->renderBeginTag('input');
		$writer->renderEndTag();
	}

	/**
	 * Loads hidden field data.
	 * This method is primarly used by framework developers.
	 * @param string the key that can be used to retrieve data from the input data collection
	 * @param array the input data collection
	 * @return boolean whether the data of the component has been changed
	 */
	public function loadPostData($key,$values)
	{
		$value=$values[$key];
		if($value===$this->getValue())
			return false;
		else
		{
			$this->setValue($value);
			return true;
		}
	}

	/**
	 * Raises postdata changed event.
	 * This method calls {@link onValueChanged} method.
	 * This method is primarly used by framework developers.
	 */
	public function raisePostDataChangedEvent()
	{
		$this->onValueChanged(null);
	}

	/**
	 * This method is invoked when the value of the {@link getValue Value} property changes between posts to the server.
	 * The method raises 'OnValueChanged' event to fire up the event delegates.
	 * If you override this method, be sure to call the parent implementation
	 * so that the attached event handlers can be invoked.
	 * @param TEventParameter event parameter to be passed to the event handlers
	 */
	public function onValueChanged($param)
	{
		$this->raiseEvent('OnValueChanged',$this,$param);
	}

	/**
	 * @return string the value of the THiddenField
	 */
	public function getValue()
	{
		return $this->getViewState('Value','');
	}

	/**
	 * Sets the value of the THiddenField
	 * @param string the value to be set
	 */
	public function setValue($value)
	{
		$this->setViewState('Value',$value,'');
	}

	/**
	 * @return boolean whether theming is enabled for this control. Defaults to false.
	 */
	public function getEnableTheming()
	{
		return false;
	}

	/**
	 * @param boolean whether theming is enabled for this control.
	 * @throws TNotSupportedException This method is always thrown when calling this method.
	 */
	public function setEnableTheming($value)
	{
		throw new TNotSupportedException('hiddenfield_theming_unsupported');
	}

	/**
	 * @param string Skin ID
	 * @throws TNotSupportedException This method is always thrown when calling this method.
	 */
	public function setSkinID($value)
	{
		throw new TNotSupportedException('hiddenfield_skinid_unsupported');
	}
}

?>