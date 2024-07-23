<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /frondend/default/recursos/recursos.twig */
class __TwigTemplate_903d784ce87ad09665b7c571951a454771fe761d613aa0a4709c706dacab93dd extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\">
";
        // line 2
        if ((0 !== twig_compare(($context["gobot"] ?? null), true))) {
            // line 3
            echo "<link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/fontawesome/css/all.css\">
<link rel=\"stylesheet\" href=\"";
            // line 4
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/owlcarousel/assets/owl.carousel.min.css\">
<link rel=\"stylesheet\" href=\"";
            // line 5
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/owlcarousel/assets/owl.theme.default.min.css\">
<link rel=\"stylesheet\" href=\"";
            // line 6
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/slick/slick.css\">
<link rel=\"stylesheet\" href=\"";
            // line 7
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/slick/slick-theme.css\">
<link rel=\"stylesheet\" href=\"";
            // line 8
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/css/lightgallery.min.css\">
";
        }
        // line 10
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/css/main.css\">
<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/favicon.png\" />
</head>
";
        // line 13
        if ((0 !== twig_compare(($context["gobot"] ?? null), true))) {
        }
    }

    public function getTemplateName()
    {
        return "/frondend/default/recursos/recursos.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 13,  73 => 11,  68 => 10,  63 => 8,  59 => 7,  55 => 6,  51 => 5,  47 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/frondend/default/recursos/recursos.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/recursos/recursos.twig");
    }
}
