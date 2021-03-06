<?php
require_once '../interfaces/iValueObject.class.php';
/**
 * Class created automatically by the NGOData system.
 * DO NOT add to or change this class directly.
 * This is a business model class!
 */
class TitleDisplay {

	// sql factory - injected
	private $sqlFactory = null;


	// error display - injected
	private $errorDisplay;

	public function __construct(iSQLFactory $sqlf) {
		$this->setSQLFactory($sqlf);
	}

	/**
	 * Method: setSQLFactory(iSQLFactory $dbf)
	 * Method created automatically by NGOData system
	 * Do NOT alter this method.
	 * Inject the required factory - injected by the lookup table display elements
	 */
	private function setSQLFactory(iSQLFactory $sqlf) {
		$this->sqlFactory = $sqlf;
	}

	/**
	 * Method: getSQLFactory()
	 * Method created automatically by NGOData system
	 * Do NOT alter this method.
	 */
	public function getSQLFactory() {
		return $this->sqlFactory;
	}

	/**
	 * Method: setErrorDisplay($ed)
	 * Method created automatically by NGOData system
	 * Do NOT alter this method.
	 * Inject the required factory - needed so the methods can inject the db where required
	 */
	public function setErrorDisplay($ed) {
		$this->errorDisplay = $ed;
	}

	/**
	 * Method: displayReview(iValueObject $vo)
	 * Method created automatically by NGOData system
	 * Validation not required for this method - no data changed/added
	 * Do NOT alter this method.
	 */
	public function displayReview(iValueObject $vo) {
		// assume headers and etc are alrady in place...
		$text = '';
		$text .= '<div id="title">'."\n";
		$text .= '<fieldset>'."\n";
		$text .= '<legend>Review - Title data</legend>'."\n";
		// the data...

		$text .= '<label for="title">Title: </label>';
		// get the data...
		$text .= $vo->getDataItem('title');
		$text .= '<br />';
		$text .= '<label for="description">Description: </label>';
		// get the data...
		$text .= $vo->getDataItem('description');
		$text .= '<br />';
		$text .= '</fieldset>';
		$text .= '</div>';
		return $text;
	}


	/**
	 * Method: DisplayNew(array $errors(may == null))
	 * @param $errors An array of error messages
	 * @param $data The originally submitted data to populate fields with in the case there is an error
	 * Method created automatically by NGOData system
	 * This method is post-validation - check error array.
	 * WE MAY WANT TO INJECT THE DBFactory into the class on instantiation
	 * Do NOT alter this method.
	 */
	public function displayNew($errors = null, $postData = null) {
		$data = null;
		if (!is_null($postData)) $data = $postData->getData();

		$text = '';
		$text .= '<div id="title">'."\n";
		$text .= '<fieldset>'."\n";
		$text .= '<legend>Enter new Title details</legend>'."\n";
		$text .= '<p>Required fields are marked with an asterisk (<abbr class="req" title="required">*</abbr>).</p>';
		// display any errors
		if (!is_null($errors)) {
			$text .= '<div class="formerror"><p><img src="/images/error_triangle.jpg" width="16" height="16" hspace="5" alt="Error image">Please check the following and try again:</p><ul>'."\n";
			// Get each error and add it to the error string as a list item.
			foreach ($errors as $field=>$errorMessage) {
				$text .= "<li>$errorMessage</li>"."\n";
			}
			$text .= '</ul></div>'."\n";
		}


		// the data...

		$text .= '<p';
		// need to check for errors here - if there is an error, we need to display any entered text
		if ($this->errorDisplay->isValidationError($errors, 'title')) {
			// get submitted text
			$text .= ' class="formerror"';
		}
		$text .= '>'."\n";
		// no error, so just display
		$text .= '<label for="title">'."\n";
		$text .= '<abbr class="req" title="This is a required field">*</abbr>';
		$text .= 'Title';
		$text .= ': </label>'."\n";
		// need to check for errors to determine whether to display data
		if (!is_null($errors)) {
			$text .= '<input type="text" name="title"';
			foreach ($data as $item) {
				foreach ($item as $field=>$value) {
					if ($field ==='title') {
						$text .= ' value="';
						$text .= $this->getFieldValue('title', $item);
						$text .= '"';
					}
				}
			}
			$text .= ' />'."\n";
		} else {
			$text .= '<input type="text" name="title" />';
		}
		$text .= '</p>'."\n";

		$text .= '<p';
		// need to check for errors here - if there is an error, we need to display any entered text
		if ($this->errorDisplay->isValidationError($errors, 'description')) {
			// get submitted text
			$text .= ' class="formerror"';
		}
		$text .= '>'."\n";
		// no error, so just display
		$text .= '<label for="description">'."\n";
		$text .= '<abbr class="req" title="This is a required field">*</abbr>';
		$text .= 'Description';
		$text .= ': </label>'."\n";
		// need to check for errors to determine whether to display data
		if (!is_null($errors)) {
			$text .= '<input type="text" name="description"';
			foreach ($data as $item) {
				foreach ($item as $field=>$value) {
					if ($field ==='description') {
						$text .= ' value="';
						$text .= $this->getFieldValue('description', $item);
						$text .= '"';
					}
				}
			}
			$text .= ' />'."\n";
		} else {
			$text .= '<input type="text" name="description" />';
		}
		$text .= '</p>'."\n";

		$text .= '</fieldset>'."\n";
		$text .= '</div>'."\n";
		return $text;

	}


	/**
	 * Method: DisplayUpdate(NGOValueObjectInterface $data)
	 * Method created automatically by NGOData system
	 * Do NOT alter this method.
	 * @param NGOValueObjectInterface $data Ensure correct type of object is given.
	 */
	public function displayUpdate(iValueObject $vo) {
		$text = '';
		$text .= '<div id="title">';
		$text .= '<fieldset>';
		$text .= '<legend>Update Title data</legend>';
		$text .= '<p>Required fields are marked with an asterisk (<abbr class="req" title="required">*</abbr>).</p>';
		// the data...

		$text .= '<label for="title">Title';
		// determine whether the field is required or not...
		$text .= '<abbr class="req" title="This is a required field">*</abbr>';
		$text .= ': </label>';
		$text .= '<input type="text" name="title" ';
		$text .= 'value="'.$vo->getData('title').'" />';
		$text .= '<br />';
		$text .= '<label for="description">Description';
		// determine whether the field is required or not...
		$text .= '<abbr class="req" title="This is a required field">*</abbr>';
		$text .= ': </label>';
		$text .= '<input type="text" name="description" ';
		$text .= 'value="'.$vo->getData('description').'" />';
		$text .= '<br />';
		$text .= '</fieldset>';
		$text .= '</div>';
		return $text;
	}


	private function getFieldValue($field, $data) {
		if (isset($data[$field])) return $data[$field];
		return null;
	}


}
?>
