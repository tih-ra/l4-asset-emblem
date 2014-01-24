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

        $content = str_replace('"', '\\"', $asset->getContent());
        $content = str_replace(PHP_EOL, "", $content);

        //$jst = 'JST = (typeof JST === "undefined") ? JST = {} : JST;' . PHP_EOL;
        $jst .= 'Ember.TEMPLATE["' . $filename . '"] = Emblem.compile(Handlebars, "';
        $jst .= $content;
        $jst .= '");' . PHP_EOL;

        $asset->setContent($jst);
    }
}