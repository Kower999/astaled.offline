<?php

class PDF extends PDFCore
{

	public function render($display = true)
	{
		$render = false;
		$this->pdf_renderer->setFontForLang('fr');
		foreach ($this->objects as $object)
		{
			$template = $this->getTemplateObject($object);
			if (!$template)
				continue;

			if (empty($this->filename))
			{
				$this->filename = $template->getFilename();
				if (count($this->objects) > 1)
					$this->filename = $template->getBulkFilename();
			}

			$template->assignHookData($object);

			$this->pdf_renderer->createAltHeader($template->getAltHeader());
			$this->pdf_renderer->createHeader($template->getHeader());
//			$this->pdf_renderer->createFooter($template->getFooter());
			$this->pdf_renderer->createContent($template->getContent());
			$this->pdf_renderer->writePage();
			$render = true;

			unset($template);
		}

		if ($render)
			return $this->pdf_renderer->render($this->filename, $display);
	}

}

