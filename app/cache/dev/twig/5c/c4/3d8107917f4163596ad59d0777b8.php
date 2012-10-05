<?php

/* ThousandMonkeysLibraryBundle:Default:index.html.twig */
class __TwigTemplate_5cc43d8107917f4163596ad59d0777b8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("ThousandMonkeysLibraryBundle::master.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "ThousandMonkeysLibraryBundle::master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "\tVersion: ";
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "!

\t";
        // line 6
        echo twig_var_dump($this->env, $context, $this->getContext($context, "user"));
        echo "
";
    }

    public function getTemplateName()
    {
        return "ThousandMonkeysLibraryBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 6,  29 => 4,  26 => 3,);
    }
}
