<?php

/* ThousandMonkeysLibraryBundle:Version:index.html.twig */
class __TwigTemplate_ac5f72892e08c1818b29407df2c03ef2 extends Twig_Template
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
        echo "\tVersion ";
        echo twig_escape_filter($this->env, $this->getContext($context, "versionId"), "html", null, true);
        echo "!
";
    }

    public function getTemplateName()
    {
        return "ThousandMonkeysLibraryBundle:Version:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  26 => 3,);
    }
}
