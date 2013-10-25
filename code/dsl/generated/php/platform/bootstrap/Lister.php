<?php
namespace NGS;

class Lister
{
    private $path;
    private $pattern;
    private $encoding;

    public $sizes;
    public $hashes;
    public $bodies;

    public $dirs;
    public $aggHash;

    public function __construct($path, $pattern = '.*', $encoding = 'UTF-8')
    {
        $this->path = $path;
        $this->pattern = $pattern;
        $this->encoding = $encoding;

        $this->sizes = array();
        $this->hashes = array();
        $this->bodies = array();

        $this->readFiles();
        $this->aggHash = self::hashHashes($this->hashes);
    }

    private function readFiles($rel = '.')
    {
        $dir = $this->path.$rel;
        $this->dirs[$rel] = $dir;

        $parent = opendir($dir);
        if ($parent === false) {
            throw new \Exception('Could not read the DSL folder: '.$dir);
        }

        while (true) {
            $filename = readdir($parent);
            if ($filename === false) {
                break;
            }

            if ($filename === '.' || $filename === '..') {
                continue;
            }

            $relFile = ($rel === '.') ? $filename : $rel.'/'.$filename;
            $path = $this->path.$relFile;

            if (is_dir($path)) {
                $this->readFiles($relFile);
            }
            elseif (is_file($path) && preg_match('/^'.$this->pattern.'$/u', $relFile)) {
                $body = file_get_contents($path);

                if ($this->encoding !== null && !mb_check_encoding($body, $this->encoding)) {
                    throw new \Exception("Wrong encoding detected in file '$relFile'. Please convert it to UTF-8.");
                }

                $this->sizes[$relFile] = strlen($body);
                $this->hashes[$relFile] = sha1($body . $relFile, true);
                $this->bodies[$relFile] = $body;
            }
        }

        closedir($parent);
    }

    private static function hashHashes($hashes)
    {
        sort($hashes);
        $agg = implode('', $hashes);
        return sha1($agg, true);
    }
}
