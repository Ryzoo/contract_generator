<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/pstrona_school/templates/layout/page.html.twig */
class __TwigTemplate_14f6ea3123234e8a2d451546fa3f988baeb665097dd2f798407eeb68e306648a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 52];
        $filters = ["escape" => 53];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 35
        echo "
";
        // line 37
        echo "<div id=\"loading\">
    <div id=\"loading-center\">
        <div id=\"loading-center-absolute\">
            <div class=\"object\" id=\"object_four\"></div>
            <div class=\"object\" id=\"object_three\"></div>
            <div class=\"object\" id=\"object_two\"></div>
            <div class=\"object\" id=\"object_one\"></div>
        </div>
    </div>
</div>
";
        // line 48
        echo "
<div class=\"layout-container\">

    <header role=\"banner\">
        ";
        // line 52
        if ($this->getAttribute(($context["page"] ?? null), "topbar", [])) {
            // line 53
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topbar", [])), "html", null, true);
            echo "
        ";
        }
        // line 55
        echo "        <div class=\"navigation-container\">
            ";
        // line 56
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
        echo "
        </div>
    </header>
    ";
        // line 59
        if ($this->getAttribute(($context["page"] ?? null), "slider", [])) {
            // line 60
            echo "        <section class=\"main-slider\">
            ";
            // line 61
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "slider", [])), "html", null, true);
            echo "
        </section>
    ";
        }
        // line 64
        echo "
    ";
        // line 65
        if ($this->getAttribute(($context["page"] ?? null), "breadcrumbs", [])) {
            // line 66
            echo "        <section class=\"breadcrumbs-container\">
            ";
            // line 67
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "breadcrumbs", [])), "html", null, true);
            echo "
        </section>
    ";
        }
        // line 70
        echo "
    <main role=\"main\">
        ";
        // line 72
        if ($this->getAttribute(($context["page"] ?? null), "messages", [])) {
            // line 73
            echo "            <section class=\"container status-messages-container\">
                <div class=\"row\">
                    <div class=\"col\">
                        ";
            // line 76
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "messages", [])), "html", null, true);
            echo "
                    </div>
                </div>
            </section>
        ";
        }
        // line 81
        echo "
        <div class=\"";
        // line 82
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container_class"] ?? null)), "html", null, true);
        echo " \">
            ";
        // line 83
        if ($this->getAttribute(($context["page"] ?? null), "leftsidebar", [])) {
            // line 84
            echo "                ";
            if ($this->getAttribute(($context["page"] ?? null), "rightsidebar", [])) {
                // line 85
                echo "                    <div class=\"row\">
                        <div class=\"col-md-12 col-lg-3\">
                            ";
                // line 87
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "leftsidebar", [])), "html", null, true);
                echo "
                        </div>
                        <div class=\"col-md-12 col-lg-6\">
                            ";
                // line 90
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
                echo "
                        </div>
                        <div class=\"col-md-12 col-lg-3\">
                            ";
                // line 93
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "rightsidebar", [])), "html", null, true);
                echo "
                        </div>
                    </div>
                ";
            } else {
                // line 97
                echo "                    <div class=\"row\">
                        <div class=\"col-sm-12 col-md-3\">
                            ";
                // line 99
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "leftsidebar", [])), "html", null, true);
                echo "
                        </div>
                        <div class=\"col-sm-12 col-md-9\">
                            ";
                // line 102
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
                echo "
                        </div>
                    </div>
                ";
            }
            // line 106
            echo "            ";
        } elseif ($this->getAttribute(($context["page"] ?? null), "rightsidebar", [])) {
            // line 107
            echo "                <div class=\"row\">
                    <div class=\"col-sm-12 col-md-9\">
                        ";
            // line 109
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
                    </div>
                    <div class=\"col-sm-12 col-md-3\">
                        ";
            // line 112
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "rightsidebar", [])), "html", null, true);
            echo "
                    </div>
                </div>
            ";
        } else {
            // line 116
            echo "                ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
            ";
        }
        // line 118
        echo "        </div>
    </main>

    ";
        // line 121
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 122
            echo "        <footer role=\"contentinfo\">
            ";
            // line 123
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
        </footer>
    ";
        }
        // line 126
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "themes/pstrona_school/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 126,  225 => 123,  222 => 122,  220 => 121,  215 => 118,  209 => 116,  202 => 112,  196 => 109,  192 => 107,  189 => 106,  182 => 102,  176 => 99,  172 => 97,  165 => 93,  159 => 90,  153 => 87,  149 => 85,  146 => 84,  144 => 83,  140 => 82,  137 => 81,  129 => 76,  124 => 73,  122 => 72,  118 => 70,  112 => 67,  109 => 66,  107 => 65,  104 => 64,  98 => 61,  95 => 60,  93 => 59,  87 => 56,  84 => 55,  78 => 53,  76 => 52,  70 => 48,  58 => 37,  55 => 35,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme override to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}

{# Preloader #}
<div id=\"loading\">
    <div id=\"loading-center\">
        <div id=\"loading-center-absolute\">
            <div class=\"object\" id=\"object_four\"></div>
            <div class=\"object\" id=\"object_three\"></div>
            <div class=\"object\" id=\"object_two\"></div>
            <div class=\"object\" id=\"object_one\"></div>
        </div>
    </div>
</div>
{# Preloader end #}

<div class=\"layout-container\">

    <header role=\"banner\">
        {% if page.topbar %}
            {{ page.topbar }}
        {% endif %}
        <div class=\"navigation-container\">
            {{ page.header }}
        </div>
    </header>
    {% if page.slider %}
        <section class=\"main-slider\">
            {{ page.slider }}
        </section>
    {% endif %}

    {% if page.breadcrumbs %}
        <section class=\"breadcrumbs-container\">
            {{ page.breadcrumbs }}
        </section>
    {% endif %}

    <main role=\"main\">
        {% if page.messages %}
            <section class=\"container status-messages-container\">
                <div class=\"row\">
                    <div class=\"col\">
                        {{ page.messages }}
                    </div>
                </div>
            </section>
        {% endif %}

        <div class=\"{{ container_class }} \">
            {% if page.leftsidebar %}
                {% if page.rightsidebar %}
                    <div class=\"row\">
                        <div class=\"col-md-12 col-lg-3\">
                            {{ page.leftsidebar }}
                        </div>
                        <div class=\"col-md-12 col-lg-6\">
                            {{ page.content }}
                        </div>
                        <div class=\"col-md-12 col-lg-3\">
                            {{ page.rightsidebar }}
                        </div>
                    </div>
                {% else %}
                    <div class=\"row\">
                        <div class=\"col-sm-12 col-md-3\">
                            {{ page.leftsidebar }}
                        </div>
                        <div class=\"col-sm-12 col-md-9\">
                            {{ page.content }}
                        </div>
                    </div>
                {% endif %}
            {% elseif page.rightsidebar %}
                <div class=\"row\">
                    <div class=\"col-sm-12 col-md-9\">
                        {{ page.content }}
                    </div>
                    <div class=\"col-sm-12 col-md-3\">
                        {{ page.rightsidebar }}
                    </div>
                </div>
            {% else %}
                {{ page.content }}
            {% endif %}
        </div>
    </main>

    {% if page.footer %}
        <footer role=\"contentinfo\">
            {{ page.footer }}
        </footer>
    {% endif %}

</div>{# /.layout-container #}
", "themes/pstrona_school/templates/layout/page.html.twig", "/var/www/html/web/themes/pstrona_school/templates/layout/page.html.twig");
    }
}
