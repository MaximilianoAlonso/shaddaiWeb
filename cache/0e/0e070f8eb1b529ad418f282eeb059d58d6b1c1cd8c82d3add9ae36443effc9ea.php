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

/* frondend/default/nosotros.twig */
class __TwigTemplate_a2a172f8f0fe61ac60e6da13dce6e84a1990a1693308e22ff723e85944f21536 extends Template
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
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
    <title>";
        // line 7
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 7)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["meta_titulo"] ?? null) : null), "html", null, true);
        echo "</title>
    <meta name=\"description\" content=\"";
        // line 8
        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 8)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta property=\"og:title\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 10)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["meta_titulo"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:site_name\" content=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_site_name", [], "any", false, false, false, 11), "html", null, true);
        echo "\" />
    <meta property=\"og:image\" content=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 12), "html", null, true);
        echo "\" />
    <meta property=\"og:image:secure_url\" content=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 13), "html", null, true);
        echo "\" />
    <meta property=\"og:locale\" content=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_locale", [], "any", false, false, false, 14), "html", null, true);
        echo "\" />
    <meta property=\"og:description\" content=\"";
        // line 15
        echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 15)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:url\" content=\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
    <meta name=\"twitter:card\" content=\"summary\" />
    <meta name=\"twitter:title\" content=\"";
        // line 18
        echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 18)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["meta_titulo"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta name=\"twitter:description\" content=\"";
        // line 19
        echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 19)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["meta_descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta name=\"twitter:image\" content=\"";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_banner", [], "any", false, false, false, 20), "html", null, true);
        echo "\" />
    <meta name=\"twitter:domain\" content=\"";
        // line 21
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
    ";
        // line 22
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/nosotros.twig", 22)->display($context);
        // line 23
        echo "</head>

<body class=\"page_nuestra_firma\">
    ";
        // line 26
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/nosotros.twig", 26)->display($context);
        // line 27
        echo "    <main>
        <section class=\"breadcrumb-area bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-12\">
                        <h2>Nuestra Firma</h2>
                        <ol class=\"breadcrumb\">
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "\">Inicio</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">Nuestra Firma</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section id=\"nuestra-firma\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <img src=\"";
        // line 45
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/nosotros.png\" alt=\"Shaddai\" class=\"img-fluid w-100\">
                    </div>
                    <div class=\"col-md-12\">
                        <h2><img src=\"";
        // line 48
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Quiénes Somos</h2>
                        ";
        // line 49
        echo (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 49)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["text_quienes_somos"] ?? null) : null);
        echo "
                    </div>
                </div>
            </div>
        </section>
        <section id=\"principios\" class=\"padding bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <h2><img src=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Nuestros Principios</h2>
                        ";
        // line 59
        echo (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 59)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["text_principios"] ?? null) : null);
        echo "
                    </div>
                </div>
            </div>
        </section>
        <section id=\"vmision\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-6 col-xs-12\">
                        <h2><img src=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Nuestra Visión</h2>
                        <p>";
        // line 69
        echo (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 69)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["text_vision"] ?? null) : null);
        echo "</p>
                    </div>
                    <div class=\"col-md-6 col-xs-12\">
                        <h2><img src=\"";
        // line 72
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-1.png\" alt=\"Shaddai\">Nuestra Misión</h2>
                        <p>";
        // line 73
        echo (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 73)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["text_mision"] ?? null) : null);
        echo "</p>
                    </div>
                </div>
            </div>
        </section>
        <section id=\"team\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <h2><img src=\"";
        // line 82
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Nuestro Equipo</h2>
                        <p>";
        // line 83
        echo twig_escape_filter($this->env, (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 83)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["text_equipo"] ?? null) : null), "html", null, true);
        echo "</p>
                    </div>
                    ";
        // line 85
        $context["sec_equipo"] = twig_get_attribute($this->env, $this->source, ($context["equipo"] ?? null), "data", [], "method", false, false, false, 85);
        // line 86
        echo "                    ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_equipo"] ?? null)), 0))) {
            // line 87
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_equipo"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 88
                echo "                    <div class=\"col-md-4 col-xs-6\">
                        <div class=\"col-team text-center\">
                            <img src=\"";
                // line 90
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 90), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 90), "html", null, true);
                echo "\" class=\"img-fluid w-100\">
                            <div class=\"info text-left\">
                                <p>";
                // line 92
                echo twig_escape_filter($this->env, (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 92)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["cargo"] ?? null) : null), "html", null, true);
                echo "</p>
                                <h2>";
                // line 93
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 93), "html", null, true);
                echo "</h2>
                            </div>
                        </div>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                    ";
        }
        // line 99
        echo "                </div>
            </div>
        </section>
    </main>
    ";
        // line 103
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/nosotros.twig", 103)->display($context);
        // line 104
        echo "    ";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/nosotros.twig", 104)->display($context);
        // line 105
        echo "</body>

</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/nosotros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  254 => 105,  251 => 104,  249 => 103,  243 => 99,  240 => 98,  229 => 93,  225 => 92,  218 => 90,  214 => 88,  209 => 87,  206 => 86,  204 => 85,  199 => 83,  195 => 82,  183 => 73,  179 => 72,  173 => 69,  169 => 68,  157 => 59,  153 => 58,  141 => 49,  137 => 48,  131 => 45,  117 => 34,  108 => 27,  106 => 26,  101 => 23,  99 => 22,  95 => 21,  91 => 20,  87 => 19,  83 => 18,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 10,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/nosotros.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/nosotros.twig");
    }
}
