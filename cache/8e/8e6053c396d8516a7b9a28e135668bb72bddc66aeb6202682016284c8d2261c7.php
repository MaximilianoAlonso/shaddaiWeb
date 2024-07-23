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

/* frondend/default/base.twig */
class __TwigTemplate_ac59382d431484a6ed02b0a3e6c926f3eeac672e52d2b0df0915d353905ff737 extends Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
\t<title>";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "titulo_personalizados", [], "any", false, false, false, 6), "html", null, true);
        echo "</title>
\t<meta name=\"description\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "descripcion_personalizados", [], "any", false, false, false, 7), "html", null, true);
        echo "\" />
\t<meta property=\"og:type\" content=\"website\" />
\t<meta property=\"og:title\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "titulo_personalizados", [], "any", false, false, false, 9), "html", null, true);
        echo "\" />
\t<meta property=\"og:site_name\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_site_name", [], "any", false, false, false, 10), "html", null, true);
        echo "\" />
\t<meta property=\"og:image\" content=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "photo_small_personalizados", [], "any", false, false, false, 11), "html", null, true);
        echo "\" />
\t<meta property=\"og:locale\" content=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_locale", [], "any", false, false, false, 12), "html", null, true);
        echo "\" />
\t<meta property=\"og:description\" content=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "descripcion_personalizados", [], "any", false, false, false, 13), "html", null, true);
        echo "\" />
\t    <script src=\"https://kit.fontawesome.com/f9457e77c9.js\" crossorigin=\"anonymous\"></script>

\t<meta property=\"og:url\" content=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
\t";
        // line 17
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/base.twig", 17)->display($context);
        // line 18
        echo "</head>
<body class=\"services\">
\t";
        // line 20
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/base.twig", 20)->display($context);
        // line 21
        echo "\t<main>

\t\t<section class=\"section padding\" id=\"services\">
\t\t\t<div class=\"container\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-lg-12\">
\t\t\t\t\t\t<div class=\"head\">
\t\t\t\t\t\t\t<h2 class=\"text-center\">
\t\t\t\t\t\t\t\t";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "name_personalizados", [], "any", false, false, false, 29), "html", null, true);
        echo "
\t\t\t\t\t\t\t</h2>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"body\">
\t\t\t\t\t\t\t";
        // line 33
        echo twig_get_attribute($this->env, $this->source, ($context["personalizados"] ?? null), "contenidos_personalizados", [], "any", false, false, false, 33);
        echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</section>
\t</main>
\t";
        // line 40
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/base.twig", 40)->display($context);
        // line 41
        echo "\t";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/base.twig", 41)->display($context);
        // line 42
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 42,  116 => 41,  114 => 40,  104 => 33,  97 => 29,  87 => 21,  85 => 20,  81 => 18,  79 => 17,  75 => 16,  69 => 13,  65 => 12,  61 => 11,  57 => 10,  53 => 9,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/base.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/base.twig");
    }
}
