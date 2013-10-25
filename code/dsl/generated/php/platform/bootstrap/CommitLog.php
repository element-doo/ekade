<?php
namespace NGS;

class CommitLog
{
    const SKIPPED     = 'skipping';
    const CREATED_DIR = 'creating directory';
    const CREATED     = 'creating';
    const NO_CHANGE   = 'up to date, skipping';
    const REPLACED    = 'replacing';
    const DELETED_DIR = 'deleting directory';
    const DELETED     = 'deleting';

    public $actions = array();

    private function addAction($path, $action, $status)
    {
        $this->actions[$path] = array($action => $status);
    }

    public function skip($path)
    {
        $this->addAction($path, self::SKIPPED, true);
    }

    public function createDir($path, $created)
    {
        $this->addAction($path, self::CREATED_DIR, $created);
    }

    public function create($path, $created)
    {
        $this->addAction($path, self::CREATED, $created);
    }

    public function noChange($path)
    {
        $this->addAction($path, self::NO_CHANGE, true);
    }

    public function replace($path, $replaced)
    {
        $this->addAction($path, self::REPLACED, $replaced);
    }

    public function delete($path, $deleted)
    {
        $this->addAction($path, self::DELETED, $deleted);
    }

    public function deleteDir($path, $deleted)
    {
        $this->addAction($path, self::DELETED_DIR, $deleted);
    }

    public function isAllOk()
    {
        foreach($this->actions as $actions) {
            foreach($actions as $success) {
                if ($success !== true) return false;
            }
        }

        return true;
    }

    public function __toString()
    {
        ob_start();

        $sorted = $this->actions;
        ksort($sorted);
?>
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Path</th>
            </tr>
        </thead>
        <tbody>
<?php foreach($sorted as $path => $actions):?>
<?php foreach($actions as $action => $success):?>
<?php if (!$success):?>
            <tr style="background:<?=$success ? '#aaffaa' : '#ff0000'?>;">
                <td><?=htmlspecialchars($action);?>... <?=
                     $success ? '(ok)' : '(ERROR!)'; ?></td>
                <td><?=htmlspecialchars($path);?></td>
            </tr>
<?php endif;?>
<?php endforeach;?>
<?php endforeach;?>
        </tbody>
    </table>
<?php
        return ob_get_clean();
    }
}
