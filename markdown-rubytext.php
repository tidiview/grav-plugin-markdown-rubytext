<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class MarkdownRubytextPlugin
 * @package Grav\Plugin
 */
class MarkdownRubytextPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onMarkdownInitialized' => [
                ['onMarkdownInitialized', 0]
            ]
        ];
    }

    /**
    * Composer autoload.
    *is
    * @return ClassLoader
    */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onMarkdownInitialized(Event $event)
    {
        $markdown = $event['markdown'];
        // Initialize Text example
        $markdown->addInlineType('{', 'RubyText');
        // Add function to handle this
        $markdown->inlineRubyText = function($excerpt) {
            if (preg_match('/(*UTF8)\{r}([^\s{]+){\/r}|{r=([a-z]{2,3})\/([a-z]{2,3})}([^\s{]+){\/r}/', $excerpt['text'], $match))
            {
                $matchright = array_slice($match,1);
                $rubyatt = 'ruby';
                $rbatt = 'rt';
                if ($matchright[0] == "") {
                    $matchright[0] = $matchright[3];
                    $rubyatt = 'ruby lang="'.$matchright[1].'"';
                    $rbatt = 'rt lang="'.$matchright[2].'"';
                };
                $matchleftright = rtrim($matchright[0],')');
                $extract = explode (')',$matchleftright);
                $out = "";

                foreach ($extract as $value) {
                $value = explode('(',$value);
                $out .= $value[0].'<rp>(</rp><'.$rbatt.'>'.$value[1].'</rb><rp>)</rp>';
                };
                $totout = array(
                  'extent' => strlen($match[0]),
                  'element' => array(
                    'name' => $rubyatt,
                    'text' => $out
                    ));
                return
                $totout;
            }
        };
    }
}
