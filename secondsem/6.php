<?php
class BST{
    public $data;
    public $left;
    public $right;

    public function __construct($data){
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }

    public function insert($data) {
        if ($data <$this->data) {
            if ($this->left === null) {
                $this->left = new BST ($data);
            } else {
                $this->left->insert($data);
            }
        }elseif ($data> $this->data) {
            if ($this->right === null) {
                $this->right = new BST ($data);
            } else {
                $this->right->insert($data);
            }
        }
    }
    public function displayTree($space = 0, $level =5 ) {
        echo str_repeat("", $space) . $this->data . "\n";

        if ($this->right !== null) {
            $this->right->displayTree($space +$level);
    }
    if ($this->left !== null) {
        $this->left->displayTree($space +$level);
    }
}
}

$root = new BST(9);
$elements = [5, 10, 13, 4, 15, 20, 1, 6, 8];
foreach ($elements as $element) {
    $root->insert($element);
}

echo "BST Pattern:\n";
$root->displayTree();
?>