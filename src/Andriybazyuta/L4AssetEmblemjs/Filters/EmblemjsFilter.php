<?php namespace Andriybazyuta\L4AssetEmblemjs\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Codesleeve\AssetPipeline\Filters\FilterHelper;

class EmblemjsFilter extends FilterHelper implements FilterInterface 
{
    public function __construct($basePath = '/app/assets/javascripts/')
    {
        $this->basePath = $basePath;
    }

    public function filterLoad(AssetInterface $asset)
    {
        // do nothing when asset is loaded
    }
 
    public function filterDump(AssetInterface $asset)
    {
        $relativePath = ltrim($this->getRelativePath($this->basePath, $asset->getSourceRoot() . '/'), '/');
        $filename =  pathinfo($asset->getSourcePath(), PATHINFO_FILENAME);
        
        $filename = pathinfo($filename, PATHINFO_FILENAME);
        
        $dirname = dirname($relativePath);

        $content = str_replace('"', '\\"', $asset->getContent());
        $content = str_replace(PHP_EOL, "\\n", $content);
        
        //$jst = 'JST = (typeof JST === "undefined") ? JST = {} : JST;' . PHP_EOL;
        $emblem = 'Ember.TEMPLATES["' . $dirname . $filename . '"] = Emblem.compile(Ember.Handlebars, "';
        $emblem .= $content;
        $emblem .= '");' . PHP_EOL;

        $asset->setContent($emblem);
    }
}