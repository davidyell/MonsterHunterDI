<?php
declare(strict_types=1);

namespace App\Views;

class View
{
    /**
     * @var array
     */
    public array $vars;

    /**
     * @var string
     */
    public string $templateFolder;

    /**
     * @var string
     */
    public string $template;

    /**
     * ViewVars constructor.
     *
     * @param array $vars Array of view variables to set
     * @param string $template The file path of the template to use
     */
    public function __construct(array $vars, string $templateFolder, string $template)
    {
        $this->vars = $vars;
        $this->templateFolder = $templateFolder;
        $this->template = $template;
    }
}
