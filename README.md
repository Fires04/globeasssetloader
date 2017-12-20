# README #
#USE in BasePresenter
```php
    protected function createComponentAssetLoader() {
        $control = new \davidsteincz\globe\control\globeassetloader\GlobeAssetLoaderControl(BASE_URL);
        $control->setCssFolder('/assets/css/');
        $control->setJsFolder('/assets/js/');

        $control->addFiles(Nette\Utils\Finder::findFiles('*.css')->in(BASE_DIR . '/www/assets/css/'));
        $control->addFiles(Nette\Utils\Finder::findFiles('*.js')->in(BASE_DIR . '/www/assets/js/'));

        $control->addRemoteFile('https://nette.github.io/resources/js/netteForms.min.js', 'js');
        $control->addRemoteFile('http://localhost:35729/livereload.js', 'js');

        return $control;
    }
```
#USE in Template
```html
<html> ....
{control assetLoader:css}

 
 

{control assetLoader:js}
....
</html>
```
