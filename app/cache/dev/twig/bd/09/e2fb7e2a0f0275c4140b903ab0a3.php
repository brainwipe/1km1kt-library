<?php

/* ThousandMonkeysLibraryBundle:Upload:index.html.twig */
class __TwigTemplate_bd09e2fb7e2a0f0275c4140b903ab0a3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("ThousandMonkeysLibraryBundle::master.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
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

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "\t<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/thousandmonkeyslibrary/css/upload.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\"/>
";
    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        // line 7
        echo "<div class=\"container upload\">
  <h1>Upload</h1>
  \tThank you for choosing to share your free RPG with the world! Get started by filling in the form below and clicking upload at the bottom. You will get a chance to add more information and files after.

\t<form action=\"#\" method=\"post\" ";
        // line 11
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'enctype');
        echo ">
    ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'errors');
        echo "
    

    ";
        // line 20
        echo "
    ";
        // line 30
        echo "
    <h2>1. What is your game called?</h2>
    ";
        // line 32
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "name"), 'widget');
        echo "

    ";
        // line 34
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "form"), "documents"));
        foreach ($context['_seq'] as $context["_key"] => $context["document"]) {
            // line 35
            echo "      ";
            echo $this->getAttribute($this, "prototypeDoc", array(0 => $this->getContext($context, "document")), "method");
            echo "

      ";
            // line 37
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "document"), "versions"));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 38
                echo "        ";
                echo $this->getAttribute($this, "prototypeVer", array(0 => $this->getContext($context, "version")), "method");
                echo "
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 40
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['document'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 42
        echo "    
    ";
        // line 43
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'rest');
        echo "

    <button class=\"btn btn-primary\" type=\"submit\"><i class=\"icon-white icon-upload\"></i> Upload</button>
  \t</form>
</div>
";
    }

    // line 15
    public function getprototypeDoc($document = null)
    {
        $context = $this->env->mergeGlobals(array(
            "document" => $document,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "      <h2>2. What is the name of the document?</h2>
      <p>If you're not sure, leave it as 'Core Rules'.</p>
      ";
            // line 18
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "document"), "name"), 'widget');
            echo "
    ";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 21
    public function getprototypeVer($version = null)
    {
        $context = $this->env->mergeGlobals(array(
            "version" => $version,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 22
            echo "      <h2>3. What version is the file?</h2>
      <p>If you're not sure, leave it as '1'. Some designers like to call games in ongoing development as 'Beta'.</p>
      ";
            // line 24
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "version"), "versionName"), 'widget');
            echo "

      <h2>4. Choose your file</h2>
      <p>Start by uploading the core rules. If you have more files, then that's ok, you can add them later.</p>
      ";
            // line 28
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "version"), "file"), 'widget');
            echo "
    ";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "ThousandMonkeysLibraryBundle:Upload:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 28,  154 => 24,  150 => 22,  139 => 21,  126 => 18,  122 => 16,  111 => 15,  101 => 43,  98 => 42,  91 => 40,  82 => 38,  78 => 37,  72 => 35,  68 => 34,  63 => 32,  59 => 30,  56 => 20,  50 => 12,  46 => 11,  40 => 7,  37 => 6,  30 => 3,  27 => 2,);
    }
}
