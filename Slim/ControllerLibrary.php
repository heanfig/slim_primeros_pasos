<?php
include_once("Slim.php");
include_once(ROOT . DS . 'application' . DS . 'views' . DS . 'RainTplView.php');

class App extends Slim {

  public function __construct() {
    parent::__construct(array(
        'templates.path' => TEMPLATE_PATH,
         'view' => new RainTplView()
    ));
    $this->container->singleton(
			'mysuperclass', function ($container) {
				return new MySuperClass();
			}
		);
  }
	public function __call($name, $params) {
		return function () use ($name, $params) {
			list($class, $action) = explode('_', $name . '_handle'); // default method is handle

			$args = [];
			$class = new \ReflectionClass($class);
			$constructor = $class->getConstructor();
			foreach ($constructor->getParameters() as $param) {
				$args[] = ($param->name === 'app') ? $this : $this->container->get($param->name);
			}
			$controller = $class->newInstanceArgs($args);
			return call_user_func([$controller, $action], func_get_args() + $params);
		};
	}
}

?>