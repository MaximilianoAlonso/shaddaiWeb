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

/* frondend/default/gracias.twig */
class __TwigTemplate_bb8addb9965c5a1045ae9aa5d06332954cd127ced92a926664f80128c9948c01 extends Template
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
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 6)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["meta_titulo"] ?? null) : null), "html", null, true);
        echo "</title>
\t<meta name=\"description\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 7)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
\t<meta property=\"og:type\" content=\"website\" />
\t<meta property=\"og:title\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 9)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["meta_titulo"] ?? null) : null), "html", null, true);
        echo "\" />
\t<meta property=\"og:site_name\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_site_name", [], "any", false, false, false, 10), "html", null, true);
        echo "\" />
\t<meta property=\"og:image\" content=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 11), "html", null, true);
        echo "\" />
\t<meta property=\"og:image:secure_url\" content=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 12), "html", null, true);
        echo "\" />
\t<meta property=\"og:locale\" content=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_locale", [], "any", false, false, false, 13), "html", null, true);
        echo "\" />
\t<meta property=\"og:description\" content=\"";
        // line 14
        echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 14)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
\t<meta property=\"og:url\" content=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
\t<meta name=\"twitter:card\" content=\"summary\" />
\t<meta name=\"twitter:title\" content=\"";
        // line 17
        echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 17)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["meta_titulo"] ?? null) : null), "html", null, true);
        echo "\" />
\t<meta name=\"twitter:description\" content=\"";
        // line 18
        echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 18)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
\t<meta name=\"twitter:image\" content=\"";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 19), "html", null, true);
        echo "\" />
\t<meta name=\"twitter:domain\" content=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
\t";
        // line 21
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/gracias.twig", 21)->display($context);
        // line 22
        echo "</head>
<body>
\t";
        // line 24
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/gracias.twig", 24)->display($context);
        // line 25
        echo "\t<main>
         <section class=\"breadcrumb-area bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-12\">
                        <h2></h2>
                        <ol class=\"breadcrumb\">
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 32
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "\">Inicio</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">Gracias</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section id=\"contacto\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12 col-xs-12 formulario text-center\">
                        <h2>Gracias por enviar su mensaje!</h2>
                        <p class=\"mb-0\">Estaremos respondiendo en un período máximo de 24 horas.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
\t";
        // line 50
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/gracias.twig", 50)->display($context);
        // line 51
        echo "\t";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/gracias.twig", 51)->display($context);
        // line 52
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/gracias.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 52,  138 => 51,  136 => 50,  115 => 32,  106 => 25,  104 => 24,  100 => 22,  98 => 21,  94 => 20,  90 => 19,  86 => 18,  82 => 17,  77 => 15,  73 => 14,  69 => 13,  65 => 12,  61 => 11,  57 => 10,  53 => 9,  48 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/gracias.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/gracias.twig");
    }
}
