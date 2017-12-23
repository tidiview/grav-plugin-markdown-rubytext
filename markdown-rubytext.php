<?php
namespace Grav\Plugin;
use \Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
class MarkdownRubyTextPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
        ];
    }
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
