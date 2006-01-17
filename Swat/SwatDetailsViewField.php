<?php

require_once 'Swat/SwatHtmlTag.php';
require_once 'Swat/SwatUIParent.php';
require_once 'Swat/SwatCellRendererContainer.php';

/**
 * A visible field in a SwatDetailsView
 *
 * @package   Swat
 * @copyright 2004-2005 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class SwatDetailsViewField extends SwatCellRendererContainer implements SwatUIParent
{
	/**
	 * The unique identifier of this field
	 *
	 * @var string
	 */
	public $id = null;

	/**
	 * The title of this field
	 *
	 * @var string
	 */
	public $title = '';

	/**
	 * The {@link SwatDetailsView} associated with this field
	 *
	 * @var SwatDetailsView
	 */
	public $view = null;

	/**
	 * Visible
	 *
	 * Whether the field is displayed.
	 *
	 * @var boolean
	 */
	public $visible = true;

	/**
	 * Creates a new details view field
	 *
	 * @param string $id an optional unique ideitifier for this details view
	 *                    field.
	 */
	public function __construct($id = null)
	{
		$this->id = $id;
		parent::__construct();
	}

	/**
	 * Displays this details view field using a data object
	 *
	 * @param mixed $data a data object used to display the cell renderers in
	 *                      this field.
	 * @param boolean $odd whether this is an odd or even field so alternating 
	 *                      style can be applied.
	 */
	public function display($data, $odd)
	{
		if (!$this->visible)
			return;

		$tr_tag = new SwatHtmlTag('tr');
		$tr_tag->class = 'swat-details-view-field';

		if ($odd)
			$tr_tag->class.= ' odd';

		$tr_tag->open();
		$this->displayHeader();
		$this->displayValue($data);
		$tr_tag->close();
	}

	/**
	 * Displays the header for this details view field
	 */
	public function displayHeader()
	{
		$th_tag = new SwatHtmlTag('th');
		$th_tag->setContent($this->title.':');
		$th_tag->display();
	}

	/**
	 * Displays the value of this details view field
	 *
	 * The properties of the cell renderers are set from the data object
	 * through the datafield property mappings.
	 *
	 * @param mixed $data the data object to display in this field.
	 */
	public function displayValue($data)
	{
		if ($this->renderers->getCount() == 0)
			throw new SwatException('No renderer has been provided for this '.
				'field.');

		$sensitive = $this->view->isSensitive();

		// Set the properties of the renderers to the value of the data field.
		foreach ($this->renderers as $renderer) {
			$this->renderers->applyMappingsToRenderer($renderer, $data);
			$renderer->sensitive = $sensitive;
		}

		$this->displayRenderers($data);
	}

	/**
	 * Renders each cell renderer in this details-view field
	 *
	 * @param mixed $data the data object being used to render the cell
	 *                     renderers of this field.
	 */
	protected function displayRenderers($data)
	{
		$first_renderer = $this->renderers->getFirst();
		$td_tag = new SwatHtmlTag('td', $first_renderer->getTdAttributes());
		$td_tag->open();

		foreach ($this->renderers as $renderer) {
			$renderer->render();
			echo ' ';
		}

		$td_tag->close();
	}

	/**
	 * Gathers the SwatHtmlHeadEntry objects needed by this field 
	 *
	 * @return array the SwatHtmlHeadEntry objects needed by this field
	 *
	 * @see SwatUIBase::getHtmlHeadEntries()
	 */
	public function getHtmlHeadEntries()
	{
		$out = $this->html_head_entries;
		$renderers = $this->getRenderers();
		foreach ($renderers as $renderer)
			$out = array_merge($out, $renderer->getHtmlHeadEntries());

		return $out;
	}
}

?>
