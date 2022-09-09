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

/* layout.twig */
class __TwigTemplate_9a58b6d254ea821eab3f9691382368a4d21717323562c1ae3e021535a65e4e88 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"en\">
<head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 5
        echo "    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <link href=\"style.css\" rel=\"stylesheet\" />
    <title>Document</title>
</head>
<body>

    <ul>
";
        // line 17
        echo "    </ul>

    ";
        // line 19
        $this->displayBlock('content', $context, $blocks);
        // line 20
        echo "
</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 19
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function getDebugInfo()
    {
        return array (  76 => 19,  70 => 4,  64 => 20,  62 => 19,  58 => 17,  46 => 5,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"en\">
<head>
    {% block head %}{% endblock %}
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <link href=\"style.css\" rel=\"stylesheet\" />
    <title>Document</title>
</head>
<body>

    <ul>
{#        <li class=\"{{ activeClass('home') }}\"><a href=\"index.php?p=home\">Accueil</a></li>#}
{#        <li class=\"{{ activeClass('contact') }}\"><a href=\"index.php?p=contact\">Contact</a></li>#}
    </ul>

    {%  block content %}{% endblock %}

</body>
</html>", "layout.twig", "C:\\wamp64\\www\\htdocs\\22-OpenClassrooms\\5-Blog-en-PHP\\templates\\layout.twig");
    }
}
