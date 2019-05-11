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

/* themes/pstrona_school/templates/views/views-view.html.twig */
class __TwigTemplate_ee164c96795190748f633322889844520bec52b4efe017b59e3d6938e072e80b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 34, "if" => 42, "trans" => 46];
        $filters = ["clean_class" => 36, "escape" => 50];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['clean_class', 'escape'],
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
        // line 34
        $context["classes"] = [0 => "view", 1 => ("view-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 36
($context["id"] ?? null)))), 2 => ("view-id-" . $this->sandbox->ensureToStringAllowed(        // line 37
($context["id"] ?? null))), 3 => ("view-display-id-" . $this->sandbox->ensureToStringAllowed(        // line 38
($context["display_id"] ?? null))), 4 => ((        // line 39
($context["dom_id"] ?? null)) ? (("js-view-dom-id-" . $this->sandbox->ensureToStringAllowed(($context["dom_id"] ?? null)))) : (""))];
        // line 42
        if ( !twig_test_empty(($context["rows"] ?? null))) {
        } else {
            // line 44
            echo "    <div class=\"text-center no-content\">
        <h1>
            ";
            // line 46
            echo t("W tej chwili nie ma do wyświetlenia żadnej zawartości.", array());
            // line 47
            echo "        </h1>
    </div>
";
        }
        // line 50
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
    ";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
        echo "
    ";
        // line 52
        if (($context["title"] ?? null)) {
            // line 53
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "
    ";
        }
        // line 55
        echo "    ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        echo "
    ";
        // line 56
        if (($context["header"] ?? null)) {
            // line 57
            echo "        <div class=\"view-header\">
            ";
            // line 58
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["header"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 61
        echo "    ";
        if (($context["exposed"] ?? null)) {
            // line 62
            echo "        <div class=\"view-filters\">
            ";
            // line 63
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["exposed"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 66
        echo "    ";
        if (($context["attachment_before"] ?? null)) {
            // line 67
            echo "        <div class=\"attachment attachment-before\">
            ";
            // line 68
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attachment_before"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 71
        echo "
    ";
        // line 72
        if (($context["rows"] ?? null)) {
            // line 73
            echo "        <div class=\"view-content\">
            ";
            // line 74
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["rows"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        } elseif (        // line 76
($context["empty"] ?? null)) {
            // line 77
            echo "        <div class=\"view-empty\">
            ";
            // line 78
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["empty"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 81
        echo "
    ";
        // line 82
        if (($context["pager"] ?? null)) {
            // line 83
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pager"] ?? null)), "html", null, true);
            echo "
    ";
        }
        // line 85
        echo "    ";
        if (($context["attachment_after"] ?? null)) {
            // line 86
            echo "        <div class=\"attachment attachment-after\">
            ";
            // line 87
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attachment_after"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 90
        echo "    ";
        if (($context["more"] ?? null)) {
            // line 91
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["more"] ?? null)), "html", null, true);
            echo "
    ";
        }
        // line 93
        echo "    ";
        if (($context["footer"] ?? null)) {
            // line 94
            echo "        <div class=\"view-footer\">
            ";
            // line 95
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 98
        echo "    ";
        if (($context["feed_icons"] ?? null)) {
            // line 99
            echo "        <div class=\"feed-icons\">
            ";
            // line 100
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["feed_icons"] ?? null)), "html", null, true);
            echo "
        </div>
    ";
        }
        // line 103
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/pstrona_school/templates/views/views-view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 103,  206 => 100,  203 => 99,  200 => 98,  194 => 95,  191 => 94,  188 => 93,  182 => 91,  179 => 90,  173 => 87,  170 => 86,  167 => 85,  161 => 83,  159 => 82,  156 => 81,  150 => 78,  147 => 77,  145 => 76,  140 => 74,  137 => 73,  135 => 72,  132 => 71,  126 => 68,  123 => 67,  120 => 66,  114 => 63,  111 => 62,  108 => 61,  102 => 58,  99 => 57,  97 => 56,  92 => 55,  86 => 53,  84 => 52,  80 => 51,  75 => 50,  70 => 47,  68 => 46,  64 => 44,  61 => 42,  59 => 39,  58 => 38,  57 => 37,  56 => 36,  55 => 34,);
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
 * Theme override for a main view template.
 *
 * Available variables:
 * - attributes: Remaining HTML attributes for the element.
 * - css_name: A css-safe version of the view name.
 * - css_class: The user-specified classes names, if any.
 * - header: The optional header.
 * - footer: The optional footer.
 * - rows: The results of the view query, if any.
 * - empty: The content to display if there are no rows.
 * - pager: The optional pager next/prev links to display.
 * - exposed: Exposed widget form/info to display.
 * - feed_icons: Optional feed icons to display.
 * - more: An optional link to the next page of results.
 * - title: Title of the view, only used when displaying in the admin preview.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the view title.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the view title.
 * - attachment_before: An optional attachment view to be displayed before the
 *   view content.
 * - attachment_after: An optional attachment view to be displayed after the
 *   view content.
 * - dom_id: Unique id for every view being printed to give unique class for
 *   Javascript.
 *
 * @see template_preprocess_views_view()
 */
#}
{%
    set classes = [
    'view',
    'view-' ~ id|clean_class,
    'view-id-' ~ id,
    'view-display-id-' ~ display_id,
    dom_id ? 'js-view-dom-id-' ~ dom_id,
]
%}
{% if rows is not empty %}
{% else %}
    <div class=\"text-center no-content\">
        <h1>
            {% trans %}W tej chwili nie ma do wyświetlenia żadnej zawartości.{% endtrans %}
        </h1>
    </div>
{% endif %}
<div{{ attributes.addClass(classes) }}>
    {{ title_prefix }}
    {% if title %}
        {{ title }}
    {% endif %}
    {{ title_suffix }}
    {% if header %}
        <div class=\"view-header\">
            {{ header }}
        </div>
    {% endif %}
    {% if exposed %}
        <div class=\"view-filters\">
            {{ exposed }}
        </div>
    {% endif %}
    {% if attachment_before %}
        <div class=\"attachment attachment-before\">
            {{ attachment_before }}
        </div>
    {% endif %}

    {% if rows %}
        <div class=\"view-content\">
            {{ rows }}
        </div>
    {% elseif empty %}
        <div class=\"view-empty\">
            {{ empty }}
        </div>
    {% endif %}

    {% if pager %}
        {{ pager }}
    {% endif %}
    {% if attachment_after %}
        <div class=\"attachment attachment-after\">
            {{ attachment_after }}
        </div>
    {% endif %}
    {% if more %}
        {{ more }}
    {% endif %}
    {% if footer %}
        <div class=\"view-footer\">
            {{ footer }}
        </div>
    {% endif %}
    {% if feed_icons %}
        <div class=\"feed-icons\">
            {{ feed_icons }}
        </div>
    {% endif %}
</div>
", "themes/pstrona_school/templates/views/views-view.html.twig", "/var/www/html/web/themes/pstrona_school/templates/views/views-view.html.twig");
    }
}
