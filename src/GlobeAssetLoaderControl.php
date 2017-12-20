<?php

/*
 * Copyright 2017 David Fires Stein.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace davidsteincz\globe\control\globeassetloader;

use Nette;

class GlobeAssetLoaderControl extends \Nette\Application\UI\Control {

    private $files;
    private $remoteFiles;
    private $baseUrl;
    private $cssFolder;
    private $jsFolder;

    function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
        $this->files['css'] = array();
        $this->files['map'] = array();
        $this->files['js'] = array();
        $this->remoteFiles['css'] = array();
        $this->remoteFiles['js'] = array();
    }


    private function addFile($type, $file) {
        $this->files[$type][] = $file;
    }

    public function addFiles($files) {
        try {
            foreach ($files as $filePath => $file) {
                switch ($file->getExtension()) {
                    case 'css':
                        $this->files['css'][] = $file;
                        break;
                    case 'map':
                        $this->files['map'][] = $file;
                        break;
                    case 'js':
                        $this->files['js'][] = $file;
                        break;
                }
            }
        } catch (\UnexpectedValueException $ex) {
            \Tracy\Debugger::log($ex, \Tracy\Debugger::WARNING);
        }
    }

    public function addRemoteFile($file, $type) {
        $this->remoteFiles[$type][] = $file;
    }

    public function renderCss() {
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/css.latte');
        $template->baseUrl = $this->baseUrl;
        $template->cssFolder = $this->cssFolder;
        $template->cssFiles = $this->files['css'];
        $template->remoteFiles = $this->remoteFiles['css'];
        $template->render();
    }

    public function renderJs() {
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/js.latte');
        $template->baseUrl = $this->baseUrl;
        $template->jsFolder = $this->jsFolder;
        $template->jsFiles = $this->files['js'];
        $template->remoteFiles = $this->remoteFiles['js'];
        $template->render();
    }

    function getBaseUrl() {
        return $this->baseUrl;
    }

    function getCssFolder() {
        return $this->cssFolder;
    }

    function getJsFolder() {
        return $this->jsFolder;
    }

    function setBaseUrl($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    function setCssFolder($cssFolder) {
        $this->cssFolder = $cssFolder;
    }

    function setJsFolder($jsFolder) {
        $this->jsFolder = $jsFolder;
    }

    function getFiles() {
        return $this->files;
    }

}
