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

/* registration/register.html.twig */
class __TwigTemplate_76f08b229a16514ef044c9559b952012b2e6a600e8756964aadb58459b0908e6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "registration/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "registration/register.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Register";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/css/register.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 6
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "    <div class=\"limiter\">
        <div class=\"container-login100\">
            <div class=\"wrap-login100\">
    <h1 class=\"blue_text mx-auto\">Créez votre compte</h1>

                ";
        // line 12
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 12, $this->source); })()), 'form_start', ["attr" => ["id" => "registration_form"]]);
        echo "

        <div>
            <h3 class=\"red_text\">Informations</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/img/heykeep_logo.png"), "html", null, true);
        echo "\" alt=\"logo mobile\">
                </div>
";
        // line 21
        echo "                ";
        // line 22
        echo "                ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 22, $this->source); })()), "email", [], "any", false, false, false, 22), 'row');
        echo "
                ";
        // line 24
        echo "                ";
        // line 25
        echo "                ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 25, $this->source); })()), "plainPassword", [], "any", false, false, false, 25), 'row');
        echo "
                <label for=\"confirm\">Confirmez mot de passe *</label>
                <input id=\"confirm\" name=\"confirm\" type=\"text\" class=\"required\">
                <p>(*) Items obligatoires</p>
            </section>
            <h3 class=\"red_text\">Profil</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/img/heykeep_logo.png"), "html", null, true);
        echo "\" alt=\"logo mobile\">
                </div>
                ";
        // line 36
        echo "                ";
        // line 37
        echo "                ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 37, $this->source); })()), "name", [], "any", false, false, false, 37), 'row');
        echo "
                <label for=\"name\">Prénom *</label>
                <input id=\"name\" name=\"name\" type=\"text\" class=\"required\">
                <label for=\"surname\">Nom *</label>
                <input id=\"surname\" name=\"surname\" type=\"text\" class=\"required\">

                <p>(*) Items obligatoires</p>
            </section>
            <h3 class=\"red_text\">Validation</h3>
            <section  class=\"cgv\">
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/img/heykeep_logo.png"), "html", null, true);
        echo "\" alt=\"logo mobile\">
                </div>
                <div>
                    <h4 class=\"blue_text\">conditions générales d'utilisation</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Massa tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada. Nibh nisl condimentum id venenatis a condimentum vitae sapien. Nunc scelerisque viverra mauris in aliquam sem fringilla. Donec massa sapien faucibus et molestie. Sed risus pretium quam vulputate dignissim suspendisse in. Aliquam sem et tortor consequat id porta nibh venenatis cras. Imperdiet dui accumsan sit amet nulla facilisi morbi. Imperdiet dui accumsan sit amet. Diam vulputate ut pharetra sit amet. Molestie ac feugiat sed lectus. Aliquet nec ullamcorper sit amet risus nullam.

                        Massa tempor nec feugiat nisl pretium. Sit amet tellus cras adipiscing enim eu turpis egestas pretium. Elementum tempus egestas sed sed risus pretium. Amet aliquam id diam maecenas ultricies mi. Turpis egestas integer eget aliquet nibh praesent tristique. Pellentesque dignissim enim sit amet. Vel facilisis volutpat est velit egestas dui. Velit ut tortor pretium viverra suspendisse potenti. Consequat ac felis donec et odio pellentesque diam volutpat. Orci sagittis eu volutpat odio facilisis mauris sit amet massa. Tempor commodo ullamcorper a lacus vestibulum sed arcu non odio. Mattis vulputate enim nulla aliquet porttitor lacus. Egestas erat imperdiet sed euismod nisi. Urna id volutpat lacus laoreet non. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque purus. Risus pretium quam vulputate dignissim suspendisse in est ante in. Consectetur lorem donec massa sapien faucibus et molestie ac. Molestie at elementum eu facilisis sed odio morbi quis commodo. Odio euismod lacinia at quis risus sed vulputate odio.

                        Nec dui nunc mattis enim ut tellus elementum sagittis. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Vel quam elementum pulvinar etiam non quam lacus suspendisse. Aliquet sagittis id consectetur purus ut faucibus pulvinar elementum integer. Aliquam nulla facilisi cras fermentum odio eu. Ut venenatis tellus in metus. Duis convallis convallis tellus id interdum velit laoreet id. Vulputate ut pharetra sit amet aliquam. At tellus at urna condimentum. Mi proin sed libero enim sed. Eget magna fermentum iaculis eu non diam phasellus vestibulum. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet proin. Commodo sed egestas egestas fringilla. Vitae sapien pellentesque habitant morbi tristique senectus. Duis at consectetur lorem donec. Duis convallis convallis tellus id interdum velit laoreet id. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Suspendisse interdum consectetur libero id faucibus. Nec sagittis aliquam malesuada bibendum arcu. Dignissim suspendisse in est ante in nibh.

                        Pellentesque pulvinar pellentesque habitant morbi. Phasellus faucibus scelerisque eleifend donec pretium. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu. Tincidunt arcu non sodales neque. Eget est lorem ipsum dolor. Porttitor leo a diam sollicitudin tempor id eu nisl. Sollicitudin ac orci phasellus egestas tellus rutrum tellus. Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Ultricies lacus sed turpis tincidunt id. Amet tellus cras adipiscing enim. Orci dapibus ultrices in iaculis nunc. Orci ac auctor augue mauris augue neque gravida. Gravida cum sociis natoque penatibus et.

                        Tempus egestas sed sed risus pretium quam vulputate dignissim. Nec ultrices dui sapien eget. Nisi lacus sed viverra tellus in hac habitasse platea. Tincidunt vitae semper quis lectus nulla at volutpat diam ut. In iaculis nunc sed augue lacus viverra vitae. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean. Purus in mollis nunc sed. Aenean euismod elementum nisi quis eleifend quam adipiscing. Purus semper eget duis at tellus at urna condimentum. Non curabitur gravida arcu ac tortor. Neque sodales ut etiam sit. Eleifend mi in nulla posuere. Mattis vulputate enim nulla aliquet porttitor. Sapien pellentesque habitant morbi tristique senectus. Viverra mauris in aliquam sem fringilla. Viverra nibh cras pulvinar mattis. Sodales neque sodales ut etiam sit amet. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque.</p>
                </div>
