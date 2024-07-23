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

/* /frondend/default/recursos/javascript.twig */
class __TwigTemplate_44e2f5076b2d4d0bd33ce0609de9c91f1c3148d647fda29dfa189ea3908b33b3 extends Template
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
        echo "<script src=\"https://code.jquery.com/jquery-3.5.1.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js\" integrity=\"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo\" crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js\" integrity=\"sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI\" crossorigin=\"anonymous\"></script>
";
        // line 4
        if ((0 !== twig_compare(($context["gobot"] ?? null), true))) {
            // line 5
            echo "<script src=\"";
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/owlcarousel/owl.carousel.min.js\"></script>
";
            // line 7
            echo "<script src=\"";
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/slick/slick.min.js\"></script>
<script src=\"";
            // line 8
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/js/lightgallery.min.js\"></script>
<script src=\"";
            // line 9
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/js/lg-fullscreen.js\"></script>
<script src=\"";
            // line 10
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/js/lg-thumbnail.js\"></script>
<script src=\"";
            // line 11
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/js/lg-video.js\"></script>
<script src=\"";
            // line 12
            echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
            echo "/recursos/lightgallery/js/lg-autoplay.js\"></script>

";
            // line 14
            if (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["args"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["nav"] ?? null) : null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["inicio"] ?? null) : null) || (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["args"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["nav"] ?? null) : null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["contacto"] ?? null) : null))) {
                // line 15
                echo "<script src=\"https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyAAkbV_12-3VtIa5W23_eQyxAPVIl1fgnU\" type=\"text/javascript\"></script>
";
            }
        }
        // line 18
        if ((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["args"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["configuration"] ?? null) : null)) {
            // line 19
            echo "<script>
var configuration = ";
            // line 20
            echo json_encode((($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["args"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["configuration"] ?? null) : null));
            echo ";
</script>
";
        }
        // line 23
        echo "<script>
var url = '";
        // line 24
        echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
        echo "';
</script>
<script src=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["theme"] ?? null), "html", null, true);
        echo "/js/main.js\"></script>";
    }

    public function getTemplateName()
    {
        return "/frondend/default/recursos/javascript.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 26,  96 => 24,  93 => 23,  87 => 20,  84 => 19,  82 => 18,  77 => 15,  75 => 14,  70 => 12,  66 => 11,  62 => 10,  58 => 9,  54 => 8,  49 => 7,  44 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/frondend/default/recursos/javascript.twig", "/home/eipdfqfc/public_html/engine/views/frondend/default/recursos/javascript.twig");
    }
}
