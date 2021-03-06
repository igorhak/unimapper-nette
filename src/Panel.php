<?php

namespace UniMapper\Nette;

use Nette\Diagnostics\Dumper,
    Nette\Diagnostics\IBarPanel;

class Panel implements IBarPanel
{

    protected $repositories = array();

    public function registerRepository(\UniMapper\Repository $repository)
    {
        $this->repositories[] = $repository;
    }

    private function getClickable($variable, $collapsed = false)
    {
        if (class_exists('Nette\Diagnostics\Dumper')) {
            return Dumper::toHtml($variable, [Dumper::COLLAPSE => $collapsed]);
        }

        // Nette 2.0 back compatibility
        return \Nette\Diagnostics\Helpers::clickableDump($variable, $collapsed);
    }

    public function getTab()
    {
        ob_start();
        $count = 0;
        foreach ($this->repositories as $repository) {
            foreach ($repository->getLogger()->getQueries() as $query) {
                if ($query->getResult() !== null) {
                    $count++;
                }
            }
        }
        require __DIR__ . "/templates/Panel.tab.phtml";
        return ob_get_clean();
    }

    public function getPanel()
    {
        ob_start();
        require __DIR__ . "/templates/Panel.panel.phtml";
        return ob_get_clean();
    }

}