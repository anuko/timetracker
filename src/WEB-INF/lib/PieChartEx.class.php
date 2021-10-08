<?php
  require_once(LIBRARY_DIR.'/libchart/classes/libchart.php');

	/**
	* Pie chart extension to render pies with no title and labels
	*
	* @author   pingw33n
	*/

	class PieChartEx extends PieChart
	{
		/**
		* Render the chart image
		*
		* @access	public
		* @param	array		options: fileName, hideLogo, hideTitle, hidePie, hideLabel
		*/

		public function renderEx($options)
		{
			$hideLabel = isset($options['hideLabel']) && $options['hideLabel'] == true;

			$this->computePercent();

			if ($hideLabel) {
			 $this->plot->setGraphPadding(new Padding(0));
			 $this->plot->setTitleHeight(0);
			}
			$this->computeLayout(!$hideLabel);

			$this->createImage();

			if (!isset($options['hideLogo']) || $options['hideLogo'] == false)
				$this->plot->printLogo();
			if (!isset($options['hideTitle']) || $options['hideTitle'] == false)
				$this->plot->printTitle();
			if (!isset($options['hidePie']) || $options['hidePie'] == false)
				$this->printPie();
			if (!$hideLabel)
				$this->printLabel();

			/*if(isset($options['fileName']))
				imagepng($this->img, $options['fileName']);
			else
				imagepng($this->img); */
			$this->plot->render($options['fileName']);
		}
	}

