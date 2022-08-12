<?php

class MyExtension extends \Twig\Extension\AbstractExtension
{
    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('markdown_filter', [$this, 'markdownParse'], ['is_safe' => ['html']])
        ];
    }

    public function getFunctions()
    {
        return [
            new Twig\TwigFunction('activeClass', [$this, 'activeClass'], ['needs_context' => true])
        ];
    }

    public function markdownParse($value) {
        return \Michelf\MarkdownExtra::defaultTransform($value);
    }

    public function activeClass(array $context, $page) {
//        var_dump($context);
        echo $page;

        if (isset($context['current_page']) && $context['current_page'] === $page) {
            return 'active';
        }
    }
}