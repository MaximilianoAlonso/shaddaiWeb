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

/* frondend/default/servicios/auto.twig */
class __TwigTemplate_1e1a075bdd070cdf53eca40953f2cbd5b3a665f883f834fe26a42998128bd1ce extends Template
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
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 7)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["meta"] ?? null) : null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["titulo"] ?? null) : null), "html", null, true);
        echo "</title>
    <meta name=\"description\" content=\"";
        // line 8
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 8)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["meta"] ?? null) : null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:type\" content=\"website\" />
    <meta property=\"og:title\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 10)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["meta"] ?? null) : null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["titulo"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:site_name\" content=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_site_name", [], "any", false, false, false, 11), "html", null, true);
        echo "\" />
    <meta property=\"og:image\" content=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "photo_small_servicios", [], "any", false, false, false, 12), "html", null, true);
        echo "\" />
    <meta property=\"og:locale\" content=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["config"] ?? null), "facebook_locale", [], "any", false, false, false, 13), "html", null, true);
        echo "\" />
    <meta property=\"og:description\" content=\"";
        // line 14
        echo twig_escape_filter($this->env, (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 14)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["meta"] ?? null) : null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["descripcion"] ?? null) : null), "html", null, true);
        echo "\" />
    <meta property=\"og:url\" content=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["request"] ?? null), "html", null, true);
        echo "\">
    ";
        // line 16
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/servicios/auto.twig", 16)->display($context);
        // line 17
        echo "</head>

<body class=\"page_service_detail\">
    ";
        // line 20
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/servicios/auto.twig", 20)->display($context);
        // line 21
        echo "    <main>
        <section class=\"breadcrumb-area bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-12\">
                        <h2>";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "name_servicios", [], "any", false, false, false, 26), "html", null, true);
        echo "</h2>
                        <ol class=\"breadcrumb\">
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "\">Inicio</a></li>
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 29
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "/servicios\">Servicios</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "name_servicios", [], "any", false, false, false, 30), "html", null, true);
        echo "</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section id=\"services_detail\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-8 left-sdetail\">
                        <img src=\"";
        // line 40
        echo twig_escape_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "photo_servicios", [], "any", false, false, false, 40)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["principalserv"] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["file"] ?? null) : null), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "name_servicios", [], "any", false, false, false, 40), "html", null, true);
        echo "\" class=\"img-fluid w-100\">
                        <div class=\"title\">
                            <p><img src=\"";
        // line 42
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Descripción</p>
                            <h3>";
        // line 43
        echo (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 43)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["texto"] ?? null) : null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["servicio"] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["descrpcion"] ?? null) : null);
        echo "</h3>
                        </div>
                        <div class=\"content\">
                            ";
        // line 46
        echo (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "extra_servicios", [], "any", false, false, false, 46)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["texto"] ?? null) : null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["servicio"] ?? null) : null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40["contenido"] ?? null) : null);
        echo "
                        </div>
                    </div>
                    <div class=\"col-md-1\"></div>
                    <div class=\"col-md-3 right-sdetail\">
                        <div class=\"other-services\">
                            <div class=\"title\">
                                <p><img src=\"";
        // line 53
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decor-3.png\" alt=\"Shaddai\">Otros Servicios</p>
                                ";
        // line 54
        $context["sec_servicio"] = twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "data", [], "method", false, false, false, 54);
        // line 55
        echo "                                ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_servicio"] ?? null)), 0))) {
            // line 56
            echo "                                <ul>
                                    ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_servicio"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 58
                echo "                                    ";
                $context["active"] = "";
                // line 59
                echo "                                    ";
                if ((0 === twig_compare(twig_get_attribute($this->env, $this->source, $context["item"], "seo", [], "any", false, false, false, 59), twig_get_attribute($this->env, $this->source, ($context["servicios"] ?? null), "seo_servicios", [], "any", false, false, false, 59)))) {
                    // line 60
                    echo "                                    ";
                    $context["active"] = "active";
                    // line 61
                    echo "                                    ";
                }
                // line 62
                echo "                                    <a href=\"";
                echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
                echo "/servicios/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "seo", [], "any", false, false, false, 62), "html", null, true);
                echo "\">
                                        <li class=\"";
                // line 63
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 63), "html", null, true);
                echo "</li>
                                    </a>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "                                </ul>
                                ";
        }
        // line 68
        echo "                            </div>
                        </div>
                        <div class=\"contact-services\">
                            <form method=\"post\" enctype=\"multipart/form-data\">
                                <div class=\"title\">
                                    <h2>Contáctanos</h2>
                                </div>
                                <div class=\"form-row\">
                                    <div class=\"form-group col-md-12\">
                                        <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Nombre\" required=\"\">
                                    </div>
                                    <div class=\"form-group col-md-12\">
                                        <input type=\"text\" class=\"form-control\" id=\"company\" name=\"company\" placeholder=\"Empresa\" required=\"\">
                                    </div>
                                    <div class=\"form-group col-md-12\">
                                        <input type=\"text\" class=\"form-control\" id=\"phone\" name=\"phone\" placeholder=\"Teléfono\" required=\"\">
                                    </div>
                                    <div class=\"form-group col-md-12\">
                                        <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Correo\" required=\"\">
                                    </div>
                                </div>
                                <div class=\"form-group\">
                                    <textarea class=\"form-control\" id=\"message\" name=\"message\" placeholder=\"Mensaje\" rows=\"3\"></textarea>
                                </div>
                                <button type=\"submit\" class=\"btn btn-primary btn-shaddai\">Enviar Mensaje</button>
                            </form>
                        </div>
                        <div class=\"help-services\">
                            <div class=\"title\">
                                <div class=\"title\">
                                    <h2>Contáctanos</h2>
                                    <p>";
        // line 99
        echo twig_escape_filter($this->env, (($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = ($context["config"] ?? null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["email"] ?? null) : null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce[0] ?? null) : null), "html", null, true);
        echo "</p>
                                    <p>";
        // line 100
        echo twig_escape_filter($this->env, (($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c = (($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = ($context["config"] ?? null)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972["whatsapp"] ?? null) : null)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c[0] ?? null) : null), "html", null, true);
        echo "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    ";
        // line 109
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/servicios/auto.twig", 109)->display($context);
        // line 110
        echo "    ";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/servicios/auto.twig", 110)->display($context);
        // line 111
        echo "</body>

</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/servicios/auto.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  251 => 111,  248 => 110,  246 => 109,  234 => 100,  230 => 99,  197 => 68,  193 => 66,  182 => 63,  175 => 62,  172 => 61,  169 => 60,  166 => 59,  163 => 58,  159 => 57,  156 => 56,  153 => 55,  151 => 54,  147 => 53,  137 => 46,  131 => 43,  127 => 42,  120 => 40,  107 => 30,  103 => 29,  99 => 28,  94 => 26,  87 => 21,  85 => 20,  80 => 17,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 10,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/servicios/auto.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/servicios/auto.twig");
    }
}
