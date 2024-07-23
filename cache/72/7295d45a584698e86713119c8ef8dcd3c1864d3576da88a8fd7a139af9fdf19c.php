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

/* frondend/default/index.twig */
class __TwigTemplate_bd4e76f685d2a96f57275b50ce17f096ba6a4b3e926cd6da76741e977d22b17b extends Template
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
        echo "<!doctype html>
<html lang=\"es-PE\">

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
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/recursos.twig"), "frondend/default/index.twig", 22)->display($context);
        // line 23
        echo "</head>

<body>
    ";
        // line 26
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/header.twig"), "frondend/default/index.twig", 26)->display($context);
        // line 27
        echo "    <main>
        ";
        // line 28
        $context["banners"] = twig_get_attribute($this->env, $this->source, ($context["slider"] ?? null), "data", [], "method", false, false, false, 28);
        // line 29
        echo "        ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["banners"] ?? null)), 0))) {
            // line 30
            echo "        <section id=\"portada\" class=\"d-md-block\">
            <div id=\"carouselJovita\" class=\"carousel slide\" data-ride=\"carousel\">
                <ol class=\"carousel-indicators\">
                    ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 34
                echo "                    ";
                $context["active"] = "";
                // line 35
                echo "                    ";
                if ((0 === twig_compare($context["key"], "0"))) {
                    // line 36
                    echo "                    ";
                    $context["active"] = "active";
                    // line 37
                    echo "                    ";
                }
                // line 38
                echo "                    <li data-target=\"#myCarousel\" data-slide-to=\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" class=\"";
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo "\"></li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "                </ol>
                <div class=\"carousel-inner\">
                    ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 43
                echo "                    ";
                $context["active"] = "";
                // line 44
                echo "                    ";
                if ((0 === twig_compare($context["key"], "0"))) {
                    // line 45
                    echo "                    ";
                    $context["active"] = "active";
                    // line 46
                    echo "                    ";
                }
                // line 47
                echo "                    <div class=\"carousel-item ";
                echo twig_escape_filter($this->env, ($context["active"] ?? null), "html", null, true);
                echo "\">
                        <img src=\"";
                // line 48
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 48), "html", null, true);
                echo "\" class=\"d-block w-100\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "photo_name", [], "any", false, false, false, 48), "html", null, true);
                echo "\">
                        <div class=\"carousel-caption container\">
                            <div class=\"row d-flex align-items-center\" style=\"height: 100%;\">
                                <div class=\"col-lg-5\">
                                    <p><img src=\"";
                // line 52
                echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
                echo "/images/decor-1.png\" alt=\"Shaddai\">";
                echo twig_escape_filter($this->env, (($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 52)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["description"] ?? null) : null), "html", null, true);
                echo "</p>
                                    <h2>";
                // line 53
                echo twig_escape_filter($this->env, (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 53)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["title"] ?? null) : null), "html", null, true);
                echo "</h2>
                                    <p><a href=\"";
                // line 54
                echo twig_escape_filter($this->env, (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 54)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["button"] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["url"] ?? null) : null), "html", null, true);
                echo "\" target=\"_self\" class=\"btn btn-shaddai\">";
                echo twig_escape_filter($this->env, (($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 54)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae["button"] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["text"] ?? null) : null), "html", null, true);
                echo "</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                </div>
                <a class=\"carousel-control-prev\" href=\"#carouselJovita\" role=\"button\" data-slide=\"prev\">
                    <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Anterior</span>
                </a>
                <a class=\"carousel-control-next\" href=\"#carouselJovita\" role=\"button\" data-slide=\"next\">
                    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Siguente</span>
                </a>
            </div>
        </section>
        ";
        }
        // line 72
        echo "        ";
        $context["sec_Servicios"] = twig_get_attribute($this->env, $this->source, ($context["servicios_categorias"] ?? null), "data", [], "method", false, false, false, 72);
        // line 73
        echo "        ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_Servicios"] ?? null)), 0))) {
            // line 74
            echo "        <section id=\"services\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row justify-content-center\">
                    <div class=\"title col-12\">
                        <p><img src=\"";
            // line 78
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/images/decorL.png\" alt=\"Shaddai\"><span>Lo que hacemos</span><img src=\"";
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/images/decorR.png\" alt=\"Shaddai\"></p>
                        <h2>";
            // line 79
            echo twig_escape_filter($this->env, (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 79)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["home_servicios"] ?? null) : null), "html", null, true);
            echo "</h2>
                    </div>
                    ";
            // line 81
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_Servicios"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 82
                echo "                    <div class=\"col-service col-md-4 col-sm-6 col-xs-12\">
                        <a href=\"";
                // line 83
                echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
                echo "/servicios/categoria/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "seo", [], "any", false, false, false, 83), "html", null, true);
                echo "\">
                            <div class=\"item\">
                                <div class=\"item-image d-flex align-items-center\">
                                    <img src=\"";
                // line 86
                echo twig_escape_filter($this->env, (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = (($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 86)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f["portada"] ?? null) : null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 86), "html", null, true);
                echo "\" class=\"img-fluid\">
                                </div>
                                <div class=\"item-text\">
                                    <h2>";
                // line 89
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 89), "html", null, true);
                echo "</h2>
                                    <p>";
                // line 90
                echo twig_escape_filter($this->env, (($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = (($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 90)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce["texto"] ?? null) : null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760["descripcion_corta"] ?? null) : null), "html", null, true);
                echo "</p>
                                    <span><img src=\"";
                // line 91
                echo twig_escape_filter($this->env, (($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = (($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 91)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c["icono"] ?? null) : null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 91), "html", null, true);
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
            // line 97
            echo "                </div>
            </div>
        </section>
        ";
        } else {
            // line 101
            echo "        ";
        }
        // line 102
        echo "        <section id=\"message\" class=\"padding bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12 text-center\">
                        <h2>";
        // line 106
        echo (($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 106)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972["home_mensaje"] ?? null) : null);
        echo "</h2>
                        <a href=\"";
        // line 107
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "/nuestra-firma\" target=\"_self\" class=\"btn btn-shaddai\">Conócenos</a>
                    </div>
                </div>
            </div>
        </section>
        <section id=\"choose\" class=\"padding bg-img\">
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-6 col-xs-12\"></div>
                    <div class=\"col-md-6 col-sm-12 col-xs-12\">
                        <h2>¿Por qué escoger<br>nuestros servicios?</h2>
                        ";
        // line 118
        echo (($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 118)) && is_array($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216) || $__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 instanceof ArrayAccess ? ($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216["home_elegirnos"] ?? null) : null);
        echo "
                    </div>
                </div>
            </div>
        </section>
        <section id=\"testimonios\" class=\"padding\">
            <div class=\"container\">
                <div class=\"row justify-content-center\">
                    <div class=\"title col-12\">
                        <p><img src=\"";
        // line 127
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decorL.png\" alt=\"Shaddai\"><span>Lo que dicen</span><img src=\"";
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/images/decorR.png\" alt=\"Shaddai\"></p>
                        <h2>";
        // line 128
        echo twig_escape_filter($this->env, (($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 128)) && is_array($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0) || $__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 instanceof ArrayAccess ? ($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0["home_clientes"] ?? null) : null), "html", null, true);
        echo "</h2>
                    </div>
                    ";
        // line 130
        $context["sec_testimonios"] = twig_get_attribute($this->env, $this->source, ($context["testimonios"] ?? null), "data", [], "method", false, false, false, 130);
        // line 131
        echo "                    ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_testimonios"] ?? null)), 0))) {
            // line 132
            echo "                    <div class=\"col-md-8 col-xs-12 owl-testimonios owl-carousel owl-theme\">
                        ";
            // line 133
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_testimonios"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 134
                echo "                        <div class=\"item\">
                            <div class=\"autor-text\">
                                <div class=\"item-autor d-flex align-items-center\">
                                    <div class=\"item-autor-img\">
                                        <img src=\"";
                // line 138
                echo twig_escape_filter($this->env, (($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c = (($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 138)) && is_array($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f) || $__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f instanceof ArrayAccess ? ($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f["autor"] ?? null) : null)) && is_array($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c) || $__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c instanceof ArrayAccess ? ($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 138), "html", null, true);
                echo "\">
                                    </div>
                                    <div class=\"item-autor-text\">
                                        <h2>";
                // line 141
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 141), "html", null, true);
                echo "</h2>
                                        <h3>";
                // line 142
                echo (($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc = (($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 142)) && is_array($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55) || $__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 instanceof ArrayAccess ? ($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55["texto"] ?? null) : null)) && is_array($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc) || $__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc instanceof ArrayAccess ? ($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc["cargo"] ?? null) : null);
                echo "</h3>
                                    </div>
                                </div>
                                <div class=\"item-comentario\">
                                    <p>";
                // line 146
                echo (($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba = (($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 146)) && is_array($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78) || $__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 instanceof ArrayAccess ? ($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78["texto"] ?? null) : null)) && is_array($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba) || $__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba instanceof ArrayAccess ? ($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba["comentario"] ?? null) : null);
                echo "</p>
                                    <p><i class=\"fas fa-quote-right\"></i></p>
                                </div>
                            </div>
                            <div class=\"item-comentario-img video-gallery\">
                                <a href=\"";
                // line 151
                echo twig_escape_filter($this->env, (($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de = (($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 151)) && is_array($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828) || $__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 instanceof ArrayAccess ? ($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828["texto"] ?? null) : null)) && is_array($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de) || $__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de instanceof ArrayAccess ? ($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de["link"] ?? null) : null), "html", null, true);
                echo "\" data-poster=\"";
                echo twig_escape_filter($this->env, (($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd = (($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 151)) && is_array($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6) || $__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 instanceof ArrayAccess ? ($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6["portada"] ?? null) : null)) && is_array($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd) || $__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd instanceof ArrayAccess ? ($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd["file"] ?? null) : null), "html", null, true);
                echo "\">
                                    <img src=\"";
                // line 152
                echo twig_escape_filter($this->env, (($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 = (($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b = twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 152)) && is_array($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b) || $__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b instanceof ArrayAccess ? ($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b["portada"] ?? null) : null)) && is_array($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855) || $__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 instanceof ArrayAccess ? ($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855["file"] ?? null) : null), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 152), "html", null, true);
                echo "\">
                                    <div class=\"shadow-img\"></div>
                                    <img src=\"";
                // line 154
                echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
                echo "/images/play-button.png\" class=\"play\" alt=\"play\">
                                </a>
                            </div>
                        </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 159
            echo "                    </div>
                    ";
        } else {
            // line 161
            echo "                    ";
        }
        // line 162
        echo "                    ";
        $context["sec_clientes"] = twig_get_attribute($this->env, $this->source, ($context["isesion"] ?? null), "data", [], "method", false, false, false, 162);
        // line 163
        echo "                    ";
        if ((1 === twig_compare(twig_length_filter($this->env, ($context["sec_clientes"] ?? null)), 0))) {
            // line 164
            echo "                    <div class=\"col-md-8 col-xs-12 owl-clientes\">
                        ";
            // line 165
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sec_clientes"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 166
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, (($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f = twig_get_attribute($this->env, $this->source, $context["item"], "extra", [], "any", false, false, false, 166)) && is_array($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f) || $__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f instanceof ArrayAccess ? ($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f["link_web"] ?? null) : null), "html", null, true);
                echo "\" target=\"_blank\"><img src=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "photo", [], "any", false, false, false, 166), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 166), "html", null, true);
                echo "\"></a>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 168
            echo "                    </div>
                    ";
        } else {
            // line 170
            echo "                    ";
        }
        // line 171
        echo "                </div>
            </div>
        </section>
        <section id=\"contact\" class=\"padding bg-img\">
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
        // line 184
        if ((0 !== twig_compare(twig_trim_filter((($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 = (($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 = ($context["config"] ?? null)) && is_array($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55) || $__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 instanceof ArrayAccess ? ($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55["email"] ?? null) : null)) && is_array($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0) || $__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 instanceof ArrayAccess ? ($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0[0] ?? null) : null)), ""))) {
            // line 185
            echo "                                <li>";
            echo twig_escape_filter($this->env, (($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a = (($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 = ($context["config"] ?? null)) && is_array($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88) || $__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 instanceof ArrayAccess ? ($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88["email"] ?? null) : null)) && is_array($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a) || $__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a instanceof ArrayAccess ? ($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a[0] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 187
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 = (($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 = ($context["config"] ?? null)) && is_array($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35) || $__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 instanceof ArrayAccess ? ($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35["email"] ?? null) : null)) && is_array($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758) || $__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 instanceof ArrayAccess ? ($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758[1] ?? null) : null)), ""))) {
            // line 188
            echo "                                <li>";
            echo twig_escape_filter($this->env, (($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b = (($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae = ($context["config"] ?? null)) && is_array($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae) || $__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae instanceof ArrayAccess ? ($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae["email"] ?? null) : null)) && is_array($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b) || $__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b instanceof ArrayAccess ? ($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b[1] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 190
        echo "                            </ul>
                        </div>
                        <div class=\"telefonos\">
                            <p><i class=\"fal fa-phone\"></i>Teléfonos</p>
                            <ul>
                                ";
        // line 195
        if ((0 !== twig_compare(twig_trim_filter((($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 = (($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f = ($context["config"] ?? null)) && is_array($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f) || $__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f instanceof ArrayAccess ? ($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f["telefono"] ?? null) : null)) && is_array($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54) || $__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 instanceof ArrayAccess ? ($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54[0] ?? null) : null)), ""))) {
            // line 196
            echo "                                <li>Ofic. ";
            echo twig_escape_filter($this->env, (($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327 = (($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412 = ($context["config"] ?? null)) && is_array($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412) || $__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412 instanceof ArrayAccess ? ($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412["telefono"] ?? null) : null)) && is_array($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327) || $__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327 instanceof ArrayAccess ? ($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327[0] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 198
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9 = (($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e = ($context["config"] ?? null)) && is_array($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e) || $__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e instanceof ArrayAccess ? ($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e["telefono"] ?? null) : null)) && is_array($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9) || $__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9 instanceof ArrayAccess ? ($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9[1] ?? null) : null)), ""))) {
            // line 199
            echo "                                <li>Ofic. ";
            echo twig_escape_filter($this->env, (($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5 = (($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a = ($context["config"] ?? null)) && is_array($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a) || $__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a instanceof ArrayAccess ? ($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a["telefono"] ?? null) : null)) && is_array($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5) || $__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5 instanceof ArrayAccess ? ($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5[1] ?? null) : null), "html", null, true);
            echo "</li>
                                ";
        }
        // line 201
        echo "                            </ul>
                        </div>
                        <div class=\"direccion\">
                            <p><i class=\"fal fa-map-marker-alt\"></i>Dirección</p>
                            <ul>
                                ";
        // line 206
        if ((0 !== twig_compare(twig_trim_filter((($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4 = ($context["config"] ?? null)) && is_array($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4) || $__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4 instanceof ArrayAccess ? ($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4["direccion"] ?? null) : null)), ""))) {
            // line 207
            echo "                                <li>";
            echo (($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d = ($context["config"] ?? null)) && is_array($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d) || $__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d instanceof ArrayAccess ? ($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d["direccion"] ?? null) : null);
            echo "</li>
                                ";
        }
        // line 209
        echo "                                ";
        if ((0 !== twig_compare(twig_trim_filter((($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5 = ($context["config"] ?? null)) && is_array($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5) || $__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5 instanceof ArrayAccess ? ($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5["direccion2"] ?? null) : null)), ""))) {
            // line 210
            echo "                                <li>";
            echo (($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a = ($context["config"] ?? null)) && is_array($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a) || $__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a instanceof ArrayAccess ? ($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a["direccion2"] ?? null) : null);
            echo "</li>
                                ";
        }
        // line 212
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
        // line 221
        echo (($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da = twig_get_attribute($this->env, $this->source, ($context["internas"] ?? null), "extra_internas", [], "any", false, false, false, 221)) && is_array($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da) || $__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da instanceof ArrayAccess ? ($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da["home_cotizacion"] ?? null) : null);
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
        <section id=\"map\" class=\"padding\"></section>
    </main>
    ";
        // line 246
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/footer.twig"), "frondend/default/index.twig", 246)->display($context);
        // line 247
        echo "    ";
        $this->loadTemplate((($context["recursos"] ?? null) . "/recursos/javascript.twig"), "frondend/default/index.twig", 247)->display($context);
        // line 248
        echo "</body>

</html>";
    }

    public function getTemplateName()
    {
        return "frondend/default/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  577 => 248,  574 => 247,  572 => 246,  544 => 221,  533 => 212,  527 => 210,  524 => 209,  518 => 207,  516 => 206,  509 => 201,  503 => 199,  500 => 198,  494 => 196,  492 => 195,  485 => 190,  479 => 188,  476 => 187,  470 => 185,  468 => 184,  453 => 171,  450 => 170,  446 => 168,  433 => 166,  429 => 165,  426 => 164,  423 => 163,  420 => 162,  417 => 161,  413 => 159,  402 => 154,  395 => 152,  389 => 151,  381 => 146,  374 => 142,  370 => 141,  362 => 138,  356 => 134,  352 => 133,  349 => 132,  346 => 131,  344 => 130,  339 => 128,  333 => 127,  321 => 118,  307 => 107,  303 => 106,  297 => 102,  294 => 101,  288 => 97,  274 => 91,  270 => 90,  266 => 89,  258 => 86,  250 => 83,  247 => 82,  243 => 81,  238 => 79,  232 => 78,  226 => 74,  223 => 73,  220 => 72,  206 => 60,  192 => 54,  188 => 53,  182 => 52,  173 => 48,  168 => 47,  165 => 46,  162 => 45,  159 => 44,  156 => 43,  152 => 42,  148 => 40,  137 => 38,  134 => 37,  131 => 36,  128 => 35,  125 => 34,  121 => 33,  116 => 30,  113 => 29,  111 => 28,  108 => 27,  106 => 26,  101 => 23,  99 => 22,  95 => 21,  91 => 20,  87 => 19,  83 => 18,  78 => 16,  74 => 15,  70 => 14,  66 => 13,  62 => 12,  58 => 11,  54 => 10,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "frondend/default/index.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/index.twig");
    }
}
