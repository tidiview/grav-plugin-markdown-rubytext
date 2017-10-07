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
            if (preg_match('/(*UTF8)\{r}([^\s{]+){\/r}|{r=([a-z]{2,3})\/([a-z]{2,3})}([^\s{]+){\/r}/', $excerpt['text'], $matches))
            {
                $matchesminusun = array_slice($matches,1);
                $rubyattribute = 'ruby';
                $rbatttribute = 'rt';
                if ($matchesminusun[0] == "") {
                    $matchesminusun[0] = $matchesminusun[3];
                    $rubyattribute = 'ruby lang="'.$matchesminusun[1].'"';
                    $rbatttribute = 'rt lang="'.$matchesminusun[2].'"';
                };
                $strings = rtrim($matchesminusun[0],')');
                $extract = explode (')',$strings);
                $out = array();

                foreach ($extract as $value) {
                $value = explode('(',$value);
                $out = array_merge($out,array(array('name'=>'rb','text'=>$value[0]),array('name'=>'rp','text'=>'('),array('name'=>$rbatttribute,'text'=>$value[1]),array('name'=>'rp','text'=>')')));
                };

                return
                array(
                  'extent' => strlen($matches[0]),
                  'element' => array(
                    'name' => $rubyattribute,
                    'handler' => 'elements',
                    'text' => $out,
                    )
                );
            }
        };
    }
}
