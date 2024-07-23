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

/* frondend/default/servicios.twig */
class __TwigTemplate_b0148274f6db8efcf7f5f2f0e1c9ba48db05e4c6d87d898ab91d924de61151cf extends Template
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
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/servicios.twig", 22)->display($context);
        // line 23
        echo "</head>

<body class=\"page_services\">
    ";
        // line 26
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/servicios.twig", 26)->display($context);
        // line 27
        echo "    <main>
        <section class=\"breadcrumb-area bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-12\">
                        <h2>Nuestros Servicios</h2>
                        <ol class=\"breadcrumb\">
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "\">Inicio</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">Servicios</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        ";
        // line 41
        $context["sec_Servicios"] = twig_get_attribute($this->env, $this->source, ($context["servicios_categorias"] ?? null), "data", [], "method", false, false, false, 41);
        // line 42
        echo "        ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_Servicios"] ?? null)), 0))) {
            // line 43
            echo "        <section id=\"services\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row justify-content-center\">
                    <div class=\"title col-12\">
                        <p><img src=\"";
            // line 47
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/images/decorL.png\" alt=\"Shaddai\"><span>Lo que hacemos</span><img src=\"";
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/images/decorR.png\" alt=\"Shaddai\"></p>
                        <h2>Nuestros Servicios</h2>
                    </div>
                    ";
            // line 50
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_Servicios"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 51
                echo "                    <div class=\"col-service col-md-4 col-sm-6 col-xs-12\">
                        <a href=\"";
                // line 52
                echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
                echo "/servicios/categoria/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "seo", [], "any", false, false, false, 52), "html", null, true);
                echo "\">
                            <div class=\"item\">
                                <div class=\"item-image d-flex align-items-center\">
                                    <img src=\"";
                // line 55
                echo twig_escape_filter($this->env, (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 55)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["portada"] ?? null) : null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 55), "html", null, true);
                echo "\" class=\"img-fluid\">
                                </div>
                                <div class=\"item-text\">
                                    <h2>";
                // line 58
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 58), "html", null, true);
                echo "</h2>
                                    <p>";
                // line 59
                echo twig_escape_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 59)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["texto"] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["descripcion_corta"] ?? null) : null), "html", null, true);
                echo "</p>
                                    <span><img src=\"";
                // line 60
                echo twig_escape_filter($this->env, (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 60)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["icono"] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 60), "html", null, true);
                echo "\"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "                </div>
            </div>
        </section>
        ";
        } else {
            // line 70
            echo "        ";
        }
        // line 71
        echo "        <section id=\"contact\" class=\"padding bg-img\">
            <div class=\" container\">
                <div class=\"row justify-content-center\">
                    <div id=\"contacto\" class=\"col-info col-md-4 col-xs-12\">
                        <div class=\"title\">
                            <h2 class=\"text-left\"><span>Contáctanos</span></h2>
                        </div>
                        <div class=\"correos\">
                            <p><i class=\"fal fa-envelope\"></i>Correo</p>
                            <ul>
                                ";
        // line 81
        if ((0 !== twig_compare(twig_trim_filter((($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = ($context["config"] ?? null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40["email"] ?? null) : null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f[0] ?? null) : null)), ""))) {
            // line 82
            echo "                                <li>";
            echo twig_escape_filter($this->env, (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = ($context["config"] ?? null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["email"] ?? null) : null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f[0] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 84
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = ($context["config"] ?? null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["email"] ?? null) : null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce[1] ?? null) : null)), ""))) {
            // line 85
            echo "                                <li>";
            echo twig_escape_filter($this->env, (($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c = (($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = ($context["config"] ?? null)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972["email"] ?? null) : null)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c[1] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 87
        echo "                            </ul>
                        </div>
                        <div class=\"telefonos\">
                            <p><i class=\"fal fa-phone\"></i>Teléfonos</p>
                            <ul>
                                ";
        // line 92
        if ((0 !== twig_compare(twig_trim_filter((($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 = (($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 = ($context["config"] ?? null)) && is_array($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0) || $__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 instanceof ArrayAccess ? ($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0["telefono"] ?? null) : null)) && is_array($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216) || $__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 instanceof ArrayAccess ? ($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216[0] ?? null) : null)), ""))) {
            // line 93
            echo "                                <li>Ofic. ";
            echo twig_escape_filter($this->env, (($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c = (($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f = ($context["config"] ?? null)) && is_array($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f) || $__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f instanceof ArrayAccess ? ($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f["telefono"] ?? null) : null)) && is_array($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c) || $__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c instanceof ArrayAccess ? ($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c[0] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 95
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc = (($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 = ($context["config"] ?? null)) && is_array($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55) || $__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 instanceof ArrayAccess ? ($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55["telefono"] ?? null) : null)) && is_array($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc) || $__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc instanceof ArrayAccess ? ($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc[1] ?? null) : null)), ""))) {
            // line 96
            echo "                                <li>Ofic. ";
            echo twig_escape_filter($this->env, (($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba = (($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 = ($context["config"] ?? null)) && is_array($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78) || $__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 instanceof ArrayAccess ? ($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78["telefono"] ?? null) : null)) && is_array($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba) || $__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba instanceof ArrayAccess ? ($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba[1] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 98
        echo "                            </ul>
                        </div>
                        <div class=\"direccion\">
                            <p><i class=\"fal fa-map-marker-alt\"></i>Dirección</p>
                            <ul>
                                ";
        // line 103
        if ((0 !== twig_compare(twig_trim_filter((($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de = ($context["config"] ?? null)) && is_array($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de) || $__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de instanceof ArrayAccess ? ($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de["direccion"] ?? null) : null)), ""))) {
            // line 104
            echo "                                <li>";
            echo (($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 = ($context["config"] ?? null)) && is_array($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828) || $__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 instanceof ArrayAccess ? ($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828["direccion"] ?? null) : null);
            echo "</li>
                                ";
        }
        // line 106
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd = ($context["config"] ?? null)) && is_array($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd) || $__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd instanceof ArrayAccess ? ($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd["direccion2"] ?? null) : null)), ""))) {
            // line 107
            echo "                                <li>";
            echo (($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 = ($context["config"] ?? null)) && is_array($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6) || $__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 instanceof ArrayAccess ? ($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6["direccion2"] ?? null) : null);
            echo "</li>
                                ";
        }
        // line 109
        echo "                            </ul>
                        </div>
                    </div>
                    <div class=\"col-md-8 col-xs-12 text-center\">
                        <form method=\"post\" enctype=\"multipart/form-data\">
                            <div class=\"title\">
                                <h2>Solicitar <span>Cotización</span></h2>
                            </div>
                            <div class=\"form-row\">
                                <p class=\"text-center\">";
        // line 118
        echo (($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 118)) && is_array($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855) || $__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 instanceof ArrayAccess ? ($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855["servicios_cotizacion"] ?? null) : null);
        echo "</p>
                                <div class=\"form-group col-md-6\">
                                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"Nombre\" required=\"\">
                                </div>
                                <div class=\"form-group col-md-6\">
                                    <input type=\"text\" class=\"form-control\" id=\"company\" name=\"company\" placeholder=\"Empresa\" required=\"\">
                                </div>
                                <div class=\"form-group col-md-6\">
                                    <input type=\"text\" class=\"form-control\" id=\"phone\" name=\"phone\" placeholder=\"Teléfono\" required=\"\">
                                </div>
                                <div class=\"form-group col-md-6\">
                                    <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Correo\" required=\"\">
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <textarea class=\"form-control\" id=\"message\" name=\"message\" placeholder=\"Mensaje\" rows=\"10\"></textarea>
                            </div>
                            <button type=\"submit\" class=\"btn btn-primary btn-shaddai\">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    ";
        // line 142
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/servicios.twig", 142)->display($context);
        // line 143
        echo "    ";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/servicios.twig", 143)->display($context);
        // line 144
        echo "</body>

</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/servicios.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  320 => 144,  317 => 143,  315 => 142,  288 => 118,  277 => 109,  271 => 107,  268 => 106,  262 => 104,  260 => 103,  253 => 98,  247 => 96,  244 => 95,  238 => 93,  236 => 92,  229 => 87,  223 => 85,  220 => 84,  214 => 82,  212 => 81,  200 => 71,  197 => 70,  191 => 66,  177 => 60,  173 => 59,  169 => 58,  161 => 55,  153 => 52,  150 => 51,  146 => 50,  138 => 47,  132 => 43,  129 => 42,  127 => 41,  117 => 34,  108 => 27,  106 => 26,  101 => 23,  99 => 22,  95 => 21,  91 => 20,  87 => 19,  83 => 18,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 10,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/servicios.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/servicios.twig");
    }
}
