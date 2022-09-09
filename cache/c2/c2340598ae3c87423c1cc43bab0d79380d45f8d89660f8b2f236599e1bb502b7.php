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

/* home.twig */
class __TwigTemplate_d2d799fe4254f71c94c984ddb2b727b4f160f5074036607baea41e9cce84028f extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.twig", "home.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <title>Accueil</title>
";
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "
    <h1>Le super blog de l'AVBN !</h1>
    <p>Derniers billets du blog :</p>

    ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 13
            echo "    <div class=\"news\">
        <h3>";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 14), "html", null, true);
            echo " le ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "frenchCreationDate", [], "any", false, false, false, 14), "html", null, true);
            echo "</h3>
        <p>
            ";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "content", [], "any", false, false, false, 16), "html", null, true);
            echo "
            <br />
            <em><a href=\"index.php?action=post&id=";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["post"], "identifier", [], "any", false, false, false, 18), "html", null, true);
            echo "\">Commentaires</a></em>
        </p>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 22,  85 => 18,  80 => 16,  73 => 14,  70 => 13,  66 => 12,  60 => 8,  56 => 7,  51 => 4,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'layout.twig' %}

{% block head %}
    <title>Accueil</title>
{% endblock %}

{% block content %}

    <h1>Le super blog de l'AVBN !</h1>
    <p>Derniers billets du blog :</p>

    {% for post in posts %}
    <div class=\"news\">
        <h3>{{ post.title }} le {{ post.frenchCreationDate }}</h3>
        <p>
            {{ post.content }}
            <br />
            <em><a href=\"index.php?action=post&id={{ post.identifier }}\">Commentaires</a></em>
        </p>
    </div>
    {% endfor %}

{% endblock %}", "home.twig", "C:\\wamp64\\www\\htdocs\\22-OpenClassrooms\\5-Blog-en-PHP\\templates\\home.twig");
    }
}
