<?php

/* ThousandMonkeysLibraryBundle::master.html.twig */
class __TwigTemplate_7442ba129ae45ce38405e697b3cbb5a5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'scripts' => array($this, 'block_scripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  \t<head>
  \t\t<link href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/thousandmonkeyslibrary/bootstrap/css/bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\"/>
  \t\t";
        // line 5
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "  \t\t";
        $this->displayBlock('scripts', $context, $blocks);
        // line 10
        echo "  </head>
  <body>
  \t<div class=\"container-fluid\">
  \t\t<div class=\"navbar\">
\t  \t\t<div class=\"navbar-inner\">
    \t\t\t<a class=\"brand\" href=\"#\">1KM1KT</a>
  \t\t\t\t<ul class=\"nav\">
  \t\t\t\t\t<li><a href=\"#\">Home</a></li>
\t\t\t\t</ul>
\t\t\t\t
        <ul class=\"nav pull-right\">
            <li>
                <a href=\"#\">
                  
                  
                </a>
            </li>
        </ul>

        <form class=\"navbar-search pull-right\">
            <input type=\"text\" class=\"search-query\" placeholder=\"Search\">
        </form>

\t\t\t</div>
\t\t</div>
  \t\t";
        // line 35
        $this->displayBlock('body', $context, $blocks);
        // line 37
        echo "  \t</div>
  </body>
</html>";
    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "  \t\t";
    }

    // line 7
    public function block_scripts($context, array $blocks = array())
    {
        // line 8
        echo "
  \t\t";
    }

    // line 35
    public function block_body($context, array $blocks = array())
    {
        // line 36
        echo "  \t\t";
    }

    public function getTemplateName()
    {
        return "ThousandMonkeysLibraryBundle::master.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 36,  84 => 35,  79 => 8,  76 => 7,  72 => 6,  69 => 5,  63 => 37,  61 => 35,  34 => 10,  31 => 7,  29 => 5,  25 => 4,  20 => 1,);
    }
}
