<?php
namespace NGS;
use NGS\Client\RestHttp;
use Dsl\ActionHistory;

class Config {
    public static $skipDiff = false;
    public static $confirmUnsafe = false;
    public static $ignore = false;
    public static $html = true;
    public static $rebuild = true;

    public static function init() {
        if (PHP_SAPI !== 'cli')
            self::initHtml();
        else
            self::paramsCLI();
    }

    private static function initHtml()
    {
        $URI = $_SERVER['REQUEST_URI'];

        self::$skipDiff = defined('NGS_UPDATE_SKIP_DIFF') && NGS_UPDATE_SKIP_DIFF;
        self::$skipDiff = self::$skipDiff || array_key_exists('_dsl_platform_confirm_diff', $_POST);

        self::$confirmUnsafe = array_key_exists('_dsl_platform_confirm_unsafe', $_POST);
        self::$rebuild = !defined('NGS_UPDATE') || (NGS_UPDATE != false && preg_match(NGS_UPDATE, $URI));
        self::$ignore = array_key_exists('_dsl_platform_ignore_diff', $_POST);

        self::$html = true;
    }

    private static function paramsCLI()
    {
        $options = getopt(null, array('skip-diff', 'confirm-unsafe', 'help'));
        if (array_key_exists('help', $options)) {
            echo <<<EOF
Command line arguments:
    --skip-diff
        Don't show the difference between local and remote DSL

    --confirm-unsafe
        Confirms unsafe database migrations without asking.

PHP defines:
    NGS_UPDATE_SKIP_DIFF
        same as --skip-diff. Set to value that evaluates to true to skip it.

    NGS_UPDATE
        If undefined, compilation process will begin automatically when DSL files changes.
        That's good for development environment.

        If set to expression that evaluates to false, compilation process will never start.
        That's good for production environment.

        Otherwise it is expected to be a string containing regular expression.
        This regex is then matched with URL. Only if it matches the compilation proccess begins.
        This allows you to control when you want to compile by changeing the URL in the location bar.
EOF;
            die;
        }

        self::$skipDiff = array_key_exists('skip-diff', $options);
        self::$confirmUnsafe = array_key_exists('confirm-unsafe', $options);
        self::$rebuild = true;
        self::$ignore = false;
        self::$html = false;
    }
}

Config::init();

try {
    // Autoload NGS + generated modules
    require_once __DIR__.'/Project.php';

    function doXtimes($x, $cb) {
        $res = false;
        for ($i = 0; $i < 3 && !$res; $i++) {
            $res = $cb();
        }
        if ($res === false)
            exit (255);

        return $res;
    }

    if (PHP_SAPI === 'cli') {
        require_once __DIR__.'/Compiler.php';

        $res = doXtimes(3, function() {
            return Compiler::checkRebuild();
        });

        if ($res === "diff") {
            $tmp = doXtimes(3, function() {
                if (file_exists(__DIR__.'/../modules/NGS/Requirements.php'))
                    echo '[C]onfirm / [I]gnore?: ';
                else
                    echo '[C]onfirm? ';

                $in = rtrim(fgets(STDIN), "\n\r");
                echo PHP_EOL;

                switch(strtolower($in)) {
                    case 'c':
                        Config::$skipDiff = true;
                        break;

                    case 'i':
                        if (!file_exists(__DIR__.'/../modules/NGS/Requirements.php')) {
                            echo "Can't ignore the first compilation!", PHP_EOL;
                            return false;
                        }
                        Config::$ignore = true;
                        break;

                    default:
                        return false;
                }

                return true;
            });
            if ($tmp)
                $res = Compiler::checkRebuild();
        }

        if ($res === 'confirm') {
            $res = doXtimes(3, function () {
                echo 'Confirm [y/n]? ';
                $in = rtrim(fgets(STDIN), "\n\r");
                echo PHP_EOL;

                switch (strtolower($in)) {
                    case 'y':
                        Config::$confirmUnsafe = true;
                        return true;

                    case 'n':
                        exit(0);
                }

                return false;
            });
            if ($res)
                Compiler::checkRebuild();
        }
    }

    else {
        // Recompiles DSL, generates sources
        require_once __DIR__.'/Compiler.php';
        $res = Compiler::checkRebuild();

        if ($res === 'diff' || $res === 'confirm')
            exit(0);

        if (Login::needReload()) {
            $redirect = sprintf('Location: %s://%s%s',
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https': 'http',
                $_SERVER['HTTP_HOST'],
                $_SERVER['REQUEST_URI']);

            header($redirect);
            exit (0);
        }
    }

    // Loads static platform components
    require_once __DIR__.'/../modules/NGS/Requirements.php';

    // Loads dynamic platform components
    require_once __DIR__.'/../modules/Modules.php';

    // Initializes the RestHttp connection
    RestHttp::instance(new RestHttp(
        Project::$apiUrl,
        Project::$username,
        Project::$ID
    ));
    RestHttp::instance()->setCertificate(__DIR__.'/../startssl-ca.pem');
} catch (\Exception $e) {
    if (Config::$html)
        \Bootstrap::remotePredefinedError('error', $e->getMessage());
    else
        echo $e->getMessage(), PHP_EOL;

    exit (0);
}
