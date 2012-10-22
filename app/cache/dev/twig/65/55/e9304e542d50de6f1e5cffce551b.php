<?php

/* ThousandMonkeysLibraryBundle::master.html.twig */
class __TwigTemplate_6555e9304e542d50de6f1e5cffce551b extends Twig_Template
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
        echo "
  \t\t";
        // line 8
        $this->displayBlock('scripts', $context, $blocks);
        // line 10
        echo "      <!--[if lt IE 9]><script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script><![endif]-->
  </head>
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
                  ";
        // line 23
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "security"), "getToken", array(), "method"), "getUser", array(), "method") != "")) {
            // line 24
            echo "                    <a href=\"#\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "security"), "getToken", array(), "method"), "getUser", array(), "method"), "getUsername", array(), "method"), "html", null, true);
            echo "</a>
                    ";
        } else {
            // line 26
            echo "                    <a href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "phpbb_forum_url"), "html", null, true);
            echo "/ucp.php?mode=login\">Hey! Login!</a>
                  ";
        }
        // line 28
        echo "            </li>
        </ul>

        <form class=\"navbar-search pull-right\">
            <input type=\"text\" class=\"search-query\" placeholder=\"Search\">
        </form>

\t\t\t</div>
\t\t</div>

  \t\t";
        // line 38
        $this->displayBlock('body', $context, $blocks);
        // line 40
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

    // line 8
    public function block_scripts($context, array $blocks = array())
    {
        // line 9
        echo "  \t\t";
    }

    // line 38
    public function block_body($context, array $blocks = array())
    {
        // line 39
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
        return array (  102 => 39,  99 => 38,  95 => 9,  92 => 8,  88 => 6,  85 => 5,  79 => 40,  77 => 38,  65 => 28,  59 => 26,  53 => 24,  51 => 23,  36 => 10,  34 => 8,  31 => 7,  29 => 5,  25 => 4,  20 => 1,  40 => 7,  37 => 6,  30 => 3,  27 => 2,);
    }
}