";
        // line 64
        echo "                ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 64, $this->source); })()), "agreeTerms", [], "any", false, false, false, 64), 'row');
        echo "
            </section>
            <h3 class=\"red_text\">Récapitulatif</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/img/heykeep_logo.png"), "html", null, true);
        echo "\" alt=\"logo mobile\">
                </div>
                <div>
                    <p>Votre e-mail est : <span id=\"recapitulatif-email\"></span></p>
                </div>
";
        // line 75
        echo "            </section>
        </div>
                ";
        // line 77
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["registrationForm"]) || array_key_exists("registrationForm", $context) ? $context["registrationForm"] : (function () { throw new RuntimeError('Variable "registrationForm" does not exist.', 77, $this->source); })()), 'form_end');
        echo "


            </div>
        </div>
    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 84
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 85
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("plugins/validator/jquery.validate.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 86
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/js/jquery.steps.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 87
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("heykeep/js/register.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "registration/register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  250 => 87,  246 => 86,  241 => 85,  231 => 84,  214 => 77,  210 => 75,  202 => 69,  193 => 64,  176 => 48,  161 => 37,  159 => 36,  154 => 33,  142 => 25,  140 => 24,  135 => 22,  133 => 21,  128 => 18,  119 => 12,  112 => 7,  102 => 6,  90 => 5,  80 => 4,  61 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Register{% endblock %}
{% block stylesheets %}
    <link href=\"{{ asset('heykeep/css/register.css') }}\" rel=\"stylesheet\" type=\"text/css\">{% endblock %}
{% block body %}
    <div class=\"limiter\">
        <div class=\"container-login100\">
            <div class=\"wrap-login100\">
    <h1 class=\"blue_text mx-auto\">Créez votre compte</h1>

                {{ form_start(registrationForm, {'attr': {'id': 'registration_form'}}) }}

        <div>
            <h3 class=\"red_text\">Informations</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"{{ asset('heykeep/img/heykeep_logo.png') }}\" alt=\"logo mobile\">
                </div>
{#                <label for=\"email\">Email *</label>#}
                {#                            <input id=\"email\" name=\"email\" type=\"text\" class=\"required email\">#}
                {{ form_row(registrationForm.email) }}
                {#<label for=\"plainPassword\">Mot de passe *</label>#}
                {# <input id=\"plainPassword\" name=\"plainPassword\" type=\"text\" class=\"required email\">#}
                {{ form_row(registrationForm.plainPassword) }}
                <label for=\"confirm\">Confirmez mot de passe *</label>
                <input id=\"confirm\" name=\"confirm\" type=\"text\" class=\"required\">
                <p>(*) Items obligatoires</p>
            </section>
            <h3 class=\"red_text\">Profil</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"{{ asset('heykeep/img/heykeep_logo.png') }}\" alt=\"logo mobile\">
                </div>
                {#  <label for=\"userName\">Pseudo *</label>#}
                {#                            <input id=\"userName\" name=\"userName\" type=\"text\" class=\"required\">#}
                {{ form_row(registrationForm.name) }}
                <label for=\"name\">Prénom *</label>
                <input id=\"name\" name=\"name\" type=\"text\" class=\"required\">
                <label for=\"surname\">Nom *</label>
                <input id=\"surname\" name=\"surname\" type=\"text\" class=\"required\">

                <p>(*) Items obligatoires</p>
            </section>
            <h3 class=\"red_text\">Validation</h3>
            <section  class=\"cgv\">
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"{{ asset('heykeep/img/heykeep_logo.png') }}\" alt=\"logo mobile\">
                </div>
                <div>
                    <h4 class=\"blue_text\">conditions générales d'utilisation</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Massa tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada. Nibh nisl condimentum id venenatis a condimentum vitae sapien. Nunc scelerisque viverra mauris in aliquam sem fringilla. Donec massa sapien faucibus et molestie. Sed risus pretium quam vulputate dignissim suspendisse in. Aliquam sem et tortor consequat id porta nibh venenatis cras. Imperdiet dui accumsan sit amet nulla facilisi morbi. Imperdiet dui accumsan sit amet. Diam vulputate ut pharetra sit amet. Molestie ac feugiat sed lectus. Aliquet nec ullamcorper sit amet risus nullam.

                        Massa tempor nec feugiat nisl pretium. Sit amet tellus cras adipiscing enim eu turpis egestas pretium. Elementum tempus egestas sed sed risus pretium. Amet aliquam id diam maecenas ultricies mi. Turpis egestas integer eget aliquet nibh praesent tristique. Pellentesque dignissim enim sit amet. Vel facilisis volutpat est velit egestas dui. Velit ut tortor pretium viverra suspendisse potenti. Consequat ac felis donec et odio pellentesque diam volutpat. Orci sagittis eu volutpat odio facilisis mauris sit amet massa. Tempor commodo ullamcorper a lacus vestibulum sed arcu non odio. Mattis vulputate enim nulla aliquet porttitor lacus. Egestas erat imperdiet sed euismod nisi. Urna id volutpat lacus laoreet non. Nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque purus. Risus pretium quam vulputate dignissim suspendisse in est ante in. Consectetur lorem donec massa sapien faucibus et molestie ac. Molestie at elementum eu facilisis sed odio morbi quis commodo. Odio euismod lacinia at quis risus sed vulputate odio.

                        Nec dui nunc mattis enim ut tellus elementum sagittis. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Vel quam elementum pulvinar etiam non quam lacus suspendisse. Aliquet sagittis id consectetur purus ut faucibus pulvinar elementum integer. Aliquam nulla facilisi cras fermentum odio eu. Ut venenatis tellus in metus. Duis convallis convallis tellus id interdum velit laoreet id. Vulputate ut pharetra sit amet aliquam. At tellus at urna condimentum. Mi proin sed libero enim sed. Eget magna fermentum iaculis eu non diam phasellus vestibulum. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet proin. Commodo sed egestas egestas fringilla. Vitae sapien pellentesque habitant morbi tristique senectus. Duis at consectetur lorem donec. Duis convallis convallis tellus id interdum velit laoreet id. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl rhoncus. Suspendisse interdum consectetur libero id faucibus. Nec sagittis aliquam malesuada bibendum arcu. Dignissim suspendisse in est ante in nibh.

                        Pellentesque pulvinar pellentesque habitant morbi. Phasellus faucibus scelerisque eleifend donec pretium. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu. Tincidunt arcu non sodales neque. Eget est lorem ipsum dolor. Porttitor leo a diam sollicitudin tempor id eu nisl. Sollicitudin ac orci phasellus egestas tellus rutrum tellus. Scelerisque eleifend donec pretium vulputate sapien nec sagittis aliquam. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Ultricies lacus sed turpis tincidunt id. Amet tellus cras adipiscing enim. Orci dapibus ultrices in iaculis nunc. Orci ac auctor augue mauris augue neque gravida. Gravida cum sociis natoque penatibus et.

                        Tempus egestas sed sed risus pretium quam vulputate dignissim. Nec ultrices dui sapien eget. Nisi lacus sed viverra tellus in hac habitasse platea. Tincidunt vitae semper quis lectus nulla at volutpat diam ut. In iaculis nunc sed augue lacus viverra vitae. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus aenean. Purus in mollis nunc sed. Aenean euismod elementum nisi quis eleifend quam adipiscing. Purus semper eget duis at tellus at urna condimentum. Non curabitur gravida arcu ac tortor. Neque sodales ut etiam sit. Eleifend mi in nulla posuere. Mattis vulputate enim nulla aliquet porttitor. Sapien pellentesque habitant morbi tristique senectus. Viverra mauris in aliquam sem fringilla. Viverra nibh cras pulvinar mattis. Sodales neque sodales ut etiam sit amet. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque.</p>
                </div>
{#                <label for=\"acceptTerms\">J'ai lu et j'accepte les conditions d'utilisations.</label>#}
{#                <input id=\"acceptTerms\" name=\"acceptTerms\" type=\"checkbox\" class=\"required\">#}
                {{ form_row(registrationForm.agreeTerms) }}
            </section>
            <h3 class=\"red_text\">Récapitulatif</h3>
            <section>
                <div class=\"register100-pic js-tilt mx-auto mb-3 mt-3\" data-tilt>
                    <img src=\"{{ asset('heykeep/img/heykeep_logo.png') }}\" alt=\"logo mobile\">
                </div>
                <div>
                    <p>Votre e-mail est : <span id=\"recapitulatif-email\"></span></p>
                </div>
{#                <button class=\"btn bg-red rounded-pill text-white mx-auto d-block\">Créez votre compte</button>#}
            </section>
        </div>
                {{ form_end(registrationForm) }}


            </div>
        </div>
    </div>
{% endblock %}
{% block javascripts %}
    <script src=\"{{ asset('plugins/validator/jquery.validate.js') }}\"></script>
    <script src=\"{{ asset('heykeep/js/jquery.steps.js') }}\"></script>
    <script src=\"{{ asset('heykeep/js/register.js') }}\"></script>
{% endblock %}
", "registration/register.html.twig", "D:\\workspace\\heykeep_server\\templates\\registration\\register.html.twig");
    }
}
